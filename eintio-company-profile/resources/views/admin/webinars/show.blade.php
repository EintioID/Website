{{-- resources/views/admin/webinars/show.blade.php --}}
<x-app-layout>
    <x-slot name="header">
    <div>
        <p class="text-xs text-slate-400 mb-1.5">Beranda / Blog & Artikel / Webinar / Tambah</p>
        <h2 class="text-xl font-bold text-brand-dark tracking-tight">Tambah Webinar</h2>
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

    <div class="min-h-screen">
    <div class="fixed inset-0 bg-gradient-to-br from-brand-mint/5 to-brand-teal/5 -z-10"></div>

    <div class="max-w-3xl mx-auto">
        <div class="reveal-modal group relative overflow-hidden rounded-2xl bg-white shadow-lg border border-slate-100 transition-shadow duration-300 hover:shadow-2xl">

            {{-- Thumbnail dipendekin dari h-64 -> h-44 --}}
            <div class="relative h-44 overflow-hidden">
                @if($webinar->thumbnail)
                    <img src="{{ Storage::url($webinar->thumbnail) }}" class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-105" alt="{{ $webinar->title }}">
                @else
                    <div class="h-full w-full flex items-center justify-center bg-gradient-to-br from-brand-mint/20 to-brand-teal/20">
                        <i class="fa-solid fa-video text-slate-300 text-4xl"></i>
                    </div>
                @endif
                <div class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent"></div>
            </div>

            <div class="px-6 py-6">
                {{-- Header --}}
                <div class="flex items-start justify-between gap-4 mb-5 flex-wrap">
                    <div class="flex-1">
                        <span class="inline-block px-3 py-1 mb-2 rounded-full text-xs font-bold text-white"
                              :class="{
                                  'bg-blue-500': '{{ $webinar->status }}' === 'draft',
                                  'bg-yellow-500': '{{ $webinar->status }}' === 'scheduled',
                                  'bg-green-500': '{{ $webinar->status }}' === 'published'
                              }">
                            {{ $webinar->status }}
                        </span>
                        <h1 class="font-bold text-xl text-brand-dark mb-1">{{ $webinar->title }}</h1>
                        <p class="text-sm text-slate-500">{{ $webinar->short_description }}</p>
                    </div>
                    <div class="flex items-center gap-2">
                        <a href="{{ route('admin.webinars.index') }}"
                           class="px-4 py-2 rounded-lg text-sm font-medium text-slate-600 border border-slate-200 transition-colors duration-200 hover:bg-slate-50 hover:border-slate-300">
                            Kembali
                        </a>
                        <a href="{{ route('admin.webinars.edit', $webinar) }}"
                           class="relative inline-flex items-center px-4 py-2 rounded-lg text-sm font-semibold text-white bg-brand-mint transition-colors duration-200 hover:bg-brand-teal">
                            <i class="fa-solid fa-pen mr-2 text-xs"></i>Edit
                        </a>
                    </div>
                </div>

                {{-- Info grid: padding dikecilin p-4 -> p-3 --}}
                <div class="grid grid-cols-1 md:grid-cols-3 gap-3 py-5 border-y border-slate-100">
                    <div class="p-3 rounded-xl bg-gradient-to-br from-brand-mint/5 to-transparent border border-brand-mint/20 transition-all duration-200 hover:border-brand-mint/50 hover:-translate-y-0.5">
                        <div class="flex items-center gap-2 mb-1.5">
                            <div class="p-1.5 rounded-lg bg-brand-mint/10">
                                <i class="fa-regular fa-calendar text-brand-mint text-sm"></i>
                            </div>
                            <p class="text-xs text-slate-400 font-semibold uppercase">Tanggal & Waktu</p>
                        </div>
                        <p class="text-sm font-semibold text-brand-dark">
                            {{ $webinar->webinar_date?->translatedFormat('d M Y') ?? '-' }}
                            @if($webinar->webinar_time)
                                <span class="text-xs text-slate-500 font-normal"> · {{ $webinar->webinar_time }} WIB</span>
                            @endif
                        </p>
                    </div>

                    <div class="p-3 rounded-xl bg-gradient-to-br from-blue-50 to-transparent border border-blue-200 transition-all duration-200 hover:border-blue-400 hover:-translate-y-0.5">
                        <div class="flex items-center gap-2 mb-1.5">
                            <div class="p-1.5 rounded-lg bg-blue-100">
                                <i class="fa-regular fa-clock text-blue-600 text-sm"></i>
                            </div>
                            <p class="text-xs text-slate-400 font-semibold uppercase">Durasi</p>
                        </div>
                        <p class="text-sm font-semibold text-brand-dark">{{ $webinar->duration ?? '-' }}</p>
                    </div>

                    <div class="p-3 rounded-xl bg-gradient-to-br from-purple-50 to-transparent border border-purple-200 transition-all duration-200 hover:border-purple-400 hover:-translate-y-0.5">
                        <div class="flex items-center gap-2 mb-1.5">
                            <div class="p-1.5 rounded-lg bg-purple-100">
                                <i class="fa-solid fa-users text-purple-600 text-sm"></i>
                            </div>
                            <p class="text-xs text-slate-400 font-semibold uppercase">Peserta</p>
                        </div>
                        <p class="text-sm font-semibold text-brand-dark">
                            {{ $webinar->participants_count }} / {{ $webinar->quota ?? '∞' }}
                        </p>
                    </div>
                </div>

                {{-- Content: gap dikecilin 8 -> 6, deskripsi + detail --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                    <div>
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">Deskripsi Lengkap</p>
                        <p class="text-sm text-slate-600 leading-relaxed whitespace-pre-line">{{ $webinar->description ?? '-' }}</p>
                    </div>

                    <div class="space-y-3">
                        <div class="p-3 rounded-xl border border-slate-100 transition-all duration-200 hover:border-brand-mint/50 hover:bg-brand-cream/40">
                            <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1.5">Platform</p>
                            <p class="text-sm font-semibold text-brand-dark mb-1">{{ $webinar->platform }}</p>
                            @if($webinar->link)
                                <a href="{{ $webinar->link }}" target="_blank" class="inline-flex items-center gap-1.5 text-sm text-brand-mint hover:text-brand-teal transition-colors duration-200 break-all">
                                    <i class="fa-solid fa-link text-xs"></i> Buka Link
                                </a>
                            @endif
                        </div>

                        @if($webinar->category)
                            <div class="p-3 rounded-xl border border-slate-100 transition-all duration-200 hover:border-brand-mint/50 hover:bg-brand-cream/40">
                                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1.5">Kategori</p>
                                <span class="inline-block bg-brand-mint/10 text-brand-mint text-xs font-semibold px-3 py-1 rounded-full">
                                    {{ $webinar->category }}
                                </span>
                            </div>
                        @endif

                        @if($webinar->tags)
                            <div class="p-3 rounded-xl border border-slate-100 transition-all duration-200 hover:border-brand-mint/50 hover:bg-brand-cream/40">
                                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">Tag</p>
                                <div class="flex flex-wrap gap-1.5">
                                    @foreach (explode(',', $webinar->tags) as $tag)
                                        <span class="inline-block bg-slate-100 text-slate-600 text-xs font-medium px-2.5 py-1 rounded-full transition-colors duration-200 hover:bg-slate-200">
                                            {{ trim($tag) }}
                                        </span>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Tombol peserta --}}
                <div class="flex justify-end mt-6 pt-5 border-t border-slate-100">
                    <a href="{{ route('admin.webinars.participants.index', $webinar) }}"
                       class="inline-flex items-center gap-2 px-5 py-2.5 rounded-lg text-sm font-semibold text-white bg-brand-mint transition-all duration-300 hover:bg-brand-teal hover:shadow-lg hover:-translate-y-1">
                        <i class="fa-solid fa-user-group text-xs"></i>
                        Lihat Peserta
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
</x-app-layout>