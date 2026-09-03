{{-- resources/views/admin/testimonials/index.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <div>
            <p class="text-xs text-slate-400 mb-1.5">Beranda / Testimoni</p>
            <h2 class="text-xl font-bold text-brand-dark tracking-tight">Manajemen Testimoni</h2>
        </div>

        <div class="flex items-center gap-5">
            <button type="button" class="notif-btn relative p-2 rounded-full">
                <i class="fa-solid fa-bell text-slate-500 text-lg notif-icon"></i>
                <span class="absolute top-1.5 right-1.5 h-2 w-2 rounded-full bg-red-500 animate-ping"></span>
                <span class="absolute top-1.5 right-1.5 h-2 w-2 rounded-full bg-red-500"></span>
            </button>

            <div x-data="{ open: false }" class="relative">
                <button type="button" @click="open = !open" @click.outside="open = false"
                        class="user-menu-btn flex items-center gap-3 pl-4 border-l border-slate-200 focus:outline-none">
                    <div class="h-9 w-9 rounded-full bg-brand-mint flex items-center justify-center text-white text-sm font-semibold user-avatar" :class="open && 'is-open'">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                    <div class="text-sm hidden sm:block text-left">
                        <p class="font-medium text-brand-dark leading-none">{{ Auth::user()->name }}</p>
                        <p class="text-slate-400 text-xs mt-1">Superadmin</p>
                    </div>
                    <i class="fa-solid fa-chevron-down text-xs text-slate-400 chevron-icon" :class="open && 'rotate-180'"></i>
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
                        <a href="{{ route('admin.profile.index') }}" class="menu-item relative flex items-center gap-3 px-4 py-2.5 text-sm text-slate-600">
                            <span class="menu-item-bar bg-brand-mint"></span>
                            <i class="fa-solid fa-user w-4 text-slate-400 menu-item-icon"></i>
                            Profil Saya
                        </a>
                    </div>
                    <div class="border-t border-slate-100 py-1">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="menu-item menu-item--danger relative w-full flex items-center gap-3 px-4 py-2.5 text-sm text-slate-600">
                                <span class="menu-item-bar bg-red-500"></span>
                                <i class="fa-solid fa-arrow-right-from-bracket w-4 text-slate-400 menu-item-icon"></i>
                                Log Out
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>

    @include('admin.testimonials.partials.styles')

    @php
        $statusColors = [
            'approved' => ['bg' => 'bg-emerald-50', 'text' => 'text-emerald-500', 'label' => 'Approved', 'icon' => 'fa-check'],
            'pending' => ['bg' => 'bg-amber-50', 'text' => 'text-amber-500', 'label' => 'Pending', 'icon' => 'fa-clock'],
            'rejected' => ['bg' => 'bg-red-50', 'text' => 'text-red-500', 'label' => 'Rejected', 'icon' => 'fa-xmark'],
        ];
        $categoryPalette = [
            'bg-blue-50 text-blue-600', 'bg-purple-50 text-purple-600', 'bg-emerald-50 text-emerald-600',
            'bg-slate-100 text-slate-500', 'bg-orange-50 text-orange-600', 'bg-pink-50 text-pink-600',
            'bg-cyan-50 text-cyan-600', 'bg-indigo-50 text-indigo-600',
        ];
        $avatarPalette = ['bg-teal-500', 'bg-blue-500', 'bg-purple-500', 'bg-amber-500', 'bg-rose-500', 'bg-indigo-500'];
    @endphp

    <div x-data="testimonialFilters()" class="space-y-6">

        @if(session('success'))
            <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)" x-transition
                 class="flex items-center gap-3 bg-brand-mint/10 border border-brand-mint/30 text-brand-mint px-5 py-3.5 rounded-xl text-sm font-medium">
                <i class="fa-solid fa-circle-check text-base"></i>
                {{ session('success') }}
            </div>
        @endif

        <div class="reveal card-hover flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-white rounded-2xl shadow-sm border border-slate-100 px-8 py-7">
            <div>
                <h3 class="text-lg font-bold text-brand-dark">Manajemen Testimoni</h3>
                <p class="text-sm text-slate-400 mt-1.5">Kelola testimoni yang masuk dari form website.</p>
            </div>
        </div>

        <form method="GET" action="{{ route('admin.testimonials.index') }}" x-ref="filterForm" class="reveal relative z-30 flex flex-col sm:flex-row gap-4" style="transition-delay:.05s">
            <div class="field-ring flex-1 flex items-center gap-3 px-4">
                <i class="fa-solid fa-magnifying-glass text-slate-400 text-sm field-icon"></i>
                <input type="text" name="search" x-model="search" @input.debounce.500ms="submitForm()"
                       placeholder="Cari testimoni..." value="{{ $filters['search'] }}"
                       class="w-full bg-transparent border-0 focus:ring-0 text-sm py-3">
                <button type="button" x-show="search.length > 0" x-cloak @click="search = ''; submitForm()" class="clear-btn text-slate-300 hover:text-slate-500" title="Hapus pencarian">
                    <i class="fa-solid fa-xmark text-xs"></i>
                </button>
            </div>

            {{-- Dropdown Kategori --}}
            <div class="dropdown-wrap sm:w-52" @click.outside="categoryOpen = false">
                <input type="hidden" name="category" x-model="category">
                <button type="button" @click="categoryOpen = !categoryOpen; statusOpen = false"
                        class="dropdown-trigger flex items-center gap-3 px-4 py-3" :class="categoryOpen && 'is-open'">
                    <i class="fa-solid fa-layer-group dropdown-icon text-sm"></i>
                    <span class="flex-1 text-sm truncate text-left" :class="category ? 'text-brand-dark' : 'text-slate-400'" x-text="category || 'Semua Kategori'"></span>
                    <i class="fa-solid fa-chevron-down dropdown-chevron text-xs"></i>
                </button>
                <div x-show="categoryOpen" x-cloak
                     x-transition:enter="transition ease-out duration-150"
                     x-transition:enter-start="opacity-0 scale-95 -translate-y-1"
                     x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                     x-transition:leave="transition ease-in duration-100"
                     x-transition:leave-start="opacity-100 scale-100"
                     x-transition:leave-end="opacity-0 scale-95"
                     class="dropdown-panel absolute mt-2 w-full bg-white z-50">
                    <div class="dropdown-list">
                        <button type="button" @click="category = ''; categoryOpen = false; submitForm()"
                                class="dropdown-option flex items-center justify-between gap-2 px-3 py-2.5 text-sm" :class="category === '' ? 'is-selected' : ''">
                            <span>Semua Kategori</span>
                            <i class="fa-solid fa-check dropdown-check text-xs" x-show="category === ''"></i>
                        </button>
                        @foreach($categories as $cat)
                            <button type="button" @click="category = '{{ $cat }}'; categoryOpen = false; submitForm()"
                                    class="dropdown-option flex items-center justify-between gap-2 px-3 py-2.5 text-sm" :class="category === '{{ $cat }}' ? 'is-selected' : ''">
                                <span>{{ $cat }}</span>
                                <i class="fa-solid fa-check dropdown-check text-xs" x-show="category === '{{ $cat }}'"></i>
                            </button>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- Dropdown Status --}}
            <div class="dropdown-wrap sm:w-48" @click.outside="statusOpen = false">
                <input type="hidden" name="status" x-model="status">
                <button type="button" @click="statusOpen = !statusOpen; categoryOpen = false"
                        class="dropdown-trigger flex items-center gap-3 px-4 py-3" :class="statusOpen && 'is-open'">
                    <i class="fa-solid fa-circle-check dropdown-icon text-sm"></i>
                    <span class="flex-1 text-sm truncate text-left" :class="status ? 'text-brand-dark' : 'text-slate-400'" x-text="statusLabel()"></span>
                    <i class="fa-solid fa-chevron-down dropdown-chevron text-xs"></i>
                </button>
                <div x-show="statusOpen" x-cloak
                     x-transition:enter="transition ease-out duration-150"
                     x-transition:enter-start="opacity-0 scale-95 -translate-y-1"
                     x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                     x-transition:leave="transition ease-in duration-100"
                     x-transition:leave-start="opacity-100 scale-100"
                     x-transition:leave-end="opacity-0 scale-95"
                     class="dropdown-panel absolute mt-2 w-full bg-white z-50">
                    <div class="dropdown-list">
                        <button type="button" @click="status = ''; statusOpen = false; submitForm()"
                                class="dropdown-option flex items-center justify-between gap-2 px-3 py-2.5 text-sm" :class="status === '' ? 'is-selected' : ''">
                            <span>Semua Status</span>
                            <i class="fa-solid fa-check dropdown-check text-xs" x-show="status === ''"></i>
                        </button>
                        <button type="button" @click="status = 'pending'; statusOpen = false; submitForm()"
                                class="dropdown-option flex items-center justify-between gap-2 px-3 py-2.5 text-sm" :class="status === 'pending' ? 'is-selected' : ''">
                            <span>Pending</span>
                            <i class="fa-solid fa-check dropdown-check text-xs" x-show="status === 'pending'"></i>
                        </button>
                        <button type="button" @click="status = 'approved'; statusOpen = false; submitForm()"
                                class="dropdown-option flex items-center justify-between gap-2 px-3 py-2.5 text-sm" :class="status === 'approved' ? 'is-selected' : ''">
                            <span>Approved</span>
                            <i class="fa-solid fa-check dropdown-check text-xs" x-show="status === 'approved'"></i>
                        </button>
                        <button type="button" @click="status = 'rejected'; statusOpen = false; submitForm()"
                                class="dropdown-option flex items-center justify-between gap-2 px-3 py-2.5 text-sm" :class="status === 'rejected' ? 'is-selected' : ''">
                            <span>Rejected</span>
                            <i class="fa-solid fa-check dropdown-check text-xs" x-show="status === 'rejected'"></i>
                        </button>
                    </div>
                </div>
            </div>

            <button type="button" @click="resetFilter()" class="btn-filter flex items-center justify-center gap-2 px-4 py-3 rounded-xl border border-slate-200 text-sm font-medium text-slate-500 shrink-0" :class="hasFilter() ? 'active' : ''" title="Reset semua filter">
                <i class="fa-solid" :class="hasFilter() ? 'fa-filter-circle-xmark' : 'fa-filter'"></i>
                <span x-text="hasFilter() ? 'Reset Filter' : 'Belum Ada Filter'"></span>
            </button>
        </form>

        <div x-show="hasFilter()" x-cloak x-transition class="relative z-10 flex items-center justify-between gap-3 px-4 py-3 rounded-xl bg-brand-mint/5 border border-brand-mint/15">
            <div class="flex items-center gap-2 text-sm text-slate-500">
                <i class="fa-solid fa-filter text-brand-mint text-xs"></i>
                <span>Menampilkan <span class="font-semibold text-brand-dark">{{ $testimonials->total() }}</span> testimoni</span>
            </div>
            <button type="button" @click="resetFilter()" class="link-underline text-xs font-medium text-brand-mint">Reset Filter</button>
        </div>

        <div class="team-table-card reveal card-hover bg-white overflow-hidden relative z-0" style="transition-delay:.1s">
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="text-left text-xs uppercase tracking-wide text-slate-400 border-b border-slate-100">
                            <th class="px-6 py-4 font-semibold">Foto</th>
                            <th class="px-6 py-4 font-semibold">Nama & Instansi</th>
                            <th class="px-6 py-4 font-semibold">Rating</th>
                            <th class="px-6 py-4 font-semibold">Kategori Layanan</th>
                            <th class="px-6 py-4 font-semibold">Status</th>
                            <th class="px-6 py-4 font-semibold">Tanggal Masuk</th>
                            <th class="px-6 py-4 font-semibold text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($testimonials as $item)
                            @php
                                $sc = $statusColors[$item->status] ?? $statusColors['pending'];
                                $catColor = $categoryPalette[crc32($item->category ?? '') % count($categoryPalette)];
                                $avColor = $avatarPalette[crc32($item->client_name) % count($avatarPalette)];
                                $initial = strtoupper(substr($item->client_name, 0, 1));
                            @endphp
                            <tr class="team-row">
                                <td class="team-row-bar bg-brand-mint"></td>
                                <td class="px-6 py-4">
                                    <div class="avatar-circle h-10 w-10 rounded-full {{ $avColor }} flex items-center justify-center text-white text-sm font-semibold">
                                        {{ $initial }}
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <p class="font-medium text-brand-dark">{{ $item->client_name }}</p>
                                    <p class="text-xs text-slate-400 mt-0.5">
                                        {{ $item->client_position }}{{ $item->client_position && $item->client_institution ? ', ' : '' }}{{ $item->client_institution }}
                                    </p>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="rating-group flex items-center gap-0.5">
                                        @for($i = 1; $i <= 5; $i++)
                                            <i class="fa-solid fa-star star-icon text-xs {{ $i <= $item->rating ? 'text-amber-400' : 'text-slate-200' }}"></i>
                                        @endfor
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    @if($item->category)
                                        <span class="badge inline-flex px-3 py-1 rounded-full text-xs font-medium {{ $catColor }}">{{ $item->category }}</span>
                                    @else
                                        <span class="badge inline-flex px-3 py-1 rounded-full text-xs font-medium bg-slate-100 text-slate-400">Tidak Ada</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <span class="badge inline-flex items-center px-3 py-1 rounded-full text-xs font-medium {{ $sc['bg'] }} {{ $sc['text'] }}">
                                        <i class="fa-solid {{ $sc['icon'] }} text-xs mr-1"></i> {{ $sc['label'] }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-slate-500 text-xs">
                                    {{ $item->submitted_at?->translatedFormat('d M Y, H:i') ?? '-' }}
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="{{ route('admin.testimonials.show', $item) }}" class="icon-action icon-view h-8 w-8 rounded-full bg-brand-cream text-slate-400 flex items-center justify-center" title="Lihat detail">
                                            <i class="fa-solid fa-eye text-xs"></i>
                                        </a>
                                        <a href="{{ route('admin.testimonials.edit', $item) }}" class="icon-action icon-edit h-8 w-8 rounded-full bg-brand-cream text-slate-400 flex items-center justify-center" title="Ubah status">
                                            <i class="fa-solid fa-pen text-xs"></i>
                                        </a>
                                        <button type="button" @click="openDelete({{ $item->id }}, @js($item->client_name))" class="icon-action icon-delete h-8 w-8 rounded-full bg-brand-cream text-slate-400 flex items-center justify-center" title="Hapus testimoni">
                                            <i class="fa-solid fa-trash text-xs"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-16 text-center">
                                    <div class="search-empty flex flex-col items-center">
                                        <div class="h-14 w-14 rounded-full bg-brand-cream flex items-center justify-center mb-3">
                                            <i class="fa-solid fa-comment-dots text-slate-300 text-lg"></i>
                                        </div>
                                        <p class="text-sm font-medium text-slate-500">Tidak ada testimoni ditemukan</p>
                                        <p class="text-xs text-slate-300 mt-1">Coba gunakan kata kunci atau filter yang berbeda.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($testimonials->hasPages())
                <div class="flex items-center justify-between px-6 py-4 border-t border-slate-100">
                    <p class="text-xs text-slate-400">Menampilkan {{ $testimonials->firstItem() }}-{{ $testimonials->lastItem() }} dari {{ $testimonials->total() }} data</p>
                    <div class="flex items-center gap-1.5">
                        {{ $testimonials->onEachSide(1)->links('vendor.pagination.custom-brand') }}
                    </div>
                </div>
            @endif
        </div>

        {{-- Ringkasan Rating --}}
        <div class="reveal bg-white rounded-2xl shadow-sm border border-slate-100 px-8 py-7" style="transition-delay:.15s">
            <h3 class="text-base font-bold text-brand-dark">Ringkasan Rating Testimoni</h3>
            <p class="text-sm text-slate-400 mt-1 mb-5">Rata-rata rating dari testimoni berstatus approved.</p>
            <div class="stat-card bg-brand-dark text-white px-5 py-4 max-w-xs">
                <p class="text-xs text-white/70">Rata-rata Overall</p>
                <p class="text-2xl font-bold mt-1">{{ $averageRating }}<span class="text-sm font-normal">/5</span></p>
                <div class="flex items-center gap-0.5 mt-1">
                    @for($i = 1; $i <= 5; $i++)
                        <i class="fa-solid fa-star text-xs {{ $i <= round($averageRating) ? 'text-amber-400' : 'text-white/20' }}"></i>
                    @endfor
                </div>
                <p class="text-[11px] text-white/50 mt-2">Berdasarkan {{ $totalApproved }} testimoni approved</p>
            </div>
        </div>

        {{-- Modal Delete --}}
        <div x-show="deleteModal.open" x-cloak style="display:none" class="fixed inset-0 z-50 flex items-center justify-center p-4">
            <div x-show="deleteModal.open" x-transition.opacity @click="deleteModal.open = false" class="absolute inset-0 bg-brand-dark/60 backdrop-blur-sm"></div>
            <div x-show="deleteModal.open"
                 x-transition:enter="transition ease-out duration-250" x-transition:enter-start="opacity-0 scale-95 translate-y-4" x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                 class="relative bg-white rounded-2xl shadow-2xl w-full max-w-sm p-7 z-10 text-center">
                <button type="button" @click="deleteModal.open = false" class="modal-close-btn absolute top-4 right-4 h-7 w-7 rounded-full flex items-center justify-center text-slate-300">
                    <i class="fa-solid fa-xmark text-sm"></i>
                </button>
                <div class="modal-danger-icon h-14 w-14 rounded-full bg-red-50 text-red-500 flex items-center justify-center mx-auto mb-4">
                    <i class="fa-solid fa-trash text-lg"></i>
                </div>
                <p class="font-semibold text-brand-dark">Apakah Anda yakin ingin menghapus testimoni dari <span x-text="deleteModal.name" class="text-red-500"></span>?</p>
                <p class="text-xs text-slate-400 mt-1.5">Data yang dihapus tidak dapat dikembalikan.</p>
                <form :action="'{{ url('admin/testimonials') }}/' + deleteModal.id" method="POST" class="flex gap-3 mt-6">
                    @csrf @method('DELETE')
                    <button type="button" @click="deleteModal.open = false" class="btn-ghost flex-1 px-4 py-2.5 rounded-lg text-sm font-medium text-slate-500 border border-slate-200">Batal</button>
                    <button type="submit" class="btn-fill flex-1 px-4 py-2.5 rounded-lg text-sm font-semibold text-white bg-red-500">
                        <span class="fill-layer bg-red-600"></span>
                        <span class="btn-label">Ya, Hapus</span>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function testimonialFilters() {
            return {
                search: '{{ $filters['search'] }}',
                category: '{{ $filters['category'] }}',
                status: '{{ $filters['status'] }}',
                categoryOpen: false,
                statusOpen: false,
                deleteModal: { open: false, id: null, name: '' },
                statusLabel() {
                    const map = { pending: 'Pending', approved: 'Approved', rejected: 'Rejected' };
                    return this.status ? map[this.status] : 'Semua Status';
                },
                hasFilter() { return this.search !== '' || this.category !== '' || this.status !== ''; },
                resetFilter() { this.search = ''; this.category = ''; this.status = ''; this.submitForm(); },
                submitForm() { this.$refs.filterForm.submit(); },
                openDelete(id, name) { this.deleteModal = { open: true, id, name }; }
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