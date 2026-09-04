{{-- resources/views/admin/Teams/partials/styles.blade.php --}}
<style>
    [x-cloak] { display: none !important; }
    :root { --ease-smooth: cubic-bezier(0.22, 1, 0.36, 1); }

    .reveal { opacity: 0; transform: translateY(24px); transition: opacity .6s var(--ease-smooth), transform .6s var(--ease-smooth); }
    .reveal.is-visible { opacity: 1; transform: translateY(0); }

    /* ===== Cards ===== */
    .card-hover { transition: box-shadow .3s var(--ease-smooth), transform .3s var(--ease-smooth), border-color .3s var(--ease-smooth); }
    .card-hover:hover { box-shadow: 0 20px 40px -20px rgba(15,23,42,0.16); transform: translateY(-3px); border-color: rgba(20,184,166,0.25); }

    .side-card { border: 1px solid #E2E8F0; border-radius: 1rem; transition: box-shadow .3s var(--ease-smooth), transform .3s var(--ease-smooth), border-color .3s var(--ease-smooth); }
    .side-card:hover { box-shadow: 0 18px 36px -18px rgba(15,23,42,0.2); transform: translateY(-3px); border-color: rgba(20,184,166,0.3); }

    .team-table-card { border: 1px solid #E2E8F0; border-radius: 1rem; position: relative; z-index: 1; transition: box-shadow .3s var(--ease-smooth), border-color .3s var(--ease-smooth); }

    /* ===== Input / Field ring  ===== */
    .field-ring { border: 1px solid #E2E8F0; background-color: rgba(251,246,238,0.4); border-radius: 0.75rem; transition: box-shadow .3s var(--ease-smooth), border-color .3s var(--ease-smooth), background-color .3s var(--ease-smooth), transform .2s var(--ease-smooth); }
    .field-ring:hover { border-color: #14B8A6; background-color: #fff; transform: translateY(-1px); }
    .field-ring:focus-within { border-color: #14B8A6; background-color: #fff; box-shadow: 0 0 0 4px rgba(20,184,166,0.14); transform: translateY(-1px); }
    .field-ring input, .field-ring textarea { outline: none; }

    .field-icon { transition: color .25s var(--ease-smooth), transform .25s var(--ease-smooth); }
    .field-ring:focus-within .field-icon, .field-ring:hover .field-icon { color: #14B8A6; }
    .field-ring:focus-within .field-icon { transform: scale(1.1); }

    .clear-btn { cursor: pointer; transition: color .2s var(--ease-smooth), transform .2s var(--ease-smooth); }
    .clear-btn:hover { color: #ef4444; transform: rotate(90deg) scale(1.1); }

    /* ===== CUSTOM DROPDOWN ===== */
    .dropdown-wrap { position: relative; }

    .dropdown-trigger {
        width: 100%;
        cursor: pointer;
        text-align: left;
        border: 1px solid #E2E8F0;
        background-color: rgba(251,246,238,0.4);
        border-radius: 0.75rem;
        transition: box-shadow .25s var(--ease-smooth), border-color .25s var(--ease-smooth), background-color .25s var(--ease-smooth), transform .2s var(--ease-smooth);
    }
    .dropdown-trigger:hover {
        border-color: #14B8A6;
        background-color: #fff;
        transform: translateY(-1px);
    }
    .dropdown-trigger.is-open {
        border-color: #14B8A6;
        background-color: #fff;
        box-shadow: 0 0 0 4px rgba(20,184,166,0.14);
        transform: translateY(-1px);
    }

    .dropdown-icon { transition: color .25s var(--ease-smooth), transform .25s var(--ease-smooth); color: #94A3B8; }
    .dropdown-trigger:hover .dropdown-icon,
    .dropdown-trigger.is-open .dropdown-icon { color: #14B8A6; }
    .dropdown-trigger.is-open .dropdown-icon { transform: scale(1.1); }

    .dropdown-chevron { transition: transform .25s var(--ease-smooth), color .25s var(--ease-smooth); color: #94A3B8; flex-shrink: 0; }
    .dropdown-trigger:hover .dropdown-chevron,
    .dropdown-trigger.is-open .dropdown-chevron { color: #14B8A6; }
    .dropdown-trigger.is-open .dropdown-chevron { transform: rotate(180deg); }

    .dropdown-panel {
        position: absolute;
        border: 1px solid #E2E8F0;
        border-radius: 0.85rem;
        box-shadow: 0 20px 40px -16px rgba(15,23,42,0.22);
        overflow: hidden;
        z-index: 50;
        background-color: #fff;
    }
    .dropdown-list { max-height: 16rem; overflow-y: auto; padding: 0.4rem; }
    .dropdown-list::-webkit-scrollbar { width: 6px; }
    .dropdown-list::-webkit-scrollbar-thumb { background-color: #E2E8F0; border-radius: 999px; }
    .dropdown-list::-webkit-scrollbar-thumb:hover { background-color: #14B8A6; }

    .dropdown-option {
        width: 100%;
        cursor: pointer;
        text-align: left;
        border-radius: 0.6rem;
        color: #475569;
        transition: background-color .15s var(--ease-smooth), color .15s var(--ease-smooth), transform .15s var(--ease-smooth);
    }
    .dropdown-option:hover {
        background-color: #FBF6EE;
        color: #14213D;
        transform: translateX(2px);
    }
    .dropdown-option.is-selected {
        background-color: rgba(20,184,166,0.08);
        color: #0d9488;
        font-weight: 600;
    }
    .dropdown-check { color: #14B8A6; transition: opacity .15s var(--ease-smooth), transform .15s var(--ease-smooth); }

    .dropdown-empty { color: #CBD5E1; font-style: italic; }

    /* ===== Buttons ===== */
    .btn-fill { cursor: pointer; position: relative; overflow: hidden; isolation: isolate; transition: transform .3s var(--ease-smooth), box-shadow .3s var(--ease-smooth); }
    .btn-fill .fill-layer { position: absolute; inset: 0; transform: scaleX(0); transform-origin: left center; transition: transform .35s var(--ease-smooth); z-index: -1; }
    .btn-fill .btn-label { position: relative; z-index: 1; display: inline-flex; align-items: center; }
    .btn-fill:hover { transform: translateY(-2px); box-shadow: 0 16px 30px -12px rgba(20,184,166,0.5); }
    .btn-fill:hover .fill-layer { transform: scaleX(1); }
    .btn-fill:active { transform: translateY(0) scale(0.96); }
    .btn-fill .plus-icon { transition: transform .3s var(--ease-smooth); }
    .btn-fill:hover .plus-icon { transform: rotate(90deg) scale(1.15); }

    .btn-ghost { cursor: pointer; transition: color .25s var(--ease-smooth), background-color .25s var(--ease-smooth), transform .2s var(--ease-smooth); border-radius: 0.5rem; }
    .btn-ghost:hover { color: #1f2937; background-color: #f8fafc; transform: translateY(-1px); }
    .btn-ghost:active { transform: translateY(0) scale(0.97); }

    .btn-outline { cursor: pointer; transition: background-color .3s var(--ease-smooth), color .3s var(--ease-smooth), transform .3s var(--ease-smooth), box-shadow .3s var(--ease-smooth); }
    .btn-outline:hover { transform: translateY(-2px); box-shadow: 0 14px 26px -14px rgba(65,82,109,0.4); }
    .btn-outline:active { transform: translateY(0) scale(0.97); }

    .btn-filter { cursor: pointer; transition: border-color .25s var(--ease-smooth), color .25s var(--ease-smooth), background-color .25s var(--ease-smooth), transform .2s var(--ease-smooth); }
    .btn-filter:hover, .btn-filter.active { border-color: #14B8A6; color: #14B8A6; background-color: rgba(20,184,166,0.05); transform: translateY(-1px); }
    .btn-filter:hover .filter-icon { transform: rotate(-15deg); }
    .filter-icon { transition: transform .25s var(--ease-smooth); display: inline-block; }

    .link-underline { cursor: pointer; position: relative; }
    .link-underline::after { content: ''; position: absolute; left: 0; bottom: -2px; width: 0; height: 1px; background: currentColor; transition: width .25s var(--ease-smooth); }
    .link-underline:hover::after { width: 100%; }
    .link-underline:hover { color: #0d9488; }

    /* ===== Notif & user menu ===== */
    .notif-btn { cursor: pointer; border-radius: 9999px; transition: background-color .3s var(--ease-smooth); }
    .notif-btn:hover { background-color: rgba(251,246,238,0.7); }
    @keyframes wiggle { 0%,100% { transform: rotate(0); } 25% { transform: rotate(-10deg); } 75% { transform: rotate(10deg); } }
    .notif-btn:hover .notif-icon { animation: wiggle .4s ease-in-out; }

    .user-menu-btn { cursor: pointer; }
    .user-avatar { transition: box-shadow .3s var(--ease-smooth); box-shadow: 0 0 0 0 rgba(20,184,166,0); }
    .user-menu-btn:hover .user-avatar, .user-avatar.is-open { box-shadow: 0 0 0 2px #14B8A6, 0 0 0 4px #fff; }
    .chevron-icon { transition: transform .3s var(--ease-smooth); }

    .menu-item { cursor: pointer; overflow: hidden; transition: color .2s var(--ease-smooth), background-color .2s var(--ease-smooth); }
    .menu-item:hover { color: #14213D; background-color: #FBF6EE; }
    .menu-item--danger:hover { color: #ef4444; background-color: #FEF2F2; }
    .menu-item-bar { position: absolute; left: 0; top: 0; height: 100%; width: 0; transition: width .2s var(--ease-smooth); }
    .menu-item:hover .menu-item-bar { width: 3px; }
    .menu-item-icon { transition: transform .2s var(--ease-smooth), color .2s var(--ease-smooth); }
    .menu-item:hover .menu-item-icon { transform: translateX(2px); color: #14B8A6; }
    .menu-item--danger:hover .menu-item-icon { color: #ef4444; }

    /* ===== Table ===== */
    .team-row { position: relative; overflow: visible; transition: background-color .25s var(--ease-smooth); }
    .team-row:hover { background-color: #FBF6EE; }
    .team-row td:first-child { position: relative; }
    .team-row-bar { position: absolute; left: 0; top: 0; bottom: 0; width: 3px; background-color: transparent; transition: background-color .25s var(--ease-smooth); }
    .team-row:hover .team-row-bar { background-color: #14B8A6; }
    .team-photo { transition: transform .3s var(--ease-smooth), box-shadow .3s var(--ease-smooth); }
    .team-row:hover .team-photo { transform: scale(1.1) rotate(-2deg); box-shadow: 0 8px 18px -6px rgba(15,23,42,0.3); }

    .icon-action { cursor: pointer; transition: transform .25s var(--ease-smooth), background-color .25s var(--ease-smooth), color .25s var(--ease-smooth), box-shadow .25s var(--ease-smooth); }
    .icon-action:hover { transform: scale(1.15) translateY(-2px); box-shadow: 0 8px 16px -6px rgba(15,23,42,0.25); }
    .icon-edit:hover { background-color: #14B8A6; color: #fff; }
    .icon-delete:hover { background-color: #ef4444; color: #fff; }

    .badge { transition: transform .2s var(--ease-smooth); }
    .team-row:hover .badge { transform: translateY(-1px) scale(1.03); }

    .search-empty { animation: fadeUp .35s ease; }
    @keyframes fadeUp { from { opacity: 0; transform: translateY(8px); } to { opacity: 1; transform: translateY(0); } }

    /* ===== Modal ===== */
    .modal-close-btn { cursor: pointer; transition: color .2s var(--ease-smooth), background-color .2s var(--ease-smooth), transform .2s var(--ease-smooth); }
    .modal-close-btn:hover { color: #1f2937; background-color: #f1f5f9; transform: rotate(90deg); }
    .modal-danger-icon { transition: transform .3s var(--ease-smooth); }
    .modal-danger-icon:hover { transform: scale(1.1) rotate(-4deg); }

    /* ===== Upload box ===== */
    .upload-box { cursor: pointer; border: 2px dashed #E2E8F0; border-radius: 1rem; transition: border-color .3s var(--ease-smooth), background-color .3s var(--ease-smooth), box-shadow .3s var(--ease-smooth), transform .3s var(--ease-smooth); }
    .upload-box:hover { border-color: #14B8A6; background-color: rgba(20,184,166,0.05); box-shadow: 0 14px 28px -14px rgba(20,184,166,0.3); transform: translateY(-2px); }
    .upload-box .upload-icon { transition: transform .3s var(--ease-smooth), background-color .3s var(--ease-smooth), color .3s var(--ease-smooth); }
    .upload-box:hover .upload-icon { transform: scale(1.15) translateY(-2px) rotate(-6deg); background-color: #14B8A6; color: #fff; }
    .upload-box img { transition: transform .3s var(--ease-smooth); }
    .upload-box:hover img { transform: scale(1.05); }
</style>