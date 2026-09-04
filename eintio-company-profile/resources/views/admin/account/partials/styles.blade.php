<style>
    /* ===== REVEAL (per section/card) ===== */
    .reveal {
        opacity: 0;
        transform: translateY(24px);
        transition: opacity .6s var(--ease-smooth, cubic-bezier(0.22, 1, 0.36, 1)),
                    transform .6s var(--ease-smooth, cubic-bezier(0.22, 1, 0.36, 1));
        will-change: opacity, transform;
    }
    .reveal.is-visible {
        opacity: 1;
        transform: translateY(0);
    }

    /* ===== CARD (component) ===== */
    .profile-card {
        transition: box-shadow .45s var(--ease-smooth, cubic-bezier(0.22, 1, 0.36, 1)),
                    transform .45s var(--ease-smooth, cubic-bezier(0.22, 1, 0.36, 1)),
                    border-color .45s var(--ease-smooth, cubic-bezier(0.22, 1, 0.36, 1));
        will-change: transform, box-shadow;
    }
    .profile-card:hover {
        box-shadow: 0 24px 48px -24px rgba(15,23,42,0.18);
        transform: translateY(-4px);
        border-color: rgba(20,184,166,0.3);
    }

    /* ===== FIELD ROW (staggered reveal + smooth hover) ===== */
    .profile-field {
        padding: .35rem 0;
        border-radius: .6rem;
        opacity: 0;
        transform: translateY(10px);
        transition: background-color .3s var(--ease-smooth, cubic-bezier(0.22, 1, 0.36, 1)),
                    opacity .5s var(--ease-smooth, cubic-bezier(0.22, 1, 0.36, 1)),
                    transform .5s var(--ease-smooth, cubic-bezier(0.22, 1, 0.36, 1));
    }
    .profile-field:hover {
        background-color: #F8FAFC;
    }
    .profile-card.is-visible .profile-field {
        opacity: 1;
        transform: translateY(0);
    }
    .profile-card.is-visible .profile-field:nth-of-type(1) { transition-delay: .08s; }
    .profile-card.is-visible .profile-field:nth-of-type(2) { transition-delay: .14s; }
    .profile-card.is-visible .profile-field:nth-of-type(3) { transition-delay: .20s; }
    .profile-card.is-visible .profile-field:nth-of-type(4) { transition-delay: .26s; }
    .profile-card.is-visible .profile-field:nth-of-type(5) { transition-delay: .32s; }

    /* ===== ICON (component hover) ===== */
    .profile-icon {
        width: 2.3rem; height: 2.3rem; flex-shrink: 0; border-radius: .65rem;
        background-color: rgba(20,184,166,0.1); color: #0d9488;
        display: flex; align-items: center; justify-content: center; font-size: .85rem;
        transition: transform .35s var(--ease-smooth, cubic-bezier(0.34, 1.56, 0.64, 1)),
                    background-color .35s var(--ease-smooth, cubic-bezier(0.22, 1, 0.36, 1));
    }
    .profile-field:hover .profile-icon {
        transform: scale(1.1) rotate(-5deg);
        background-color: rgba(20,184,166,0.18);
    }

    .role-badge {
        display: inline-flex; align-items: center; gap: .35rem;
        background-color: #F5F0FF; color: #7C3AED;
        font-size: .72rem; font-weight: 600; padding: .3rem .7rem; border-radius: 999px;
        transition: transform .3s var(--ease-smooth, cubic-bezier(0.22, 1, 0.36, 1)),
                    box-shadow .3s var(--ease-smooth, cubic-bezier(0.22, 1, 0.36, 1));
    }
    .role-badge:hover {
        transform: translateY(-1px);
        box-shadow: 0 6px 14px -8px rgba(124,58,237,0.45);
    }

    /* ===== AVATAR ===== */
    .avatar-wrap { width: 96px; height: 96px; }
    .avatar-img, .avatar-placeholder {
        width: 96px; height: 96px; border-radius: 999px; object-fit: cover;
        border: 3px solid #fff; box-shadow: 0 8px 20px -8px rgba(15,23,42,0.25);
        transition: transform .4s var(--ease-smooth, cubic-bezier(0.22, 1, 0.36, 1)),
                    box-shadow .4s var(--ease-smooth, cubic-bezier(0.22, 1, 0.36, 1));
    }
    .avatar-placeholder {
        display: flex; align-items: center; justify-content: center;
        background: linear-gradient(135deg, #14B8A6, #0D9488);
        color: #fff; font-size: 1.8rem; font-weight: 700;
    }
    .avatar-wrap:hover .avatar-img,
    .avatar-wrap:hover .avatar-placeholder {
        transform: scale(1.06);
        box-shadow: 0 12px 28px -10px rgba(15,23,42,0.35);
    }
    .avatar-dot {
        position: absolute; bottom: 4px; right: 4px; width: 14px; height: 14px;
        background-color: #14B8A6; border: 3px solid #fff; border-radius: 999px;
        transition: transform .3s var(--ease-smooth, cubic-bezier(0.34, 1.56, 0.64, 1));
    }
    .avatar-wrap:hover .avatar-dot {
        transform: scale(1.15);
    }

    /* ===== GHOST PILL BUTTON ===== */
    .btn-ghost-pill {
        background-color: rgba(20,184,166,0.1); color: #0d9488;
        transition: background-color .3s var(--ease-smooth, cubic-bezier(0.22, 1, 0.36, 1)),
                    transform .25s var(--ease-smooth, cubic-bezier(0.22, 1, 0.36, 1)),
                    box-shadow .3s var(--ease-smooth, cubic-bezier(0.22, 1, 0.36, 1));
    }
    .btn-ghost-pill:hover {
        background-color: rgba(20,184,166,0.2);
        transform: translateY(-2px);
        box-shadow: 0 10px 20px -12px rgba(20,184,166,0.4);
    }
    .btn-ghost-pill:active {
        transform: translateY(0) scale(0.96);
        transition-duration: .15s;
    }

    .security-icon {
        width: 2.1rem; height: 2.1rem; border-radius: .6rem;
        background-color: rgba(20,184,166,0.1); color: #0d9488;
        display: flex; align-items: center; justify-content: center; font-size: .8rem;
        transition: transform .35s var(--ease-smooth, cubic-bezier(0.34, 1.56, 0.64, 1));
    }
    .profile-card:hover .security-icon {
        transform: rotate(-6deg) scale(1.05);
    }

    /* ===== PASSWORD STRENGTH ===== */
    .strength-bar { display: flex; gap: .25rem; }
    .strength-seg {
        flex: 1; height: 4px; border-radius: 999px; background-color: #E2E8F0;
        transition: background-color .35s var(--ease-smooth, cubic-bezier(0.22, 1, 0.36, 1)),
                    transform .25s var(--ease-smooth, cubic-bezier(0.22, 1, 0.36, 1));
    }
    .strength-seg.is-active {
        background-color: #14B8A6;
        transform: scaleY(1.4);
    }

    /* ===== INPUT FIELD RING ===== */
    .field-ring {
        border: 1px solid #E2E8F0; border-radius: .65rem;
        transition: box-shadow .35s var(--ease-smooth, cubic-bezier(0.22, 1, 0.36, 1)),
                    border-color .35s var(--ease-smooth, cubic-bezier(0.22, 1, 0.36, 1)),
                    transform .25s var(--ease-smooth, cubic-bezier(0.22, 1, 0.36, 1));
    }
    .field-ring:hover {
        border-color: #14B8A6;
        transform: translateY(-1px);
    }
    .field-ring:focus-within {
        border-color: #14B8A6;
        box-shadow: 0 0 0 4px rgba(20,184,166,0.14);
        transform: translateY(-1px);
    }

    /* ===== FILLED BUTTON ===== */
    .btn-fill {
        transition: transform .35s var(--ease-smooth, cubic-bezier(0.22, 1, 0.36, 1)),
                    box-shadow .35s var(--ease-smooth, cubic-bezier(0.22, 1, 0.36, 1));
    }
    .btn-fill:hover {
        transform: translateY(-3px);
        box-shadow: 0 18px 34px -14px rgba(20,184,166,0.55);
    }
    .btn-fill:hover .fill-layer {
        transform: scaleX(1);
    }
    .btn-fill:active {
        transform: translateY(-1px) scale(0.97);
        transition-duration: .15s;
    }
    .fill-layer {
        position: absolute; inset: 0; transform: scaleX(0); transform-origin: left;
        transition: transform .4s var(--ease-smooth, cubic-bezier(0.22, 1, 0.36, 1));
        z-index: 0;
    }
    .btn-label { position: relative; z-index: 1; }
</style>