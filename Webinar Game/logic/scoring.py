class ScoreManager:
    def __init__(self):
        self.score = 0
        self.streak = 0
        self.best_streak = 0
        self.correct_count = 0
        self.wrong_count = 0

    def answer_correct(self, time_left: int, time_limit: int):
        base = 100
        speed_bonus = int((time_left / time_limit) * 50)
        self.streak += 1
        self.best_streak = max(self.best_streak, self.streak)

        combo_bonus = 0
        if self.streak >= 3:
            combo_bonus = 50

        total = base + speed_bonus + combo_bonus
        self.score += total
        self.correct_count += 1
        return total

    def answer_wrong(self):
        self.streak = 0
        self.wrong_count += 1
        self.score = max(0, self.score - 20)
        return -20

    def timeout(self):
        self.streak = 0
        self.wrong_count += 1
        self.score = max(0, self.score - 30)
        return -30

    def accuracy(self, total_questions: int):
        return round((self.correct_count / total_questions) * 100)