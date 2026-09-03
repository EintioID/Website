import ctypes
import sys
import os

if sys.platform == "win32":
    try:
        ctypes.windll.shcore.SetProcessDpiAwareness(1)
    except Exception:
        try:
            ctypes.windll.user32.SetProcessDPIAware()
        except Exception:
            pass

import math
import tkinter as tk
import tkinter.font as tkfont
import customtkinter as ctk
from logic.game_manager import GameManager
from ui.effects import (
    draw_gradient, draw_grid_dots, draw_neon_lock, Confetti, animate_count, slide_in,
    pulse_label, FloatingParticles, bind_hover, draw_hearts, draw_badge_circle,
    draw_neon_glow_card, draw_neon_border, load_private_font,
    create_neon_icon, glow_behind_widget
)

BASE_DIR = os.path.dirname(os.path.abspath(__file__))
FONT_FILE = os.path.join(BASE_DIR, "assets", "fonts", "PressStart2P-Regular.ttf")
_FONT_LOADED = load_private_font(FONT_FILE)

ctk.set_appearance_mode("dark")
ctk.set_default_color_theme("blue")

try:
    ctk.deactivate_automatic_dpi_awareness()
except Exception:
    pass

W, H = 820, 660

BG_TOP = "#0A0E27"
BG_BOTTOM = "#141B3C"
NEON_CYAN = "#00D9FF"
NEON_MAGENTA = "#FF3EC9"
NEON_MAGENTA_LIGHT = "#FF8FE0"
NEON_GOLD = "#FFC107"
NEON_PURPLE = "#7B2FF7"
NEON_GREEN = "#00FFA3"
NEON_RED = "#FF4D6D"
CARD_BG = "#131A3A"
TEXT_MUTED = "#7C89B8"
WHITE = "#F0F4FF"

ACCENT = NEON_GOLD
ACCENT2 = NEON_MAGENTA
SUCCESS = NEON_GREEN
DANGER = NEON_RED
GOLD = NEON_GOLD
SKY = NEON_CYAN

_PIXEL_FONT_NAME = "Press Start 2P"
FONT_MAIN = "Segoe UI"
FONT_MONO = "Consolas"
FONT_EMOJI = "Segoe UI Emoji"
FONT_HEADER = "Agency FB"
IS_PIXEL = False

FS_CARD_TITLE = 19     # judul di dalam card (EASY, DECODE, dst)
FS_CARD_SUB = 13       # subjudul / deskripsi pendek
FS_CARD_BODY = 14      # isi paragraf dalam card
FS_LABEL_SMALL = 12    # label kecil (5 QUESTIONS, LOCKED, dst)

_HEADER_FALLBACK_CHAIN = [
    _PIXEL_FONT_NAME, "Agency FB", "Bahnschrift", "Arial Black", "Impact",
    "Segoe UI Black", "Segoe UI Semibold", "Verdana", "Arial", "Segoe UI",
]


def _resolve_header_font():
    try:
        available = set(tkfont.families())
    except Exception:
        return "Segoe UI"
    for family in _HEADER_FALLBACK_CHAIN:
        if family in available:
            return family
    return "Segoe UI"


