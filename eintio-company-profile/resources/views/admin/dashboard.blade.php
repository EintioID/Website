<x-app-layout>
    <x-slot name="header">
        <div>
            <p class="text-xs text-slate-400 mb-1">Beranda / Dashboard</p>
            <h2 class="text-xl font-bold text-brand-dark tracking-tight">Dashboard</h2>
        </div>

        <div class="flex items-center gap-5">
            <button class="relative p-2 rounded-full hover:bg-brand-beige/50 transition-all duration-300 ease-smooth group">
                <i class="fa-solid fa-bell text-slate-500 text-lg transition-transform duration-300 ease-smooth group-hover:animate-wiggle"></i>
                <span class="absolute top-1.5 right-1.5 h-2 w-2 rounded-full bg-red-500 group-hover:animate-ping"></span>
                <span class="absolute top-1.5 right-1.5 h-2 w-2 rounded-full bg-red-500"></span>
            </button>

            <div x-data="{ open: false }" class="relative">
                <button @click="open = !open" @click.outside="open = false"
                        class="flex items-center gap-3 pl-4 border-l border-slate-200 group focus:outline-none">
                    @if (!empty(Auth::user()->photo))
                        <img src="{{ Storage::url(Auth::user()->photo) }}"
                             alt="{{ Auth::user()->name }}"
                             class="h-9 w-9 rounded-full object-cover
                                    ring-2 ring-transparent transition-all duration-300 ease-smooth group-hover:ring-brand-mint group-hover:ring-offset-2"
                             :class="open && 'ring-brand-mint ring-offset-2'">
                    @else
                        <div class="h-9 w-9 rounded-full bg-brand-mint flex items-center justify-center text-white text-sm font-semibold
                                    ring-2 ring-transparent transition-all duration-300 ease-smooth group-hover:ring-brand-mint group-hover:ring-offset-2"
                             :class="open && 'ring-brand-mint ring-offset-2'">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </div>
                    @endif
                    <div class="text-sm hidden sm:block text-left">
                        <p class="font-medium text-brand-dark leading-none">{{ Auth::user()->name }}</p>
                        <p class="text-slate-400 text-xs mt-1">{{ ucfirst(Auth::user()->role ?? 'Admin') }}</p>
                    </div>
                    <i class="fa-solid fa-chevron-down text-xs text-slate-400 transition-transform duration-300 ease-smooth"
                       :class="open && 'rotate-180'"></i>
                </button>

                <div x-show="open"
                     x-transition:enter="transition ease-smooth duration-200"
                     x-transition:enter-start="opacity-0 scale-95 -translate-y-2"
                     x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                     x-transition:leave="transition ease-smooth duration-150"
                     x-transition:leave-start="opacity-100 scale-100"
                     x-transition:leave-end="opacity-0 scale-95"
                     class="absolute right-0 mt-3 w-56 bg-white rounded-xl shadow-xl border border-slate-100 overflow-hidden z-30"
                     style="display: none;">

                    <div class="px-4 py-3 bg-brand-cream border-b border-slate-100">
                        <p class="text-sm font-semibold text-brand-dark">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-slate-400 truncate">{{ Auth::user()->email }}</p>
                    </div>

                    <div class="py-1">
                        <a href="{{ route('admin.account.index') }}"
                           class="group/item relative flex items-center gap-3 px-4 py-2.5 text-sm text-slate-600 overflow-hidden
                                  transition-colors duration-200 ease-smooth hover:text-brand-dark">
                            <span class="absolute left-0 top-0 h-full w-0 bg-brand-mint transition-all duration-200 ease-smooth group-hover/item:w-1"></span>
                            <i class="fa-solid fa-user w-4 text-slate-400 transition-transform duration-200 ease-smooth group-hover/item:translate-x-0.5 group-hover/item:text-brand-mint"></i>
                            Profil Saya
                        </a>
                        <a href="{{ route('admin.profile.edit') }}"
                           class="group/item relative flex items-center gap-3 px-4 py-2.5 text-sm text-slate-600 overflow-hidden
                                  transition-colors duration-200 ease-smooth hover:text-brand-dark">
                            <span class="absolute left-0 top-0 h-full w-0 bg-brand-mint transition-all duration-200 ease-smooth group-hover/item:w-1"></span>
                            <i class="fa-solid fa-gear w-4 text-slate-400 transition-transform duration-200 ease-smooth group-hover/item:translate-x-0.5 group-hover/item:text-brand-mint"></i>
                            Pengaturan
                        </a>
                    </div>

                    <div class="border-t border-slate-100 py-1">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                    class="group/item relative w-full flex items-center gap-3 px-4 py-2.5 text-sm text-slate-600 overflow-hidden
                                           transition-colors duration-200 ease-smooth hover:text-red-500">
                                <span class="absolute left-0 top-0 h-full w-0 bg-red-500 transition-all duration-200 ease-smooth group-hover/item:w-1"></span>
                                <i class="fa-solid fa-arrow-right-from-bracket w-4 text-slate-400 transition-transform duration-200 ease-smooth group-hover/item:translate-x-0.5 group-hover/item:text-red-500"></i>
                                Log Out
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>

    <style>
        .reveal {
            opacity: 0;
            transform: translateY(24px);
            transition: opacity 0.6s cubic-bezier(0.22,1,0.36,1), transform 0.6s cubic-bezier(0.22,1,0.36,1);
        }
        .reveal.reveal-show {
            opacity: 1;
            transform: translateY(0);
        }
    </style>

    <div class="space-y-6">

        {{-- ===== STATISTIC CARDS ===== --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">

            <div x-data="{ rx:0, ry:0 }"
                 @mousemove="let r=$el.getBoundingClientRect(); rx=((event.clientY-r.top)/r.height-0.5)*-8; ry=((event.clientX-r.left)/r.width-0.5)*8"
                 @mouseleave="rx=0;ry=0"
                 :style="`transform: perspective(600px) rotateX(${rx}deg) rotateY(${ry}deg); transition: transform .25s cubic-bezier(0.22,1,0.36,1);`"
                 class="reveal bg-white rounded-xl p-5 shadow-sm border border-slate-100 transition-shadow duration-300 ease-smooth
                        hover:shadow-xl hover:shadow-brand-mint/10 will-change-transform transform-gpu">
                <div class="h-10 w-10 rounded-lg bg-brand-mint/10 flex items-center justify-center transition-transform duration-300 ease-smooth hover:rotate-12 hover:scale-110">
                    <i class="fa-solid fa-briefcase text-brand-mint"></i>
                </div>
                <p class="text-sm text-slate-400 mt-3">Total Layanan</p>
                <p class="text-2xl font-bold text-brand-dark">{{ $stats['services'] }}</p>
            </div>

            <div x-data="{ rx:0, ry:0 }"
                 @mousemove="let r=$el.getBoundingClientRect(); rx=((event.clientY-r.top)/r.height-0.5)*-8; ry=((event.clientX-r.left)/r.width-0.5)*8"
                 @mouseleave="rx=0;ry=0"
                 :style="`transform: perspective(600px) rotateX(${rx}deg) rotateY(${ry}deg); transition: transform .25s cubic-bezier(0.22,1,0.36,1);`"
                 class="reveal bg-white rounded-xl p-5 shadow-sm border border-slate-100 transition-shadow duration-300 ease-smooth
                        hover:shadow-xl hover:shadow-brand-gold/10 will-change-transform transform-gpu">
                <div class="h-10 w-10 rounded-lg bg-brand-gold/10 flex items-center justify-center transition-transform duration-300 ease-smooth hover:rotate-12 hover:scale-110">
                    <i class="fa-solid fa-folder-open text-brand-gold"></i>
                </div>
                <p class="text-sm text-slate-400 mt-3">Total Portofolio</p>
                <p class="text-2xl font-bold text-brand-dark">{{ $stats['portfolios'] }}</p>
            </div>

            <div x-data="{ rx:0, ry:0 }"
                 @mousemove="let r=$el.getBoundingClientRect(); rx=((event.clientY-r.top)/r.height-0.5)*-8; ry=((event.clientX-r.left)/r.width-0.5)*8"
                 @mouseleave="rx=0;ry=0"
                 :style="`transform: perspective(600px) rotateX(${rx}deg) rotateY(${ry}deg); transition: transform .25s cubic-bezier(0.22,1,0.36,1);`"
                 class="reveal bg-white rounded-xl p-5 shadow-sm border border-slate-100 transition-shadow duration-300 ease-smooth
                        hover:shadow-xl hover:shadow-brand-slate/10 will-change-transform transform-gpu">
                <div class="h-10 w-10 rounded-lg bg-brand-slate/10 flex items-center justify-center transition-transform duration-300 ease-smooth hover:rotate-12 hover:scale-110">
                    <i class="fa-solid fa-file-lines text-brand-slate"></i>
                </div>
                <p class="text-sm text-slate-400 mt-3">Total Artikel</p>
                <p class="text-2xl font-bold text-brand-dark">{{ $stats['blog_posts'] }}</p>
            </div>

            <div x-data="{ rx:0, ry:0 }"
                 @mousemove="let r=$el.getBoundingClientRect(); rx=((event.clientY-r.top)/r.height-0.5)*-8; ry=((event.clientX-r.left)/r.width-0.5)*8"
                 @mouseleave="rx=0;ry=0"
                 :style="`transform: perspective(600px) rotateX(${rx}deg) rotateY(${ry}deg); transition: transform .25s cubic-bezier(0.22,1,0.36,1);`"
                 class="reveal bg-white rounded-xl p-5 shadow-sm border border-slate-100 transition-shadow duration-300 ease-smooth
                        hover:shadow-xl hover:shadow-brand-teal/10 will-change-transform transform-gpu">
                <div class="h-10 w-10 rounded-lg bg-brand-teal/10 flex items-center justify-center transition-transform duration-300 ease-smooth hover:rotate-12 hover:scale-110">
                    <i class="fa-solid fa-comment-dots text-brand-teal"></i>
                </div>
                <p class="text-sm text-slate-400 mt-3">Total Testimoni</p>
                <p class="text-2xl font-bold text-brand-dark">{{ $stats['testimonials'] }}</p>
            </div>
        </div>

        {{-- ===== CHARTS ===== --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-5">

            <div class="reveal bg-white rounded-xl p-5 shadow-sm border border-slate-100 transition-shadow duration-300 ease-smooth hover:shadow-md">
                <div class="flex items-center justify-between mb-4">
                    <p class="font-semibold text-brand-dark text-sm">Pesan Masuk per Bulan</p>
                    <x-year-dropdown />
                </div>
                <div class="relative">
                    <canvas id="chartPesan" height="130"></canvas>
                    @if(empty(array_filter($chartPesan ?? [])))
                        <div class="absolute inset-0 flex flex-col items-center justify-center bg-white/70 backdrop-blur-[1px]">
                            <i class="fa-solid fa-chart-line text-slate-200 text-3xl mb-2"></i>
                            <p class="text-xs text-slate-400">Belum ada data pesan masuk</p>
                        </div>
                    @endif
                </div>
            </div>

            <div class="reveal bg-white rounded-xl p-5 shadow-sm border border-slate-100 transition-shadow duration-300 ease-smooth hover:shadow-md">
                <div class="flex items-center justify-between mb-4">
                    <p class="font-semibold text-brand-dark text-sm">Artikel Published per Bulan</p>
                    <x-year-dropdown />
                </div>
                <div class="relative">
                    <canvas id="chartArtikel" height="130"></canvas>
                    @if(empty(array_filter($chartArtikel ?? [])))
                        <div class="absolute inset-0 flex flex-col items-center justify-center bg-white/70 backdrop-blur-[1px]">
                            <i class="fa-solid fa-chart-bar text-slate-200 text-3xl mb-2"></i>
                            <p class="text-xs text-slate-400">Belum ada data artikel</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- ===== AKTIVITAS & NOTIFIKASI ===== --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-5">

            <div class="reveal bg-white rounded-xl p-5 shadow-sm border border-slate-100 transition-shadow duration-300 ease-smooth hover:shadow-md">
                <p class="font-semibold text-brand-dark text-sm mb-3">Aktivitas Terbaru</p>
                <div class="divide-y divide-slate-100">
                    @forelse ($activities as $a)
                        <div class="group flex items-start gap-3 py-3 rounded-lg transition-all duration-300 ease-smooth hover:bg-brand-cream hover:pl-3 relative overflow-hidden">
                            <span class="absolute left-0 top-0 h-full w-0 bg-brand-mint transition-all duration-300 ease-smooth group-hover:w-1"></span>
                            <span class="h-8 w-8 flex items-center justify-center rounded-full bg-brand-mint/10 text-brand-mint transition-transform duration-300 ease-smooth group-hover:scale-110 group-hover:rotate-6">
                                <i class="fa-solid fa-star text-xs"></i>
                            </span>
                            <div>
                                <p class="text-sm text-slate-700">{{ $a['text'] }}</p>
                                <p class="text-xs text-slate-400">{{ $a['time'] }}</p>
                            </div>
                        </div>
                    @empty
                        <div class="flex flex-col items-center justify-center py-10 text-center">
                            <div class="h-12 w-12 rounded-full bg-brand-cream flex items-center justify-center mb-3">
                                <i class="fa-solid fa-clock-rotate-left text-slate-300"></i>
                            </div>
                            <p class="text-sm text-slate-400">Belum ada aktivitas terbaru</p>
                            <p class="text-xs text-slate-300 mt-1">Aktivitas akan muncul otomatis dari modul lain</p>
                        </div>
                    @endforelse
                </div>
                @if($activities->isNotEmpty())
                    <a href="#" class="text-xs font-medium text-brand-mint hover:underline mt-2 inline-block transition-all duration-200 ease-smooth">Lihat Semua Aktivitas →</a>
                @endif
            </div>

            <div class="reveal bg-white rounded-xl p-5 shadow-sm border border-slate-100 transition-shadow duration-300 ease-smooth hover:shadow-md">
                <p class="font-semibold text-brand-dark text-sm mb-3">Notifikasi Penting</p>
                <div class="space-y-3">
                    @forelse ($notifications as $n)
                        <div class="flex items-center gap-3 p-3 rounded-lg border-l-4 border-brand-gold bg-brand-gold/5 transition-all duration-300 ease-smooth hover:bg-brand-gold/10">
                            <span class="h-8 w-8 flex items-center justify-center rounded-full bg-brand-gold/15 text-brand-gold shrink-0">
                                <i class="fa-solid fa-star text-xs"></i>
                            </span>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-brand-dark truncate">{{ $n['title'] }}</p>
                                <p class="text-xs text-slate-400">{{ $n['desc'] }}</p>
                            </div>
                            <button class="relative overflow-hidden shrink-0 px-3 py-1.5 rounded-lg border border-brand-gold text-brand-gold font-medium text-xs group">
                                <span class="absolute inset-0 bg-brand-gold scale-x-0 origin-center transition-transform duration-300 ease-smooth group-hover:scale-x-100"></span>
                                <span class="relative z-10 flex items-center gap-1 group-hover:text-white transition-colors duration-300 ease-smooth">
                                    {{ $n['btn'] }}
                                    <i class="fa-solid fa-arrow-right text-[10px] -translate-x-1 opacity-0 transition-all duration-300 ease-smooth group-hover:translate-x-0 group-hover:opacity-100"></i>
                                </span>
                            </button>
                        </div>
                    @empty
                        <div class="flex flex-col items-center justify-center py-10 text-center">
                            <div class="h-12 w-12 rounded-full bg-brand-cream flex items-center justify-center mb-3">
                                <i class="fa-solid fa-bell-slash text-slate-300"></i>
                            </div>
                            <p class="text-sm text-slate-400">Tidak ada notifikasi penting</p>
                        </div>
                    @endforelse
                </div>
                @if($notifications->isNotEmpty())
                    <a href="#" class="text-xs font-medium text-brand-mint hover:underline mt-3 inline-block transition-all duration-200 ease-smooth">Lihat Semua Notifikasi →</a>
                @endif
            </div>
        </div>

        {{-- ===== QUICK ACTIONS ===== --}}
        <div class="reveal bg-white rounded-xl p-5 shadow-sm border border-slate-100 transition-shadow duration-300 ease-smooth hover:shadow-md">
            <p class="font-semibold text-brand-dark text-sm mb-4">Shortcut / Quick Actions</p>
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-4">
                @php
                    $shortcuts = [
                        ['icon' => 'fa-plus', 'title' => 'Tambah Layanan', 'desc' => 'Buat layanan baru', 'route' => 'admin.services.create'],
                        ['icon' => 'fa-folder-plus', 'title' => 'Tambah Portofolio', 'desc' => 'Tambah proyek baru', 'route' => 'admin.portfolios.create'],
                        ['icon' => 'fa-pen-nib', 'title' => 'Tulis Artikel', 'desc' => 'Buat artikel baru', 'route' => 'admin.blog-posts.create'],
                        ['icon' => 'fa-comment-dots', 'title' => 'Kelola Testimoni', 'desc' => 'Review & kelola', 'route' => 'admin.testimonials.index'],
                        ['icon' => 'fa-cloud-arrow-up', 'title' => 'Upload Media', 'desc' => 'Unggah file baru', 'route' => 'admin.profile.edit'],
                    ];
                @endphp
                @foreach ($shortcuts as $s)
                    <a href="{{ route($s['route']) }}"
                       x-data="{ x:0, y:0 }"
                       @mousemove="let r=$el.getBoundingClientRect(); x=event.clientX-r.left; y=event.clientY-r.top"
                       class="relative overflow-hidden bg-white rounded-xl p-4 border border-slate-100 cursor-pointer
                              transition-all duration-300 ease-smooth hover:border-brand-mint/40 hover:-translate-y-1 hover:shadow-lg group transform-gpu">
                        <div :style="`background: radial-gradient(150px circle at ${x}px ${y}px, rgba(20,184,166,0.12), transparent 70%)`"
                             class="absolute inset-0 opacity-0 group-hover:opacity-100 transition-opacity duration-300 ease-smooth pointer-events-none"></div>

                        <div class="relative z-10 flex flex-col items-center text-center gap-2">
                            <div class="h-10 w-10 rounded-lg bg-brand-mint/10 flex items-center justify-center
                                        transition-transform duration-300 ease-smooth group-hover:-translate-y-1 group-hover:rotate-6">
                                <i class="fa-solid {{ $s['icon'] }} text-brand-mint"></i>
                            </div>
                            <p class="text-sm font-medium text-brand-dark">{{ $s['title'] }}</p>
                            <p class="text-xs text-slate-400">{{ $s['desc'] }}</p>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const pesanData = @json($chartPesan ?? array_fill(0, 12, 0));
            const artikelData = @json($chartArtikel ?? array_fill(0, 12, 0));
            const labels = ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'];

            new Chart(document.getElementById('chartPesan'), {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        data: pesanData,
                        borderColor: '#14B8A6',
                        backgroundColor: 'rgba(20,184,166,0.1)',
                        tension: 0.4,
                        fill: true,
                        pointBackgroundColor: '#14B8A6',
                    }]
                },
                options: {
                    plugins: { legend: { display: false } },
                    scales: { y: { beginAtZero: true, suggestedMax: 10 } }
                }
            });

            new Chart(document.getElementById('chartArtikel'), {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        data: artikelData,
                        backgroundColor: '#41526D',
                        borderRadius: 6,
                    }]
                },
                options: {
                    plugins: { legend: { display: false } },
                    scales: { y: { beginAtZero: true, suggestedMax: 10 } }
                }
            });

            // ===== Scroll reveal animation =====
            const revealEls = document.querySelectorAll('.reveal');

            const observer = new IntersectionObserver((entries) => {
                entries.forEach((entry, index) => {
                    if (entry.isIntersecting) {
                        setTimeout(() => {
                            entry.target.classList.add('reveal-show');
                        }, index * 80);
                        observer.unobserve(entry.target);
                    }
                });
            }, {
                threshold: 0.15,
                rootMargin: '0px 0px -50px 0px'
            });

            revealEls.forEach(el => observer.observe(el));
        });
    </script>
</x-app-layout>