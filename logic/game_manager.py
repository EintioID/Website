from logic.questions import generate_questions
from logic.scoring import ScoreManager

TIME_LIMIT = {"easy": 60, "medium": 45, "hard": 30}
UNLOCK_REQUIREMENT = {"easy": 0, "medium": 300, "hard": 350}

class GameManager:
    def __init__(self):
        self.level = None
        self.questions = []
        self.current_index = 0
        self.score_manager = ScoreManager()
        self.unlocked = {"easy": True, "medium": False, "hard": False}
        self.best_score = 0

    def start_level(self, level: str):
        self.level = level
        self.questions = generate_questions(level, 5)
        self.current_index = 0
        self.score_manager = ScoreManager()

    def get_current_question(self):
        return self.questions[self.current_index]

    def get_time_limit(self):
        return TIME_LIMIT[self.level]

    def submit_answer(self, user_answer: str, time_left: int):
        q = self.get_current_question()

        # FIX BUG ENCODE: sebelumnya "correct_value = q['original'] if type != find_shift
        # else str(q['shift'])" — ini salah untuk tipe "encode". Di soal encode, yang
        # ditampilkan ke pemain adalah kata ASLI (q['original']), dan pemain diminta
        # MENGENKRIPSINYA — jadi jawaban benarnya adalah versi terenkripsi (q['encrypted']),
        # bukan q['original']. Kode lama membandingkan jawaban pemain dengan kata asli,
        # jadi soal encode praktis selalu dianggap salah walau jawaban pemain benar.
        if q["type"] == "find_shift":
            correct_value = str(q["shift"])
        elif q["type"] == "encode":
            correct_value = q["encrypted"]
        else:  # decode, multiple_choice, atau tipe lain -> jawabannya kata asli
            correct_value = q["original"]

        is_correct = user_answer.strip().upper() == correct_value.upper()

        if is_correct:
            points = self.score_manager.answer_correct(time_left, self.get_time_limit())
        else:
            points = self.score_manager.answer_wrong()

        return is_correct, points, correct_value

    def next_question(self):
        self.current_index += 1
        return self.current_index < len(self.questions)

    def finish_level(self):
        self.best_score = max(self.best_score, self.score_manager.score)
        if self.score_manager.score >= UNLOCK_REQUIREMENT.get("medium", 999999) and self.level == "easy":
            self.unlocked["medium"] = True
        if self.score_manager.score >= UNLOCK_REQUIREMENT.get("hard", 999999) and self.level == "medium":
            self.unlocked["hard"] = True