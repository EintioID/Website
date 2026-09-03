<aside x-data="{ open: false }" class="w-64 bg-gradient-to-b from-brand-navy to-brand-dark flex flex-col justify-between shrink-0 hidden sm:flex">
    <div>
        <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-5 py-6 border-b border-white/10">
            <div class="h-9 w-9 rounded-lg bg-white flex items-center justify-center overflow-hidden">
                <x-application-logo class="h-6 w-6 object-contain" />
            </div>
            <div>
                <p class="text-white font-semibold text-sm leading-none">PT. Eintio</p>
                <p class="text-brand-beige/60 text-[11px] mt-1">Academic & Technology</p>
            </div>
        </a>

        <nav class="px-3 py-4 space-y-1" x-data="{ blogOpen: {{ request()->routeIs('admin.blog-posts.*') || request()->routeIs('admin.webinars.*') ? 'true' : 'false' }} }">
            @php
                $menus = [
                    ['label' => 'Dashboard', 'icon' => 'fa-gauge', 'route' => 'dashboard'],
                    ['label' => 'Profil Perusahaan', 'icon' => 'fa-building', 'route' => 'admin.profile.index'],
                    ['label' => 'Layanan', 'icon' => 'fa-briefcase', 'route' => 'admin.services.index'],
                    ['label' => 'Portofolio', 'icon' => 'fa-folder-open', 'route' => 'admin.portfolios.index'],
                    ['label' => 'Tim', 'icon' => 'fa-users', 'route' => 'admin.teams.index'],
                    [
                        'label' => 'Blog / Artikel',
                        'icon' => 'fa-file-lines',
                        'children' => [
                            ['label' => 'Artikel', 'icon' => 'fa-newspaper', 'route' => 'admin.blog-posts.index'],
                            ['label' => 'Webinar', 'icon' => 'fa-video', 'route' => 'admin.webinars.index'],
                        ],
                    ],
                    ['label' => 'Testimoni', 'icon' => 'fa-comment-dots', 'route' => 'admin.testimonials.index'],
                    ['label' => 'Pengaturan', 'icon' => 'fa-gear', 'route' => 'admin.settings.index'],
                ];
            @endphp

            @foreach ($menus as $menu)
                @if (isset($menu['children']))
                    @php
                        $childActive = collect($menu['children'])->contains(fn ($c) => request()->routeIs($c['route'].'*'));
                    @endphp

                    <div>
                        <button type="button" @click="blogOpen = !blogOpen"
                                class="group relative w-full flex items-center gap-3 px-4 py-3 rounded-lg overflow-hidden
                                       transition-all duration-300 ease-smooth hover:tracking-wide
                                       {{ $childActive ? 'text-white bg-white/10' : 'text-brand-beige/70 hover:text-white' }}">

                            <span class="absolute left-0 top-0 h-full w-1 bg-gradient-to-b from-brand-mint to-brand-gold
                                         transition-transform duration-300 ease-smooth skew-y-6
                                         {{ $childActive ? 'translate-x-0 skew-y-0' : '-translate-x-full group-hover:translate-x-0 group-hover:skew-y-0' }}"></span>

                            <span class="absolute inset-0 bg-white/5 -translate-x-full transition-transform duration-300 ease-smooth
                                         group-hover:translate-x-0"></span>

                            <span class="relative z-10 w-4 text-center transition-transform duration-300 ease-smooth group-hover:translate-x-1 group-hover:scale-110">
                                <i class="fa-solid {{ $menu['icon'] }}"></i>
                            </span>
                            <span class="relative z-10 text-sm flex-1 text-left">{{ $menu['label'] }}</span>
                            <i class="fa-solid fa-chevron-down relative z-10 text-xs transition-transform duration-300"
                               :class="blogOpen && 'rotate-180'"></i>
                        </button>

                        <div x-show="blogOpen" x-collapse class="pl-6 mt-1 space-y-1">
                            @foreach ($menu['children'] as $child)
                                @continue(!Route::has($child['route']))
                                @php $active = request()->routeIs($child['route'].'*'); @endphp
                                <a href="{{ route($child['route']) }}"
                                   class="group relative flex items-center gap-3 px-4 py-2.5 rounded-lg overflow-hidden
                                          transition-all duration-300 ease-smooth hover:tracking-wide
                                          {{ $active ? 'text-white bg-white/10' : 'text-brand-beige/60 hover:text-white' }}">

                                    <span class="absolute left-0 top-0 h-full w-1 bg-gradient-to-b from-brand-mint to-brand-gold
                                                 transition-transform duration-300 ease-smooth skew-y-6
                                                 {{ $active ? 'translate-x-0 skew-y-0' : '-translate-x-full group-hover:translate-x-0 group-hover:skew-y-0' }}"></span>

                                    <span class="absolute inset-0 bg-white/5 -translate-x-full transition-transform duration-300 ease-smooth
                                                 group-hover:translate-x-0"></span>

                                    <span class="relative z-10 w-4 text-center text-xs transition-transform duration-300 ease-smooth group-hover:translate-x-1 group-hover:scale-110">
                                        <i class="fa-solid {{ $child['icon'] }}"></i>
                                    </span>
                                    <span class="relative z-10 text-sm">{{ $child['label'] }}</span>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @else
                    @continue(!Route::has($menu['route']))
                    @php $active = request()->routeIs($menu['route'].'*'); @endphp
                    <a href="{{ route($menu['route']) }}"
                       class="group relative flex items-center gap-3 px-4 py-3 rounded-lg overflow-hidden
                              transition-all duration-300 ease-smooth hover:tracking-wide
                              {{ $active ? 'text-white bg-white/10' : 'text-brand-beige/70 hover:text-white' }}">

                        <span class="absolute left-0 top-0 h-full w-1 bg-gradient-to-b from-brand-mint to-brand-gold
                                     transition-transform duration-300 ease-smooth skew-y-6
                                     {{ $active ? 'translate-x-0 skew-y-0' : '-translate-x-full group-hover:translate-x-0 group-hover:skew-y-0' }}"></span>

                        <span class="absolute inset-0 bg-white/5 -translate-x-full transition-transform duration-300 ease-smooth
                                     group-hover:translate-x-0"></span>

                        <span class="relative z-10 w-4 text-center transition-transform duration-300 ease-smooth group-hover:translate-x-1 group-hover:scale-110">
                            <i class="fa-solid {{ $menu['icon'] }}"></i>
                        </span>
                        <span class="relative z-10 text-sm">{{ $menu['label'] }}</span>
                    </a>
                @endif
            @endforeach
        </nav>
    </div>

    <div class="px-4 py-4 border-t border-white/10">
        <div class="flex items-center gap-3 mb-3">
            <div class="relative">
                <div class="h-9 w-9 rounded-full bg-brand-mint flex items-center justify-center text-white text-sm font-semibold
                            ring-2 ring-transparent transition-all duration-300 ease-smooth
                            hover:ring-brand-gold hover:ring-offset-2 hover:ring-offset-brand-dark hover:scale-105 cursor-pointer">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
                <span class="absolute bottom-0 right-0 h-2.5 w-2.5 rounded-full bg-brand-mint border-2 border-brand-dark"></span>
            </div>
            <div>
                <p class="text-white text-sm font-medium leading-none">{{ Auth::user()->name }}</p>
                <p class="text-brand-beige/60 text-xs mt-1">Superadmin • Online</p>
            </div>
        </div>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                    class="group w-full flex items-center gap-2 px-3 py-2 rounded-lg text-brand-beige/60
                           transition-all duration-300 ease-smooth hover:text-red-400 hover:bg-red-500/10">
                <i class="fa-solid fa-arrow-right-from-bracket transition-transform duration-300 ease-smooth group-hover:translate-x-1"></i>
                <span class="text-sm">Log Out</span>
            </button>
        </form>
    </div>
</aside>

<div x-data="{ open: false }" class="sm:hidden bg-brand-dark flex items-center justify-between px-4 py-3">
    <a href="{{ route('dashboard') }}" class="flex items-center gap-2">
        <x-application-logo class="h-7 w-7" />
        <span class="text-white font-semibold text-sm">PT. Eintio</span>
    </a>
    <button @click="open = ! open" class="text-white p-2">
        <i class="fa-solid fa-bars"></i>
    </button>
</div>