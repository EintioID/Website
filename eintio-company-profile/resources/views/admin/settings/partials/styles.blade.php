<style>
    [x-cloak] { display: none !important; }

    /* ===== REVEAL ANIMATION ===== */
    .reveal { 
        opacity: 0; 
        transform: translateY(20px); 
        transition: opacity .5s ease, transform .5s ease; 
    }
    .reveal.is-visible { 
        opacity: 1; 
        transform: translateY(0); 
    }

    /* ===== CARD HOVER ===== */
    .card-hover { 
        transition: box-shadow .3s ease, transform .3s ease, border-color .3s ease; 
        border-color: #E2E8F0;
    }
    .card-hover:hover { 
        box-shadow: 0 14px 30px -14px rgba(15,23,42,.14); 
        transform: translateY(-2px); 
        border-color: #99f6e4;
    }

    /* ===== FIELD RING (INPUT) ===== */
    .field-ring {
        border: 1px solid #E2E8F0; 
        border-radius: .75rem;
        transition: border-color .2s ease, box-shadow .2s ease, background-color .2s ease;
    }
    .field-ring:hover { 
        border-color: #99f6e4; 
    }
    .field-ring:focus-within { 
        border-color: #14b8a6; 
        box-shadow: 0 0 0 4px rgba(20,184,166,.12); 
        background-color: #f8fffe; 
    }
    .field-ring input:focus, 
    .field-ring select:focus { 
        outline: none; 
    }

    /* ===== EYE BUTTON ===== */
    .eye-btn { 
        cursor: pointer; 
        transition: color .2s ease, transform .2s ease; 
        color: #94a3b8; 
        padding: .25rem .5rem;
        display: flex;
        align-items: center;
    }
    .eye-btn:hover { 
        color: #14b8a6; 
        transform: scale(1.1);
    }

    /* ===== ICON BADGE ===== */
    .icon-badge { 
        transition: transform .25s ease, box-shadow .25s ease; 
    }
    .card-hover:hover .icon-badge { 
        transform: scale(1.12) rotate(-4deg); 
        box-shadow: 0 6px 16px rgba(0,0,0,.1);
    }

    /* ===== DROPDOWN ===== */
    .dropdown-wrap {
        position: relative;
    }

    .dropdown-trigger {
        border: 1.5px solid #E2E8F0;
        border-radius: .85rem;
        background: #ffffff;
        cursor: pointer;
        transition: all .2s ease;
        display: flex;
        align-items: center;
        gap: .75rem;
    }

    .dropdown-trigger:hover {
        border-color: #99f6e4;
        box-shadow: 0 4px 12px rgba(20,184,166,.08);
    }

    .dropdown-trigger.is-open {
        border-color: #14b8a6;
        box-shadow: 0 0 0 4px rgba(20,184,166,.12);
        background: #f8fffe;
    }

    .dropdown-icon {
        color: #64748b;
    }

    .dropdown-chevron {
        transition: transform .2s ease;
        color: #94a3b8;
    }

    .dropdown-trigger.is-open .dropdown-chevron {
        transform: rotate(180deg);
    }

    .dropdown-panel {
        position: absolute;
        top: calc(100% + .5rem);
        left: 0;
        right: 0;
        background: #ffffff;
        border: 1px solid #E2E8F0;
        border-radius: .85rem;
        box-shadow: 0 10px 30px rgba(0,0,0,.12);
        z-index: 20;
        overflow: hidden;
    }

    .dropdown-list {
        display: flex;
        flex-direction: column;
    }

    .dropdown-option {
        cursor: pointer;
        transition: all .2s ease;
        border: none;
        background: transparent;
        text-align: left;
        width: 100%;
        color: #475569;
        font-weight: 500;
    }

    .dropdown-option:hover {
        background: #f1f5f9;
        color: #14b8a6;
        padding-left: 1.2rem;
    }

    .dropdown-option.is-selected {
        background: #f0fdfb;
        color: #14b8a6;
        border-left: 3px solid #14b8a6;
        padding-left: calc(1rem - 3px);
    }

    /* ===== THEME OPTION (LIGHT/DARK) ===== */
    .theme-option {
        cursor: pointer; 
        border: 1.5px solid #E2E8F0; 
        border-radius: .85rem;
        transition: all .2s ease;
        position: relative;
        padding: 1.5rem 1rem;
        background: #ffffff;
    }

    .theme-option:hover { 
        border-color: #99f6e4; 
        transform: translateY(-3px); 
        box-shadow: 0 8px 20px rgba(20,184,166,.12);
    }

    .theme-option.is-active { 
        border-color: #14b8a6; 
        box-shadow: 0 0 0 4px rgba(20,184,166,.12), 0 8px 20px rgba(20,184,166,.12); 
        background: #f0fdfb;
    }

    .theme-option i {
        font-size: 1.75rem;
        margin-bottom: .5rem;
        transition: transform .2s ease;
    }

    .theme-option:hover i {
        transform: scale(1.1);
    }

    /* ===== SWITCH TOGGLE ===== */
    .switch-track {
        width: 44px; 
        height: 24px; 
        border-radius: 999px; 
        background: #cbd5e1;
        transition: background-color .25s ease; 
        position: relative; 
        cursor: pointer;
        display: flex;
        align-items: center;
    }

    .switch-track:hover {
        background: #bfdbf7;
    }

    .switch-track.is-on { 
        background: #14b8a6; 
    }

    .switch-track.is-on:hover {
        background: #0d9488;
    }

    .switch-thumb {
        position: absolute; 
        top: 2px; 
        left: 2px; 
        width: 20px; 
        height: 20px;
        border-radius: 999px; 
        background: #fff; 
        transition: transform .25s ease;
        box-shadow: 0 2px 4px rgba(0,0,0,.15);
    }

    .switch-track.is-on .switch-thumb { 
        transform: translateX(20px); 
    }

    /* ===== BUTTON ===== */
    .btn-fill {
        position: relative; 
        overflow: hidden; 
        cursor: pointer;
        transition: all .2s ease;
    }

    .btn-fill:hover { 
        box-shadow: 0 10px 22px -8px rgba(13,148,136,.5); 
        transform: translateY(-1px); 
    }

    .btn-fill:active {
        transform: translateY(0);
    }

    .btn-fill .fill-layer { 
        position: absolute; 
        inset: 0; 
        transform: translateX(-100%); 
        transition: transform .3s ease; 
        z-index: 0; 
    }

    .btn-fill:hover .fill-layer { 
        transform: translateX(0); 
    }

    .btn-fill .btn-label { 
        position: relative; 
        z-index: 1; 
    }

    /* ===== STRENGTH BAR ===== */
    .strength-bar { 
        height: 5px; 
        border-radius: 999px; 
        background: #e2e8f0; 
        overflow: hidden; 
        flex: 1; 
    }

    .strength-bar-fill { 
        height: 100%; 
        border-radius: 999px; 
        transition: width .3s ease, background-color .3s ease; 
    }
</style>