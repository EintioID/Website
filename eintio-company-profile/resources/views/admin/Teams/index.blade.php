{{-- resources/views/admin/Teams/index.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <div>
            <p class="text-xs text-slate-400 mb-1.5">Beranda / Tim</p>
            <h2 class="text-xl font-bold text-brand-dark tracking-tight">Manajemen Tim</h2>
        </div>

        <div class="flex items-center gap-5">
            <button type="button" class="notif-btn relative p-2 rounded-full">
                <i class="fa-solid fa-bell text-slate-500 text-lg notif-icon"></i>
                <span class="absolute top-1.5 right-1.5 h-2 w-2 rounded-full bg-red-500 animate-ping"></span>
                <span class="absolute top-1.5 right-1.5 h-2 w-2 rounded-full bg-red-500"></span>
            </button>

            <div x-data="{ open: false }" class="relative">
                <button
                    type="button"
                    @click="open = !open"
                    @click.outside="open = false"
                    class="user-menu-btn flex items-center gap-3 pl-4 border-l border-slate-200 focus:outline-none"
                >
                    <div class="h-9 w-9 rounded-full bg-brand-mint flex items-center justify-center text-white text-sm font-semibold user-avatar" :class="open && 'is-open'">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                    <div class="text-sm hidden sm:block text-left">
                        <p class="font-medium text-brand-dark leading-none">{{ Auth::user()->name }}</p>
                        <p class="text-slate-400 text-xs mt-1">Superadmin</p>
                    </div>
                    <i class="fa-solid fa-chevron-down text-xs text-slate-400 chevron-icon" :class="open && 'rotate-180'"></i>
                </button>

                <div
                    x-show="open"
                    x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 scale-95 -translate-y-2"
                    x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                    x-transition:leave="transition ease-in duration-150"
                    x-transition:leave-start="opacity-100 scale-100"
                    x-transition:leave-end="opacity-0 scale-95"
                    class="absolute right-0 mt-3 w-56 bg-white rounded-xl shadow-xl border border-slate-100 overflow-hidden z-30"
                    style="display: none;"
                >
                    <div class="px-4 py-3 bg-brand-cream border-b border-slate-100">
                        <p class="text-sm font-semibold text-brand-dark">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-slate-400 truncate">{{ Auth::user()->email }}</p>
                    </div>
                    <div class="py-1">
                        <a href="{{ route('admin.account.index') }}" class="menu-item relative flex items-center gap-3 px-4 py-2.5 text-sm text-slate-600">
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

    @include('admin.Teams.partials.styles')

    @php
        $divisionColors = [
            'SDM' => ['bg' => 'bg-amber-50', 'text' => 'text-amber-600'],
            'Website' => ['bg' => 'bg-sky-50', 'text' => 'text-sky-600'],
            'Aplikasi' => ['bg' => 'bg-indigo-50', 'text' => 'text-indigo-600'],
            'Finance' => ['bg' => 'bg-emerald-50', 'text' => 'text-emerald-600'],
            'Direktur' => ['bg' => 'bg-purple-50', 'text' => 'text-purple-600'],
            'Corporate and Marketing' => ['bg' => 'bg-pink-50', 'text' => 'text-pink-600'],
            'Akademik' => ['bg' => 'bg-cyan-50', 'text' => 'text-cyan-600'],
            'Sekretaris' => ['bg' => 'bg-orange-50', 'text' => 'text-orange-600'],
        ];
    @endphp

    <div x-data="teamManager()" class="space-y-6">

        @if(session('success'))
            <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)" x-transition
                 class="flex items-center gap-3 bg-brand-mint/10 border border-brand-mint/30 text-brand-mint px-5 py-3.5 rounded-xl text-sm font-medium">
                <i class="fa-solid fa-circle-check text-base"></i>
                {{ session('success') }}
            </div>
        @endif

        <div class="reveal card-hover flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-white rounded-2xl shadow-sm border border-slate-100 px-8 py-7">
            <div>
                <h3 class="text-lg font-bold text-brand-dark">Manajemen Tim</h3>
                <p class="text-sm text-slate-400 mt-1.5">Kelola tim dan informasi divisi perusahaan.</p>
            </div>

            <a href="{{ route('admin.teams.create') }}" class="btn-fill inline-flex items-center gap-2 px-5 py-2.5 rounded-lg text-sm font-semibold text-white bg-brand-mint">
                <span class="fill-layer bg-brand-teal"></span>
                <span class="btn-label flex items-center gap-2">
                    <i class="fa-solid fa-plus text-xs plus-icon"></i>
                    Tambah Anggota Tim
                </span>
            </a>
        </div>

        {{-- ===== FILTER (server-side, z-index diperbaiki) ===== --}}
        <form method="GET" x-ref="filterForm" class="reveal relative z-30 flex flex-col sm:flex-row gap-4" style="transition-delay:.05s">
            <div class="field-ring flex-1 flex items-center gap-3 px-4">
                <i class="fa-solid fa-magnifying-glass text-slate-400 text-sm field-icon"></i>
                <input type="text" name="search" x-model="search" @input.debounce.500ms="$nextTick(() => $refs.filterForm.submit())"
                       placeholder="Cari anggota tim..." class="w-full bg-transparent border-0 focus:ring-0 text-sm py-3">
                <button type="button" x-show="search.length > 0" x-cloak
                        @click="search = ''; $nextTick(() => $refs.filterForm.submit())"
                        class="clear-btn text-slate-300 hover:text-slate-500" title="Hapus pencarian">
                    <i class="fa-solid fa-xmark text-xs"></i>
                </button>
            </div>

            {{-- Dropdown: Filter Divisi --}}
            <div class="dropdown-wrap sm:w-56" @click.outside="divisionOpen = false">
                <input type="hidden" name="division_id" :value="divisionFilter">
                <button type="button" @click="divisionOpen = !divisionOpen; sortOpen = false"
                        class="dropdown-trigger flex items-center gap-3 px-4 py-3" :class="divisionOpen && 'is-open'">
                    <i class="fa-solid fa-layer-group dropdown-icon text-sm"></i>
                    <span class="flex-1 text-sm truncate" :class="divisionFilter ? 'text-brand-dark' : 'text-slate-400'" x-text="divisionLabel()"></span>
                    <i class="fa-solid fa-chevron-down dropdown-chevron text-xs"></i>
                </button>

                <div x-show="divisionOpen" x-cloak
                     x-transition:enter="transition ease-out duration-150"
                     x-transition:enter-start="opacity-0 scale-95 -translate-y-1"
                     x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                     x-transition:leave="transition ease-in duration-100"
                     x-transition:leave-start="opacity-100 scale-100"
                     x-transition:leave-end="opacity-0 scale-95"
                     class="dropdown-panel mt-2 w-full bg-white">
                    <div class="dropdown-list">
                        <button type="button" @click="setDivision('')"
                                class="dropdown-option flex items-center justify-between gap-2 px-3 py-2.5 text-sm"
                                :class="divisionFilter === '' ? 'is-selected' : ''">
                            <span>Semua Divisi</span>
                            <i class="fa-solid fa-check dropdown-check text-xs" x-show="divisionFilter === ''"></i>
                        </button>
                        @forelse($divisions as $division)
                            <button type="button" @click="setDivision('{{ $division->id }}')"
                                    class="dropdown-option flex items-center justify-between gap-2 px-3 py-2.5 text-sm"
                                    :class="divisionFilter === '{{ $division->id }}' ? 'is-selected' : ''">
                                <span>{{ $division->name }}</span>
                                <i class="fa-solid fa-check dropdown-check text-xs" x-show="divisionFilter === '{{ $division->id }}'"></i>
                            </button>
                        @empty
                            <p class="dropdown-empty px-3 py-2.5 text-sm">Tidak ada divisi</p>
                        @endforelse
                    </div>
                </div>
            </div>

            {{-- Dropdown: Urutkan (Terbaru/Terlama/Nama A-Z/Nama Z-A) --}}
            <div class="dropdown-wrap sm:w-48" @click.outside="sortOpen = false">
                <input type="hidden" name="sort" :value="sortVal">
                <button type="button" @click="sortOpen = !sortOpen; divisionOpen = false"
                        class="btn-filter dropdown-trigger relative flex items-center gap-2 px-4 py-3 rounded-xl text-sm font-medium" :class="sortOpen && 'is-open'">
                    <i class="fa-solid fa-arrow-down-wide-short text-xs filter-icon"></i>
                    <span class="flex-1 text-left truncate" x-text="sortLabel()"></span>
                    <i class="fa-solid fa-chevron-down dropdown-chevron text-xs"></i>
                </button>

                <div x-show="sortOpen" x-cloak
                     x-transition:enter="transition ease-out duration-150"
                     x-transition:enter-start="opacity-0 scale-95 -translate-y-1"
                     x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                     x-transition:leave="transition ease-in duration-100"
                     x-transition:leave-start="opacity-100 scale-100"
                     x-transition:leave-end="opacity-0 scale-95"
                     class="dropdown-panel mt-2 w-full bg-white">
                    <div class="dropdown-list">
                        <button type="button" @click="setSort('urutan')"
                                class="dropdown-option flex items-center justify-between gap-2 px-3 py-2.5 text-sm" :class="sortVal === 'urutan' || sortVal === '' ? 'is-selected' : ''">
                            <span>Urutan Manual</span>
                            <i class="fa-solid fa-check dropdown-check text-xs" x-show="sortVal === 'urutan' || sortVal === ''"></i>
                        </button>
                        <button type="button" @click="setSort('terbaru')"
                                class="dropdown-option flex items-center justify-between gap-2 px-3 py-2.5 text-sm" :class="sortVal === 'terbaru' ? 'is-selected' : ''">
                            <span>Terbaru</span>
                            <i class="fa-solid fa-check dropdown-check text-xs" x-show="sortVal === 'terbaru'"></i>
                        </button>
                        <button type="button" @click="setSort('terlama')"
                                class="dropdown-option flex items-center justify-between gap-2 px-3 py-2.5 text-sm" :class="sortVal === 'terlama' ? 'is-selected' : ''">
                            <span>Terlama</span>
                            <i class="fa-solid fa-check dropdown-check text-xs" x-show="sortVal === 'terlama'"></i>
                        </button>
                        <button type="button" @click="setSort('nama_az')"
                                class="dropdown-option flex items-center justify-between gap-2 px-3 py-2.5 text-sm" :class="sortVal === 'nama_az' ? 'is-selected' : ''">
                            <span>Nama A-Z</span>
                            <i class="fa-solid fa-check dropdown-check text-xs" x-show="sortVal === 'nama_az'"></i>
                        </button>
                        <button type="button" @click="setSort('nama_za')"
                                class="dropdown-option flex items-center justify-between gap-2 px-3 py-2.5 text-sm" :class="sortVal === 'nama_za' ? 'is-selected' : ''">
                            <span>Nama Z-A</span>
                            <i class="fa-solid fa-check dropdown-check text-xs" x-show="sortVal === 'nama_za'"></i>
                        </button>
                    </div>
                </div>
            </div>

            <button type="button" x-show="hasFilter()" x-cloak @click="resetFilter()"
                    class="btn-filter flex items-center justify-center gap-2 px-4 py-3 rounded-xl border border-slate-200 text-sm font-medium text-slate-500 active">
                <i class="fa-solid fa-rotate-left text-xs filter-icon"></i>
                <span>Reset</span>
            </button>
        </form>

        <div x-show="hasFilter()" x-cloak x-transition class="flex items-center justify-between gap-3 px-4 py-3 rounded-xl bg-brand-mint/5 border border-brand-mint/15">
            <div class="flex items-center gap-2 text-sm text-slate-500">
                <i class="fa-solid fa-filter text-brand-mint text-xs"></i>
                <span>Menampilkan <span class="font-semibold text-brand-dark">{{ $members->total() }}</span> anggota tim</span>
            </div>
            <button type="button" @click="resetFilter()" class="link-underline text-xs font-medium text-brand-mint">Reset Filter</button>
        </div>

        <div class="team-table-card reveal card-hover bg-white overflow-hidden" style="transition-delay:.1s">
            <div class="overflow-x-auto">
                <table class="w-full text-sm table-fixed border-collapse">
                    <colgroup>
                        <col style="width: 90px">
                        <col>
                        <col style="width: 180px">
                        <col style="width: 200px">
                        <col style="width: 100px">
                        <col style="width: 120px">
                        <col style="width: 110px">
                    </colgroup>
                    <thead>
                        <tr class="text-left text-xs uppercase tracking-wide text-slate-400 border-b border-slate-100 bg-slate-50/70">
                            <th class="px-6 py-4 font-semibold">Foto</th>
                            <th class="px-4 py-4 font-semibold">Nama</th>
                            <th class="px-4 py-4 font-semibold">Jabatan</th>
                            <th class="px-4 py-4 font-semibold text-center">Divisi</th>
                            <th class="px-4 py-4 font-semibold text-center">Urutan</th>
                            <th class="px-4 py-4 font-semibold text-center">Status</th>
                            <th class="px-4 py-4 font-semibold text-right pr-6">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($members as $member)
                            @php
                                $divColor = $divisionColors[$member->division?->name] ?? ['bg' => 'bg-blue-50', 'text' => 'text-blue-500'];
                            @endphp
                            <tr class="team-row">
                                <td class="px-6 py-4 align-middle relative">
                                    <span class="team-row-bar"></span>
                                    <img src="{{ $member->photo ? asset('storage/'.$member->photo) : asset('images/avatar-placeholder.png') }}" class="team-photo h-10 w-10 rounded-full object-cover border border-slate-100" alt="{{ $member->name }}">
                                </td>
                                <td class="px-4 py-4 align-middle">
                                    <p class="font-medium text-brand-dark truncate">{{ $member->name }}</p>
                                </td>
                                <td class="px-4 py-4 align-middle text-slate-500 truncate">{{ $member->position }}</td>
                                <td class="px-4 py-4 align-middle text-center">
                                    @if($member->division)
                                        <span class="badge inline-flex justify-center items-center min-w-[90px] px-3 py-1 rounded-full text-xs font-medium {{ $divColor['bg'] }} {{ $divColor['text'] }} whitespace-nowrap">{{ $member->division->name }}</span>
                                    @else
                                        <span class="badge inline-flex justify-center items-center min-w-[90px] px-3 py-1 rounded-full text-xs font-medium bg-slate-100 text-slate-400 whitespace-nowrap">Tidak Ada</span>
                                    @endif
                                </td>
                                <td class="px-4 py-4 align-middle text-center">
                                    <span class="inline-flex justify-center items-center min-w-[32px] bg-slate-100 text-slate-600 px-2 py-1 rounded text-xs font-medium">{{ $member->order ?? '-' }}</span>
                                </td>
                                <td class="px-4 py-4 align-middle text-center">
                                    @if($member->is_active)
                                        <span class="badge inline-flex justify-center items-center min-w-[80px] px-3 py-1 rounded-full text-xs font-medium bg-emerald-50 text-emerald-500 whitespace-nowrap">
                                            <i class="fa-solid fa-check text-xs mr-1"></i> Aktif
                                        </span>
                                    @else
                                        <span class="badge inline-flex justify-center items-center min-w-[80px] px-3 py-1 rounded-full text-xs font-medium bg-slate-100 text-slate-400 whitespace-nowrap">
                                            <i class="fa-solid fa-ban text-xs mr-1"></i> Nonaktif
                                        </span>
                                    @endif
                                </td>
                                <td class="px-4 py-4 align-middle pr-6">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="{{ route('admin.teams.edit', $member) }}" class="icon-action icon-edit h-8 w-8 rounded-full bg-brand-cream text-slate-400 flex items-center justify-center shrink-0" title="Edit anggota">
                                            <i class="fa-solid fa-pen text-xs"></i>
                                        </a>
                                        <button type="button" @click="openDelete({{ $member->id }}, @js($member->name))" class="icon-action icon-delete h-8 w-8 rounded-full bg-brand-cream text-slate-400 flex items-center justify-center shrink-0" title="Hapus anggota">
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
                                            <i class="fa-solid fa-users text-slate-300 text-lg"></i>
                                        </div>
                                        @if(request('search') || request('division_id'))
                                            <p class="text-sm font-medium text-slate-500">Data tidak ditemukan</p>
                                            <p class="text-xs text-slate-300 mt-1">Coba gunakan kata kunci atau filter divisi yang berbeda.</p>
                                        @else
                                            <p class="text-sm text-slate-400">Belum ada anggota tim</p>
                                            <p class="text-xs text-slate-300 mt-1">Klik "Tambah Anggota Tim" untuk mulai menambahkan.</p>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($members->hasPages())
                <div class="flex items-center justify-between px-6 py-4 border-t border-slate-100">
                    <p class="text-xs text-slate-400">Menampilkan {{ $members->firstItem() }}-{{ $members->lastItem() }} dari {{ $members->total() }} data</p>
                    <div class="flex items-center gap-1.5">
                        {{ $members->onEachSide(1)->links('vendor.pagination.custom-brand') }}
                    </div>
                </div>
            @endif
        </div>

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
                <p class="font-semibold text-brand-dark">Apakah Anda yakin ingin menghapus <span x-text="deleteModal.name" class="text-red-500"></span>?</p>
                <p class="text-xs text-slate-400 mt-1.5">Data yang dihapus tidak dapat dikembalikan.</p>
                <form :action="'{{ url('admin/teams') }}/' + deleteModal.id" method="POST" class="flex gap-3 mt-6">
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
        function teamManager() {
            return {
                search: '{{ request('search') }}',
                divisionFilter: '{{ request('division_id') }}',
                sortVal: '{{ request('sort', 'urutan') }}',
                divisionOpen: false,
                sortOpen: false,
                deleteModal: { open: false, id: null, name: '' },
                divisionNames: @js($divisions->pluck('name', 'id')),

                divisionLabel() {
                    if (this.divisionFilter === '') return 'Semua Divisi';
                    return this.divisionNames[this.divisionFilter] || 'Semua Divisi';
                },
                sortLabel() {
                    const map = { urutan: 'Urutan Manual', terbaru: 'Terbaru', terlama: 'Terlama', nama_az: 'Nama A-Z', nama_za: 'Nama Z-A' };
                    return map[this.sortVal] || 'Urutan Manual';
                },
                hasFilter() {
                    return this.search.trim() !== '' || this.divisionFilter !== '' || (this.sortVal !== '' && this.sortVal !== 'urutan');
                },
                setDivision(val) {
                    this.divisionFilter = val;
                    this.divisionOpen = false;
                    this.$nextTick(() => this.$refs.filterForm.submit());
                },
                setSort(val) {
                    this.sortVal = val;
                    this.sortOpen = false;
                    this.$nextTick(() => this.$refs.filterForm.submit());
                },
                resetFilter() {
                    this.search = '';
                    this.divisionFilter = '';
                    this.sortVal = 'urutan';
                    this.$nextTick(() => this.$refs.filterForm.submit());
                },
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