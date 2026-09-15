import random

# Bank kata diperbanyak signifikan (dari ~40/38/30 kata menjadi 90+ per
# level) supaya soal terasa jauh lebih bervariasi antar attempt, sesuai
# permintaan. Dikombinasikan dengan reset histori setiap level dimulai
# (lihat generate_questions/start_level) sehingga urutan & pilihan kata
# selalu terasa acak dari awal setiap kali pemain menekan START/PLAY AGAIN.
WORD_BANK = {
    "easy": [
        "HELLO", "CAT", "DOG", "PYTHON", "CODE", "GAME", "BOOK", "SUN",
        "MOON", "STAR", "TREE", "FISH", "BIRD", "CAKE", "SHIP", "RAIN",
        "SNOW", "WIND", "LEAF", "ROCK", "LAMP", "DOOR", "DESK", "CHAIR",
        "PLANT", "CLOUD", "RIVER", "HOUSE", "MUSIC", "HAPPY", "SMILE",
        "LIGHT", "WATER", "EARTH", "APPLE", "GRAPE", "MANGO", "PIZZA",
        "TIGER", "PANDA", "ROBOT",
        "BEAR", "LION", "DUCK", "FROG", "GOAT", "MILK", "BREAD", "JUICE",
        "CANDY", "BENCH", "TABLE", "PHONE", "PAPER", "PENCIL", "ERASER",
        "WATCH", "CLOCK", "MIRROR", "PILLOW", "BLANKET", "WINDOW",
        "GARDEN", "FOREST", "BEACH", "OCEAN", "MOUNTAIN", "VALLEY",
        "BRIDGE", "TUNNEL", "TRAIN", "PLANE", "BOAT", "BIKE", "TRUCK",
        "CANDLE", "MIRROR", "BUTTON", "ZIPPER", "SOCKS", "SHOES",
        "JACKET", "SCARF", "GLOVES", "HAT", "BELT", "WALLET", "PURSE",
        "SPOON", "FORK", "KNIFE", "PLATE", "BOWL", "CUP", "KETTLE",
        "TOAST", "BUTTER", "CHEESE", "HONEY", "SUGAR", "SALT", "PEPPER"
    ],
    "medium": [
        "CIPHER", "SECURITY", "PROGRAM", "KEYBOARD", "NETWORK",
        "COMPUTER", "INTERNET", "PASSWORD", "SOFTWARE", "HARDWARE",
        "ALGORITHM", "DATABASE", "FUNCTION", "VARIABLE", "TEACHER",
        "STUDENT", "SCIENCE", "HISTORY", "PLANET", "WEATHER",
        "JOURNEY", "MYSTERY", "ADVENTURE", "TREASURE", "GUARDIAN",
        "CRYSTAL", "DRAGON", "CASTLE", "KNIGHT", "GALAXY",
        "COMET", "ROCKET", "ISLAND", "JUNGLE", "MONSTER",
        "WIZARD", "PUZZLE", "VICTORY", "CHAMPION",
        "AIRPORT", "BALCONY", "CAPTAIN", "DIAMOND", "ELEPHANT",
        "FESTIVAL", "GOVERNOR", "HARMONY", "IMAGINE", "JOURNAL",
        "KINGDOM", "LANTERN", "MERCHANT", "NOVELIST", "ORCHARD",
        "PENGUIN", "QUALITY", "RAINBOW", "SANCTUARY", "TELESCOPE",
        "UMBRELLA", "VOLCANO", "WARRIOR", "XYLOPHONE", "YOUTHFUL",
        "ZEPPELIN", "ACADEMY", "BOUNDARY", "CHEMISTRY", "DELEGATE",
        "ENERGY", "FOUNTAIN", "GALLERY", "HORIZON", "INSTINCT",
        "JACKPOT", "KILOGRAM", "LIBRARY", "MELODY", "NARRATOR",
        "OBSTACLE", "PARADISE", "QUANTITY", "RESCUE", "SYMPHONY"
    ],
    "hard": [
        "CRYPTOGRAPHY", "ALGORITHM", "ENCRYPTION", "PROTOCOL",
        "AUTHENTICATION", "CYBERSECURITY", "PROGRAMMING", "ARCHITECTURE",
        "INFRASTRUCTURE", "COMMUNICATION", "TRANSFORMATION",
        "CONFIGURATION", "OPTIMIZATION", "VISUALIZATION",
        "COLLABORATION", "IMPLEMENTATION", "SPECIFICATION",
        "REVOLUTIONARY", "EXTRAORDINARY", "INVESTIGATION",
        "CONSTELLATION", "PHOTOSYNTHESIS", "BIODIVERSITY",
        "PHILOSOPHICAL", "MATHEMATICAL", "PSYCHOLOGICAL",
        "ENVIRONMENTAL", "REVOLUTIONIZE", "UNPRECEDENTED",
        "INTERDISCIPLINARY",
        "ACCOMPLISHMENT", "ADMINISTRATION", "BREAKTHROUGH", "CIRCUMSTANCE",
        "CLASSIFICATION", "COMPREHENSION", "CONSEQUENTIAL", "CONTRIBUTION",
        "DEMONSTRATION", "DETERMINATION", "DISTRIBUTION", "ENTREPRENEUR",
        "EXPERIMENTATION", "FUNDAMENTALLY", "GENERALIZATION", "IDENTIFICATION",
        "ILLUSTRATION", "INDEPENDENCE", "INTELLECTUAL", "INTERPRETATION",
        "INVESTIGATOR", "MANIPULATION", "NEGOTIATION", "OBSERVATION",
        "ORGANIZATION", "PARTICIPATION", "PERSPECTIVE", "PRESENTATION",
        "PRODUCTIVITY", "QUALIFICATION", "RECOMMENDATION", "REGISTRATION",
        "REPRESENTATION", "RESPONSIBILITY", "SIGNIFICANTLY", "SUBSTANTIALLY",
        "SUSTAINABILITY", "TRANSPARENCY", "UNDERSTANDING", "VULNERABILITY"
    ]
}

