import tkinter as tk
import random
import ctypes
import os
import sys
from PIL import Image, ImageDraw, ImageTk, ImageFilter

PALETTE = ["#FFC107", "#FF3EC9", "#00FFA3", "#00D9FF", "#7B2FF7"]
DIM_PALETTE = ["#3a3018", "#3a1830", "#183a2c", "#183a3a", "#2a1a4a"]


def load_private_font(font_path: str) -> bool:
    if sys.platform != "win32":
        return False
    if not os.path.isfile(font_path):
        return False
    try:
        FR_PRIVATE = 0x10
        path_buf = ctypes.create_unicode_buffer(font_path)
        num_fonts_added = ctypes.windll.gdi32.AddFontResourceExW(
            ctypes.byref(path_buf), FR_PRIVATE, 0
        )
        return num_fonts_added > 0
    except Exception:
        return False


def hex_to_rgb(color: str):
    color = color.lstrip("#")
    return tuple(int(color[i:i + 2], 16) for i in (0, 2, 4))


def _cut_corner_points(x1, y1, x2, y2, cut):
    return [
        x1 + cut, y1, x2 - cut, y1, x2, y1 + cut,
        x2, y2 - cut, x2 - cut, y2, x1 + cut, y2,
        x1, y2 - cut, x1, y1 + cut,
    ]


def draw_gradient(canvas: tk.Canvas, width: int, height: int, color1: str, color2: str):
    width, height = max(1, width), max(1, height)
    r1, g1, b1 = [c >> 8 for c in canvas.winfo_rgb(color1)]
    r2, g2, b2 = [c >> 8 for c in canvas.winfo_rgb(color2)]

    strip = Image.new("RGB", (1, height))
    px = strip.load()
    for y in range(height):
        t = y / height
        px[0, y] = (int(r1 + (r2 - r1) * t), int(g1 + (g2 - g1) * t), int(b1 + (b2 - b1) * t))

    img = strip.resize((width, height))
    photo = ImageTk.PhotoImage(img)
    canvas.gradient_photo = photo
    canvas.create_image(0, 0, image=photo, anchor="nw")


def draw_grid_dots(canvas: tk.Canvas, width: int, height: int, color="#1E2550", spacing=44, size=1):
    for x in range(0, width, spacing):
        for y in range(0, height, spacing):
            canvas.create_oval(x, y, x + size, y + size, fill=color, outline="")


