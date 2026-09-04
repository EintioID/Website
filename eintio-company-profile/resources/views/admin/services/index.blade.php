{{-- resources/views/admin/services/index.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <div>
            <p class="text-xs text-slate-400 mb-1.5">Beranda / Layanan</p>
            <h2 class="text-xl font-bold text-brand-dark tracking-tight">Layanan</h2>
        </div>

        <div class="flex items-center gap-5">
            <button type="button" class="notif-btn relative p-2 rounded-full">
                <i class="fa-solid fa-bell text-slate-500 text-lg notif-icon"></i>
                <span class="absolute top-1.5 right-1.5 h-2 w-2 rounded-full bg-red-500 animate-ping"></span>
                <span class="absolute top-1.5 right-1.5 h-2 w-2 rounded-full bg-red-500"></span>
            </button>

            <div x-data="{ open: false }" class="relative">
                <button type="button" @click="open = !open" @click.outside="open = false"
                        class="flex items-center gap-3 pl-4 border-l border-slate-200 focus:outline-none">
                    <div class="h-9 w-9 rounded-full bg-brand-mint flex items-center justify-center text-white text-sm font-semibold">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                    <div class="text-sm hidden sm:block text-left">
                        <p class="font-medium text-brand-dark leading-none">{{ Auth::user()->name }}</p>
                        <p class="text-slate-400 text-xs mt-1">Superadmin</p>
                    </div>
                    <i class="fa-solid fa-chevron-down text-xs text-slate-400" :class="open && 'rotate-180'"></i>
                </button>

                <div x-show="open"
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 scale-95 -translate-y-2"
                     x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                     x-transition:leave="transition ease-in duration-150"
                     x-transition:leave-start="opacity-100 scale-100"
                     x-transition:leave-end="opacity-0 scale-95"
                     class="absolute right-0 mt-3 w-56 bg-white rounded-xl shadow-xl border border-slate-100 overflow-hidden z-30"
                     style="display: none;">
                    <div class="px-4 py-3 bg-brand-cream border-b border-slate-100">
                        <p class="text-sm font-semibold text-brand-dark">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-slate-400 truncate">{{ Auth::user()->email }}</p>
                    </div>
                    <div class="py-1">
                        <a href="{{ route('admin.account.index') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm text-slate-600 hover:bg-slate-50">
                            <i class="fa-solid fa-user w-4 text-slate-400"></i>
                            Profil Saya
                        </a>
                    </div>
                    <div class="border-t border-slate-100 py-1">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full flex items-center gap-3 px-4 py-2.5 text-sm text-slate-600 hover:bg-red-50">
                                <i class="fa-solid fa-arrow-right-from-bracket w-4 text-slate-400"></i>
                                Log Out
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>

    @include('admin.services.partials.styles')

    <div x-data="serviceFilters()" class="space-y-6 w-full">

        @if (session('success'))
            <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)" x-transition
                 class="flex items-center gap-3 bg-brand-mint/10 border border-brand-mint/30 text-brand-mint px-5 py-3.5 rounded-xl text-sm font-medium">
                <i class="fa-solid fa-circle-check text-base"></i>
                {{ session('success') }}
            </div>
        @endif

        {{-- ===== SECTION 1: Header + Filter ===== --}}
        <div class="reveal card-hover bg-white rounded-2xl shadow-sm border border-slate-100 px-8 py-7">
            <div class="flex items-center justify-between mb-5 flex-wrap gap-4">
                <div>
                    <h3 class="font-bold text-brand-dark text-lg">Informasi Layanan</h3>
                    <p class="text-sm text-slate-400 mt-1">Kelola daftar layanan yang akan ditampilkan pada website.</p>
                </div>
                <a href="{{ route('admin.services.create') }}" class="btn-fill inline-flex items-center gap-2 px-5 py-2.5 rounded-lg text-sm font-semibold text-white bg-brand-mint">
                    <span class="fill-layer bg-brand-teal"></span>
                    <span class="btn-label flex items-center gap-2">
                        <i class="fa-solid fa-plus text-xs"></i>
                        Tambah Layanan
                    </span>
                </a>
            </div>

            <div class="flex flex-wrap gap-3">
                <div class="field-ring flex-1 min-w-[200px] flex items-center gap-3 px-4">
                    <i class="fa-solid fa-magnifying-glass text-slate-400 text-sm field-icon"></i>
                    <input type="text" x-model="search" @input.debounce.500ms="submitForm()"
                           placeholder="Cari layanan..."
                           class="w-full border-0 focus:ring-0 text-sm py-2.5 bg-transparent">
                </div>

                {{-- ===== FILTER KATEGORI ===== --}}
                <div class="dropdown-wrap w-52" @click.outside="categoryOpen = false">
                    <button type="button" @click="categoryOpen = !categoryOpen; statusOpen = false; filterOpen = false"
                            class="dropdown-trigger flex items-center gap-3 px-4 py-2.5 text-sm" :class="categoryOpen && 'is-open'">
                        <span class="flex-1 text-left truncate text-slate-600" x-text="category === 'all' || category === '' ? 'Semua Kategori' : category"></span>
                        <i class="fa-solid fa-chevron-down dropdown-chevron text-xs"></i>
                    </button>
                    <div x-show="categoryOpen" x-cloak
                         x-transition:enter="transition ease-out duration-150"
                         x-transition:enter-start="opacity-0 scale-95 -translate-y-1"
                         x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                         x-transition:leave="transition ease-in duration-100"
                         x-transition:leave-start="opacity-100 scale-100"
                         x-transition:leave-end="opacity-0 scale-95"
                         class="dropdown-panel absolute mt-2 w-full bg-white z-20">
                        <div class="dropdown-list">
                            <button type="button" @click="setCategory('all')"
                                    class="dropdown-option flex items-center justify-between gap-2 px-3 py-2.5 text-sm" :class="(category === 'all' || category === '') ? 'is-selected' : ''">
                                <span>Semua Kategori</span>
                                <i class="fa-solid fa-check dropdown-check text-xs" x-show="category === 'all' || category === ''"></i>
                            </button>
                            @foreach ($categories as $cat)
                                <button type="button" @click="setCategory('{{ $cat }}')"
                                        class="dropdown-option flex items-center justify-between gap-2 px-3 py-2.5 text-sm" :class="category === '{{ $cat }}' ? 'is-selected' : ''">
                                    <span>{{ $cat }}</span>
                                    <i class="fa-solid fa-check dropdown-check text-xs" x-show="category === '{{ $cat }}'"></i>
                                </button>
                            @endforeach
                        </div>
                    </div>
                </div>

                {{-- ===== FILTER STATUS ===== --}}
                <div class="dropdown-wrap w-48" @click.outside="statusOpen = false">
                    <button type="button" @click="statusOpen = !statusOpen; categoryOpen = false; filterOpen = false"
                            class="dropdown-trigger flex items-center gap-3 px-4 py-2.5 text-sm" :class="statusOpen && 'is-open'">
                        <span class="flex-1 text-left truncate text-slate-600" x-text="statusLabel()"></span>
                        <i class="fa-solid fa-chevron-down dropdown-chevron text-xs"></i>
                    </button>
                    <div x-show="statusOpen" x-cloak
                         x-transition:enter="transition ease-out duration-150"
                         x-transition:enter-start="opacity-0 scale-95 -translate-y-1"
                         x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                         x-transition:leave="transition ease-in duration-100"
                         x-transition:leave-start="opacity-100 scale-100"
                         x-transition:leave-end="opacity-0 scale-95"
                         class="dropdown-panel absolute mt-2 w-full bg-white z-20">
                        <div class="dropdown-list">
                            <button type="button" @click="setStatus('all')"
                                    class="dropdown-option flex items-center justify-between gap-2 px-3 py-2.5 text-sm" :class="(status === 'all' || status === '') ? 'is-selected' : ''">
                                <span>Semua Status</span>
                                <i class="fa-solid fa-check dropdown-check text-xs" x-show="status === 'all' || status === ''"></i>
                            </button>
                            <button type="button" @click="setStatus('aktif')"
                                    class="dropdown-option flex items-center justify-between gap-2 px-3 py-2.5 text-sm" :class="status === 'aktif' ? 'is-selected' : ''">
                                <span>Aktif</span>
                                <i class="fa-solid fa-check dropdown-check text-xs" x-show="status === 'aktif'"></i>
                            </button>
                            <button type="button" @click="setStatus('nonaktif')"
                                    class="dropdown-option flex items-center justify-between gap-2 px-3 py-2.5 text-sm" :class="status === 'nonaktif' ? 'is-selected' : ''">
                                <span>Nonaktif</span>
                                <i class="fa-solid fa-check dropdown-check text-xs" x-show="status === 'nonaktif'"></i>
                            </button>
                        </div>
                    </div>
                </div>

                {{-- ===== TOMBOL FILTER (opsi urutan + reset) ===== --}}
                <div class="dropdown-wrap" @click.outside="filterOpen = false">
                    <button type="button" @click="filterOpen = !filterOpen; categoryOpen = false; statusOpen = false"
                            class="btn-filter dropdown-trigger relative flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl border border-slate-200 text-sm font-medium text-slate-500"
                            :class="filterOpen && 'is-open'">
                        <i class="fa-solid fa-filter text-xs filter-icon"></i>
                        <span x-text="hasFilter() ? 'Filter Aktif' : 'Filter'"></span>
                        <span x-show="hasFilter()" x-cloak class="h-1.5 w-1.5 rounded-full bg-brand-mint"></span>
                    </button>
                    <div x-show="filterOpen" x-cloak
                         x-transition:enter="transition ease-out duration-150"
                         x-transition:enter-start="opacity-0 scale-95 -translate-y-1"
                         x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                         x-transition:leave="transition ease-in duration-100"
                         x-transition:leave-start="opacity-100 scale-100"
                         x-transition:leave-end="opacity-0 scale-95"
                         class="dropdown-panel absolute right-0 mt-2 w-56 bg-white z-20">
                        <div class="dropdown-list">
                            <p class="px-3 pt-2 pb-1.5 text-[11px] font-bold uppercase tracking-wide text-slate-400">Urutkan Berdasarkan</p>
                            @foreach ([
                                'urutan'  => 'Urutan Manual',
                                'terbaru' => 'Terbaru',
                                'terlama' => 'Terlama',
                                'nama_az' => 'Nama A-Z',
                                'nama_za' => 'Nama Z-A',
                            ] as $key => $label)
                                <button type="button" @click="setSort('{{ $key }}')"
                                        class="dropdown-option flex items-center justify-between gap-2 px-3 py-2.5 text-sm" :class="sort === '{{ $key }}' ? 'is-selected' : ''">
                                    <span>{{ $label }}</span>
                                    <i class="fa-solid fa-check dropdown-check text-xs" x-show="sort === '{{ $key }}'"></i>
                                </button>
                            @endforeach

                            <div class="my-1 border-t border-slate-100"></div>

                            <button type="button" @click="resetFilter()"
                                    x-show="hasFilter()" x-cloak
                                    class="dropdown-option flex items-center gap-2 px-3 py-2.5 text-sm text-red-500 hover:!bg-red-50 hover:!text-red-600">
                                <i class="fa-solid fa-rotate-left text-xs"></i>
                                <span>Reset Semua Filter</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ===== SECTION 2: Table (delay .1s dari section 1, sama seperti Testimoni) ===== --}}
        <div class="reveal card-hover team-table-card bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden" style="transition-delay:.8s">
            <div class="overflow-x-auto">
                <table class="services-table text-sm">
                    <colgroup>
                        <col class="col-no">
                        <col class="col-name">
                        <col class="col-category">
                        <col class="col-status">
                        <col class="col-order">
                        <col class="col-action">
                    </colgroup>
                    <thead>
                        <tr class="text-left text-xs uppercase tracking-wide text-slate-400 bg-slate-50 border-b border-slate-100">
                            <th class="font-semibold">#</th>
                            <th class="font-semibold">Nama Layanan</th>
                            <th class="font-semibold">Kategori</th>
                            <th class="font-semibold">Status</th>
                            <th class="font-semibold">Urutan</th>
                            <th class="font-semibold text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse ($services as $i => $service)
                            <tr class="team-row">
                                <td class="text-slate-400 relative">
                                    <span class="team-row-bar"></span>
                                    {{ $services->firstItem() + $i }}
                                </td>
                                <td>
                                    <div class="flex items-center gap-3">
                                        @if ($service->icon)
                                            <img src="{{ Storage::url($service->icon) }}" class="service-icon-thumb w-10 h-10 rounded-lg object-cover">
                                        @else
                                            <div class="service-icon-thumb w-10 h-10 rounded-lg bg-brand-mint/10 flex items-center justify-center text-brand-mint">
                                                <i class="fa-solid fa-briefcase text-xs"></i>
                                            </div>
                                        @endif
                                        <div class="min-w-0">
                                            <p class="font-semibold text-brand-dark truncate">{{ $service->name }}</p>
                                            <p class="text-xs text-slate-400 truncate">{{ Str::limit($service->short_description, 40) }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge text-xs font-semibold text-slate-600 bg-slate-100 px-2.5 py-1 rounded-full">{{ $service->category }}</span>
                                </td>
                                <td>
                                    @if ($service->status === 'aktif')
                                        <span class="badge inline-flex items-center text-xs font-bold text-brand-mint"><span class="status-dot h-1.5 w-1.5 rounded-full bg-brand-mint mr-1.5"></span>Aktif</span>
                                    @else
                                        <span class="badge inline-flex items-center text-xs font-bold text-red-500"><span class="status-dot h-1.5 w-1.5 rounded-full bg-red-500 mr-1.5"></span>Nonaktif</span>
                                    @endif
                                </td>
                                <td class="text-slate-500">{{ $service->order }}</td>
                                <td>
                                    <div class="action-icons">
                                        <a href="{{ route('admin.services.edit', $service) }}" class="icon-action icon-edit" title="Edit layanan">
                                            <i class="fa-solid fa-pen text-sm"></i>
                                        </a>
                                        <button type="button" @click="openDelete('{{ route('admin.services.destroy', $service) }}', @js($service->name))"
                                                class="icon-action icon-delete" title="Hapus layanan">
                                            <i class="fa-solid fa-trash text-sm"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-4 py-16 text-center">
                                    <div class="flex flex-col items-center">
                                        <div class="h-14 w-14 rounded-full bg-brand-cream flex items-center justify-center mb-3">
                                            <i class="fa-solid fa-briefcase text-slate-300 text-lg"></i>
                                        </div>
                                        <p class="text-sm text-slate-400">Belum ada data layanan.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($services->hasPages())
                <div class="flex items-center justify-between px-8 py-5 border-t border-slate-100">
                    <p class="text-xs text-slate-400">Menampilkan {{ $services->firstItem() }}-{{ $services->lastItem() }} dari {{ $services->total() }} data</p>
                    <div class="flex items-center gap-1.5">
                        {{ $services->onEachSide(1)->links() }}
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
                    <p class="font-semibold text-brand-dark">Apakah Anda yakin ingin menghapus <span x-text="deleteModal.name" class="text-red-500"></span>?</p>
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
        function serviceFilters() {
            return {
                search: '{{ request('search') }}',
                category: '{{ request('category', 'all') }}',
                status: '{{ request('status', 'all') }}',
                sort: '{{ request('sort', 'urutan') }}',
                categoryOpen: false,
                statusOpen: false,
                filterOpen: false,
                deleteModal: { open: false, url: '', name: '' },

                statusLabel() {
                    const map = { aktif: 'Aktif', nonaktif: 'Nonaktif' };
                    return (this.status === 'all' || this.status === '') ? 'Semua Status' : map[this.status];
                },
                hasFilter() {
                    return this.search !== ''
                        || (this.category !== 'all' && this.category !== '')
                        || (this.status !== 'all' && this.status !== '')
                        || (this.sort !== 'urutan' && this.sort !== '');
                },

                setCategory(val) { this.category = val; this.categoryOpen = false; this.$nextTick(() => this.submitForm()); },
                setStatus(val) { this.status = val; this.statusOpen = false; this.$nextTick(() => this.submitForm()); },
                setSort(val) { this.sort = val; this.filterOpen = false; this.$nextTick(() => this.submitForm()); },
                resetFilter() { this.search = ''; this.category = 'all'; this.status = 'all'; this.sort = 'urutan'; this.filterOpen = false; this.$nextTick(() => this.submitForm()); },
                submitForm() {
                    const params = new URLSearchParams();
                    if (this.search) params.set('search', this.search);
                    if (this.category && this.category !== 'all') params.set('category', this.category);
                    if (this.status && this.status !== 'all') params.set('status', this.status);
                    if (this.sort && this.sort !== 'urutan') params.set('sort', this.sort);
                    const query = params.toString();
                    window.location.href = window.location.pathname + (query ? '?' + query : '');
                },
                openDelete(url, name) { this.deleteModal = { open: true, url, name }; },
            }
        }

        // ===== REVEAL OBSERVER =====
        document.addEventListener('DOMContentLoaded', () => {
            const io = new IntersectionObserver((entries) => {
                entries.forEach((e) => {
                    if (e.isIntersecting) {
                        e.target.classList.add('is-visible');
                        io.unobserve(e.target);
                    }
                });
            }, { threshold: 0.1, rootMargin: '0px 0px -30px 0px' });

            document.querySelectorAll('.reveal').forEach((el) => io.observe(el));
        });
    </script>
</x-app-layout>