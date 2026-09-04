{{-- resources/views/admin/blog-posts/partials/styles.blade.php --}}
@include('admin.services.partials.styles')

<style>
    /* ============================================================
       OVERRIDE & UPGRADE HOVER INTERACTIONS (setara testimonials)
       ============================================================ */

    /* ===== Card utama: lift + shadow saat hover ===== */
    .card-hover {
        transition: box-shadow .3s var(--ease-smooth), transform .3s var(--ease-smooth), border-color .3s var(--ease-smooth);
    }
    .card-hover:hover {
        box-shadow: 0 20px 40px -20px rgba(15,23,42,0.16);
        transform: translateY(-3px);
        border-color: rgba(20,184,166,0.25);
    }

    /* ===== Table card ===== */
    .team-table-card {
        border-radius: 1rem;
        transition: box-shadow .3s var(--ease-smooth), border-color .3s var(--ease-smooth);
    }

    /* ===== Field ring (search input)  ===== */
    .field-ring {
        transition: box-shadow .3s var(--ease-smooth), border-color .3s var(--ease-smooth), background-color .3s var(--ease-smooth), transform .2s var(--ease-smooth);
    }
    .field-ring:hover { border-color: #14B8A6; transform: translateY(-1px); }
    .field-ring:focus-within { border-color: #14B8A6; box-shadow: 0 0 0 4px rgba(20,184,166,0.14); transform: translateY(-1px); }

    /* ===== Dropdown trigger ===== */
    .dropdown-trigger {
        transition: box-shadow .25s var(--ease-smooth), border-color .25s var(--ease-smooth), transform .2s var(--ease-smooth);
    }
    .dropdown-trigger:hover { border-color: #14B8A6; transform: translateY(-1px); }
    .dropdown-trigger.is-open { border-color: #14B8A6; box-shadow: 0 0 0 4px rgba(20,184,166,0.14); transform: translateY(-1px); }

    .dropdown-option {
        transition: background-color .15s var(--ease-smooth), color .15s var(--ease-smooth), transform .15s var(--ease-smooth);
    }
    .dropdown-option:hover { background-color: #F0FDFA; color: #0f172a; transform: translateX(2px); }

    /* ===== Tombol Filter  ===== */
    .btn-filter {
        transition: border-color .25s var(--ease-smooth), color .25s var(--ease-smooth), background-color .25s var(--ease-smooth), transform .2s var(--ease-smooth);
    }
    .btn-filter:hover {
        border-color: #14B8A6; color: #14B8A6; background-color: rgba(20,184,166,0.05);
        transform: translateY(-1px);
    }
    .btn-filter:hover .filter-icon { transform: rotate(-15deg); }
    .filter-icon { transition: transform .25s var(--ease-smooth); display: inline-block; }

    /* ===== Tombol fill (Tulis Artikel, Simpan, dll) ===== */
    .btn-fill {
        transition: transform .3s var(--ease-smooth), box-shadow .3s var(--ease-smooth);
    }
    .btn-fill:hover {
        transform: translateY(-2px);
        box-shadow: 0 16px 30px -12px rgba(20,184,166,0.5);
    }
    .btn-fill:hover .fill-layer { transform: scaleX(1); }
    .btn-fill:active { transform: translateY(0) scale(0.96); }

    .btn-ghost {
        transition: color .25s var(--ease-smooth), background-color .25s var(--ease-smooth), transform .2s var(--ease-smooth);
    }
    .btn-ghost:hover { color: #1f2937; background-color: #f8fafc; transform: translateY(-1px); }
    .btn-ghost:active { transform: translateY(0) scale(0.97); }

    /* ===== Table row ===== */
    .team-row {
        position: relative;
        overflow: hidden;
        transition: background-color .25s var(--ease-smooth);
    }
    .team-row:hover { background-color: #F8FAFC; }
    .team-row-bar {
        position: absolute; left: 0; top: 0; bottom: 0; width: 0;
        background-color: #14B8A6;
        transition: width .25s var(--ease-smooth);
    }
    .team-row:hover .team-row-bar { width: 3px; }

    /* ===== Thumbnail gambar ===== */
    .blog-cover-thumb, .blog-cover-placeholder {
        transition: transform .3s var(--ease-smooth), box-shadow .3s var(--ease-smooth);
    }
    .team-row:hover .blog-cover-thumb,
    .team-row:hover .blog-cover-placeholder {
        transform: scale(1.08) rotate(-1deg);
        box-shadow: 0 8px 16px -6px rgba(15,23,42,0.25);
    }

    /* ===== Badge kategori ===== */
    .cat-badge { transition: transform .2s var(--ease-smooth); }
    .team-row:hover .cat-badge { transform: translateY(-1px) scale(1.03); }

    /* ===== Icon aksi (view/edit/delete)  ===== */
    .icon-action {
        cursor: pointer;
        display: inline-flex; align-items: center; justify-content: center;
        width: 2rem; height: 2rem;
        border-radius: 0.5rem;
        transition: transform .25s var(--ease-smooth), background-color .25s var(--ease-smooth), color .25s var(--ease-smooth), box-shadow .25s var(--ease-smooth);
    }
    .icon-action:hover {
        transform: scale(1.15) translateY(-2px);
        box-shadow: 0 8px 16px -6px rgba(15,23,42,0.25);
    }
    .icon-action[style*="94A3B8"]:hover { background-color: #3b82f6; color: #fff !important; }
    .icon-edit { color: #14B8A6; }
    .icon-edit:hover { background-color: #14B8A6; color: #fff; }
    .icon-delete { color: #ef4444; }
    .icon-delete:hover { background-color: #ef4444; color: #fff; }

    /* ===== Star toggle (featured) ===== */
    .star-toggle { transition: transform .2s var(--ease-smooth); }
    .team-row:hover .star-toggle { transform: scale(1.1); }

    /* ===== Status pill ===== */
    .status-pill { transition: transform .2s var(--ease-smooth); }
    .team-row:hover .status-pill { transform: translateY(-1px); }

    /* ============================================================
       Table kolom Blog (compact, sesuai mockup)
       ============================================================ */
    .blog-table { width: 100%; border-collapse: collapse; table-layout: fixed; }
    .blog-table col.col-img      { width: 72px; }
    .blog-table col.col-title    { width: 26%; }
    .blog-table col.col-category { width: 15%; }
    .blog-table col.col-author   { width: 12%; }
    .blog-table col.col-date     { width: 100px; }
    .blog-table col.col-status   { width: 100px; }
    .blog-table col.col-featured { width: 80px; }
    .blog-table col.col-action   { width: 120px; }

    .blog-table th, .blog-table td {
        padding: 0.9rem 1rem;
        vertical-align: middle;
    }
    .blog-table th:first-child, .blog-table td:first-child { padding-left: 1.5rem; }
    .blog-table th:last-child, .blog-table td:last-child { padding-right: 1.5rem; }
    .blog-table th {
        padding-top: 0.9rem;
        padding-bottom: 0.9rem;
        letter-spacing: 0.04em;
    }
    .blog-table th.text-center, .blog-table td.text-center { text-align: center; }

    .blog-cover-thumb { width: 46px; height: 46px; border-radius: 0.65rem; object-fit: cover; flex-shrink: 0; display: block; }
    .blog-cover-placeholder {
        width: 46px; height: 46px; border-radius: 0.65rem; flex-shrink: 0;
        background: linear-gradient(135deg, #F0FDFA, #F1F5F9);
        display: flex; align-items: center; justify-content: center;
    }

    .blog-title-text {
        font-size: 0.875rem;
        line-height: 1.35;
        white-space: normal;
        overflow: hidden;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
    }

    .star-toggle { cursor: default; font-size: 0.9rem; }
    .star-toggle.is-featured { color: #f59e0b; }
    .star-toggle.is-not-featured { color: #cbd5e1; }

    /* ===== Badge kategori ===== */
    .cat-badge {
        display: inline-block;
        max-width: 100%;
        font-size: 0.72rem;
        font-weight: 600;
        padding: 0.32rem 0.7rem;
        border-radius: 999px;
        line-height: 1.3;
        white-space: normal;
        word-break: break-word;
    }
    .cat-badge.cat-0 { background-color: #EFF6FF; color: #2563EB; }
    .cat-badge.cat-1 { background-color: #FFF7ED; color: #EA580C; }
    .cat-badge.cat-2 { background-color: #FAF5FF; color: #9333EA; }
    .cat-badge.cat-3 { background-color: #ECFDF5; color: #059669; }
    .cat-badge.cat-4 { background-color: #FDF2F8; color: #DB2777; }
    .cat-badge.cat-5 { background-color: #F0FDFA; color: #0D9488; }
    .cat-badge.cat-6 { background-color: #FEFCE8; color: #CA8A04; }
    .cat-badge.cat-7 { background-color: #F1F5F9; color: #475569; }

    /* ===== Status badge (compact) ===== */
    .status-pill {
        display: inline-flex;
        align-items: center;
        gap: 0.35rem;
        font-size: 0.75rem;
        font-weight: 600;
        white-space: nowrap;
    }
    .status-pill .status-dot { width: 5px; height: 5px; border-radius: 999px; flex-shrink: 0; }
    .status-pill.is-published { color: #14B8A6; }
    .status-pill.is-published .status-dot { background-color: #14B8A6; }
    .status-pill.is-draft { color: #94A3B8; }
    .status-pill.is-draft .status-dot { background-color: #CBD5E1; }

    /* ===== Toggle switch (Featured di form) ===== */
    .toggle-switch { position: relative; display: inline-block; width: 42px; height: 24px; cursor: pointer; }
    .toggle-switch input { opacity: 0; width: 0; height: 0; }
    .toggle-slider {
        position: absolute; inset: 0; background-color: #E2E8F0; border-radius: 999px;
        transition: background-color .25s var(--ease-smooth);
    }
    .toggle-slider::before {
        content: ""; position: absolute; height: 18px; width: 18px; left: 3px; top: 3px;
        background-color: #fff; border-radius: 50%; transition: transform .25s var(--ease-smooth);
        box-shadow: 0 2px 4px rgba(15,23,42,0.2);
    }
    .toggle-switch input:checked + .toggle-slider { background-color: #14B8A6; }
    .toggle-switch input:checked + .toggle-slider::before { transform: translateX(18px); }

    /* ===== Modal-style form card (Create/Edit) ===== */
    .form-modal-card { border-radius: 1.25rem; box-shadow: 0 30px 60px -30px rgba(15,23,42,0.25); }

    /* ===== Section item (Isi Artikel) ===== */
    .section-item {
        border: 1px solid #E2E8F0; border-radius: 0.75rem; background: #fff;
        transition: border-color .25s var(--ease-smooth), box-shadow .25s var(--ease-smooth), transform .2s var(--ease-smooth);
    }
    .section-item:hover {
        border-color: rgba(20,184,166,0.35);
        box-shadow: 0 12px 24px -16px rgba(15,23,42,0.18);
        transform: translateY(-1px);
    }
    .section-item.is-dragging { opacity: 0.4; }
    .section-grip { cursor: grab; color: #cbd5e1; transition: color .2s var(--ease-smooth); }
    .section-item:hover .section-grip { color: #94A3B8; }
    .section-num { color: #94A3B8; font-weight: 600; font-size: 0.75rem; }

    .section-action-btn {
        cursor: pointer; display: inline-flex; align-items: center; justify-content: center;
        width: 1.85rem; height: 1.85rem; border-radius: 0.5rem; color: #94A3B8;
        transition: background-color .2s var(--ease-smooth), color .2s var(--ease-smooth), transform .2s var(--ease-smooth);
    }
    .section-action-btn:hover { transform: scale(1.1); }
    .section-action-btn.is-view:hover { background-color: #F1F5F9; color: #475569; }
    .section-action-btn.is-edit:hover { background-color: rgba(20,184,166,0.12); color: #0d9488; }
    .section-action-btn.is-delete:hover { background-color: rgba(239,68,68,0.12); color: #dc2626; }

    .add-section-link { cursor: pointer; transition: color .2s var(--ease-smooth), gap .2s var(--ease-smooth); display: inline-flex; align-items: center; gap: 0.4rem; }
    .add-section-link:hover { color: #0d9488; gap: 0.6rem; }

        /* ===== Pagination ===== */
    .blog-pagination-nav { display: flex; justify-content: flex-end; }
    .blog-pagination {
        display: flex;
        align-items: center;
        gap: 0.4rem;
        background: #F8FAFC;
        padding: 0.35rem;
        border-radius: 0.85rem;
        border: 1px solid #E2E8F0;
    }

    .pg-btn {
        min-width: 2.15rem;
        height: 2.15rem;
        padding: 0 0.6rem;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 0.6rem;
        font-size: 0.8rem;
        font-weight: 600;
        color: #64748B;
        background: transparent;
        cursor: pointer;
        transition: background-color .2s var(--ease-smooth), color .2s var(--ease-smooth),
                    transform .2s var(--ease-smooth), box-shadow .2s var(--ease-smooth);
    }

    .pg-btn:hover:not(.pg-disabled):not(.pg-active) {
        background-color: #FFFFFF;
        color: #0D9488;
        transform: translateY(-2px);
        box-shadow: 0 8px 16px -8px rgba(15,23,42,0.18);
    }

    .pg-btn:active:not(.pg-disabled):not(.pg-active) {
        transform: translateY(0) scale(0.94);
    }

    .pg-active {
        background-color: #14B8A6 !important;
        color: #fff !important;
        box-shadow: 0 8px 18px -6px rgba(20,184,166,0.55);
    }

    .pg-disabled {
        opacity: 0.35;
        cursor: not-allowed;
        pointer-events: none;
    }

    .pg-dots {
        min-width: 2rem;
        height: 2.15rem;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        color: #94A3B8;
        font-size: 0.8rem;
        font-weight: 600;
    }

    /* ===== Notif bell hover ===== */
    .notif-btn { transition: background-color .3s var(--ease-smooth); }
    .notif-btn:hover { background-color: rgba(20,184,166,0.08); }
    @keyframes blogBellWiggle { 0%,100% { transform: rotate(0); } 25% { transform: rotate(-10deg); } 75% { transform: rotate(10deg); } }
    .notif-btn:hover .notif-icon { animation: blogBellWiggle .4s ease-in-out; }

        /* ============================================================
       ISI ARTIKEL — Section Types (Deskripsi/List/Kolom/Manfaat/Timeline/Quote)
       ============================================================ */

    /* ===== Menu pilih tipe section ===== */
    .section-type-menu {
        width: 220px;
        border: 1px solid #E2E8F0;
        border-radius: 0.85rem;
        box-shadow: 0 20px 40px -20px rgba(15,23,42,0.25);
        overflow: hidden;
        padding: 0.35rem;
    }
    .section-type-option {
        border-radius: 0.6rem;
        color: #475569;
        transition: background-color .15s var(--ease-smooth), color .15s var(--ease-smooth);
    }
    .section-type-option:hover { background-color: #F0FDFA; color: #0d9488; }

    /* ===== Badge chip tipe section ===== */
    .section-type-chip {
        display: inline-flex; align-items: center; flex-shrink: 0;
        font-size: 0.68rem; font-weight: 600;
        padding: 0.2rem 0.55rem; border-radius: 999px;
        background-color: #F0FDFA; color: #0d9488; white-space: nowrap;
    }
    .section-badge-chip {
        display: inline-flex; align-items: center;
        font-size: 0.72rem; font-weight: 600;
        padding: 0.3rem 0.7rem; border-radius: 999px;
        background-color: #F0FDFA; color: #0d9488;
    }

    /* ===== Item row di dalam modal section ===== */
    .item-row {
        border: 1px solid #E2E8F0; border-radius: 0.65rem; background: #fff;
        transition: border-color .2s var(--ease-smooth), box-shadow .2s var(--ease-smooth);
    }
    .item-row:hover { border-color: rgba(20,184,166,0.35); box-shadow: 0 8px 16px -12px rgba(15,23,42,0.18); }
    .item-row-icon, .item-row-num {
        width: 1.85rem; height: 1.85rem; flex-shrink: 0;
        display: flex; align-items: center; justify-content: center;
        border-radius: 0.5rem; background-color: rgba(20,184,166,0.1); color: #0d9488;
    }
    .item-row-num { font-weight: 700; font-size: 0.7rem; }

    /* ===== Icon grid picker ===== */
    .icon-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 0.5rem; }
    .icon-grid-option {
        height: 2.4rem; border-radius: 0.6rem; border: 1px solid #E2E8F0;
        display: flex; align-items: center; justify-content: center; color: #94A3B8;
        transition: border-color .2s var(--ease-smooth), color .2s var(--ease-smooth), background-color .2s var(--ease-smooth);
    }
    .icon-grid-option:hover { border-color: #14B8A6; color: #14B8A6; }
    .icon-grid-option.is-selected { border-color: #14B8A6; background-color: rgba(20,184,166,0.1); color: #0d9488; }

    /* ===== Modal section (kiri) & modal item  ===== */
    .section-modal-panel { max-height: 85vh; }
    .item-modal-panel { align-self: flex-start; margin-top: 2rem; }

            .show-quote-block { border-left: 3px solid #14B8A6; padding-left: 1.25rem; }
        .show-item-card {
            border: 1px solid #E2E8F0; border-radius: 0.85rem;
            transition: border-color .25s var(--ease-smooth), box-shadow .25s var(--ease-smooth);
        }
        .show-item-card:hover { border-color: rgba(20,184,166,0.3); box-shadow: 0 10px 20px -14px rgba(15,23,42,0.15); }
        .show-item-card-icon {
            width: 2.2rem; height: 2.2rem; border-radius: 0.6rem;
            background-color: rgba(20,184,166,0.1); color: #0d9488;
            display: flex; align-items: center; justify-content: center;
        }

            .section-type-num { color: #94A3B8; font-size: 0.75rem; width: 1rem; flex-shrink: 0; }
</style>