# Frasa pendek — dipakai random di medium/hard biar makin variatif
PHRASE_BANK = {
    "medium": [
        "GOOD LUCK", "STAY FOCUSED", "KEEP GOING", "TRY AGAIN",
        "WELL DONE", "NICE WORK", "BE BRAVE", "THINK FAST",
        "GAME TIME", "LEVEL UP",
        "STAY SHARP", "MOVE FORWARD", "AIM HIGHER", "PUSH LIMITS",
        "RISE AND SHINE", "MAKE IT COUNT", "DREAM BIGGER",
        "ONE MORE TRY", "TAKE THE LEAD", "FIND YOUR WAY"
    ],
    "hard": [
        "THE QUICK FOX", "BREAK THE CODE", "TRUST THE PROCESS",
        "KNOWLEDGE IS POWER", "PRACTICE MAKES PERFECT",
        "NEVER GIVE UP HOPE", "SECURITY MATTERS MOST",
        "CIPHER MASTER MODE",
        "EVERY EXPERT WAS ONCE A BEGINNER",
        "GREAT MINDS THINK ALIKE",
        "ACTIONS SPEAK LOUDER THAN WORDS",
        "FORTUNE FAVORS THE BOLD",
        "CURIOSITY DRIVES DISCOVERY",
        "PATIENCE IS A VIRTUE INDEED",
        "SHARPEN YOUR MIND DAILY",
        "THE FUTURE BELONGS TO THE PREPARED"
    ]
}

SHIFT_RANGE = {"easy": (1, 5), "medium": (6, 15), "hard": (16, 25)}
QUESTION_TYPES = ["decode", "encode", "find_shift", "multiple_choice"]

# Riwayat kata yang sudah muncul, supaya user tidak gampang menghapal
_used_history = {"easy": set(), "medium": set(), "hard": set()}


def _get_word_pool(level):
    pool = list(WORD_BANK[level])
    if level in PHRASE_BANK:
        pool += PHRASE_BANK[level]
    return pool


def generate_questions(level: str, count: int = 5, fresh: bool = True):
    """fresh=True (default): histori kata untuk level ini di-reset dulu
    sebelum mengambil sample baru, supaya SETIAP kali pemain menekan
    START/PLAY AGAIN, soal terasa benar-benar acak dari awal (bukan
    kelanjutan histori attempt sebelumnya). Set fresh=False kalau suatu
    saat perlu perilaku lama (hindari kata yang baru saja keluar, sampai
    pool habis lalu di-reset)."""
    from logic.cipher import caesar_shift

    pool = _get_word_pool(level)

    if fresh:
        _used_history[level].clear()

    unused = [w for w in pool if w not in _used_history[level]]

    # kalau kata unik sudah hampir habis, reset histori supaya tidak stuck
    if len(unused) < count:
        _used_history[level].clear()
        unused = pool

    words = random.sample(unused, min(count, len(unused)))
    _used_history[level].update(words)

    questions = []
    for word in words:
        shift = random.randint(*SHIFT_RANGE[level])
        qtype = random.choice(QUESTION_TYPES) if level != "easy" else random.choice(["decode", "encode"])
        encrypted = caesar_shift(word, shift)

        question = {
            "type": qtype,
            "original": word,
            "encrypted": encrypted,
            "shift": shift
        }

        if qtype == "multiple_choice":
            distractors = random.sample(
                [w for w in pool if w != word and len(w) <= len(word) + 3],
                min(3, len(pool) - 1)
            )
            choices = [word] + distractors
            random.shuffle(choices)
            question["choices"] = choices

        questions.append(question)

    return questions


class QuestionGenerator:
    """Wrapper class supaya bisa diimport sebagai QuestionGenerator di logic/__init__.py"""

    @staticmethod
    def generate(level: str, count: int = 5):
        return generate_questions(level, count)
