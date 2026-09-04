{{-- resources/views/admin/webinars/participants/index.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <div>
            <p class="text-xs text-slate-400 mb-1.5">Beranda / Blog & Artikel / Webinar / Peserta</p>
            <h2 class="text-xl font-bold text-brand-dark tracking-tight">Peserta Webinar</h2>
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
                    <div class="h-9 w-9 rounded-full bg-brand-mint flex items-center justify-center text-white text-sm font-semibold">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                    <div class="text-sm hidden sm:block text-left">
                        <p class="font-medium text-brand-dark leading-none">{{ Auth::user()->name }}</p>
                        <p class="text-slate-400 text-xs mt-1">Superadmin</p>
                    </div>
                    <i class="fa-solid fa-chevron-down text-xs text-slate-400" :class="open && 'rotate-180'"></i>
                </button>
            </div>
        </div>
    </x-slot>

    @include('admin.webinars.partials.styles')

    <div x-data="participantFilters()" class="space-y-6 w-full">

        {{-- SECTION 1: Judul + Aksi --}}
        <div class="reveal-section flex items-center justify-between flex-wrap gap-4" data-delay="1">
            <div>
                <h3 class="font-bold text-brand-dark text-lg">Peserta Webinar</h3>
                <p class="text-sm text-slate-400 mt-1">Daftar peserta yang mendaftar untuk webinar ini.</p>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.webinars.show', $webinar) }}"
                   class="inline-flex items-center gap-2 px-4 py-2.5 rounded-lg text-sm font-medium text-slate-600 border border-slate-200 transition-all duration-200 hover:bg-slate-50 hover:border-slate-300">
                    <i class="fa-regular fa-eye text-xs"></i> Lihat Detail Webinar
                </a>
                <a href="{{ route('admin.webinars.participants.export', $webinar) }}"
                   class="btn-fill group relative inline-flex items-center gap-2 px-4 py-2.5 rounded-lg text-sm font-semibold text-white bg-brand-mint transition-all duration-200 hover:shadow-md">
                    <span class="fill-layer bg-brand-teal"></span>
                    <span class="btn-label"><i class="fa-solid fa-file-export text-xs mr-2"></i>Export Excel</span>
                </a>
            </div>
        </div>

        {{-- SECTION 2: Info Webinar banner --}}
        <div class="reveal-section flex items-center gap-4 bg-white rounded-2xl shadow-sm border border-slate-100 px-6 py-4 transition-all duration-300 hover:shadow-md hover:border-brand-mint/30" data-delay="2">
            <div class="h-14 w-20 rounded-lg overflow-hidden bg-slate-100 flex-shrink-0">
                @if($webinar->thumbnail)
                    <img src="{{ Storage::url($webinar->thumbnail) }}" class="h-full w-full object-cover" alt="{{ $webinar->title }}">
                @else
                    <div class="h-full w-full flex items-center justify-center bg-gradient-to-br from-brand-mint/10 to-brand-teal/10">
                        <i class="fa-solid fa-video text-slate-300"></i>
                    </div>
                @endif
            </div>
            <div class="flex-1 min-w-0">
                <h4 class="font-semibold text-brand-dark text-sm truncate">{{ $webinar->title }}</h4>
                <div class="flex items-center gap-4 text-xs text-slate-500 mt-1.5">
                    <span class="flex items-center gap-1.5"><i class="fa-regular fa-calendar text-brand-mint"></i>{{ $webinar->webinar_date?->translatedFormat('d M Y') }}</span>
                    <span class="flex items-center gap-1.5"><i class="fa-regular fa-clock text-brand-mint"></i>{{ $webinar->webinar_time }} WIB</span>
                    <span class="flex items-center gap-1.5"><i class="fa-solid fa-users text-brand-mint"></i>{{ $participants->total() }} Peserta</span>
                </div>
            </div>
            <span class="px-3 py-1 rounded-full text-xs font-bold text-white flex-shrink-0"
                  :class="{
                      'bg-blue-500': '{{ $webinar->status }}' === 'draft',
                      'bg-yellow-500': '{{ $webinar->status }}' === 'scheduled',
                      'bg-green-500': '{{ $webinar->status }}' === 'published'
                  }">
                {{ ucfirst($webinar->status) }}
            </span>
        </div>

        {{-- SECTION 3: Filter + Tabel --}}
        <div class="reveal-section bg-white rounded-2xl shadow-sm border border-slate-100 px-6 py-6 transition-shadow duration-300 hover:shadow-md" data-delay="3">

            <form method="GET" x-ref="filterForm" class="flex flex-wrap gap-3 mb-5">
                <div class="field-ring flex-1 min-w-[200px] flex items-center gap-3 px-4">
                    <i class="fa-solid fa-magnifying-glass text-slate-400 text-sm"></i>
                    <input type="text" name="search" x-model="search" @input.debounce.500ms="submitForm()"
                           value="{{ request('search') }}" placeholder="Cari peserta..."
                           class="w-full border-0 focus:ring-0 text-sm py-2.5 bg-transparent">
                </div>

                <div class="dropdown-wrap sm:w-52" @click.outside="statusOpen = false">
                    <input type="hidden" name="status" x-model="status">
                    <button type="button" @click="statusOpen = !statusOpen"
                            class="dropdown-trigger flex items-center gap-3 px-4 py-2.5" :class="statusOpen && 'is-open'">
                        <i class="fa-solid fa-circle-check text-sm"></i>
                        <span class="flex-1 text-sm text-slate-600 text-left" x-text="statusLabel()"></span>
                        <i class="fa-solid fa-chevron-down text-xs"></i>
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
                            @foreach (['all' => 'Semua Status', 'pending' => 'Pending', 'verified' => 'Verified'] as $key => $label)
                                <button type="button" @click="status = '{{ $key }}'; statusOpen = false; $nextTick(() => submitForm())"
                                        class="dropdown-option flex items-center justify-between gap-2 px-3 py-2.5 text-sm" :class="status === '{{ $key }}' ? 'is-selected' : ''">
                                    <span>{{ $label }}</span>
                                    <i class="fa-solid fa-check text-xs" x-show="status === '{{ $key }}'"></i>
                                </button>
                            @endforeach
                        </div>
                    </div>
                </div>
            </form>

            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="text-left text-xs text-slate-400 uppercase border-b border-slate-100">
                            <th class="py-3 pr-4 font-semibold">No</th>
                            <th class="py-3 pr-4 font-semibold">Nama Lengkap</th>
                            <th class="py-3 pr-4 font-semibold">Email</th>
                            <th class="py-3 pr-4 font-semibold">WhatsApp</th>
                            <th class="py-3 pr-4 font-semibold">Instansi / Pekerjaan</th>
                            <th class="py-3 pr-4 font-semibold">Tanggal Daftar</th>
                            <th class="py-3 pr-4 font-semibold">Status</th>
                            <th class="py-3 pr-4 font-semibold text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($participants as $i => $p)
                            <tr class="border-b border-slate-50 transition-colors duration-150 hover:bg-brand-cream/40">
                                <td class="py-3.5 pr-4 text-slate-500">{{ $participants->firstItem() + $i }}</td>
                                <td class="py-3.5 pr-4 font-medium text-brand-dark">{{ $p->name }}</td>
                                <td class="py-3.5 pr-4 text-slate-500">{{ $p->email }}</td>
                                <td class="py-3.5 pr-4 text-slate-500">{{ $p->whatsapp }}</td>
                                <td class="py-3.5 pr-4 text-slate-500">{{ $p->institution }}</td>
                                <td class="py-3.5 pr-4 text-slate-500">{{ $p->created_at?->translatedFormat('d M Y, H:i') }}</td>
                                <td class="py-3.5 pr-4">
                                    <span class="px-2.5 py-1 rounded-full text-xs font-semibold"
                                          :class="{{ $p->status === 'verified' ? "'bg-green-100 text-green-600'" : "'bg-yellow-100 text-yellow-600'" }}">
                                        {{ ucfirst($p->status) }}
                                    </span>
                                </td>
                                <td class="py-3.5 pr-4 text-right">
                                    <a href="{{ route('admin.webinars.participants.show', [$webinar, $p]) }}"
                                       class="inline-flex h-8 w-8 rounded-full bg-brand-cream text-slate-400 items-center justify-center transition-all duration-200 hover:bg-brand-mint hover:text-white hover:scale-110">
                                        <i class="fa-regular fa-eye text-xs"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="py-10 text-center text-slate-400 text-sm">Belum ada peserta terdaftar.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($participants->hasPages())
                <div class="flex items-center justify-between mt-6 pt-5 border-t border-slate-100">
                    <p class="text-xs text-slate-400">Menampilkan {{ $participants->firstItem() }}-{{ $participants->lastItem() }} dari {{ $participants->total() }} data</p>
                    <div class="flex items-center gap-1.5">{{ $participants->onEachSide(1)->links() }}</div>
                </div>
            @endif
        </div>
    </div>

    <script>
        function participantFilters() {
            return {
                search: '{{ request('search') }}',
                status: '{{ request('status', 'all') }}',
                statusOpen: false,
                statusLabel() {
                    const map = { pending: 'Pending', verified: 'Verified' };
                    return (this.status === 'all' || this.status === '') ? 'Semua Status' : map[this.status];
                },
                submitForm() { this.$refs.filterForm.submit(); },
            }
        }
    </script>
</x-app-layout>