class CaesarApp(ctk.CTk):
    def __init__(self):
        super().__init__()
        self.title("Caesar Cipher Challenge")
        self.geometry(f"{W}x{H}")
        self.resizable(False, False)
        self.protocol("WM_DELETE_WINDOW", self.request_exit)

        global FONT_HEADER, IS_PIXEL
        FONT_HEADER = _resolve_header_font()
        IS_PIXEL = (FONT_HEADER == _PIXEL_FONT_NAME)

        self.game = GameManager()
        self.time_left = 0
        self.timer_id = None
        self.confetti = None
        self.particles = None
        self._loose_widgets = []
        self._icon_refs = []
        self._cw, self._ch = W, H
        self._modal_widgets = []
        self._frozen_place = []
        self._frozen_canvas_windows = []

        self.canvas = tk.Canvas(self, width=W, height=H, highlightthickness=0, bd=0)
        self.canvas.pack(fill="both", expand=True)

        self.show_home()

    # ========== HELPERS ==========
    def hf(self, size):
        return size * 0.62 if IS_PIXEL else size

    def reset_screen(self, top_color, bottom_color, particles=False, grid=True):
        self.close_modal()
        if self.timer_id:
            self.after_cancel(self.timer_id)
            self.timer_id = None
        if self.confetti:
            self.confetti.stop()
            self.confetti = None
        if self.particles:
            self.particles.stop()
            self.particles = None

        for w in self._loose_widgets:
            try:
                w.destroy()
            except Exception:
                pass
        self._loose_widgets = []
        self._icon_refs = []

        self.canvas.delete("all")
        self.canvas._glow_refs = []
        self.canvas._heart_refs = []
        self.canvas._lock_refs = []
        self.update_idletasks()
        self._cw = self.winfo_width() or W
        self._ch = self.winfo_height() or H
        self.canvas.configure(width=self._cw, height=self._ch)
        draw_gradient(self.canvas, self._cw, self._ch, top_color, bottom_color)

        if grid:
            draw_grid_dots(self.canvas, self._cw, self._ch)
        if particles:
            self.particles = FloatingParticles(self.canvas, self._cw, self._ch)
            self.particles.animate()

    def track(self, widget):
        self._loose_widgets.append(widget)
        return widget

    def canvas_icon(self, x, y, kind, color, size=22, glow_blur=5):
        icon = create_neon_icon(kind, color, size=size, glow_blur=glow_blur)
        self._icon_refs.append(icon)
        return self.canvas.create_image(x, y, image=icon)

    def card(self, x_rel, y_rel, w, h, border=NEON_PURPLE, cut=16, bg=CARD_BG):
        cx, cy = x_rel * self._cw, y_rel * self._ch

        draw_neon_glow_card(self.canvas, cx, cy, w, h, border, cut=cut)
        draw_neon_border(self.canvas, cx, cy, w, h, border, cut=cut, fill=bg, width=2)

        inset = 20
        frame = ctk.CTkFrame(self, width=w - inset, height=h - inset,
                              corner_radius=min(cut - 4, 14),
                              fg_color=bg, border_width=0)
        self.canvas.create_window(cx, cy, window=frame, anchor="center")
        frame.pack_propagate(False)
        self.track(frame)
        return frame

    def styled_button(self, parent, text, fg_color, hover_color, text_color="#0A0E27",
                       width=220, height=44, font_size=13, command=None, glow_color=None,
                       icon_kind=None, glow_size="normal"):
        """
        glow_size: 'normal' untuk tombol berdiri sendiri, 'compact' untuk
        tombol yang ditumpuk rapat (mis. dalam panel menu) -- FIX untuk bug
        halo neon antar-tombol menyatu jadi satu blob besar: halo compact
        jauh lebih kecil radiusnya jadi tidak nembus ke tombol tetangga.
        """
        icon_photo = None
        if icon_kind:
            icon_photo = create_neon_icon(icon_kind, text_color, size=16, glow_blur=3)

        kwargs = dict(
            text=text, width=width, height=height,
            fg_color=fg_color, hover_color=hover_color, text_color=text_color,
            font=(FONT_MAIN, font_size, "bold"), corner_radius=height // 2,
            command=command,
        )
        if icon_photo:
            kwargs["image"] = icon_photo
            kwargs["compound"] = "left"

        btn = ctk.CTkButton(parent, **kwargs)
        if icon_photo:
            btn._icon_ref = icon_photo
            self._icon_refs.append(icon_photo)

        bind_hover(btn, glow_color or hover_color)

        glow_c = glow_color or hover_color
        canvas = self.canvas
        if glow_size == "compact":
            btn.after(120, lambda: glow_behind_widget(
                canvas, btn, glow_c, pad=6,
                halo_width=10, halo_blur=8, halo_boost=2.2,
                core_width=4, core_blur=3, core_boost=1.6))
        else:
            btn.after(120, lambda: glow_behind_widget(
                canvas, btn, glow_c, pad=10,
                halo_width=16, halo_blur=11, halo_boost=2.6,
                core_width=6, core_blur=4, core_boost=1.9))
        return btn

    # ========== MODAL (Exit confirmation) ==========
    def _freeze_background(self):
        self._frozen_place = []
        for w in self._loose_widgets:
            try:
                info = w.place_info()
            except Exception:
                info = {}
            if info:
                self._frozen_place.append((w, dict(info)))
                w.place_forget()

        self._frozen_canvas_windows = []
        for item_id in self.canvas.find_all():
            if self.canvas.type(item_id) == "window":
                state = self.canvas.itemcget(item_id, "state")
                if state != "hidden":
                    self.canvas.itemconfigure(item_id, state="hidden")
                    self._frozen_canvas_windows.append(item_id)

    def _unfreeze_background(self):
        for w, info in self._frozen_place:
            try:
                clean = {k: v for k, v in info.items()
                         if k in ("relx", "rely", "x", "y", "anchor", "relwidth", "relheight")
                         and v not in ("", None)}
                w.place(**clean)
            except Exception:
                pass
        self._frozen_place = []

        for item_id in self._frozen_canvas_windows:
            try:
                self.canvas.itemconfigure(item_id, state="normal")
            except Exception:
                pass
        self._frozen_canvas_windows = []

    def close_modal(self):
        for w in self._modal_widgets:
            try:
                w.destroy()
            except Exception:
                pass
        self._modal_widgets = []
        self.canvas.delete("modal_dim")
        self._unfreeze_background()

    def show_exit_confirm(self):
        if self._modal_widgets:
            return

        self._freeze_background()

        dim_id = self.canvas.create_rectangle(0, 0, self._cw, self._ch,
                                               fill="#000000", stipple="gray50", outline="")
        self.canvas.addtag_withtag("modal_dim", dim_id)

        mw, mh = 360, 260
        cx, cy = self._cw / 2, self._ch / 2

        items_before = set(self.canvas.find_all())
        draw_neon_glow_card(self.canvas, cx, cy, mw, mh, NEON_MAGENTA, cut=16)
        items_after = set(self.canvas.find_all())
        for item_id in (items_after - items_before):
            self.canvas.addtag_withtag("modal_dim", item_id)

        border_id = draw_neon_border(self.canvas, cx, cy, mw, mh, NEON_MAGENTA, cut=16, fill=CARD_BG, width=2)
        self.canvas.addtag_withtag("modal_dim", border_id)

        panel = ctk.CTkFrame(self, width=mw - 20, height=mh - 20, corner_radius=14,
                              fg_color=CARD_BG, border_width=0)
        win_id = self.canvas.create_window(cx, cy, window=panel, anchor="center")
        self.canvas.addtag_withtag("modal_dim", win_id)
        panel.pack_propagate(False)

        lock_icon = create_neon_icon("lock", NEON_MAGENTA, size=30, glow_blur=5)
        self._icon_refs.append(lock_icon)
        ctk.CTkLabel(panel, text="", image=lock_icon).pack(pady=(26, 8))

        ctk.CTkLabel(panel, text="EXIT GAME?", font=(FONT_HEADER, int(self.hf(18)), "bold"),
                     text_color=WHITE).pack(pady=(0, 6))
        ctk.CTkLabel(panel, text="Are you sure you want to exit?", font=(FONT_MAIN, FS_CARD_SUB),
                     text_color=TEXT_MUTED).pack(pady=(0, 18))

        row = ctk.CTkFrame(panel, fg_color="transparent")
        row.pack()

        cancel_btn = self.styled_button(row, "CANCEL", "#1A2248", "#242c5c", SKY,
                                         width=130, height=40, command=self.close_modal,
                                         glow_color=SKY, icon_kind="arrow_left", glow_size="compact")
        cancel_btn.pack(side="left", padx=10)
        exit_btn = self.styled_button(row, "EXIT", "#3a1030", "#5c1a4a", NEON_MAGENTA,
                                       width=130, height=40, command=self.destroy,
                                       glow_color=NEON_MAGENTA, icon_kind="door", glow_size="compact")
        exit_btn.pack(side="left", padx=10)

        self._modal_widgets = [panel]

    def request_exit(self):
        self.show_exit_confirm()

    # ========== HOME SCREEN ==========
    def show_home(self):
        self.reset_screen(BG_TOP, BG_BOTTOM, particles=True)

        self.lock_cx, self.lock_cy = self._cw / 2, 62
        self._bounce_i = 0
        self._bounce_lock()

        self.canvas.create_text(self._cw / 2, 122, text="CAESAR CIPHER",
                                 font=(FONT_HEADER, int(self.hf(30)), "bold"), fill=ACCENT)
        self.canvas.create_text(self._cw / 2, 156, text="CHALLENGE",
                                 font=(FONT_HEADER, int(self.hf(20)), "bold"), fill=WHITE)
        self.canvas.create_text(self._cw / 2, 186, text="DECODE THE MESSAGE. BREAK THE CIPHER.",
                                 font=(FONT_MAIN, 11), fill=TEXT_MUTED)

        self.demo_label = self.canvas.create_text(self._cw / 2, 212, text="KHOOR ZRUOG",
                                                    font=(FONT_MONO, 14, "bold"), fill=ACCENT2)
        self.demo_toggle = True
        self._animate_demo_text()


        panel = self.card(0.5, 0.61, 320, 276, border=NEON_PURPLE)
        b1 = self.styled_button(panel, "PLAY GAME", ACCENT, "#FFD54D", "#0A0E27",
                                 width=260, height=46, font_size=14,
                                 command=self.show_level_select, glow_color="#FFE082",
                                 icon_kind="play", glow_size="compact")
        b1.pack(pady=(26, 14))
        b2 = self.styled_button(panel, "HOW TO PLAY", "#1A2248", "#242c5c", WHITE,
                                 width=260, height=42, command=self.show_how_to_play,
                                 glow_color=SKY, icon_kind="book", glow_size="compact")
        b2.pack(pady=8)
        b3 = self.styled_button(panel, "EXIT", "#3a1030", "#5c1a4a", WHITE,
                                 width=260, height=42, command=self.request_exit,
                                 glow_color=DANGER, icon_kind="door", glow_size="compact")
        b3.pack(pady=(8, 24))

        score_card = self.card(0.5, 0.895, 260, 66, border=SKY)
        row = ctk.CTkFrame(score_card, fg_color="transparent")
        row.pack(expand=True)
        trophy_icon = create_neon_icon("trophy", GOLD, size=26, glow_blur=4)
        self._icon_refs.append(trophy_icon)
        ctk.CTkLabel(row, text="", image=trophy_icon).pack(side="left", padx=(0, 12))
        col = ctk.CTkFrame(row, fg_color="transparent")
        col.pack(side="left")
        ctk.CTkLabel(col, text="BEST SCORE", font=(FONT_MAIN, 10, "bold"),
                     text_color=TEXT_MUTED, anchor="w").pack(anchor="w")
        ctk.CTkLabel(col, text=str(self.game.best_score), font=(FONT_MAIN, 18, "bold"),
                     text_color=SKY, anchor="w").pack(anchor="w")

    def _bounce_lock(self):
        offset = math.sin(self._bounce_i * 0.15) * 8
        self.canvas.delete("lockicon")
        icon_id = self.canvas_icon(self.lock_cx, self.lock_cy + offset, "lock", NEON_PURPLE, size=42, glow_blur=6)
        self.canvas.addtag_withtag("lockicon", icon_id)
        self._bounce_i += 1
        self.timer_id = self.after(45, self._bounce_lock)

    def _animate_demo_text(self):
        text = "KHOOR ZRUOG" if self.demo_toggle else "HELLO WORLD"
        color = ACCENT2 if self.demo_toggle else SKY
        self.canvas.itemconfigure(self.demo_label, text=text, fill=color)
        self.demo_toggle = not self.demo_toggle
        self.after(1200, self._animate_demo_text)

    # ========== HOW TO PLAY ==========
    def show_how_to_play(self):
        self.reset_screen("#0A0E27", "#0d123a")
        self.canvas.create_text(self._cw / 2, 50, text="HOW TO PLAY",
                                 font=(FONT_HEADER, int(self.hf(24)), "bold"), fill=ACCENT)

        
        steps = [
            ("UNDERSTAND", "Caesar Cipher menggeser\ntiap huruf sesuai shift.\nA \u2192 B, B \u2192 C ...\n(SHIFT = 3)", SKY, "search"),
            ("DECODE", "Gunakan angka shift untuk\nmengembalikan pesan\nmenjadi teks asli.\n\nKHOOR \u2192 HELLO", ACCENT2, "unlock"),
            ("COMPLETE", "Jawab 5 pertanyaan\nsetiap level dan\nkumpulkan skor\ntertinggi!", GOLD, "trophy"),
        ]

        positions = [0.17, 0.5, 0.83]
        card_w, card_h = 250, 370
        y_rel = 0.52

        for i, (title, desc, color, icon_kind) in enumerate(steps):
            x_rel = positions[i]
            panel = self.card(x_rel, y_rel, card_w, card_h, border=color)

            badge = ctk.CTkLabel(panel, text=f"0{i+1}", width=40, height=40, corner_radius=20,
                                  fg_color="#0A0E27", text_color=color,
                                  font=(FONT_MAIN, 16, "bold"))
            badge.pack(pady=(20, 8))

            icon_photo = create_neon_icon(icon_kind, color, size=38, glow_blur=5)
            self._icon_refs.append(icon_photo)
            ctk.CTkLabel(panel, text="", image=icon_photo).pack(pady=(4, 12))

            ctk.CTkLabel(panel, text=title, font=(FONT_MAIN, FS_CARD_TITLE, "bold"),
                         text_color=color).pack(pady=(0, 12))
            ctk.CTkLabel(panel, text=desc, font=(FONT_MAIN, FS_CARD_BODY), text_color="#c9c9d9",
                         justify="center", wraplength=card_w - 30).pack(padx=8)

        back = self.styled_button(self, "BACK", ACCENT, "#FFD54D", "#0A0E27",
                                   width=150, command=self.show_home, glow_color="#FFE082",
                                   icon_kind="arrow_left")
        self.track(back)
        back.place(relx=0.5, rely=0.93, anchor="center")

    # ========== LEVEL SELECT ==========
    def show_level_select(self):
        self.reset_screen(BG_TOP, "#111838", particles=True)
        self.canvas.create_text(self._cw / 2, 40, text="SELECT LEVEL",
                                 font=(FONT_HEADER, int(self.hf(24)), "bold"), fill=ACCENT)

        levels = [
            ("easy", "EASY", "Caesar Beginner", SUCCESS, 0.18),
            ("medium", "MEDIUM", "Cipher Explorer", NEON_PURPLE, 0.5),
            ("hard", "HARD", "Cipher Master", ACCENT2, 0.82),
        ]

    
        for key, label, subtitle, color, x in levels:
            unlocked = self.game.unlocked[key]
            frame = self.card(x, 0.49, 210, 310, border=color if unlocked else "#3a3a5a")

            top_icon = create_neon_icon("check_circle" if unlocked else "lock",
                                         color if unlocked else "#555555", size=24, glow_blur=4)
            self._icon_refs.append(top_icon)
            ctk.CTkLabel(frame, text="", image=top_icon).pack(pady=(24, 6))

            ctk.CTkLabel(frame, text=label, font=(FONT_HEADER, int(self.hf(18)), "bold"),
                         text_color=color if unlocked else "#555").pack()
            ctk.CTkLabel(frame, text=subtitle, font=(FONT_MAIN, FS_CARD_SUB),
                         text_color=TEXT_MUTED if unlocked else "#444").pack(pady=(4, 0))

            if unlocked:
                ctk.CTkLabel(frame, text="5 QUESTIONS", font=(FONT_MAIN, FS_LABEL_SMALL),
                             text_color="#9a8fc0").pack(pady=(16, 0))
                start_btn = self.styled_button(frame, "START", color, "#ffffff", "#0A0E27",
                                                width=150, height=42, font_size=13,
                                                command=lambda k=key: self.start_game(k),
                                                glow_color="#ffffff", icon_kind="play",
                                                glow_size="compact")
                start_btn.pack(pady=(24, 20))
            else:
                lock_icon = create_neon_icon("lock", "#7C89B8", size=30, glow_blur=4)
                self._icon_refs.append(lock_icon)
                ctk.CTkLabel(frame, text="", image=lock_icon).pack(pady=(22, 8))
                lock_card = ctk.CTkFrame(frame, fg_color="#1A2248", corner_radius=6, height=34)
                lock_card.pack(fill="x", padx=30, pady=(0, 10))
                ctk.CTkLabel(lock_card, text="LOCKED", font=(FONT_MAIN, FS_LABEL_SMALL, "bold"),
                             text_color="#7C89B8").pack(pady=6)
                req = "Complete Easy first" if key == "medium" else "Complete Medium first"
                ctk.CTkLabel(frame, text=req, font=(FONT_MAIN, FS_LABEL_SMALL), text_color="#555",
                             justify="center", wraplength=150).pack(pady=(4, 0))

        info = self.card(0.5, 0.845, 480, 50, border=SKY)
        row = ctk.CTkFrame(info, fg_color="transparent")
        row.pack(expand=True)
        info_icon = create_neon_icon("info", SKY, size=16, glow_blur=3)
        self._icon_refs.append(info_icon)
        ctk.CTkLabel(row, text="", image=info_icon).pack(side="left", padx=(0, 8))
        ctk.CTkLabel(row, text="Selesaikan level sebelumnya untuk membuka level selanjutnya.",
                     font=(FONT_MAIN, FS_CARD_SUB), text_color=SKY).pack(side="left")

        back = self.styled_button(self, "BACK", ACCENT, "#FFD54D", "#0A0E27",
                                   width=150, command=self.show_home, glow_color="#FFE082",
                                   icon_kind="arrow_left")
        self.track(back)
        back.place(relx=0.5, rely=0.955, anchor="center")

    # ========== GAMEPLAY ==========
    def start_game(self, level):
        self.game.start_level(level)
        self.show_question()

    def show_question(self):
        self.reset_screen("#0A0E27", "#0f1840", grid=True, particles=False)
        q = self.game.get_current_question()
        idx = self.game.current_index + 1
        total = len(self.game.questions)

        self.canvas_icon(58, 25, "trophy", GOLD, size=16, glow_blur=3)
        self.canvas.create_text(90, 25, text="SCORE", font=(FONT_MAIN, 11), fill=TEXT_MUTED, anchor="w")
        self.canvas.create_text(75, 48, text=str(self.game.score_manager.score),
                                 font=(FONT_HEADER, int(self.hf(18)), "bold"), fill=GOLD)

        dots = "".join("\u25cf" if i < idx - 1 else ("\u25c9" if i == idx - 1 else "\u25cb") for i in range(total))
        self.canvas.create_text(self._cw / 2, 28, text=f"QUESTION {idx}/{total}",
                                 font=(FONT_MAIN, 11, "bold"), fill=TEXT_MUTED)
        self.canvas.create_text(self._cw / 2, 52, text=dots, font=(FONT_MAIN, 16), fill=SKY)

        alive = max(0, 3 - self.game.score_manager.wrong_count)
        draw_hearts(self.canvas, self._cw - 110, 40, alive, total=3)

        card = self.card(0.5, 0.53, 480, 340, border=SKY)

        if q["type"] == "decode":
            prompt, shown = "DECODE THIS MESSAGE", q["encrypted"]
        elif q["type"] == "encode":
            prompt, shown = "ENCODE THIS MESSAGE", q["original"]
        elif q["type"] == "find_shift":
            prompt, shown = f"{q['encrypted']}  \u2192  {q['original']}\nWHAT IS THE SHIFT?", ""
        else:
            prompt, shown = "DECRYPT THIS MESSAGE", q["encrypted"]

        ctk.CTkLabel(card, text=prompt, font=(FONT_MAIN, 14, "bold"),
                     text_color=SKY, justify="center").pack(pady=(26, 8))
        if shown:
            ctk.CTkLabel(card, text=shown, font=(FONT_MONO, 24, "bold"),
                         text_color=WHITE).pack(pady=5)
        if q["type"] != "find_shift":
            ctk.CTkLabel(card, text=f"SHIFT : {q['shift']}", font=(FONT_MAIN, 12),
                         text_color=TEXT_MUTED).pack(pady=(0, 10))

        self.answer_var = ctk.StringVar()
        if q["type"] == "multiple_choice":
            row = ctk.CTkFrame(card, fg_color="transparent")
            row.pack(pady=10)
            for i, choice in enumerate(q["choices"]):
                cbtn = self.styled_button(row, choice, "#1A2248", ACCENT, WHITE,
                                           width=190, height=38, font_size=12,
                                           command=lambda c=choice: self.submit(c),
                                           glow_color=ACCENT, glow_size="compact")
                cbtn.grid(row=i // 2, column=i % 2, padx=8, pady=8)
        else:
            entry = ctk.CTkEntry(card, textvariable=self.answer_var, width=280, height=40,
                                  placeholder_text="Type your answer...", font=(FONT_MAIN, 14),
                                  corner_radius=8, border_color=SKY, border_width=1)
            entry.pack(pady=8)
            entry.bind("<Return>", lambda e: self.submit(self.answer_var.get()))
            check_btn = self.styled_button(card, "CHECK ANSWER", ACCENT, "#FFD54D", "#0A0E27",
                                            width=220, height=42, command=lambda: self.submit(self.answer_var.get()),
                                            glow_color="#FFE082", icon_kind="check")
            check_btn.pack(pady=8)

        self.timer_bar = ctk.CTkProgressBar(self, width=480, height=12, corner_radius=6,
                                             progress_color=ACCENT)
        self.track(self.timer_bar)
        self.timer_bar.place(relx=0.5, rely=0.86, anchor="center")
        self.timer_label = self.canvas.create_text(self._cw / 2, self._ch * 0.905, text="",
                                                     font=(FONT_MAIN, 13, "bold"), fill=WHITE)

        self.time_left = self.game.get_time_limit() * 10
        self.total_time = self.time_left
        self.run_timer()

    def run_timer(self):
        ratio = self.time_left / self.total_time
        self.timer_bar.set(ratio)
        seconds = self.time_left / 10
        color = SUCCESS if ratio > 0.5 else (GOLD if ratio > 0.2 else DANGER)
        self.timer_bar.configure(progress_color=color)
        self.canvas.itemconfigure(self.timer_label, text=f"{seconds:0.1f}s", fill=color)

        if self.time_left <= 0:
            self.game.score_manager.timeout()
            self.go_next()
            return
        self.time_left -= 1
        self.timer_id = self.after(100, self.run_timer)

    def submit(self, answer):
        if self.timer_id:
            self.after_cancel(self.timer_id)
            self.timer_id = None
        is_correct, points, correct = self.game.submit_answer(answer, int(self.time_left / 10))
        self.show_feedback(is_correct, points, correct)

    def show_feedback(self, is_correct, points, correct):
        self.reset_screen(BG_TOP, "#111838", grid=True, particles=False)
        color = SUCCESS if is_correct else DANGER
        icon_kind = "check" if is_correct else "cross"
        title = "CORRECT!" if is_correct else "INCORRECT"

        self._feedback_icon_size = int(self.hf(28))
        icon_photo = create_neon_icon(icon_kind, color, size=self._feedback_icon_size, glow_blur=6)
        self._icon_refs.append(icon_photo)
        icon_id = self.canvas.create_image(self._cw / 2, 150, image=icon_photo)
        self._pulse_canvas_icon(icon_id, icon_kind, color, int(self.hf(28)), int(self.hf(56)))

        self.canvas.create_text(self._cw / 2, 220, text=title,
                                 font=(FONT_HEADER, int(self.hf(24)), "bold"), fill=color)
        if not is_correct:
            self.canvas.create_text(self._cw / 2, 260, text=f"Correct Answer: {correct}",
                                     font=(FONT_MAIN, 13), fill="#c9c9d9")

        prefix = "+" if points > 0 else ""
        points_label = ctk.CTkLabel(self, text="0 PTS", font=(FONT_MAIN, 18, "bold"), text_color=color)
        self.track(points_label)
        points_label.place(relx=0.5, rely=0.55, anchor="center")
        animate_count(points_label, 0, points, duration_ms=500, prefix=prefix, suffix=" PTS")

        streak = self.game.score_manager.streak
        if streak >= 3:
            combo_icon = create_neon_icon("fire", ACCENT2, size=20, glow_blur=4)
            self._icon_refs.append(combo_icon)
            combo = ctk.CTkLabel(self, text=f" COMBO x{streak}!", image=combo_icon, compound="left",
                                  font=(FONT_MAIN, 16, "bold"), text_color=ACCENT2)
            self.track(combo)
            combo.place(relx=0.5, rely=0.68, anchor="center")
            pulse_label(combo, 16, 22, family=FONT_MAIN, cycles=4)

        next_btn = self.styled_button(self, "NEXT QUESTION", ACCENT, "#FFD54D", "#0A0E27",
                                       width=230, height=46, command=self.go_next, glow_color="#FFE082",
                                       icon_kind="arrow_right")
        self.track(next_btn)
        next_btn.place(relx=0.5, rely=0.85, anchor="center")

    def _pulse_canvas_icon(self, item_id, icon_kind, color, base_size, peak_size, cycles=4, delay=70):
        def step(i=0, growing=True):
            if i > cycles:
                icon = create_neon_icon(icon_kind, color, size=base_size, glow_blur=6)
                self._icon_refs.append(icon)
                self.canvas.itemconfigure(item_id, image=icon)
                return
            size = peak_size if growing else base_size
            icon = create_neon_icon(icon_kind, color, size=size, glow_blur=6)
            self._icon_refs.append(icon)
            self.canvas.itemconfigure(item_id, image=icon)
            self.after(delay, lambda: step(i + 1, not growing))
        step()

    def go_next(self):
        has_more = self.game.next_question()
        if has_more:
            self.show_question()
        else:
            self.game.finish_level()
            self.show_result()

    # ========== RESULT SCREEN ==========
    def show_result(self):
        self.reset_screen("#0d1a4a", "#141B3C", grid=True)
        sm = self.game.score_manager
        total = len(self.game.questions)

        if sm.score >= 300:
            self.confetti = Confetti(self.canvas, self._cw, self._ch, count=40)
            self.confetti.animate()

        self.canvas.create_text(self._cw / 2, 46, text="LEVEL COMPLETE!",
                                 font=(FONT_HEADER, int(self.hf(28)), "bold"), fill=WHITE)
        self.canvas_icon(self._cw / 2, 96, "trophy", GOLD, size=40, glow_blur=6)

        score_label = ctk.CTkLabel(self, text="0", font=(FONT_MAIN, 30, "bold"), text_color=GOLD)
        self.track(score_label)
        score_label.place(relx=0.5, rely=0.235, anchor="center")
        animate_count(score_label, 0, sm.score, duration_ms=800, suffix=" PTS")

        stars_count = min(5, max(0, sm.score // 100))
        stars = "\u2605" * stars_count + "\u2606" * (5 - stars_count)
        self.canvas.create_text(self._cw / 2, self._ch * 0.30, text=stars,
                                 font=(FONT_MAIN, 28), fill=GOLD)

        panel = self.card(0.5, 0.54, 460, 170, border=SKY)
        info = (f"Correct Answers    :  {sm.correct_count}/{total}\n"
                f"Accuracy           :  {sm.accuracy(total)}%\n"
                f"Best Streak        :  {sm.best_streak}")
        ctk.CTkLabel(panel, text=info, font=(FONT_MONO, 16), text_color="#e5e5e5",
                     justify="left").pack(pady=26)

 
        row = ctk.CTkFrame(self, fg_color="transparent")
        self.canvas.create_window(self._cw / 2, self._ch * 0.88, window=row, anchor="center")
        self.track(row)

        btn1 = self.styled_button(row, "PLAY AGAIN", ACCENT, "#FFD54D", "#0A0E27",
                                   width=168, font_size=12,
                                   command=lambda: self.start_game(self.game.level),
                                   glow_color="#FFE082", icon_kind="play", glow_size="compact")
        btn1.pack(side="left", padx=10)
        btn2 = self.styled_button(row, "LEVEL SELECT", ACCENT2, "#ff5cbb", WHITE,
                                   width=168, font_size=12,
                                   command=self.show_level_select, glow_color=NEON_MAGENTA_LIGHT,
                                   icon_kind="arrow_right", glow_size="compact")
        btn2.pack(side="left", padx=10)
        btn3 = self.styled_button(row, "MAIN MENU", "#1A2248", "#242c5c", WHITE,
                                   width=168, font_size=12,
                                   command=self.show_home, glow_color=SKY,
                                   icon_kind="door", glow_size="compact")
        btn3.pack(side="left", padx=10)


if __name__ == "__main__":
    app = CaesarApp()
    app.mainloop()