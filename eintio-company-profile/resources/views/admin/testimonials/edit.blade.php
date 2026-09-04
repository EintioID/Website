{{-- resources/views/admin/testimonials/edit.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <div>
            <p class="text-xs text-slate-400 mb-1.5">Beranda / Testimoni / Ubah Status</p>
            <h2 class="text-xl font-bold text-brand-dark tracking-tight">Ubah Status Testimoni</h2>
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

    @include('admin.testimonials.partials.styles')

    @php
        $avatarPalette = ['bg-teal-500', 'bg-blue-500', 'bg-purple-500', 'bg-amber-500', 'bg-rose-500', 'bg-indigo-500'];
        $avColor = $avatarPalette[crc32($testimonial->client_name) % count($avatarPalette)];
        $initial = strtoupper(substr($testimonial->client_name, 0, 1));
    @endphp

    <div class="space-y-6 max-w-2xl" x-data="editStatusForm()">

        @if(session('success'))
            <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)" x-transition
                 class="flex items-center gap-3 bg-brand-mint/10 border border-brand-mint/30 text-brand-mint px-5 py-3.5 rounded-xl text-sm font-medium">
                <i class="fa-solid fa-circle-check text-base"></i>
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('admin.testimonials.update', $testimonial) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="reveal card-hover flex items-center justify-between bg-white rounded-2xl shadow-sm border border-slate-100 px-8 py-7">
                <div>
                    <h3 class="text-lg font-bold text-brand-dark">Ubah Status</h3>
                    <p class="text-sm text-slate-400 mt-1.5">Tinjau isi testimoni lalu tentukan statusnya.</p>
                </div>
                <a href="{{ route('admin.testimonials.index') }}"
                   class="modal-close-btn h-9 w-9 rounded-full flex items-center justify-center text-slate-400 border border-slate-100">
                    <i class="fa-solid fa-xmark"></i>
                </a>
            </div>

            {{-- Info testimoni: read-only, hanya untuk konteks --}}
            <div class="reveal card-hover bg-white rounded-2xl shadow-sm border border-slate-100 p-8 space-y-6" style="transition-delay:.05s">
                <div class="flex items-center gap-4">
                    <div class="avatar-circle h-12 w-12 rounded-full {{ $avColor }} flex items-center justify-center text-white text-base font-semibold">
                        {{ $initial }}
                    </div>
                    <div>
                        <p class="font-semibold text-brand-dark">{{ $testimonial->client_name }}</p>
                        <p class="text-xs text-slate-400 mt-0.5">
                            {{ $testimonial->client_position }}{{ $testimonial->client_position && $testimonial->client_institution ? ', ' : '' }}{{ $testimonial->client_institution }}
                        </p>
                    </div>
                    <div class="ml-auto flex items-center gap-0.5">
                        @for($i = 1; $i <= 5; $i++)
                            <i class="fa-solid fa-star text-sm {{ $i <= $testimonial->rating ? 'text-amber-400' : 'text-slate-200' }}"></i>
                        @endfor
                    </div>
                </div>

                <div class="quote-card bg-brand-cream/50 border border-slate-100 px-5 py-4">
                    <p class="text-sm text-slate-600 leading-relaxed">{{ $testimonial->testimoni }}</p>
                </div>

                {{-- Dropdown Status --}}
                <div>
                    <label class="text-sm font-medium text-brand-dark mb-2 block">Status Testimoni <span class="text-red-500">*</span></label>
                    <div class="dropdown-wrap" @click.outside="statusOpen = false">
                        <input type="hidden" name="status" :value="status">
                        <button type="button" @click="statusOpen = !statusOpen"
                                class="dropdown-trigger flex items-center gap-3 px-4 py-3" :class="statusOpen && 'is-open'">
                            <i class="fa-solid dropdown-icon text-sm" :class="statusIcon()"></i>
                            <span class="flex-1 text-sm text-brand-dark truncate" x-text="statusLabel()"></span>
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
                                <button type="button" @click="status = 'pending'; statusOpen = false"
                                        class="dropdown-option flex items-center justify-between gap-2 px-3 py-2.5 text-sm" :class="status === 'pending' ? 'is-selected' : ''">
                                    <span class="flex items-center gap-2"><i class="fa-solid fa-clock text-amber-500 text-xs"></i> Pending</span>
                                    <i class="fa-solid fa-check dropdown-check text-xs" x-show="status === 'pending'"></i>
                                </button>
                                <button type="button" @click="status = 'approved'; statusOpen = false"
                                        class="dropdown-option flex items-center justify-between gap-2 px-3 py-2.5 text-sm" :class="status === 'approved' ? 'is-selected' : ''">
                                    <span class="flex items-center gap-2"><i class="fa-solid fa-check text-emerald-500 text-xs"></i> Approved</span>
                                    <i class="fa-solid fa-check dropdown-check text-xs" x-show="status === 'approved'"></i>
                                </button>
                                <button type="button" @click="status = 'rejected'; statusOpen = false"
                                        class="dropdown-option flex items-center justify-between gap-2 px-3 py-2.5 text-sm" :class="status === 'rejected' ? 'is-selected' : ''">
                                    <span class="flex items-center gap-2"><i class="fa-solid fa-xmark text-red-500 text-xs"></i> Rejected</span>
                                    <i class="fa-solid fa-check dropdown-check text-xs" x-show="status === 'rejected'"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    @error('status') <p class="text-xs text-red-500 mt-1.5">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="reveal card-hover flex justify-end gap-3 bg-white rounded-2xl shadow-sm border border-slate-100 px-8 py-6" style="transition-delay:.1s">
                <a href="{{ route('admin.testimonials.index') }}" class="btn-ghost px-5 py-2.5 text-sm font-medium text-slate-500">Batal</a>
                <button type="submit" class="btn-fill px-6 py-2.5 rounded-lg text-sm font-semibold text-white bg-brand-mint">
                    <span class="fill-layer bg-brand-teal"></span>
                    <span class="btn-label"><i class="fa-solid fa-floppy-disk mr-2"></i>Simpan Status</span>
                </button>
            </div>
        </form>
    </div>

    <script>
        function editStatusForm() {
            return {
                status: '{{ old('status', $testimonial->status) }}',
                statusOpen: false,
                statusLabel() {
                    const map = { pending: 'Pending', approved: 'Approved', rejected: 'Rejected' };
                    return map[this.status] || 'Pilih status';
                },
                statusIcon() {
                    const map = { pending: 'fa-clock text-amber-500', approved: 'fa-check text-emerald-500', rejected: 'fa-xmark text-red-500' };
                    return map[this.status] || 'fa-circle-question';
                },
            };
        }
        document.addEventListener('DOMContentLoaded', () => {
            const revealObserver = new IntersectionObserver((entries) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting) { entry.target.classList.add('is-visible'); revealObserver.unobserve(entry.target); }
                });
            }, { threshold: 0.1, rootMargin: '0px 0px -30px 0px' });
            document.querySelectorAll('.reveal').forEach((el) => revealObserver.observe(el));
        });
    </script>
</x-app-layout>