    {{-- resources/views/admin/services/create.blade.php --}}
    <x-app-layout>
        <x-slot name="header">
            <div>
                <p class="text-xs text-slate-400 mb-1.5">Layanan / Tambah Layanan</p>
                <h2 class="text-xl font-bold text-brand-dark tracking-tight">Tambah Layanan</h2>
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

        @include('admin.services.partials.styles')

        <div class="w-full px-0 py-0" x-data="{ categoryOpen: false, category: '{{ old('category', '') }}', photoPreview: null }">
            <div class="space-y-6">

                @if (session('success'))
                    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)" x-transition
                        class="flex items-center gap-3 bg-brand-mint/10 border border-brand-mint/30 text-brand-mint px-5 py-3.5 rounded-xl text-sm font-medium">
                        <i class="fa-solid fa-circle-check text-base"></i>
                        {{ session('success') }}
                    </div>
                @endif

                <div class="grid grid-cols-1 lg:grid-cols-4 gap-6 items-start w-full">

                    {{-- SIDEBAR TAB --}}
                    <div class="reveal card-hover bg-white rounded-2xl p-2 border border-slate-100 h-fit w-full">
                        <div class="side-tab is-active w-full text-left px-4 py-3 rounded-lg text-sm font-medium">
                            Informasi Layanan
                        </div>
                        <div class="side-tab is-disabled w-full flex items-center justify-between gap-2 px-4 py-3 rounded-lg text-sm font-medium text-slate-400" title="Simpan informasi dasar terlebih dahulu">
                            <span>Keunggulan Layanan</span>
                            <i class="fa-solid fa-lock text-xs flex-shrink-0"></i>
                        </div>
                        <div class="side-tab is-disabled w-full flex items-center justify-between gap-2 px-4 py-3 rounded-lg text-sm font-medium text-slate-400" title="Simpan informasi dasar terlebih dahulu">
                            <span>Fitur Layanan</span>
                            <i class="fa-solid fa-lock text-xs flex-shrink-0"></i>
                        </div>
                    </div>

                    {{-- CONTENT --}}
                    <div class="reveal card-hover lg:col-span-3 bg-white rounded-2xl p-6 sm:p-8 border border-slate-100 w-full" style="transition-delay:.05s">

                        {{-- STEP INDICATOR --}}
                        <div class="flex items-center gap-2 sm:gap-3 mb-7 text-xs sm:text-sm flex-wrap">
                            <span class="flex items-center gap-2 font-semibold text-brand-mint whitespace-nowrap">
                                <span class="step-dot w-6 h-6 rounded-full bg-brand-mint text-white flex items-center justify-center text-xs flex-shrink-0">1</span>
                                <span class="hidden sm:inline">Informasi Dasar</span>
                                <span class="sm:hidden">Informasi</span>
                            </span>
                            <span class="flex-1 h-px bg-slate-200 min-w-[16px]"></span>
                            <span class="flex items-center gap-2 text-slate-400 whitespace-nowrap">
                                <span class="step-dot w-6 h-6 rounded-full bg-slate-100 flex items-center justify-center text-xs flex-shrink-0">2</span>
                                <span class="hidden sm:inline">Keunggulan Layanan</span>
                                <span class="sm:hidden">Keunggulan</span>
                            </span>
                            <span class="flex-1 h-px bg-slate-200 min-w-[16px]"></span>
                            <span class="flex items-center gap-2 text-slate-400 whitespace-nowrap">
                                <span class="step-dot w-6 h-6 rounded-full bg-slate-100 flex items-center justify-center text-xs flex-shrink-0">3</span>
                                <span class="hidden sm:inline">Fitur Layanan</span>
                                <span class="sm:hidden">Fitur</span>
                            </span>
                        </div>

                        <p class="text-xs text-slate-400 mb-6 bg-brand-cream/60 border border-slate-100 rounded-lg px-4 py-2.5 flex items-start gap-2">
                            <i class="fa-solid fa-circle-info mt-0.5 flex-shrink-0"></i>
                            <span>Simpan informasi dasar terlebih dahulu untuk membuka tab Keunggulan & Fitur Layanan.</span>
                        </p>

                        <form method="POST" action="{{ route('admin.services.store') }}" enctype="multipart/form-data" class="space-y-5">
                            @csrf

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                                <div>
                                    <label class="block text-xs font-bold text-slate-700 mb-2 uppercase tracking-wide">Nama Layanan *</label>
                                    <div class="field-ring flex items-center gap-3 px-4">
                                        <i class="fa-solid fa-briefcase field-icon text-slate-400 text-sm flex-shrink-0"></i>
                                        <input type="text" name="name" value="{{ old('name') }}" placeholder="Contoh: Digital Marketing"
                                            class="w-full min-w-0 bg-transparent border-0 focus:ring-0 text-sm py-2.5" required>
                                    </div>
                                    @error('name') <p class="text-xs text-red-500 mt-1.5">{{ $message }}</p> @enderror
                                </div>

                                {{-- Custom dropdown: Kategori --}}
                                <div>
                                    <label class="block text-xs font-bold text-slate-700 mb-2 uppercase tracking-wide">Kategori Layanan *</label>
                                    <div class="dropdown-wrap" @click.outside="categoryOpen = false">
                                        <input type="hidden" name="category" :value="category">
                                        <button type="button" @click="categoryOpen = !categoryOpen"
                                                class="dropdown-trigger flex items-center gap-3 px-4 py-2.5" :class="categoryOpen && 'is-open'">
                                            <i class="fa-solid fa-layer-group text-slate-400 text-sm flex-shrink-0"></i>
                                            <span class="flex-1 text-sm text-left truncate" :class="category ? 'text-slate-800' : 'text-slate-400'" x-text="category || 'Pilih Kategori'"></span>
                                            <i class="fa-solid fa-chevron-down dropdown-chevron text-xs flex-shrink-0"></i>
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
                                                @foreach ($categories as $cat)
                                                    <button type="button" @click="category = '{{ $cat }}'; categoryOpen = false"
                                                            class="dropdown-option flex items-center justify-between gap-2 px-3 py-2.5 text-sm" :class="category === '{{ $cat }}' ? 'is-selected' : ''">
                                                        <span>{{ $cat }}</span>
                                                        <i class="fa-solid fa-check dropdown-check text-xs" x-show="category === '{{ $cat }}'"></i>
                                                    </button>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    @error('category') <p class="text-xs text-red-500 mt-1.5">{{ $message }}</p> @enderror
                                </div>
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-slate-700 mb-2 uppercase tracking-wide">Icon / Gambar</label>
                                <label class="upload-box relative flex flex-col items-center justify-center py-8 px-4 border-2 border-dashed border-slate-300 rounded-lg overflow-hidden">
                                    <template x-if="!photoPreview">
                                        <div class="flex flex-col items-center text-center">
                                            <i class="fa-solid fa-cloud-arrow-up upload-icon text-2xl text-slate-400 mb-2"></i>
                                            <span class="text-sm text-slate-500">Klik untuk upload</span>
                                            <span class="text-xs text-slate-400">SVG, PNG, JPG (Maks. 2MB)</span>
                                        </div>
                                    </template>
                                    <img :src="photoPreview" x-show="photoPreview" class="max-h-32 object-contain">
                                    <input type="file" name="icon" accept="image/*" class="hidden"
                                        @change="photoPreview = URL.createObjectURL($event.target.files[0])">
                                </label>
                                @error('icon') <p class="text-xs text-red-500 mt-1.5">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-slate-700 mb-2 uppercase tracking-wide">Deskripsi Singkat *</label>
                                <div class="field-ring px-4 py-1">
                                    <textarea name="short_description" rows="3" maxlength="500" placeholder="Tuliskan deskripsi singkat tentang layanan ini..."
                                            class="w-full bg-transparent border-0 focus:ring-0 text-sm py-2 resize-none">{{ old('short_description') }}</textarea>
                                </div>
                                @error('short_description') <p class="text-xs text-red-500 mt-1.5">{{ $message }}</p> @enderror
                            </div>

                            <div class="flex flex-col-reverse sm:flex-row sm:justify-between gap-3 pt-3">
                                <a href="{{ route('admin.services.index') }}" class="btn-ghost border-2 border-slate-200 rounded-lg px-5 py-2.5 text-sm font-semibold text-slate-600 text-center">Batal</a>
                                <button type="submit" class="btn-fill bg-brand-mint text-white font-semibold px-5 py-2.5 rounded-lg">
                                    <span class="fill-layer bg-brand-teal"></span>
                                    <span class="btn-label justify-center w-full">Selanjutnya →</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const io = new IntersectionObserver((entries) => {
                    entries.forEach((e) => { if (e.isIntersecting) { e.target.classList.add('is-visible'); io.unobserve(e.target); } });
                }, { threshold: 0.1, rootMargin: '0px 0px -30px 0px' });
                document.querySelectorAll('.reveal').forEach((el) => io.observe(el));
            });
        </script>
    </x-app-layout>