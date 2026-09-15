import string

def caesar_shift(text: str, shift: int) -> str:
    result = ""
    for char in text.upper():
        if char in string.ascii_uppercase:
            idx = (ord(char) - ord('A') + shift) % 26
            result += chr(idx + ord('A'))
        else:
            result += char
    return result

def caesar_unshift(text: str, shift: int) -> str:
    return caesar_shift(text, -shift)

def detect_shift(plain: str, cipher: str) -> int:
    for a, b in zip(plain.upper(), cipher.upper()):
        if a in string.ascii_uppercase and b in string.ascii_uppercase:
            return (ord(b) - ord(a)) % 26
    return 0