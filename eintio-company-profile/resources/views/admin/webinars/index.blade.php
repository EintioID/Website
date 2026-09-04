{{-- resources/views/admin/webinars/index.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <div>
            <p class="text-xs text-slate-400 mb-1.5">Beranda / Blog & Artikel / Webinar</p>
            <h2 class="text-xl font-bold text-brand-dark tracking-tight">Manajemen Webinar</h2>
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

    @include('admin.webinars.partials.styles')

    <div x-data="webinarFilters()" class="space-y-6 w-full">

        @if (session('success'))
            <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:leave="transition ease-in duration-300"
                 class="flex items-center gap-3 bg-brand-mint/10 border border-brand-mint/30 text-brand-mint px-5 py-3.5 rounded-xl text-sm font-medium animate-slideIn">
                <i class="fa-solid fa-circle-check text-base"></i>
                {{ session('success') }}
            </div>
        @endif

        <div class="reveal card-hover bg-white rounded-2xl shadow-sm border border-slate-100 px-8 py-7">
            <div class="flex items-center justify-between mb-5 flex-wrap gap-4">
                <div>
                    <h3 class="font-bold text-brand-dark text-lg">Manajemen Webinar</h3>
                    <p class="text-sm text-slate-400 mt-1">Kelola webinar yang ditampilkan di website.</p>
                </div>
                <a href="{{ route('admin.webinars.create') }}"
                   class="btn-fill group relative inline-flex items-center gap-2 px-5 py-2.5 rounded-lg text-sm font-semibold text-white bg-brand-mint">
                    <span class="fill-layer bg-brand-teal"></span>
                    <span class="btn-label">
                        <i class="fa-solid fa-plus text-xs transition-transform duration-300 group-hover:rotate-90 mr-2"></i>
                        Tambah Webinar
                    </span>
                </a>
            </div>

            <form method="GET" x-ref="filterForm" class="flex flex-wrap gap-3 mb-6 relative z-20">
                <div class="field-ring flex-1 min-w-[200px] flex items-center gap-3 px-4">
                    <i class="fa-solid fa-magnifying-glass text-slate-400 text-sm field-icon"></i>
                    <input type="text" name="search" x-model="search" @input.debounce.500ms="submitForm()"
                           value="{{ request('search') }}" placeholder="Cari webinar..."
                           class="w-full border-0 focus:ring-0 text-sm py-2.5 bg-transparent">
                    <button type="button" x-show="search.length > 0" x-cloak @click="search = ''; submitForm()" class="clear-btn text-slate-300 hover:text-slate-500" title="Hapus pencarian">
                        <i class="fa-solid fa-xmark text-xs"></i>
                    </button>
                </div>

                <div class="dropdown-wrap sm:w-52" @click.outside="statusOpen = false">
                    <input type="hidden" name="status" x-model="status">
                    <button type="button" @click="statusOpen = !statusOpen; typeOpen = false"
                            class="dropdown-trigger flex items-center gap-3 px-4 py-2.5" :class="statusOpen && 'is-open'">
                        <i class="fa-solid fa-circle-check dropdown-icon text-sm"></i>
                        <span class="flex-1 text-sm text-slate-600 text-left" x-text="statusLabel()"></span>
                        <i class="fa-solid fa-chevron-down dropdown-chevron text-xs"></i>
                    </button>
                    <div x-show="statusOpen" x-cloak
                         x-transition:enter="transition ease-out duration-150"
                         x-transition:enter-start="opacity-0 scale-95 -translate-y-1"
                         x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                         x-transition:leave="transition ease-in duration-100"
                         x-transition:leave-start="opacity-100 scale-100"
                         x-transition:leave-end="opacity-0 scale-95"
                         class="dropdown-panel absolute mt-2 w-52 bg-white z-50">
                        <div class="dropdown-list">
                            {{-- Status dropdown --}}
                                @foreach (['all' => 'Semua Status', 'draft' => 'Draft', 'scheduled' => 'Scheduled', 'published' => 'Published'] as $key => $label)
                                    <button type="button" @click="status = '{{ $key }}'; statusOpen = false; $nextTick(() => submitForm())"
                                            class="dropdown-option flex items-center justify-between gap-2 px-3 py-2.5 text-sm" :class="status === '{{ $key }}' ? 'is-selected' : ''">
                                        <span>{{ $label }}</span>
                                        <i class="fa-solid fa-check dropdown-check text-xs" x-show="status === '{{ $key }}'"></i>
                                    </button>
                                @endforeach
                        </div>
                    </div>
                </div>

                <div class="dropdown-wrap sm:w-52" @click.outside="typeOpen = false">
                    <input type="hidden" name="type" x-model="type">
                    <button type="button" @click="typeOpen = !typeOpen; statusOpen = false"
                            class="dropdown-trigger flex items-center gap-3 px-4 py-2.5" :class="typeOpen && 'is-open'">
                        <i class="fa-solid fa-video dropdown-icon text-sm"></i>
                        <span class="flex-1 text-sm text-slate-600 text-left" x-text="typeLabel()"></span>
                        <i class="fa-solid fa-chevron-down dropdown-chevron text-xs"></i>
                    </button>
                    <div x-show="typeOpen" x-cloak
                         x-transition:enter="transition ease-out duration-150"
                         x-transition:enter-start="opacity-0 scale-95 -translate-y-1"
                         x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                         x-transition:leave="transition ease-in duration-100"
                         x-transition:leave-start="opacity-100 scale-100"
                         x-transition:leave-end="opacity-0 scale-95"
                         class="dropdown-panel absolute mt-2 w-52 bg-white z-50">
                        <div class="dropdown-list">
                           {{-- Type dropdown --}}
                                @foreach (['all' => 'Semua Tipe', 'live' => 'Live Webinar', 'recorded' => 'Pre-recorded'] as $key => $label)
                                    <button type="button" @click="type = '{{ $key }}'; typeOpen = false; $nextTick(() => submitForm())"
                                            class="dropdown-option flex items-center justify-between gap-2 px-3 py-2.5 text-sm" :class="type === '{{ $key }}' ? 'is-selected' : ''">
                                        <span>{{ $label }}</span>
                                        <i class="fa-solid fa-check dropdown-check text-xs" x-show="type === '{{ $key }}'"></i>
                                    </button>
                                @endforeach
                        </div>
                    </div>
                </div>

                <button type="button" @click="resetFilter()"
                        class="btn-filter flex items-center gap-2 px-4 py-2.5 rounded-lg border border-slate-200 text-sm font-medium text-slate-500" :class="hasFilter() ? 'active' : ''">
                    <i class="fa-solid fa-filter filter-icon text-xs"></i>
                    <span x-text="hasFilter() ? 'Reset' : 'Filter'"></span>
                </button>
            </form>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5 relative z-0">
                @forelse ($webinars as $webinar)
                    {{-- Card webinar --}}
<div class="webinar-card-item group relative overflow-hidden rounded-xl border border-slate-100 bg-white transition-all duration-300 hover:shadow-lg hover:-translate-y-1 hover:border-brand-mint/40">
    <div class="relative h-40 overflow-hidden bg-slate-100">
        @if ($webinar->thumbnail)
            <img src="{{ Storage::url($webinar->thumbnail) }}" class="webinar-thumb h-full w-full object-cover transition-transform duration-500 group-hover:scale-105" alt="{{ $webinar->title }}">
        @else
            <div class="flex h-full w-full items-center justify-center bg-gradient-to-br from-brand-mint/10 to-brand-teal/10">
                <i class="fa-solid fa-video text-slate-300 text-3xl"></i>
            </div>
        @endif
        <span class="badge absolute top-3 right-3 inline-block px-2.5 py-1 rounded-full text-xs font-bold text-white"
              :class="{
                  'bg-blue-500': '{{ $webinar->status }}' === 'draft',
                  'bg-yellow-500': '{{ $webinar->status }}' === 'scheduled',
                  'bg-green-500': '{{ $webinar->status }}' === 'published'
              }">
            {{ $webinar->status }}
        </span>
    </div>

    <div class="p-4">
        <h4 class="font-semibold text-brand-dark text-sm line-clamp-2 mb-3 group-hover:text-brand-mint transition-colors duration-200">{{ $webinar->title }}</h4>

        <div class="space-y-2 mb-4 text-xs text-slate-500">
            <div class="flex items-center gap-2">
                <i class="fa-regular fa-calendar w-3.5 text-brand-mint"></i>
                <span>{{ $webinar->webinar_date?->translatedFormat('d M Y') ?? '-' }}</span>
                @if($webinar->webinar_time)
                    <span class="ml-auto">{{ $webinar->webinar_time }} WIB</span>
                @endif
            </div>
            <div class="flex items-center gap-2">
                <i class="fa-solid fa-users w-3.5 text-brand-mint"></i>
                <span>{{ $webinar->participants_count }} Peserta</span>
            </div>
        </div>

        {{-- ICON ACTIONS: sekarang ngumpul rapi di kanan --}}
        <div class="flex items-center justify-end gap-2 border-t border-slate-100 pt-3">
            <a href="{{ route('admin.webinars.show', $webinar) }}"
               class="icon-action icon-view h-8 w-8 rounded-full bg-brand-cream text-slate-400 flex items-center justify-center transition-all duration-200 hover:bg-brand-mint hover:text-white hover:scale-110" title="Lihat">
                <i class="fa-regular fa-eye text-xs"></i>
            </a>
            <a href="{{ route('admin.webinars.edit', $webinar) }}"
               class="icon-action icon-edit h-8 w-8 rounded-full bg-brand-cream text-slate-400 flex items-center justify-center transition-all duration-200 hover:bg-blue-500 hover:text-white hover:scale-110" title="Edit">
                <i class="fa-solid fa-pen text-xs"></i>
            </a>
            <a href="{{ route('admin.webinars.participants.index', $webinar) }}"
               class="icon-action icon-participants h-8 w-8 rounded-full bg-brand-cream text-slate-400 flex items-center justify-center transition-all duration-200 hover:bg-purple-500 hover:text-white hover:scale-110" title="Peserta">
                <i class="fa-solid fa-user-group text-xs"></i>
            </a>
            <button type="button" @click="openDelete('{{ route('admin.webinars.destroy', $webinar) }}', @js($webinar->title))"
                    class="icon-action icon-delete h-8 w-8 rounded-full bg-brand-cream text-slate-400 flex items-center justify-center transition-all duration-200 hover:bg-red-500 hover:text-white hover:scale-110" title="Hapus">
                <i class="fa-solid fa-trash text-xs"></i>
            </button>
        </div>
    </div>
</div>
                @empty
                    <div class="col-span-full">
                        <div class="search-empty flex flex-col items-center justify-center py-16">
                            <div class="h-14 w-14 rounded-full bg-brand-cream flex items-center justify-center mb-3">
                                <i class="fa-solid fa-video text-slate-300 text-lg"></i>
                            </div>
                            <p class="text-sm text-slate-400">Belum ada data webinar.</p>
                        </div>
                    </div>
                @endforelse
            </div>

            @if($webinars->hasPages())
                <div class="flex items-center justify-between mt-8 pt-6 border-t border-slate-100">
                    <p class="text-xs text-slate-400">Menampilkan {{ $webinars->firstItem() }}-{{ $webinars->lastItem() }} dari {{ $webinars->total() }} data</p>
                    <div class="flex items-center gap-1.5">
                        {{ $webinars->onEachSide(1)->links() }}
                    </div>
                </div>
            @endif
        </div>

        {{-- MODAL DELETE --}}
        <template x-teleport="body">
            <div x-show="deleteModal.open" x-cloak style="display:none"
                 class="fixed inset-0 z-50 flex items-center justify-center p-4">
                <div x-show="deleteModal.open" x-transition.opacity @click="deleteModal.open = false"
                     class="absolute inset-0 bg-brand-dark/60 backdrop-blur-sm"></div>
                <div x-show="deleteModal.open"
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 scale-95 translate-y-4"
                     x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                     x-transition:leave="transition ease-in duration-150"
                     x-transition:leave-start="opacity-100 scale-100"
                     x-transition:leave-end="opacity-0 scale-95"
                     class="relative bg-white rounded-2xl shadow-2xl p-7 w-full max-w-sm z-10 text-center">
                    <button type="button" @click="deleteModal.open = false"
                            class="modal-close-btn absolute top-4 right-4 h-7 w-7 rounded-full flex items-center justify-center text-slate-300">
                        <i class="fa-solid fa-xmark text-sm"></i>
                    </button>
                    <div class="modal-danger-icon h-14 w-14 rounded-full bg-red-50 text-red-500 flex items-center justify-center mx-auto mb-4">
                        <i class="fa-solid fa-trash text-lg"></i>
                    </div>
                    <p class="font-semibold text-brand-dark">Apakah Anda yakin menghapus <span x-text="deleteModal.name" class="text-red-500"></span>?</p>
                    <p class="text-xs text-slate-400 mt-1.5">Data yang dihapus tidak dapat dikembalikan.</p>
                    <div class="flex gap-3 mt-6">
                        <button type="button" @click="deleteModal.open = false"
                                class="btn-ghost flex-1 px-4 py-2.5 rounded-lg text-sm font-medium text-slate-500 border border-slate-200">
                            Batal
                        </button>
                        <form :action="deleteModal.url" method="POST" class="flex-1">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn-fill w-full px-4 py-2.5 rounded-lg text-sm font-semibold text-white bg-red-500">
                                <span class="fill-layer bg-red-600"></span>
                                <span class="btn-label">Ya, Hapus</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </template>
    </div>

    <script>
        function webinarFilters() {
            return {
                search: '{{ request('search') }}',
                status: '{{ request('status', 'all') }}',
                type: '{{ request('type', 'all') }}',
                statusOpen: false,
                typeOpen: false,
                deleteModal: { open: false, url: '', name: '' },
                statusLabel() {
                    const map = { draft: 'Draft', scheduled: 'Scheduled', published: 'Published' };
                    return (this.status === 'all' || this.status === '') ? 'Semua Status' : map[this.status];
                },
                typeLabel() {
                    const map = { live: 'Live Webinar', recorded: 'Pre-recorded' };
                    return (this.type === 'all' || this.type === '') ? 'Semua Tipe' : map[this.type];
                },
                hasFilter() { return this.search !== '' || (this.status !== 'all' && this.status !== '') || (this.type !== 'all' && this.type !== ''); },
                resetFilter() { this.search = ''; this.status = 'all'; this.type = 'all'; this.submitForm(); },
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