def create_neon_icon(kind: str, color: str, size: int = 22, glow: bool = True,
                      glow_blur: int = 4) -> ImageTk.PhotoImage:
    canvas_size = size * 3
    img = Image.new("RGBA", (canvas_size, canvas_size), (0, 0, 0, 0))
    draw = ImageDraw.Draw(img)
    cx = cy = canvas_size // 2
    rgb = hex_to_rgb(color)
    s = size

    if kind == "play":
        draw.polygon([(cx - s*0.35, cy - s*0.5), (cx - s*0.35, cy + s*0.5), (cx + s*0.55, cy)],
                     fill=rgb + (255,))
    elif kind == "book":
        draw.line([cx, cy - s*0.4, cx, cy + s*0.4], fill=rgb + (255,), width=2)
        draw.arc([cx - s*0.55, cy - s*0.4, cx + 4, cy + s*0.45], start=250, end=110,
                  fill=rgb + (255,), width=3)
        draw.arc([cx - 4, cy - s*0.4, cx + s*0.55, cy + s*0.45], start=70, end=290,
                  fill=rgb + (255,), width=3)
    elif kind == "door":
        draw.rectangle([cx - s*0.32, cy - s*0.5, cx + s*0.32, cy + s*0.5],
                        outline=rgb + (255,), width=3)
        draw.ellipse([cx + s*0.08, cy - 3, cx + s*0.08 + 6, cy + 3], fill=rgb + (255,))
        draw.line([cx + s*0.32, cy - s*0.5, cx + s*0.5, cy - s*0.4], fill=rgb + (255,), width=3)
        draw.line([cx + s*0.5, cy - s*0.4, cx + s*0.5, cy + s*0.5], fill=rgb + (255,), width=3)
        draw.line([cx + s*0.32, cy + s*0.5, cx + s*0.5, cy + s*0.5], fill=rgb + (255,), width=3)
    elif kind == "trophy":
        draw.arc([cx - s*0.55, cy - s*0.35, cx - s*0.2, cy + s*0.15], start=270, end=90,
                  fill=rgb + (255,), width=3)
        draw.arc([cx + s*0.2, cy - s*0.35, cx + s*0.55, cy + s*0.15], start=90, end=270,
                  fill=rgb + (255,), width=3)
        draw.rectangle([cx - s*0.28, cy - s*0.4, cx + s*0.28, cy + s*0.1],
                        outline=rgb + (255,), width=3)
        draw.line([cx, cy + s*0.1, cx, cy + s*0.32], fill=rgb + (255,), width=3)
        draw.line([cx - s*0.18, cy + s*0.4, cx + s*0.18, cy + s*0.4], fill=rgb + (255,), width=3)
        draw.line([cx - s*0.18, cy + s*0.4, cx - s*0.1, cy + s*0.32], fill=rgb + (255,), width=3)
        draw.line([cx + s*0.18, cy + s*0.4, cx + s*0.1, cy + s*0.32], fill=rgb + (255,), width=3)
    elif kind == "lock":
        r = s * 0.28
        draw.arc([cx - r, cy - s*0.55, cx + r, cy - s*0.05], start=180, end=360,
                  fill=rgb + (255,), width=3)
        draw.rounded_rectangle([cx - s*0.35, cy - s*0.15, cx + s*0.35, cy + s*0.45],
                                radius=3, outline=rgb + (255,), fill=rgb + (60,), width=3)
        draw.ellipse([cx - 3, cy + s*0.05, cx + 3, cy + s*0.11], fill=rgb + (255,))
    elif kind == "unlock":
        r = s * 0.28
        draw.arc([cx - r + s*0.15, cy - s*0.6, cx + r + s*0.15, cy - s*0.1], start=200, end=380,
                  fill=rgb + (255,), width=3)
        draw.rounded_rectangle([cx - s*0.35, cy - s*0.15, cx + s*0.35, cy + s*0.45],
                                radius=3, outline=rgb + (255,), fill=rgb + (60,), width=3)
        draw.ellipse([cx - 3, cy + s*0.05, cx + 3, cy + s*0.11], fill=rgb + (255,))
    elif kind == "check_circle":
        draw.ellipse([cx - s*0.5, cy - s*0.5, cx + s*0.5, cy + s*0.5],
                     outline=rgb + (255,), width=3)
        draw.line([cx - s*0.22, cy + s*0.02, cx - s*0.02, cy + s*0.24, cx + s*0.28, cy - s*0.22],
                   fill=rgb + (255,), width=3, joint="curve")
    elif kind == "heart":
        draw.polygon([
            (cx, cy + s*0.45), (cx - s*0.5, cy - s*0.05), (cx - s*0.5, cy - s*0.35),
            (cx - s*0.2, cy - s*0.5), (cx, cy - s*0.25), (cx + s*0.2, cy - s*0.5),
            (cx + s*0.5, cy - s*0.35), (cx + s*0.5, cy - s*0.05)
        ], fill=rgb + (255,))
    elif kind == "check":
        draw.line([cx - s*0.35, cy, cx - s*0.05, cy + s*0.3, cx + s*0.4, cy - s*0.35],
                   fill=rgb + (255,), width=4, joint="curve")
    elif kind == "cross":
        draw.line([cx - s*0.32, cy - s*0.32, cx + s*0.32, cy + s*0.32], fill=rgb + (255,), width=4)
        draw.line([cx + s*0.32, cy - s*0.32, cx - s*0.32, cy + s*0.32], fill=rgb + (255,), width=4)
    elif kind == "arrow_left":
        draw.line([cx + s*0.3, cy - s*0.35, cx - s*0.3, cy, cx + s*0.3, cy + s*0.35],
                   fill=rgb + (255,), width=4, joint="curve")
    elif kind == "arrow_right":
        draw.line([cx - s*0.3, cy - s*0.35, cx + s*0.3, cy, cx - s*0.3, cy + s*0.35],
                   fill=rgb + (255,), width=4, joint="curve")
    elif kind == "info":
        draw.ellipse([cx - s*0.4, cy - s*0.4, cx + s*0.4, cy + s*0.4], outline=rgb + (255,), width=3)
        draw.ellipse([cx - 2, cy - s*0.2, cx + 2, cy - s*0.2 + 4], fill=rgb + (255,))
        draw.line([cx, cy - s*0.05, cx, cy + s*0.3], fill=rgb + (255,), width=3)
    elif kind == "search":
        draw.ellipse([cx - s*0.4, cy - s*0.45, cx + s*0.15, cy + s*0.1], outline=rgb + (255,), width=3)
        draw.line([cx + s*0.1, cy + s*0.05, cx + s*0.45, cy + s*0.4], fill=rgb + (255,), width=4)
    elif kind == "fire":
        draw.polygon([
            (cx, cy - s*0.5), (cx + s*0.28, cy - s*0.05), (cx + s*0.15, cy - s*0.05),
            (cx + s*0.35, cy + s*0.45), (cx, cy + s*0.25), (cx - s*0.35, cy + s*0.45),
            (cx - s*0.15, cy - s*0.05), (cx - s*0.28, cy - s*0.05)
        ], fill=rgb + (255,))

    combined = Image.alpha_composite(img.filter(ImageFilter.GaussianBlur(glow_blur)), img) if glow else img
    photo = ImageTk.PhotoImage(combined)
    return photo


