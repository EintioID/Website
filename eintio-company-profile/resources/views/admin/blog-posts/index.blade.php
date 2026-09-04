{{-- resources/views/admin/blog-posts/index.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <div>
            <p class="text-xs text-slate-400 mb-1.5">Beranda / Blog & Artikel / Artikel</p>
            <h2 class="text-xl font-bold text-brand-dark tracking-tight">Manajemen Blog / Artikel</h2>
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
        // Palette badge kategori dirotasi otomatis berdasarkan id kategori, biar tiap kategori punya warna konsisten & beda-beda seperti mockup.
        $catPaletteCount = 8;
    @endphp

    <div x-data="blogFilters()" class="space-y-6 w-full">

        @if (session('success'))
            <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)" x-transition
                 class="reveal flex items-center gap-3 bg-brand-mint/10 border border-brand-mint/30 text-brand-mint px-5 py-3.5 rounded-xl text-sm font-medium">
                <i class="fa-solid fa-circle-check text-base"></i>
                {{ session('success') }}
            </div>
        @endif

        <div class="reveal card-hover bg-white rounded-2xl shadow-sm border border-slate-100 px-8 py-7">
            <div class="flex items-center justify-between mb-5 flex-wrap gap-4">
                <div>
                    <h3 class="font-bold text-brand-dark text-lg">Manajemen Blog / Artikel</h3>
                    <p class="text-sm text-slate-400 mt-1">Kelola semua artikel yang ditampilkan di website.</p>
                </div>
                <a href="{{ route('admin.blog-posts.create') }}" class="btn-fill inline-flex items-center gap-2 px-5 py-2.5 rounded-lg text-sm font-semibold text-white bg-brand-mint">
                    <span class="fill-layer bg-brand-teal"></span>
                    <span class="btn-label flex items-center gap-2">
                        <i class="fa-solid fa-pen text-xs"></i>
                        Tulis Artikel
                    </span>
                </a>
            </div>

            <form method="GET" x-ref="filterForm" class="flex flex-wrap gap-3 mb-5">
                <div class="field-ring flex-1 min-w-[200px] flex items-center gap-3 px-4">
                    <i class="fa-solid fa-magnifying-glass text-slate-400 text-sm field-icon"></i>
                    <input type="text" name="search" x-model="search" @input.debounce.500ms="submitForm()"
                           value="{{ request('search') }}" placeholder="Cari artikel..."
                           class="w-full border-0 focus:ring-0 text-sm py-2.5 bg-transparent">
                </div>

                {{-- Dropdown Kategori --}}
                <div class="dropdown-wrap w-48" @click.outside="categoryOpen = false">
                    <input type="hidden" name="category" x-model="category">
                    <button type="button" @click="categoryOpen = !categoryOpen; statusOpen = false; sortOpen = false"
                            class="dropdown-trigger flex items-center gap-3 px-4 py-2.5 text-sm" :class="categoryOpen && 'is-open'">
                        <span class="flex-1 text-left truncate text-slate-600" x-text="categoryLabel()"></span>
                        <i class="fa-solid fa-chevron-down dropdown-chevron text-xs"></i>
                    </button>
                    <div x-show="categoryOpen" x-cloak
                         x-transition:enter="transition ease-out duration-150"
                         x-transition:enter-start="opacity-0 scale-95 -translate-y-1"
                         x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                         class="dropdown-panel absolute mt-2 w-full bg-white z-20">
                        <div class="dropdown-list">
                            <button type="button" @click="category = 'all'; categoryOpen = false; submitForm()"
                                    class="dropdown-option flex items-center justify-between gap-2 px-3 py-2.5 text-sm" :class="(category === 'all' || category === '') ? 'is-selected' : ''">
                                <span>Semua Kategori</span>
                                <i class="fa-solid fa-check dropdown-check text-xs" x-show="category === 'all' || category === ''"></i>
                            </button>
                            @foreach ($categories as $cat)
                                <button type="button" @click="category = '{{ $cat->id }}'; categoryOpen = false; submitForm()"
                                        class="dropdown-option flex items-center justify-between gap-2 px-3 py-2.5 text-sm" :class="category == '{{ $cat->id }}' ? 'is-selected' : ''">
                                    <span>{{ $cat->name }}</span>
                                    <i class="fa-solid fa-check dropdown-check text-xs" x-show="category == '{{ $cat->id }}'"></i>
                                </button>
                            @endforeach
                        </div>
                    </div>
                </div>

                {{-- Dropdown Status --}}
                <div class="dropdown-wrap w-44" @click.outside="statusOpen = false">
                    <input type="hidden" name="status" x-model="status">
                    <button type="button" @click="statusOpen = !statusOpen; categoryOpen = false; sortOpen = false"
                            class="dropdown-trigger flex items-center gap-3 px-4 py-2.5 text-sm" :class="statusOpen && 'is-open'">
                        <span class="flex-1 text-left truncate text-slate-600" x-text="statusLabel()"></span>
                        <i class="fa-solid fa-chevron-down dropdown-chevron text-xs"></i>
                    </button>
                    <div x-show="statusOpen" x-cloak
                         x-transition:enter="transition ease-out duration-150"
                         x-transition:enter-start="opacity-0 scale-95 -translate-y-1"
                         x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                         class="dropdown-panel absolute mt-2 w-full bg-white z-20">
                        <div class="dropdown-list">
                            @foreach (['all' => 'Semua Status', 'published' => 'Published', 'draft' => 'Draft'] as $key => $label)
                                <button type="button" @click="status = '{{ $key }}'; statusOpen = false; submitForm()"
                                        class="dropdown-option flex items-center justify-between gap-2 px-3 py-2.5 text-sm" :class="status === '{{ $key }}' ? 'is-selected' : ''">
                                    <span>{{ $label }}</span>
                                    <i class="fa-solid fa-check dropdown-check text-xs" x-show="status === '{{ $key }}'"></i>
                                </button>
                            @endforeach
                        </div>
                    </div>
                </div>

                {{-- Dropdown Sortir --}}
                <div class="dropdown-wrap w-48" @click.outside="sortOpen = false">
                    <input type="hidden" name="sort" x-model="sort">
                    <button type="button" @click="sortOpen = !sortOpen; categoryOpen = false; statusOpen = false"
                            class="dropdown-trigger flex items-center gap-3 px-4 py-2.5 text-sm" :class="sortOpen && 'is-open'">
                        <i class="fa-solid fa-arrow-up-short-wide text-slate-400 text-xs"></i>
                        <span class="flex-1 text-left truncate text-slate-600" x-text="sortLabel()"></span>
                        <i class="fa-solid fa-chevron-down dropdown-chevron text-xs"></i>
                    </button>
                    <div x-show="sortOpen" x-cloak
                         x-transition:enter="transition ease-out duration-150"
                         x-transition:enter-start="opacity-0 scale-95 -translate-y-1"
                         x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                         class="dropdown-panel absolute mt-2 w-full bg-white z-20">
                        <div class="dropdown-list">
                            @foreach (['terbaru' => 'Terbaru', 'terlama' => 'Terlama', 'az' => 'Judul A-Z', 'za' => 'Judul Z-A'] as $key => $label)
                                <button type="button" @click="sort = '{{ $key }}'; sortOpen = false; submitForm()"
                                        class="dropdown-option flex items-center justify-between gap-2 px-3 py-2.5 text-sm" :class="sort === '{{ $key }}' ? 'is-selected' : ''">
                                    <span>{{ $label }}</span>
                                    <i class="fa-solid fa-check dropdown-check text-xs" x-show="sort === '{{ $key }}'"></i>
                                </button>
                            @endforeach
                        </div>
                    </div>
                </div>

                <button type="button" @click="resetFilter()" class="btn-filter flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl border border-slate-200 text-sm font-medium text-slate-500">
                    <i class="fa-solid fa-filter text-xs filter-icon"></i>
                    <span x-text="hasFilter() ? 'Reset' : 'Filter'"></span>
                </button>
            </form>

            {{-- PENTING: class "reveal" wajib ada supaya row tabel ke-trigger animasi & tidak stuck opacity:0 --}}
            <div class="team-table-card reveal border border-slate-100 overflow-hidden overflow-x-auto" style="transition-delay:.1s">
                <table class="blog-table text-sm">
                    <colgroup>
                        <col class="col-img"><col class="col-title"><col class="col-category">
                        <col class="col-author"><col class="col-date"><col class="col-status">
                        <col class="col-featured"><col class="col-action">
                    </colgroup>
                    <thead>
                        <tr class="text-left text-xs uppercase tracking-wide text-slate-400 bg-slate-50 border-b border-slate-100">
                            <th class="font-semibold">Img</th>
                            <th class="font-semibold">Judul Artikel</th>
                            <th class="font-semibold">Kategori</th>
                            <th class="font-semibold">Penulis</th>
                            <th class="font-semibold">Tanggal</th>
                            <th class="font-semibold">Status</th>
                            <th class="font-semibold text-center">Featured</th>
                            <th class="font-semibold text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse ($blogPosts as $post)
                            @php
                                $catColorIndex = $post->category_id ? ($post->category_id % $catPaletteCount) : 7;
                            @endphp
                            <tr class="team-row">
                                <td class="relative">
                                    <span class="team-row-bar"></span>
                                    @if ($post->thumbnail)
                                        <img src="{{ Storage::url($post->thumbnail) }}" class="blog-cover-thumb">
                                    @else
                                        <div class="blog-cover-placeholder">
                                            <i class="fa-regular fa-image text-slate-300 text-xs"></i>
                                        </div>
                                    @endif
                                </td>
                                <td>
                                    <p class="blog-title-text font-semibold text-brand-dark truncate">{{ Str::limit($post->title, 40) }}</p>
                                </td>
                                <td>
                                    <span class="cat-badge cat-{{ $catColorIndex }}">{{ $post->category->name ?? '-' }}</span>
                                </td>
                                <td class="text-slate-500 text-sm">{{ $post->is_anonymous ? 'Anonim' : ($post->author->name ?? '-') }}</td>
                                <td class="text-slate-500 text-xs">{{ optional($post->published_at ?? $post->created_at)->translatedFormat('d M Y') }}</td>
                                <td>
                                    @if ($post->is_published)
                                        <span class="status-pill is-published"><span class="status-dot"></span>Published</span>
                                    @else
                                        <span class="status-pill is-draft"><span class="status-dot"></span>Draft</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <i class="fa-solid fa-star star-toggle {{ $post->featured ? 'is-featured' : 'is-not-featured' }}"></i>
                                </td>
                                <td>
                                    <div class="action-icons">
                                        <a href="{{ route('admin.blog-posts.show', $post) }}" class="icon-action" style="color:#94A3B8" title="Lihat">
                                            <i class="fa-regular fa-eye text-sm"></i>
                                        </a>
                                        <a href="{{ route('admin.blog-posts.edit', $post) }}" class="icon-action icon-edit" title="Edit">
                                            <i class="fa-solid fa-pen text-sm"></i>
                                        </a>
                                        <button type="button" @click="openDelete('{{ route('admin.blog-posts.destroy', $post) }}', @js($post->title))"
                                                class="icon-action icon-delete" title="Hapus">
                                            <i class="fa-solid fa-trash text-sm"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="px-4 py-16 text-center">
                                    <div class="flex flex-col items-center">
                                        <div class="h-14 w-14 rounded-full bg-brand-cream flex items-center justify-center mb-3">
                                            <i class="fa-regular fa-file-lines text-slate-300 text-lg"></i>
                                        </div>
                                        <p class="text-sm text-slate-400">Belum ada data artikel.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($blogPosts->hasPages())
                <div class="flex items-center justify-between mt-4 pt-4 border-t border-slate-100">
                    <p class="text-xs text-slate-400">Menampilkan {{ $blogPosts->firstItem() }}-{{ $blogPosts->lastItem() }} dari {{ $blogPosts->total() }} data</p>
                    <div class="blog-pagination">
                        {{ $blogPosts->onEachSide(1)->links() }}
                    </div>
                </div>
            @endif
        </div>

        {{-- MODAL KONFIRMASI DELETE --}}
        <template x-teleport="body">
            <div x-show="deleteModal.open" x-cloak style="display:none" class="modal-overlay flex items-center justify-center p-4">
                <div x-show="deleteModal.open" x-transition.opacity @click="deleteModal.open = false" class="absolute inset-0 bg-brand-dark/60 backdrop-blur-sm"></div>
                <div x-show="deleteModal.open"
                     x-transition:enter="transition ease-out duration-250" x-transition:enter-start="opacity-0 scale-95 translate-y-4" x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                     x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                     class="modal-panel relative bg-white rounded-2xl shadow-2xl p-7 w-full max-w-sm text-center z-10">
                    <button type="button" @click="deleteModal.open = false" class="modal-close-btn absolute top-4 right-4 h-7 w-7 text-slate-300">
                        <i class="fa-solid fa-xmark text-sm"></i>
                    </button>
                    <div class="modal-danger-icon h-14 w-14 rounded-full bg-red-50 text-red-500 flex items-center justify-center mx-auto mb-4">
                        <i class="fa-solid fa-trash text-lg"></i>
                    </div>
                    <p class="font-semibold text-brand-dark">Apakah anda yakin ingin menghapus <span x-text="deleteModal.name" class="text-red-500"></span>?</p>
                    <p class="text-xs text-slate-400 mt-1.5">Data yang dihapus tidak dapat dikembalikan.</p>
                    <div class="flex gap-3 mt-6">
                        <button type="button" @click="deleteModal.open = false" class="btn-ghost flex-1 px-4 py-2.5 rounded-lg text-sm font-medium text-slate-500 border border-slate-200">Batal</button>
                        <form :action="deleteModal.url" method="POST" class="flex-1">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn-fill w-full px-4 py-2.5 rounded-lg text-sm font-semibold text-white bg-red-500">
                                <span class="fill-layer bg-red-600"></span>
                                <span class="btn-label mx-auto">Ya, Hapus</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </template>
    </div>

    <script>
        function blogFilters() {
            return {
                search: '{{ request('search') }}',
                category: '{{ request('category', 'all') }}',
                status: '{{ request('status', 'all') }}',
                sort: '{{ request('sort', 'terbaru') }}',
                categories: {!! $categories->pluck('name', 'id')->toJson() !!},
                categoryOpen: false,
                statusOpen: false,
                sortOpen: false,
                deleteModal: { open: false, url: '', name: '' },
                categoryLabel() {
                    return (this.category === 'all' || this.category === '') ? 'Semua Kategori' : (this.categories[this.category] || 'Semua Kategori');
                },
                statusLabel() {
                    const map = { published: 'Published', draft: 'Draft' };
                    return (this.status === 'all' || this.status === '') ? 'Semua Status' : map[this.status];
                },
                sortLabel() {
                    const map = { terbaru: 'Terbaru', terlama: 'Terlama', az: 'Judul A-Z', za: 'Judul Z-A' };
                    return map[this.sort] || 'Terbaru';
                },
                hasFilter() {
                    return this.search !== '' || (this.category !== 'all' && this.category !== '') ||
                           (this.status !== 'all' && this.status !== '') || this.sort !== 'terbaru';
                },
                resetFilter() { this.search = ''; this.category = 'all'; this.status = 'all'; this.sort = 'terbaru'; this.submitForm(); },
                submitForm() { this.$refs.filterForm.submit(); },
                openDelete(url, name) { this.deleteModal = { open: true, url, name }; },
            }
        }
        document.addEventListener('DOMContentLoaded', () => {
            const io = new IntersectionObserver((entries) => {
                entries.forEach((e) => { if (e.isIntersecting) { e.target.classList.add('is-visible'); io.unobserve(e.target); } });
            }, { threshold: 0.1, rootMargin: '0px 0px -30px 0px' });
            document.querySelectorAll('.reveal').forEach((el) => io.observe(el));
        });
    </script>
</x-app-layout>