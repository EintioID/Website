{{-- resources/views/admin/testimonials/show.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <div>
            <p class="text-xs text-slate-400 mb-1.5">Beranda / Testimoni / Detail</p>
            <h2 class="text-xl font-bold text-brand-dark tracking-tight">Detail Testimoni</h2>
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
        $sc = $statusColors[$testimonial->status] ?? $statusColors['pending'];
        $avatarPalette = ['bg-teal-500', 'bg-blue-500', 'bg-purple-500', 'bg-amber-500', 'bg-rose-500', 'bg-indigo-500'];
        $avColor = $avatarPalette[crc32($testimonial->client_name) % count($avatarPalette)];
        $initial = strtoupper(substr($testimonial->client_name, 0, 1));
    @endphp

    <div class="space-y-6 max-w-3xl">
        <div class="reveal card-hover flex items-center justify-between bg-white rounded-2xl shadow-sm border border-slate-100 px-8 py-7">
            <div>
                <h3 class="text-lg font-bold text-brand-dark">Detail Testimoni</h3>
                <p class="text-sm text-slate-400 mt-1.5">Informasi lengkap testimoni yang masuk.</p>
            </div>
            <a href="{{ route('admin.testimonials.index') }}"
               class="modal-close-btn h-9 w-9 rounded-full flex items-center justify-center text-slate-400 border border-slate-100">
                <i class="fa-solid fa-xmark"></i>
            </a>
        </div>

        <div class="reveal card-hover bg-white rounded-2xl shadow-sm border border-slate-100 p-8" style="transition-delay:.05s">
            <div class="flex items-start justify-between gap-4 flex-wrap">
                <div class="flex items-center gap-4">
                    <div class="avatar-circle h-14 w-14 rounded-full {{ $avColor }} flex items-center justify-center text-white text-xl font-semibold">
                        {{ $initial }}
                    </div>
                    <div>
                        <p class="font-bold text-brand-dark text-lg">{{ $testimonial->client_name }}</p>
                        <p class="text-sm text-slate-400 mt-0.5">
                            {{ $testimonial->client_position }}{{ $testimonial->client_position && $testimonial->client_institution ? ', ' : '' }}{{ $testimonial->client_institution }}
                        </p>
                    </div>
                </div>
                <span class="badge inline-flex items-center px-3 py-1.5 rounded-full text-xs font-semibold {{ $sc['bg'] }} {{ $sc['text'] }}">
                    <i class="fa-solid {{ $sc['icon'] }} text-xs mr-1.5"></i> {{ $sc['label'] }}
                </span>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-7">
                <div class="side-card-mini border border-slate-100 rounded-xl px-4 py-3.5">
                    <p class="text-[11px] text-slate-400 uppercase tracking-wide mb-1.5">Rating</p>
                    <div class="flex items-center gap-1">
                        @for($i = 1; $i <= 5; $i++)
                            <i class="fa-solid fa-star text-sm {{ $i <= $testimonial->rating ? 'text-amber-400' : 'text-slate-200' }}"></i>
                        @endfor
                        <span class="text-xs text-slate-400 ml-1">({{ $testimonial->rating }}/5)</span>
                    </div>
                </div>
                <div class="side-card-mini border border-slate-100 rounded-xl px-4 py-3.5">
                    <p class="text-[11px] text-slate-400 uppercase tracking-wide mb-1.5">Kategori Layanan</p>
                    @if($testimonial->category)
                        <span class="badge inline-flex px-3 py-1 rounded-full text-xs font-medium bg-blue-50 text-blue-600">{{ $testimonial->category }}</span>
                    @else
                        <span class="text-xs text-slate-300 italic">Tidak ada kategori</span>
                    @endif
                </div>
                <div class="side-card-mini border border-slate-100 rounded-xl px-4 py-3.5 sm:col-span-2">
                    <p class="text-[11px] text-slate-400 uppercase tracking-wide mb-1.5">Tanggal Masuk</p>
                    <p class="text-sm text-brand-dark font-medium">
                        <i class="fa-regular fa-calendar text-slate-400 mr-1.5"></i>
                        {{ $testimonial->submitted_at?->translatedFormat('d F Y, H:i') ?? '-' }} WIB
                    </p>
                </div>
            </div>

            <div class="mt-7">
                <p class="text-[11px] text-slate-400 uppercase tracking-wide mb-2.5">Isi Testimoni</p>
                <div class="quote-card bg-brand-cream/50 border border-slate-100 px-6 py-5">
                    <i class="fa-solid fa-quote-left text-brand-mint/30 text-2xl absolute top-4 left-4"></i>
                    <p class="text-sm text-slate-600 leading-relaxed relative z-10 pl-6">{{ $testimonial->testimoni }}</p>
                </div>
            </div>
        </div>

        <div class="reveal card-hover flex justify-end gap-3 bg-white rounded-2xl shadow-sm border border-slate-100 px-8 py-6" style="transition-delay:.1s">
            <a href="{{ route('admin.testimonials.index') }}" class="btn-ghost px-5 py-2.5 text-sm font-medium text-slate-500">Kembali</a>
            <a href="{{ route('admin.testimonials.edit', $testimonial) }}" class="btn-fill px-6 py-2.5 rounded-lg text-sm font-semibold text-white bg-brand-mint">
                <span class="fill-layer bg-brand-teal"></span>
                <span class="btn-label"><i class="fa-solid fa-pen mr-2"></i>Ubah Status</span>
            </a>
        </div>
    </div>

    <script>
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