def glow_behind_widget(canvas: tk.Canvas, widget, color: str, pad: int = 16,
                        halo_width=22, halo_blur=16, halo_boost=3.0,
                        core_width=8, core_blur=5, core_boost=2.2, _retries: int = 6):
    try:
        widget.update_idletasks()
        x = widget.winfo_rootx() - canvas.winfo_rootx()
        y = widget.winfo_rooty() - canvas.winfo_rooty()
        w, h = widget.winfo_width(), widget.winfo_height()
    except Exception:
        return None

    if w <= 1 or h <= 1:
        if _retries > 0:
            try:
                widget.after(40, lambda: glow_behind_widget(canvas, widget, color, pad,
                                                              halo_width, halo_blur, halo_boost,
                                                              core_width, core_blur, core_boost,
                                                              _retries - 1))
            except Exception:
                pass
        return None

    img_w, img_h = w + pad * 2, h + pad * 2
    radius = min(h // 2, 40)

    def shape(draw, rgba, width):
        draw.rounded_rectangle([pad, pad, pad + w, pad + h], radius=radius,
                                outline=rgba, width=width)

    halo = _render_glow_layer((img_w, img_h), shape, color, halo_width, halo_blur, halo_boost)
    core = _render_glow_layer((img_w, img_h), shape, color, core_width, core_blur, core_boost)

    photo_halo = ImageTk.PhotoImage(halo)
    photo_core = ImageTk.PhotoImage(core)

    if not hasattr(canvas, "_glow_refs"):
        canvas._glow_refs = []
    canvas._glow_refs.append(photo_halo)
    canvas._glow_refs.append(photo_core)

    id_halo = canvas.create_image(x - pad, y - pad, image=photo_halo, anchor="nw")
    id_core = canvas.create_image(x - pad, y - pad, image=photo_core, anchor="nw")
    canvas.tag_lower(id_core)
    canvas.tag_lower(id_halo)
    return id_core


def draw_hearts(canvas, x, y, alive, total=3, spacing=26):
    ids = []
    if not hasattr(canvas, "_heart_refs"):
        canvas._heart_refs = []
    for i in range(total):
        color = "#FF4D6D" if i < alive else "#3A2540"
        icon = create_neon_icon("heart", color, size=15, glow=(i < alive))
        canvas._heart_refs.append(icon)
        item = canvas.create_image(x + i * spacing, y, image=icon)
        ids.append(item)
    return ids


def draw_badge_circle(canvas, x, y, r, number, color, font=("Segoe UI", 12, "bold")):
    canvas.create_oval(x - r, y - r, x + r, y + r, outline=color, width=2, fill="#0A0E27")
    if number:
        canvas.create_text(x, y, text=str(number), font=font, fill=color)


def draw_neon_lock(canvas, cx, cy, size, color, glow=True):
    if not hasattr(canvas, "_lock_refs"):
        canvas._lock_refs = []
    icon = create_neon_icon("lock", color, size=int(size * 0.9), glow=glow, glow_blur=6)
    canvas._lock_refs.append(icon)
    return canvas.create_image(cx, cy, image=icon)


def _boost_alpha(img: Image.Image, factor: float) -> Image.Image:
    r, g, b, a = img.split()
    a = a.point(lambda v: min(255, int(v * factor)))
    return Image.merge("RGBA", (r, g, b, a))


def _render_glow_layer(size, draw_fn, color, stroke_width, blur_radius, boost):
    img = Image.new("RGBA", size, (0, 0, 0, 0))
    draw = ImageDraw.Draw(img)
    rgb = hex_to_rgb(color)
    draw_fn(draw, rgb + (255,), stroke_width)
    blurred = img.filter(ImageFilter.GaussianBlur(blur_radius))
    return _boost_alpha(blurred, boost)


def draw_neon_glow_card(canvas: tk.Canvas, cx, cy, w, h, color, cut=16,
                         glow_pad=48, halo_width=26, halo_blur=18, halo_boost=3.0,
                         core_width=10, core_blur=6, core_boost=2.2,
                         glow_blur=None, line_width=None, glow_alpha=None):
    w_img = int(w + glow_pad * 2)
    h_img = int(h + glow_pad * 2)
    x1, y1, x2, y2 = glow_pad, glow_pad, glow_pad + w, glow_pad + h

    def shape(draw, rgba, width):
        pts = _cut_corner_points(x1, y1, x2, y2, cut)
        draw.polygon(pts, outline=rgba, width=width)

    halo = _render_glow_layer((w_img, h_img), shape, color, halo_width, halo_blur, halo_boost)
    core = _render_glow_layer((w_img, h_img), shape, color, core_width, core_blur, core_boost)

    photo_halo = ImageTk.PhotoImage(halo)
    photo_core = ImageTk.PhotoImage(core)
    if not hasattr(canvas, "_glow_refs"):
        canvas._glow_refs = []
    canvas._glow_refs.append(photo_halo)
    canvas._glow_refs.append(photo_core)

    canvas.create_image(cx - w_img / 2, cy - h_img / 2, image=photo_halo, anchor="nw")
    canvas.create_image(cx - w_img / 2, cy - h_img / 2, image=photo_core, anchor="nw")


def draw_neon_border(canvas: tk.Canvas, cx, cy, w, h, color, cut=16, fill="", width=2):
    x1, y1, x2, y2 = cx - w / 2, cy - h / 2, cx + w / 2, cy + h / 2
    pts = _cut_corner_points(x1, y1, x2, y2, cut)
    return canvas.create_polygon(pts, outline=color, fill=fill, width=width)


class Confetti:
    def __init__(self, canvas: tk.Canvas, width, height, count=35):
        self.canvas = canvas
        self.width = width
        self.height = height
        self.particles = []
        for _ in range(count):
            x = random.randint(0, width)
            y = random.randint(-height, 0)
            size = random.randint(6, 12)
            color = random.choice(PALETTE)
            shape = canvas.create_oval(x, y, x + size, y + size, fill=color, outline="")
            speed = random.uniform(2, 5)
            self.particles.append([shape, speed])
        self.running = True

    def animate(self):
        if not self.running:
            return
        for p in self.particles:
            shape, speed = p
            self.canvas.move(shape, random.uniform(-1, 1), speed)
            coords = self.canvas.coords(shape)
            if coords and coords[1] > self.height:
                x = random.randint(0, self.width)
                self.canvas.coords(shape, x, -10, x + 8, -2)
        self.canvas.after(30, self.animate)

    def stop(self):
        self.running = False


class FloatingParticles:
    def __init__(self, canvas, width, height, count=28):
        self.canvas = canvas
        self.width = width
        self.height = height
        self.running = True
        self.items = []
        symbols = ["A", "K", "H", "0", "1", "2", "3", "?", "◆", "✦", "X"]
        for _ in range(count):
            x = random.randint(0, width)
            y = random.randint(0, height)
            sym = random.choice(symbols)
            color = random.choice(DIM_PALETTE)
            size = random.randint(11, 20)
            item = canvas.create_text(x, y, text=sym, font=("Consolas", size, "bold"), fill=color)
            speed = random.uniform(0.25, 0.75)
            drift = random.uniform(-0.15, 0.15)
            self.items.append([item, speed, drift])

    def animate(self):
        if not self.running:
            return
        for item, speed, drift in self.items:
            self.canvas.move(item, drift, -speed)
            coords = self.canvas.coords(item)
            if coords and coords[1] < -20:
                x = random.randint(0, self.width)
                self.canvas.coords(item, x, self.height + 20)
        self.canvas.after(55, self.animate)

    def stop(self):
        self.running = False


def animate_count(widget, start: int, end: int, duration_ms=600, prefix="", suffix=""):
    steps = 20
    step_time = max(10, duration_ms // steps)
    diff = end - start

    def step(i=0):
        value = int(start + (diff * (i / steps)))
        widget.configure(text=f"{prefix}{value}{suffix}")
        if i < steps:
            widget.after(step_time, lambda: step(i + 1))
        else:
            widget.configure(text=f"{prefix}{end}{suffix}")

    step()


def slide_in(widget, target_rely, start_rely=1.3, relx=0.5, anchor="center", steps=14, delay=12):
    diff = target_rely - start_rely

    def step(i=0):
        progress = i / steps
        eased = 1 - (1 - progress) ** 3
        current = start_rely + diff * eased
        widget.place(relx=relx, rely=current, anchor=anchor)
        if i < steps:
            widget.after(delay, lambda: step(i + 1))

    step()


def pulse_label(widget, base_font_size, peak_font_size, family="Segoe UI", weight="bold", cycles=6, delay=60):
    def step(i=0, growing=True):
        if i > cycles:
            widget.configure(font=(family, base_font_size, weight))
            return
        size = peak_font_size if growing else base_font_size
        widget.configure(font=(family, size, weight))
        widget.after(delay, lambda: step(i + 1, not growing))

    step()


def bind_hover(button, glow_color="#ffffff", base_width=2, hover_width=5, steps=5, delay=15):
    button.configure(border_width=base_width, border_color=glow_color, cursor="hand2")
    state = {"job": None}

    def animate_to(target):
        current = int(button.cget("border_width"))
        if current == target:
            return
        step = 1 if target > current else -1
        next_val = current + step
        try:
            button.configure(border_width=next_val)
        except Exception:
            return
        state["job"] = button.after(delay, lambda: animate_to(target))

    def on_enter(event):
        if state["job"]:
            button.after_cancel(state["job"])
        animate_to(hover_width)

    def on_leave(event):
        if state["job"]:
            button.after_cancel(state["job"])
        animate_to(base_width)

    button.bind("<Enter>", on_enter)
    button.bind("<Leave>", on_leave)