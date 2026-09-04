<x-app-layout>
    <x-slot name="header">
        <div>
            <p class="text-xs text-slate-400 mb-1.5">Beranda / Portofolio</p>
            <h2 class="text-xl font-bold text-brand-dark tracking-tight">Portofolio</h2>
        </div>
    </x-slot>

    @include('admin.portfolios.partials.styles')

    <div x-data="portfolioIndex()" class="space-y-6">

        @if(session('success'))
            <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)" x-transition
                 class="flex items-center gap-3 bg-brand-mint/10 border border-brand-mint/30 text-brand-mint px-5 py-3.5 rounded-xl text-sm font-medium">
                <i class="fa-solid fa-circle-check text-base"></i>
                {{ session('success') }}
            </div>
        @endif

        <div class="reveal card-hover flex items-center justify-between bg-white rounded-2xl shadow-sm border border-slate-100 px-8 py-7">
            <div>
                <h3 class="text-lg font-bold text-brand-dark">Portofolio</h3>
                <p class="text-sm text-slate-400 mt-1.5">Kelola semua portfolio proyek yang ditampilkan di website.</p>
            </div>
            <a href="{{ route('admin.portfolios.create') }}"
               class="btn-fill flex items-center gap-2 px-5 py-2.5 rounded-lg text-sm font-semibold text-white bg-brand-mint">
                <span class="fill-layer bg-brand-teal"></span>
                <span class="btn-label"><i class="fa-solid fa-plus mr-1"></i> Tambah Portfolio</span>
            </a>
        </div>

        <div class="reveal card-hover bg-white rounded-2xl shadow-sm border border-slate-100 overflow-visible" style="transition-delay:.05s">
            <form method="GET" x-ref="filterForm" class="flex flex-wrap items-center gap-3 px-6 py-5 border-b border-slate-100 relative z-10">
                <div class="field-ring flex items-center gap-2 px-3 flex-1 min-w-[200px]">
                    <i class="fa-solid fa-magnifying-glass text-slate-400 text-xs"></i>
                    <input type="text" name="search" x-model="search" @input.debounce.500ms="$nextTick(() => $refs.filterForm.submit())"
                           placeholder="Cari portfolio..."
                           class="w-full bg-transparent border-0 focus:ring-0 text-sm py-2.5">
                    <button type="button" x-show="search.length > 0" x-cloak
                            @click="search = ''; $nextTick(() => $refs.filterForm.submit())"
                            class="text-slate-300 hover:text-red-500 transition-colors" title="Hapus pencarian">
                        <i class="fa-solid fa-xmark text-xs"></i>
                    </button>
                </div>

                {{-- Dropdown Kategori --}}
                <div class="dropdown-wrap w-52" @click.outside="categoryOpen = false">
                    <input type="hidden" name="category_id" :value="categoryId">
                    <button type="button" @click="categoryOpen = !categoryOpen; statusOpen = false"
                            class="dropdown-trigger flex items-center gap-2 px-4 py-2.5" :class="categoryOpen && 'is-open'">
                        <i class="fa-solid fa-layer-group text-slate-400 text-xs"></i>
                        <span class="flex-1 text-sm text-left truncate" x-text="categoryLabel()"></span>
                        <i class="fa-solid fa-chevron-down dropdown-chevron text-xs"></i>
                    </button>
                    <div x-show="categoryOpen" x-cloak
                         x-transition:enter="transition ease-out duration-150"
                         x-transition:enter-start="opacity-0 scale-95 -translate-y-1"
                         x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                         x-transition:leave="transition ease-in duration-100"
                         x-transition:leave-start="opacity-100 scale-100"
                         x-transition:leave-end="opacity-0 scale-95"
                         class="dropdown-panel absolute mt-2 w-56 z-30">
                        <div class="dropdown-list">
                            <button type="button" @click="setCategory('')"
                                    class="dropdown-option flex items-center justify-between px-3.5 py-2.5 text-sm"
                                    :class="categoryId === '' ? 'is-selected' : ''">
                                <span>Semua Kategori</span>
                                <i class="fa-solid fa-check dropdown-check text-xs" x-show="categoryId === ''"></i>
                            </button>
                            @foreach($categories as $cat)
                                <button type="button" @click="setCategory('{{ $cat->id }}')"
                                        class="dropdown-option flex items-center justify-between px-3.5 py-2.5 text-sm"
                                        :class="categoryId === '{{ $cat->id }}' ? 'is-selected' : ''">
                                    <span>{{ $cat->name }}</span>
                                    <i class="fa-solid fa-check dropdown-check text-xs" x-show="categoryId === '{{ $cat->id }}'"></i>
                                </button>
                            @endforeach
                        </div>
                    </div>
                </div>

                {{-- Dropdown Status --}}
                <div class="dropdown-wrap w-44" @click.outside="statusOpen = false">
                    <input type="hidden" name="status" :value="statusVal">
                    <button type="button" @click="statusOpen = !statusOpen; categoryOpen = false"
                            class="dropdown-trigger flex items-center gap-2 px-4 py-2.5" :class="statusOpen && 'is-open'">
                        <i class="fa-solid fa-filter text-slate-400 text-xs"></i>
                        <span class="flex-1 text-sm text-left truncate" x-text="statusLabel()"></span>
                        <i class="fa-solid fa-chevron-down dropdown-chevron text-xs"></i>
                    </button>
                    <div x-show="statusOpen" x-cloak
                         x-transition:enter="transition ease-out duration-150"
                         x-transition:enter-start="opacity-0 scale-95 -translate-y-1"
                         x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                         x-transition:leave="transition ease-in duration-100"
                         x-transition:leave-start="opacity-100 scale-100"
                         x-transition:leave-end="opacity-0 scale-95"
                         class="dropdown-panel absolute right-0 mt-2 w-44 z-30">
                        <div class="dropdown-list">
                            <button type="button" @click="setStatus('')"
                                    class="dropdown-option flex items-center justify-between px-3.5 py-2.5 text-sm" :class="statusVal === '' ? 'is-selected' : ''">
                                <span>Semua Status</span>
                                <i class="fa-solid fa-check dropdown-check text-xs" x-show="statusVal === ''"></i>
                            </button>
                            <button type="button" @click="setStatus('draft')"
                                    class="dropdown-option flex items-center justify-between px-3.5 py-2.5 text-sm" :class="statusVal === 'draft' ? 'is-selected' : ''">
                                <span>Draft</span>
                                <i class="fa-solid fa-check dropdown-check text-xs" x-show="statusVal === 'draft'"></i>
                            </button>
                            <button type="button" @click="setStatus('published')"
                                    class="dropdown-option flex items-center justify-between px-3.5 py-2.5 text-sm" :class="statusVal === 'published' ? 'is-selected' : ''">
                                <span>Published</span>
                                <i class="fa-solid fa-check dropdown-check text-xs" x-show="statusVal === 'published'"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <button type="button" x-show="hasFilter()" x-cloak @click="resetFilter()"
                        class="btn-ghost flex items-center gap-2 px-4 py-2.5 rounded-lg text-sm font-medium text-slate-500 border border-slate-200">
                    <i class="fa-solid fa-rotate-left text-xs"></i> Reset
                </button>
            </form>

            <div class="overflow-x-auto">
                <table class="w-full text-sm table-fixed border-collapse">
                    <colgroup>
                        <col style="width: 40px">
                        <col style="width: 88px">
                        <col>{{-- Judul Proyek: fleksibel, ambil sisa ruang --}}
                        <col style="width: 130px">
                        <col style="width: 80px">
                        <col style="width: 100px">
                        <col style="width: 100px">
                    </colgroup>
                    <thead>
                        <tr class="text-xs font-semibold text-slate-400 bg-slate-50/70 border-b border-slate-100">
                            <th class="px-4 py-3.5"></th>
                            <th class="px-4 py-3.5 text-left">Thumbnail</th>
                            <th class="px-4 py-3.5 text-left">Judul Proyek</th>
                            <th class="px-4 py-3.5 text-center">Kategori</th>
                            <th class="px-4 py-3.5 text-center">Tahun</th>
                            <th class="px-4 py-3.5 text-center">Status</th>
                            <th class="px-4 py-3.5 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($portfolios as $item)
                            <tr class="table-row-hover border-b border-slate-50">
                                <td class="px-4 py-3.5 align-middle text-center">
                                    <i class="fa-solid fa-grip-vertical drag-handle text-xs"></i>
                                </td>
                                <td class="px-4 py-3.5 align-middle">
                                    <div class="h-12 w-12 rounded-lg overflow-hidden bg-brand-cream/60 flex items-center justify-center shrink-0 ring-1 ring-slate-100">
                                        @if($item->image)
                                            <img src="{{ asset('storage/'.$item->image) }}" class="w-full h-full object-cover">
                                        @else
                                            <i class="fa-solid fa-image text-slate-300 text-sm"></i>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-4 py-3.5 align-middle overflow-hidden">
                                    <p class="font-semibold text-brand-dark truncate leading-snug">{{ $item->title }}</p>
                                    <p class="text-xs text-slate-400 truncate leading-snug mt-0.5">{{ $item->description }}</p>
                                </td>
                                <td class="px-4 py-3.5 align-middle text-center">
                                    @if($item->category)
                                        <span class="inline-flex justify-center items-center min-w-[76px] text-xs font-medium px-2.5 py-1 rounded-full bg-indigo-50 text-indigo-500 whitespace-nowrap">
                                            {{ $item->category->name }}
                                        </span>
                                    @else
                                        <span class="text-xs text-slate-300">-</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3.5 align-middle text-center text-slate-500 whitespace-nowrap">
                                    {{ $item->project_date ? \Carbon\Carbon::parse($item->project_date)->format('Y') : '-' }}
                                </td>
                                <td class="px-4 py-3.5 align-middle text-center">
                                    @if($item->status === 'published')
                                        <span class="inline-flex justify-center items-center min-w-[80px] text-xs font-medium px-2.5 py-1 rounded-full bg-emerald-50 text-emerald-600 whitespace-nowrap">Published</span>
                                    @else
                                        <span class="inline-flex justify-center items-center min-w-[80px] text-xs font-medium px-2.5 py-1 rounded-full bg-amber-50 text-amber-600 whitespace-nowrap">Draft</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3.5 align-middle">
                                    <div class="flex items-center justify-center gap-2">
                                        <a href="{{ route('admin.portfolios.edit', $item) }}"
                                           class="action-btn h-8 w-8 rounded-lg flex items-center justify-center text-slate-400 hover:bg-brand-mint/10 hover:text-brand-mint">
                                            <i class="fa-solid fa-pen text-xs"></i>
                                        </a>
                                        <button type="button" @click="deleteId = {{ $item->id }}; deleteOpen = true"
                                                class="action-btn h-8 w-8 rounded-lg flex items-center justify-center text-slate-400 hover:bg-red-50 hover:text-red-500">
                                            <i class="fa-solid fa-trash text-xs"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-10 text-center text-slate-400 text-sm">
                                    @if(request('search') || request('category_id') || request('status'))
                                        Tidak ada portfolio yang cocok dengan filter ini.
                                    @else
                                        Belum ada portfolio.
                                    @endif
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="px-6 py-5 border-t border-slate-100">
                {{ $portfolios->withQueryString()->onEachSide(1)->links('admin.portfolios.partials.pagination') }}
            </div>
        </div>

        <div x-show="deleteOpen" x-cloak
             class="fixed inset-0 bg-slate-900/40 flex items-center justify-center z-50 px-4"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0">
            <div @click.outside="deleteOpen = false"
                 class="bg-white rounded-2xl shadow-xl w-full max-w-sm p-6 relative"
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 scale-95"
                 x-transition:enter-end="opacity-100 scale-100">
                <button @click="deleteOpen = false"
                        class="modal-close-btn absolute top-4 right-4 h-8 w-8 rounded-full flex items-center justify-center text-slate-400 border border-slate-100">
                    <i class="fa-solid fa-xmark text-xs"></i>
                </button>
                <div class="h-11 w-11 rounded-full bg-red-50 text-red-500 flex items-center justify-center mb-4">
                    <i class="fa-solid fa-trash text-sm"></i>
                </div>
                <p class="font-semibold text-brand-dark text-sm mb-1">Apakah Anda yakin ingin menghapus portofolio ini?</p>
                <p class="text-xs text-slate-400 mb-5">Data yang dihapus tidak dapat dikembalikan.</p>

                <form :action="`/admin/portfolios/${deleteId}`" method="POST" class="flex gap-3">
                    @csrf
                    @method('DELETE')
                    <button type="button" @click="deleteOpen = false"
                            class="btn-ghost flex-1 py-2.5 rounded-lg text-sm font-medium text-slate-500 border border-slate-100">
                        Batal
                    </button>
                    <button type="submit"
                            class="btn-fill flex-1 py-2.5 rounded-lg text-sm font-semibold text-white bg-red-500">
                        <span class="fill-layer bg-red-600"></span>
                        <span class="btn-label">Ya, Hapus</span>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function portfolioIndex() {
            return {
                deleteId: null,
                deleteOpen: false,
                categoryOpen: false,
                statusOpen: false,
                search: '{{ request('search') }}',
                categoryId: '{{ request('category_id') }}',
                statusVal: '{{ request('status') }}',
                categoryNames: @js($categories->pluck('name', 'id')),

                categoryLabel() {
                    if (!this.categoryId) return 'Semua Kategori';
                    return this.categoryNames[this.categoryId] || 'Semua Kategori';
                },
                statusLabel() {
                    if (this.statusVal === 'draft') return 'Draft';
                    if (this.statusVal === 'published') return 'Published';
                    return 'Semua Status';
                },
                hasFilter() {
                    return this.search !== '' || this.categoryId !== '' || this.statusVal !== '';
                },

                setCategory(val) {
                    this.categoryId = val;
                    this.categoryOpen = false;
                    this.$nextTick(() => this.$refs.filterForm.submit());
                },
                setStatus(val) {
                    this.statusVal = val;
                    this.statusOpen = false;
                    this.$nextTick(() => this.$refs.filterForm.submit());
                },
                resetFilter() {
                    this.search = '';
                    this.categoryId = '';
                    this.statusVal = '';
                    this.$nextTick(() => this.$refs.filterForm.submit());
                },
            };
        }

        document.addEventListener('DOMContentLoaded', () => {
            const revealObserver = new IntersectionObserver((entries) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('is-visible');
                        revealObserver.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.1, rootMargin: '0px 0px -30px 0px' });
            document.querySelectorAll('.reveal').forEach((el) => revealObserver.observe(el));
        });
    </script>
</x-app-layout>