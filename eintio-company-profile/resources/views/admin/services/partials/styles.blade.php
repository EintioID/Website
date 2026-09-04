{{-- resources/views/admin/services/partials/styles.blade.php --}}
<style>
    [x-cloak] { display: none !important; }
    :root { --ease-smooth: cubic-bezier(0.22, 1, 0.36, 1); }

        /* ===== REVEAL ===== */
    :root {
        --ease-smooth: cubic-bezier(0.16, 1, 0.3, 1);
        --ease-soft: cubic-bezier(0.25, 0.46, 0.45, 0.94);
    }

    .reveal {
        opacity: 0;
        transform: translateY(28px) scale(0.985);
        transition: opacity .7s var(--ease-smooth), transform .7s var(--ease-smooth);
        will-change: opacity, transform;
    }
    .reveal.is-visible {
        opacity: 1;
        transform: translateY(0) scale(1);
    }

    /* ===== Stagger Animasi  ===== */
    @keyframes rowFadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .team-table-card tbody tr {
        opacity: 0;
    }
    .team-table-card.is-visible tbody tr {
        animation: rowFadeIn .5s var(--ease-soft) forwards;
    }
    .team-table-card.is-visible tbody tr:nth-child(1)  { animation-delay: .05s; }
    .team-table-card.is-visible tbody tr:nth-child(2)  { animation-delay: .10s; }
    .team-table-card.is-visible tbody tr:nth-child(3)  { animation-delay: .15s; }
    .team-table-card.is-visible tbody tr:nth-child(4)  { animation-delay: .20s; }
    .team-table-card.is-visible tbody tr:nth-child(5)  { animation-delay: .25s; }
    .team-table-card.is-visible tbody tr:nth-child(6)  { animation-delay: .30s; }
    .team-table-card.is-visible tbody tr:nth-child(7)  { animation-delay: .35s; }
    .team-table-card.is-visible tbody tr:nth-child(8)  { animation-delay: .40s; }
    .team-table-card.is-visible tbody tr:nth-child(9)  { animation-delay: .45s; }
    .team-table-card.is-visible tbody tr:nth-child(10) { animation-delay: .50s; }

    /* ===== Cards ===== */
    .card-hover { transition: box-shadow .3s var(--ease-smooth), transform .3s var(--ease-smooth), border-color .3s var(--ease-smooth); }
    .card-hover:hover { box-shadow: 0 20px 40px -20px rgba(15,23,42,0.16); transform: translateY(-3px); border-color: rgba(20,184,166,0.25); }

    .team-table-card { border-radius: 1rem; transition: box-shadow .3s var(--ease-smooth), border-color .3s var(--ease-smooth); }

    /* ===== Sidebar Tab  ===== */
    .side-tab { cursor: pointer; transition: background-color .25s var(--ease-smooth), color .25s var(--ease-smooth); }
    .side-tab:hover { background-color: #F1F5F9; }
    .side-tab.is-active { background-color: rgba(20,184,166,0.08); color: #0d9488; }

    /* ===== Step indicator ===== */
    .step-dot { transition: background-color .3s var(--ease-smooth), color .3s var(--ease-smooth); }

    /* ===== Input / Field ring ===== */
    .field-ring { border: 2px solid #E2E8F0; background-color: #fff; border-radius: 0.75rem; transition: box-shadow .3s var(--ease-smooth), border-color .3s var(--ease-smooth); }
    .field-ring:hover { border-color: #14B8A6; }
    .field-ring:focus-within { border-color: #14B8A6; box-shadow: 0 0 0 4px rgba(20,184,166,0.14); }
    .field-ring input, .field-ring textarea, .field-ring select { outline: none; }

    .field-icon { transition: color .25s var(--ease-smooth); }
    .field-ring:focus-within .field-icon, .field-ring:hover .field-icon { color: #14B8A6; }

    /* ===== Custom dropdown ===== */
    .dropdown-wrap { position: relative; }
    .dropdown-trigger {
        width: 100%; cursor: pointer; text-align: left;
        border: 2px solid #E2E8F0; background-color: #fff; border-radius: 0.75rem;
        transition: box-shadow .25s var(--ease-smooth), border-color .25s var(--ease-smooth);
    }
    .dropdown-trigger:hover { border-color: #14B8A6; }
    .dropdown-trigger.is-open { border-color: #14B8A6; box-shadow: 0 0 0 4px rgba(20,184,166,0.14); }
    .dropdown-trigger:focus, .dropdown-trigger:focus-visible {
        outline: none;
        box-shadow: 0 0 0 3px rgba(20, 184, 166, 0.15);
        border-color: rgba(20, 184, 166, 0.4);
    }

    .dropdown-chevron { transition: transform .25s var(--ease-smooth), color .25s var(--ease-smooth); color: #94A3B8; flex-shrink: 0; }
    .dropdown-trigger:hover .dropdown-chevron, .dropdown-trigger.is-open .dropdown-chevron { color: #14B8A6; }
    .dropdown-trigger.is-open .dropdown-chevron { transform: rotate(180deg); }

    .dropdown-panel { border: 1px solid #E2E8F0; border-radius: 0.85rem; box-shadow: 0 20px 40px -16px rgba(15,23,42,0.22); overflow: hidden; }
    .dropdown-panel.right-0 { left: auto; }
    .dropdown-list { max-height: 16rem; overflow-y: auto; padding: 0.4rem; }
    .dropdown-list::-webkit-scrollbar { width: 6px; }
    .dropdown-list::-webkit-scrollbar-thumb { background-color: #E2E8F0; border-radius: 999px; }
    .dropdown-list::-webkit-scrollbar-thumb:hover { background-color: #14B8A6; }

    .dropdown-option { width: 100%; cursor: pointer; text-align: left; border-radius: 0.6rem; color: #475569; transition: background-color .15s var(--ease-smooth), color .15s var(--ease-smooth); }
    .dropdown-option:hover { background-color: #F0FDFA; color: #0f172a; }
    .dropdown-option.is-selected { background-color: rgba(20,184,166,0.08); color: #0d9488; font-weight: 600; }
    .dropdown-check { color: #14B8A6; }

    /* ===== Buttons ===== */
    .btn-fill { cursor: pointer; position: relative; overflow: hidden; isolation: isolate; transition: box-shadow .3s var(--ease-smooth); }
    .btn-fill .fill-layer { position: absolute; inset: 0; transform: scaleX(0); transform-origin: left center; transition: transform .35s var(--ease-smooth); z-index: -1; }
    .btn-fill .btn-label { position: relative; z-index: 1; display: inline-flex; align-items: center; }
    .btn-fill:hover { box-shadow: 0 16px 30px -12px rgba(20,184,166,0.5); }
    .btn-fill:hover .fill-layer { transform: scaleX(1); }
    .btn-fill:active { opacity: 0.9; }

    .btn-ghost { cursor: pointer; transition: color .25s var(--ease-smooth), background-color .25s var(--ease-smooth), border-color .25s var(--ease-smooth); }
    .btn-ghost:hover { color: #1f2937; background-color: #f8fafc; border-color: #cbd5e1; }

    .btn-filter { cursor: pointer; transition: border-color .25s var(--ease-smooth), color .25s var(--ease-smooth), background-color .25s var(--ease-smooth); }
    .btn-filter:hover { border-color: #14B8A6; color: #14B8A6; background-color: rgba(20,184,166,0.05); }
    .filter-icon { display: inline-block; }

    /* ===== Table (index) ===== */
    .services-table { width: 100%; border-collapse: collapse; table-layout: fixed; }
    .services-table col.col-no       { width: 60px; }
    .services-table col.col-name     { }
    .services-table col.col-category { width: 150px; }
    .services-table col.col-status   { width: 120px; }
    .services-table col.col-order    { width: 100px; }
    .services-table col.col-action   { width: 130px; }

    .services-table th, .services-table td {
        padding: 1rem 1.25rem;
        vertical-align: middle;
    }
    .services-table th:first-child, .services-table td:first-child { padding-left: 1.5rem; }
    .services-table th:last-child, .services-table td:last-child { padding-right: 1.5rem; }

    .team-row { position: relative; transition: background-color .25s var(--ease-smooth); }
    .team-row:hover { background-color: #F8FAFC; }
    .team-row-bar { position: absolute; left: 0; top: 0; bottom: 0; width: 3px; background-color: transparent; transition: background-color .25s var(--ease-smooth); }
    .team-row:hover .team-row-bar { background-color: #14B8A6; }

    .service-icon-thumb { flex-shrink: 0; transition: box-shadow .3s var(--ease-smooth); }
    .team-row:hover .service-icon-thumb { box-shadow: 0 8px 18px -6px rgba(15,23,42,0.25); }

    .action-icons { display: flex; align-items: center; justify-content: flex-end; gap: 0.5rem; }
    .icon-action {
        cursor: pointer;
        display: inline-flex; align-items: center; justify-content: center;
        width: 2rem; height: 2rem;
        border-radius: 0.5rem;
        transition: background-color .2s var(--ease-smooth), color .2s var(--ease-smooth);
    }
    .icon-edit { color: #14B8A6; }
    .icon-edit:hover { background-color: #14B8A6; color: #fff; }
    .icon-delete { color: #ef4444; }
    .icon-delete:hover { background-color: #ef4444; color: #fff; }

    .badge { display: inline-block; }

    /* ===== Upload box ===== */
    .upload-box { cursor: pointer; transition: border-color .3s var(--ease-smooth), background-color .3s var(--ease-smooth), box-shadow .3s var(--ease-smooth); }
    .upload-box:hover { border-color: #14B8A6; background-color: rgba(20,184,166,0.05); box-shadow: 0 14px 28px -14px rgba(20,184,166,0.3); }
    .upload-box .upload-icon { transition: transform .3s var(--ease-smooth), color .3s var(--ease-smooth); }
    .upload-box:hover .upload-icon { transform: scale(1.1); color: #14B8A6; }

    /* ===== Item row (advantage / feature list) ===== */
    .item-row { border: 1px solid #E2E8F0; border-radius: 0.75rem; transition: border-color .25s var(--ease-smooth), box-shadow .25s var(--ease-smooth), background-color .25s var(--ease-smooth); }
    .item-row:hover { border-color: rgba(20,184,166,0.35); box-shadow: 0 12px 24px -16px rgba(15,23,42,0.2); background-color: #FAFDFC; }
    .item-row .grip-icon { transition: color .2s var(--ease-smooth); }
    .item-row:hover .grip-icon { color: #94A3B8; }

    .item-icon-box { transition: background-color .25s var(--ease-smooth); }

    .item-action-btn {
        cursor: pointer;
        display: inline-flex; align-items: center; justify-content: center;
        width: 2rem; height: 2rem; border-radius: 0.5rem;
        transition: color .2s var(--ease-smooth), background-color .2s var(--ease-smooth);
    }
    .item-action-btn.is-edit:hover { color: #0d9488; background-color: rgba(20,184,166,0.1); }
    .item-action-btn.is-delete:hover { color: #dc2626; background-color: rgba(239,68,68,0.1); }

    /* ===== Icon picker grid ===== */
    .icon-swatch { cursor: pointer; transition: background-color .2s var(--ease-smooth), color .2s var(--ease-smooth); }
    .icon-swatch:hover { background-color: #CCFBF1; color: #0f766e; }
    .icon-swatch.is-selected { background-color: #14B8A6; color: #fff; }
    .icon-swatch.is-selected:hover { background-color: #0d9488; }

    .icon-preview-box { transition: background-color .3s var(--ease-smooth); }

    /* ===== Modal ===== */
    .modal-close-btn {
        cursor: pointer;
        display: inline-flex; align-items: center; justify-content: center;
        transition: color .2s var(--ease-smooth), background-color .2s var(--ease-smooth);
        border-radius: 9999px;
    }
    .modal-close-btn:hover { color: #1f2937; background-color: #f1f5f9; }

    .modal-panel { transition: box-shadow .3s var(--ease-smooth); }
    .modal-danger-icon { transition: transform .3s var(--ease-smooth); }

    .status-dot { display: inline-block; }

    .row-icon-link { cursor: pointer; display: inline-flex; align-items: center; justify-content: center; transition: color .2s var(--ease-smooth); }

    .side-tab.is-disabled { cursor: not-allowed; opacity: 0.4; }
    .side-tab.is-disabled:hover { background-color: transparent; }

    /* ===== Modal overlay via x-teleport ===== */
    .modal-overlay { position: fixed; inset: 0; width: 100vw; height: 100vh; z-index: 9999; }
</style>