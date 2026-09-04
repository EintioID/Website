<style>
    input:focus, textarea:focus, select:focus, button:focus {
        outline: none !important;
        box-shadow: none;
    }

    /* Reveal animation */
    .reveal {
        opacity: 0;
        transform: translateY(16px);
        transition: opacity .5s ease, transform .5s ease;
    }
    .reveal.is-visible {
        opacity: 1;
        transform: translateY(0);
    }

    .card-hover {
        transition: box-shadow .25s ease, transform .25s ease;
    }
    .card-hover:hover {
        box-shadow: 0 10px 25px -8px rgba(15, 23, 42, .12);
        transform: translateY(-2px);
    }

    .hover-icon {
        transition: transform .2s ease, background-color .2s ease, color .2s ease;
    }
    .hover-icon:hover {
        transform: scale(1.08);
    }

    .btn-fill {
        position: relative;
        overflow: hidden;
        transition: box-shadow .2s ease, transform .15s ease;
    }
    .btn-fill:hover {
        box-shadow: 0 8px 18px -6px rgba(13, 148, 136, .45);
        transform: translateY(-1px);
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

    .btn-ghost {
        transition: background-color .2s ease, color .2s ease;
        border-radius: .5rem;
    }
    .btn-ghost:hover {
        background-color: #f1f5f9;
        color: #0f172a;
    }

    .table-row-hover {
        transition: background-color .2s ease;
    }
    .table-row-hover:hover {
        background-color: #f8fafc;
    }

    .action-btn {
        transition: background-color .2s ease, transform .15s ease, color .2s ease;
    }
    .action-btn:hover {
        transform: translateY(-1px);
    }

    /* Field ring */
    .field-ring {
        border: 1px solid #e2e8f0;
        border-radius: .65rem;
        transition: border-color .2s ease, box-shadow .2s ease, background-color .2s ease;
    }
    .field-ring:hover {
        border-color: #cbd5e1;
    }
    .field-ring:focus-within {
        border-color: #14b8a6;
        box-shadow: 0 0 0 3px rgba(20, 184, 166, .12);
        background-color: #f8fffe;
    }

    /* ===== DROPDOWN ===== */
    .dropdown-wrap { position: relative; }
    .dropdown-trigger {
        width: 100%;
        border: 1.5px solid #e2e8f0;
        border-radius: .75rem;
        background: #fff;
        transition: border-color .2s ease, box-shadow .2s ease, background-color .2s ease;
        cursor: pointer;
    }
    .dropdown-trigger:hover {
        border-color: #99f6e4;
        background-color: #f8fffe;
    }
    .dropdown-trigger.is-open {
        border-color: #14b8a6;
        box-shadow: 0 0 0 4px rgba(20, 184, 166, .12);
    }
    .dropdown-chevron {
        transition: transform .25s ease;
        color: #94a3b8;
    }
    .dropdown-trigger.is-open .dropdown-chevron {
        transform: rotate(180deg);
        color: #14b8a6;
    }
    .dropdown-panel {
        border: 1px solid #f1f5f9;
        border-radius: .85rem;
        box-shadow: 0 20px 40px -12px rgba(15, 23, 42, .18), 0 4px 10px -4px rgba(15,23,42,.08);
        overflow: hidden;
        padding: .375rem;
        background: #fff;
    }
    .dropdown-list {
        max-height: 260px;
        overflow-y: auto;
        display: flex;
        flex-direction: column;
        gap: 2px;
    }
    .dropdown-list::-webkit-scrollbar { width: 5px; }
    .dropdown-list::-webkit-scrollbar-thumb { background: #e2e8f0; border-radius: 10px; }

    .dropdown-option {
        width: 100%;
        text-align: left;
        border-radius: .6rem;
        transition: background-color .15s ease, color .15s ease;
        color: #475569;
        cursor: pointer;
    }
    .dropdown-option:hover {
        background-color: #f0fdfa;
        color: #0f766e;
    }
    .dropdown-option.is-selected {
        background-color: #ccfbf1;
        color: #0f766e;
        font-weight: 600;
    }
    .dropdown-check { color: #14b8a6; }
    /* ===== END DROPDOWN ===== */

    .upload-box {
        border: 2px dashed #e2e8f0;
        border-radius: .75rem;
        transition: border-color .2s ease, background-color .2s ease;
    }
    .upload-box:hover {
        border-color: #14b8a6;
        background-color: #f0fdfa;
    }

    .repeat-item {
        border: 1px solid #e2e8f0;
        border-radius: .65rem;
        transition: border-color .2s ease, box-shadow .2s ease;
    }
    .repeat-item:hover {
        border-color: #99f6e4;
        box-shadow: 0 4px 12px -4px rgba(15, 23, 42, .08);
    }
    .repeat-item:focus-within {
        border-color: #14b8a6;
        box-shadow: 0 0 0 3px rgba(20, 184, 166, .12);
    }

    .icon-choice {
        border: 1.5px solid #e2e8f0;
        border-radius: .55rem;
        transition: border-color .15s ease, background-color .15s ease, transform .1s ease;
        color: #94a3b8;
    }
    .icon-choice:hover {
        border-color: #14b8a6;
        color: #14b8a6;
        transform: translateY(-1px);
    }
    .icon-choice.is-active {
        border-color: #14b8a6;
        background-color: #f0fdfa;
        color: #0f766e;
    }

    .modal-close-btn {
        transition: background-color .2s ease, color .2s ease, transform .15s ease;
    }
    .modal-close-btn:hover {
        background-color: #fee2e2;
        color: #ef4444;
        transform: rotate(90deg);
    }

    .drag-handle {
        color: #cbd5e1;
        cursor: grab;
        transition: color .15s ease;
    }
    .drag-handle:hover {
        color: #94a3b8;
    }

    /* ===== TABLE (Portofolio) ===== */
    table.table-fixed th,
    table.table-fixed td {
        border-right: none;
    }
    table.table-fixed tbody tr:last-child {
        border-bottom: none;
    }
    table.table-fixed tbody tr td {
        vertical-align: middle;
    }
    /* ===== END TABLE ===== */

    /* ===== PAGINATION ===== */
    .page-btn {
        height: 2rem;
        width: 2rem;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: .5rem;
        font-size: .8125rem;
        font-weight: 600;
        color: #64748b;
        transition: background-color .15s ease, color .15s ease;
    }
    .page-btn:hover {
        background-color: #f1f5f9;
        color: #0f172a;
    }
    .page-btn.is-active {
        background-color: #0f766e;
        color: #fff;
    }
    .page-btn.is-ellipsis {
        cursor: default;
        color: #cbd5e1;
    }
    .page-btn.is-ellipsis:hover {
        background-color: transparent;
        color: #cbd5e1;
    }
    .page-arrow {
        height: 2rem;
        width: 2rem;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: .5rem;
        color: #94a3b8;
        transition: background-color .15s ease, color .15s ease;
    }
    .page-arrow:hover {
        background-color: #f1f5f9;
        color: #0f172a;
    }
    .page-arrow.is-disabled {
        opacity: .4;
        pointer-events: none;
    }
    /* ===== END PAGINATION ===== */

    [x-cloak] { display: none !important; }
</style>