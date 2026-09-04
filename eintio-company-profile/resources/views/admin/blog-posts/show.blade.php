{{-- resources/views/admin/blog-posts/show.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <div>
            <p class="text-xs text-slate-400 mb-1.5">Beranda / Blog & Artikel / Artikel / Detail</p>
            <h2 class="text-xl font-bold text-brand-dark tracking-tight">Detail Artikel</h2>
        </div>

        <div class="flex items-center gap-5">
            <button type="button" class="notif-btn relative p-2 rounded-full">
                <i class="fa-solid fa-bell text-slate-500 text-lg notif-icon"></i>
                <span class="absolute top-1.5 right-1.5 h-2 w-2 rounded-full bg-red-500 animate-ping"></span>
                <span class="absolute top-1.5 right-1.5 h-2 w-2 rounded-full bg-red-500"></span>
            </button>
            <div class="flex items-center gap-3 pl-4 border-l border-slate-200">
                <div class="h-9 w-9 rounded-full bg-brand-mint flex items-center justify-center text-white text-sm font-semibold">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
                <div class="text-sm hidden sm:block text-left">
                    <p class="font-medium text-brand-dark leading-none">{{ Auth::user()->name }}</p>
                    <p class="text-slate-400 text-xs mt-1">Superadmin</p>
                </div>
            </div>
        </div>
    </x-slot>

    @include('admin.blog-posts.partials.styles')

    @php
        $catPaletteCount = 8;
        $catColorIndex = $blogPost->category_id ? ($blogPost->category_id % $catPaletteCount) : 7;
        $thumbUrl = $blogPost->thumbnail ? \Illuminate\Support\Facades\Storage::url($blogPost->thumbnail) : null;
    @endphp

    <style>
        /* ===== HERO dengan background blur dari thumbnail ===== */
        .show-hero {
            position: relative;
            border-radius: 1.25rem;
            overflow: hidden;
            min-height: 280px;
            display: flex;
            align-items: flex-end;
            box-shadow: 0 30px 60px -30px rgba(15,23,42,0.35);
        }
        .show-hero-bg {
            position: absolute;
            inset: -20px;
            background-size: cover;
            background-position: center;
            filter: blur(28px) brightness(0.55) saturate(1.2);
            transform: scale(1.15);
            transition: transform 8s var(--ease-smooth);
        }
        .show-hero:hover .show-hero-bg { transform: scale(1.22); }
        .show-hero-bg.no-image {
            background: linear-gradient(135deg, #0f766e, #134e4a 60%, #0b3b37);
        }
        .show-hero-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(180deg, rgba(15,23,42,0.15) 0%, rgba(15,23,42,0.75) 100%);
        }
        .show-hero-content {
            position: relative;
            z-index: 2;
            padding: 2.25rem 2.5rem;
            width: 100%;
        }
        .show-hero-thumb {
            position: relative;
            z-index: 2;
            width: 100%;
            max-width: 220px;
            aspect-ratio: 4 / 3;
            border-radius: 0.9rem;
            object-fit: cover;
            box-shadow: 0 20px 40px -16px rgba(0,0,0,0.5);
            border: 3px solid rgba(255,255,255,0.15);
            transition: transform .4s var(--ease-smooth);
        }
        .show-hero-thumb:hover { transform: translateY(-4px) scale(1.02); }
        .show-hero-thumb-placeholder {
            position: relative;
            z-index: 2;
            width: 100%;
            max-width: 220px;
            aspect-ratio: 4 / 3;
            border-radius: 0.9rem;
            background: rgba(255,255,255,0.08);
            border: 3px solid rgba(255,255,255,0.15);
            display: flex;
            align-items: center;
            justify-content: center;
            color: rgba(255,255,255,0.4);
        }

        .show-back-btn {
            position: absolute;
            top: 1.25rem; left: 1.25rem;
            z-index: 3;
            width: 2.4rem; height: 2.4rem;
            border-radius: 9999px;
            background: rgba(255,255,255,0.15);
            backdrop-filter: blur(8px);
            color: #fff;
            display: flex; align-items: center; justify-content: center;
            transition: background-color .25s var(--ease-smooth), transform .25s var(--ease-smooth);
        }
        .show-back-btn:hover { background: rgba(255,255,255,0.28); transform: translateX(-2px); }

        .show-meta-chip {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            font-size: 0.75rem;
            font-weight: 600;
            padding: 0.35rem 0.8rem;
            border-radius: 999px;
            backdrop-filter: blur(6px);
        }

        .show-info-card {
            border: 1px solid #E2E8F0;
            border-radius: 1rem;
            transition: box-shadow .3s var(--ease-smooth), border-color .3s var(--ease-smooth), transform .3s var(--ease-smooth);
        }
        .show-info-card:hover {
            box-shadow: 0 16px 32px -18px rgba(15,23,42,0.18);
            border-color: rgba(20,184,166,0.3);
            transform: translateY(-2px);
        }
        .show-info-icon {
            width: 2.5rem; height: 2.5rem;
            border-radius: 0.75rem;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
            transition: transform .3s var(--ease-smooth);
        }
        .show-info-card:hover .show-info-icon { transform: scale(1.1) rotate(-4deg); }

        .show-section-card {
            border: 1px solid #E2E8F0;
            border-radius: 1rem;
            transition: border-color .3s var(--ease-smooth), box-shadow .3s var(--ease-smooth);
        }
        .show-section-card:hover {
            border-color: rgba(20,184,166,0.3);
            box-shadow: 0 14px 28px -18px rgba(15,23,42,0.15);
        }
        .show-section-num {
            width: 2rem; height: 2rem;
            border-radius: 0.6rem;
            background: rgba(20,184,166,0.1);
            color: #0d9488;
            font-weight: 700;
            font-size: 0.8rem;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }
        .show-content-body {
            font-size: 0.9rem;
            line-height: 1.75;
            color: #475569;
            white-space: pre-line;
        }

        .show-action-btn {
            transition: transform .25s var(--ease-smooth), box-shadow .25s var(--ease-smooth), background-color .25s var(--ease-smooth), color .25s var(--ease-smooth);
        }
        .show-action-btn:hover { transform: translateY(-2px); }
    </style>

    <div class="space-y-6 w-full">

        {{-- ===== HERO SECTION dengan background blur ===== --}}
        <div class="reveal show-hero">
            <div class="show-hero-bg {{ $thumbUrl ? '' : 'no-image' }}"
                 @if($thumbUrl) style="background-image: url('{{ $thumbUrl }}')" @endif></div>
            <div class="show-hero-overlay"></div>

            <a href="{{ route('admin.blog-posts.index') }}" class="show-back-btn" title="Kembali ke daftar artikel">
                <i class="fa-solid fa-arrow-left text-sm"></i>
            </a>

            <div class="show-hero-content flex flex-col sm:flex-row items-start sm:items-end gap-6">
                @if($thumbUrl)
                    <img src="{{ $thumbUrl }}" class="show-hero-thumb" alt="{{ $blogPost->title }}">
                @else
                    <div class="show-hero-thumb-placeholder">
                        <i class="fa-regular fa-image text-3xl"></i>
                    </div>
                @endif

                <div class="flex-1 min-w-0">
                    <div class="flex items-center gap-2 flex-wrap mb-3">
                        <span class="show-meta-chip cat-badge cat-{{ $catColorIndex }}">{{ $blogPost->category->name ?? '-' }}</span>
                        @if($blogPost->is_published)
                            <span class="show-meta-chip bg-brand-mint/20 text-brand-mint">
                                <span class="h-1.5 w-1.5 rounded-full bg-brand-mint"></span> Published
                            </span>
                        @else
                            <span class="show-meta-chip bg-white/15 text-white/80">
                                <span class="h-1.5 w-1.5 rounded-full bg-white/50"></span> Draft
                            </span>
                        @endif
                        @if($blogPost->featured)
                            <span class="show-meta-chip bg-amber-400/20 text-amber-300">
                                <i class="fa-solid fa-star text-[10px]"></i> Featured
                            </span>
                        @endif
                    </div>
                    <h1 class="text-white font-bold text-2xl sm:text-3xl leading-tight mb-2">{{ $blogPost->title }}</h1>
                    <p class="text-white/70 text-sm flex items-center gap-2 flex-wrap">
                        <i class="fa-regular fa-user text-xs"></i>
                        {{ $blogPost->is_anonymous ? 'Anonim' : ($blogPost->author->name ?? '-') }}
                        <span class="text-white/30">•</span>
                        <i class="fa-regular fa-calendar text-xs"></i>
                        {{ optional($blogPost->published_at ?? $blogPost->created_at)->translatedFormat('d M Y, H:i') }}
                    </p>
                </div>
            </div>
        </div>

        {{-- ===== ACTION BAR ===== --}}
        <div class="reveal flex items-center justify-end gap-3" style="transition-delay:.05s">
            <a href="{{ route('admin.blog-posts.index') }}"
               class="show-action-btn btn-ghost px-5 py-2.5 rounded-lg text-sm font-medium text-slate-500 border border-slate-200">
                Kembali
            </a>
            <a href="{{ route('admin.blog-posts.edit', $blogPost) }}"
               class="show-action-btn btn-fill inline-flex items-center gap-2 px-5 py-2.5 rounded-lg text-sm font-semibold text-white bg-brand-mint">
                <span class="fill-layer bg-brand-teal"></span>
                <span class="btn-label flex items-center gap-2">
                    <i class="fa-solid fa-pen text-xs"></i> Edit Artikel
                </span>
            </a>
        </div>

        {{-- ===== INFO CARDS (grid meta info) ===== --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <div class="reveal show-info-card bg-white p-5 flex items-center gap-3" style="transition-delay:.1s">
                <div class="show-info-icon bg-blue-50 text-blue-500">
                    <i class="fa-solid fa-folder-open text-sm"></i>
                </div>
                <div class="min-w-0">
                    <p class="text-[11px] text-slate-400 uppercase tracking-wide font-semibold">Kategori</p>
                    <p class="text-sm font-semibold text-brand-dark truncate">{{ $blogPost->category->name ?? '-' }}</p>
                </div>
            </div>

            <div class="reveal show-info-card bg-white p-5 flex items-center gap-3" style="transition-delay:.15s">
                <div class="show-info-icon bg-purple-50 text-purple-500">
                    <i class="fa-solid fa-user text-sm"></i>
                </div>
                <div class="min-w-0">
                    <p class="text-[11px] text-slate-400 uppercase tracking-wide font-semibold">Penulis</p>
                    <p class="text-sm font-semibold text-brand-dark truncate">{{ $blogPost->is_anonymous ? 'Anonim' : ($blogPost->author->name ?? '-') }}</p>
                </div>
            </div>

            <div class="reveal show-info-card bg-white p-5 flex items-center gap-3" style="transition-delay:.2s">
                <div class="show-info-icon bg-emerald-50 text-emerald-500">
                    <i class="fa-solid fa-calendar-day text-sm"></i>
                </div>
                <div class="min-w-0">
                    <p class="text-[11px] text-slate-400 uppercase tracking-wide font-semibold">Tanggal</p>
                    <p class="text-sm font-semibold text-brand-dark truncate">{{ optional($blogPost->published_at ?? $blogPost->created_at)->translatedFormat('d M Y') }}</p>
                </div>
            </div>

            <div class="reveal show-info-card bg-white p-5 flex items-center gap-3" style="transition-delay:.25s">
                <div class="show-info-icon {{ $blogPost->is_published ? 'bg-teal-50 text-teal-500' : 'bg-slate-100 text-slate-400' }}">
                    <i class="fa-solid {{ $blogPost->is_published ? 'fa-circle-check' : 'fa-file-pen' }} text-sm"></i>
                </div>
                <div class="min-w-0">
                    <p class="text-[11px] text-slate-400 uppercase tracking-wide font-semibold">Status</p>
                    <p class="text-sm font-semibold text-brand-dark truncate">{{ $blogPost->is_published ? 'Published' : 'Draft' }}</p>
                </div>
            </div>
        </div>

        {{-- ===== RINGKASAN / EXCERPT ===== --}}
        <div class="reveal card-hover bg-white rounded-2xl shadow-sm border border-slate-100 px-8 py-7" style="transition-delay:.3s">
            <h4 class="font-bold text-brand-dark text-sm uppercase tracking-wide text-slate-400 mb-3">Ringkasan Singkat</h4>
            <p class="text-sm text-slate-600 leading-relaxed">{{ $blogPost->excerpt }}</p>
        </div>

        {{-- ===== ISI ARTIKEL (SECTIONS) ===== --}}
        <div class="reveal card-hover bg-white rounded-2xl shadow-sm border border-slate-100 px-8 py-7" style="transition-delay:.35s">
            <h4 class="font-bold text-brand-dark text-sm uppercase tracking-wide text-slate-400 mb-5">Isi Artikel</h4>

            @if($blogPost->sections->isEmpty())
                <div class="flex flex-col items-center justify-center py-14 text-center">
                    <div class="h-14 w-14 rounded-full bg-brand-cream flex items-center justify-center mb-3">
                        <i class="fa-regular fa-file-lines text-slate-300 text-lg"></i>
                    </div>
                    <p class="text-sm text-slate-400">Artikel ini belum memiliki isi section.</p>
                </div>
            @else
                <div class="space-y-5">
                    @foreach($blogPost->sections as $section)
                        <div class="show-section-card bg-white p-6">
                            <div class="flex items-start gap-3 mb-3">
                                <span class="show-section-num">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                                <h5 class="font-bold text-brand-dark text-base pt-1">{{ $section->title }}</h5>
                            </div>
                            <div class="show-content-body pl-11">
                                {{ $section->content ?: '—' }}
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        {{-- ===== ZONA BAHAYA ===== --}}
        <div class="reveal card-hover bg-white rounded-2xl shadow-sm border border-slate-100 px-8 py-6 flex items-center justify-between flex-wrap gap-4" style="transition-delay:.4s">
            <div>
                <p class="text-sm font-semibold text-red-500">Hapus Artikel</p>
                <p class="text-xs text-slate-400">Artikel yang dihapus tidak dapat dikembalikan.</p>
            </div>
            <button type="button" @click="$dispatch('open-delete-modal')" onclick="document.getElementById('show-delete-modal').classList.remove('hidden')"
                    class="show-action-btn btn-ghost px-5 py-2.5 rounded-lg text-sm font-medium text-red-500 border border-red-200 hover:bg-red-50">
                <i class="fa-solid fa-trash mr-1.5"></i> Hapus Artikel
            </button>
        </div>
    </div>

    {{-- ===== MODAL KONFIRMASI DELETE ===== --}}
    <div id="show-delete-modal" x-data="{ open: false }" x-init="open = false"
         class="hidden modal-overlay flex items-center justify-center p-4">
        <div @click="document.getElementById('show-delete-modal').classList.add('hidden')" class="absolute inset-0 bg-brand-dark/60 backdrop-blur-sm"></div>
        <div class="modal-panel relative bg-white rounded-2xl shadow-2xl p-7 w-full max-w-sm text-center z-10">
            <button type="button" onclick="document.getElementById('show-delete-modal').classList.add('hidden')"
                    class="modal-close-btn absolute top-4 right-4 h-7 w-7 text-slate-300">
                <i class="fa-solid fa-xmark text-sm"></i>
            </button>
            <div class="modal-danger-icon h-14 w-14 rounded-full bg-red-50 text-red-500 flex items-center justify-center mx-auto mb-4">
                <i class="fa-solid fa-trash text-lg"></i>
            </div>
            <p class="font-semibold text-brand-dark">Apakah Anda yakin ingin menghapus <span class="text-red-500">{{ $blogPost->title }}</span>?</p>
            <p class="text-xs text-slate-400 mt-1.5">Data yang dihapus tidak dapat dikembalikan.</p>
            <div class="flex gap-3 mt-6">
                <button type="button" onclick="document.getElementById('show-delete-modal').classList.add('hidden')"
                        class="btn-ghost flex-1 px-4 py-2.5 rounded-lg text-sm font-medium text-slate-500 border border-slate-200">Batal</button>
                <form action="{{ route('admin.blog-posts.destroy', $blogPost) }}" method="POST" class="flex-1">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn-fill w-full px-4 py-2.5 rounded-lg text-sm font-semibold text-white bg-red-500">
                        <span class="fill-layer bg-red-600"></span>
                        <span class="btn-label mx-auto">Ya, Hapus</span>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const io = new IntersectionObserver((entries) => {
                entries.forEach((e) => { if (e.isIntersecting) { e.target.classList.add('is-visible'); io.unobserve(e.target); } });
            }, { threshold: 0.1, rootMargin: '0px 0px -30px 0px' });
            document.querySelectorAll('.reveal').forEach((el) => io.observe(el));
        });
    </script>
</x-app-layout>