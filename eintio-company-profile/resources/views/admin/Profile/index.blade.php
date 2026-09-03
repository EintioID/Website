<x-app-layout>
    <x-slot name="header">
        <div>
            <p class="text-xs text-slate-400 mb-1.5">Beranda / Profil Perusahaan</p>
            <h2 class="text-xl font-bold text-brand-dark tracking-tight">Profil Perusahaan</h2>
        </div>

        <div class="flex items-center gap-5">
            <button class="notif-btn relative p-2 rounded-full">
                <i class="fa-solid fa-bell text-slate-500 text-lg notif-icon"></i>
                <span class="absolute top-1.5 right-1.5 h-2 w-2 rounded-full bg-red-500 animate-ping"></span>
                <span class="absolute top-1.5 right-1.5 h-2 w-2 rounded-full bg-red-500"></span>
            </button>

            <div x-data="{ open: false }" class="relative">
                <button @click="open = !open" @click.outside="open = false"
                        class="user-menu-btn flex items-center gap-3 pl-4 border-l border-slate-200 focus:outline-none">
                    <div class="h-9 w-9 rounded-full bg-brand-mint flex items-center justify-center text-white text-sm font-semibold user-avatar"
                         :class="open && 'is-open'">
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

    <style>
        [x-cloak] { display: none !important; }
        :root { --ease-smooth: cubic-bezier(0.22, 1, 0.36, 1); }

        /* ===== REVEAL SAAT SCROLL / REFRESH / GANTI TAB ===== */
        .reveal { opacity: 0; transform: translateY(24px); transition: opacity .6s var(--ease-smooth), transform .6s var(--ease-smooth); }
        .reveal.is-visible { opacity: 1; transform: translateY(0); }

        /* ===== INPUT FIELD (BOX JELAS) ===== */
        .field-ring {
            border: 1px solid #E2E8F0;
            background-color: rgba(251,246,238,0.4);
            border-radius: 0.75rem;
            transition: box-shadow .3s var(--ease-smooth), border-color .3s var(--ease-smooth), background-color .3s ease;
        }
        .field-ring:hover { border-color: #14B8A6; background-color: #fff; }
        .field-ring:focus-within { border-color: #14B8A6; background-color: #fff; box-shadow: 0 0 0 4px rgba(20,184,166,0.14); }

        /* ===== TOMBOL FILL ===== */
        .btn-fill { position: relative; overflow: hidden; isolation: isolate; transition: transform .3s var(--ease-smooth), box-shadow .3s var(--ease-smooth); }
        .btn-fill .fill-layer { position: absolute; inset: 0; transform: scaleX(0); transform-origin: left center; transition: transform .3s var(--ease-smooth); z-index: -1; }
        .btn-fill .btn-label { position: relative; z-index: 1; }
        .btn-fill:hover { transform: translateY(-2px); box-shadow: 0 14px 28px -12px rgba(20,184,166,0.45); }
        .btn-fill:hover .fill-layer { transform: scaleX(1); }
        .btn-fill:active { transform: translateY(0) scale(0.96); }

        /* ===== TOMBOL OUTLINE -> FILL ===== */
        .btn-outline-fill { position: relative; overflow: hidden; isolation: isolate; transition: color .3s var(--ease-smooth), border-color .3s var(--ease-smooth), transform .3s var(--ease-smooth), box-shadow .3s var(--ease-smooth); }
        .btn-outline-fill .fill-layer { position: absolute; inset: 0; transform: translateY(100%); transition: transform .3s var(--ease-smooth); z-index: -1; }
        .btn-outline-fill:hover { color: #fff; transform: translateY(-2px); box-shadow: 0 12px 24px -12px rgba(20,184,166,0.4); }
        .btn-outline-fill:hover .fill-layer { transform: translateY(0); }

        .btn-ghost { transition: color .25s var(--ease-smooth), background-color .25s var(--ease-smooth); border-radius: 0.5rem; }
        .btn-ghost:hover { color: #1f2937; background-color: #f8fafc; }

        /* ===== TAB SIDEBAR ===== */
        .tab-btn { position: relative; overflow: hidden; border-radius: 0.75rem; transition: background-color .3s var(--ease-smooth), color .3s var(--ease-smooth), transform .3s var(--ease-smooth), box-shadow .3s var(--ease-smooth); }
        .tab-btn:not(.is-active):hover { background-color: #FBF6EE; color: #1f2937; transform: translateX(4px); }
        .tab-btn .tab-icon { transition: transform .3s var(--ease-smooth); }
        .tab-btn:not(.is-active):hover .tab-icon { transform: scale(1.15); }
        .tab-btn .tab-chevron { transition: transform .3s var(--ease-smooth), opacity .3s var(--ease-smooth); opacity: 0; }
        .tab-btn:not(.is-active):hover .tab-chevron { opacity: .6; }
        .tab-btn.is-active { background-color: #14B8A6; color: #fff; box-shadow: 0 10px 20px -10px rgba(20,184,166,0.5); }
        .tab-btn.is-active .tab-chevron { opacity: 1; transform: translateX(2px); }

        /* ===== BELL & USER MENU ===== */
        .notif-btn { border-radius: 9999px; transition: background-color .3s var(--ease-smooth); }
        .notif-btn:hover { background-color: rgba(251,246,238,0.7); }
        @keyframes wiggle { 0%,100%{transform:rotate(0)} 25%{transform:rotate(-10deg)} 75%{transform:rotate(10deg)} }
        .notif-btn:hover .notif-icon { animation: wiggle .4s ease-in-out; }
        .user-avatar { transition: box-shadow .3s var(--ease-smooth); box-shadow: 0 0 0 0 rgba(20,184,166,0); }
        .user-menu-btn:hover .user-avatar, .user-avatar.is-open { box-shadow: 0 0 0 2px #14B8A6, 0 0 0 4px #fff; }
        .chevron-icon { transition: transform .3s var(--ease-smooth); }
        .menu-item { overflow: hidden; transition: color .2s var(--ease-smooth); }
        .menu-item:hover { color: #14213D; }
        .menu-item--danger:hover { color: #ef4444; }
        .menu-item-bar { position: absolute; left: 0; top: 0; height: 100%; width: 0; transition: width .2s var(--ease-smooth); }
        .menu-item:hover .menu-item-bar { width: 3px; }
        .menu-item-icon { transition: transform .2s var(--ease-smooth), color .2s var(--ease-smooth); }
        .menu-item:hover .menu-item-icon { transform: translateX(2px); color: #14B8A6; }
        .menu-item--danger:hover .menu-item-icon { color: #ef4444; }

        /* ===== UPLOAD BOX ===== */
        .upload-box { border: 2px dashed #E2E8F0; border-radius: 1rem; transition: border-color .3s var(--ease-smooth), background-color .3s var(--ease-smooth), box-shadow .3s var(--ease-smooth); }
        .upload-box:hover { border-color: #14B8A6; background-color: rgba(20,184,166,0.05); box-shadow: 0 12px 24px -12px rgba(20,184,166,0.25); }
        .upload-box .upload-placeholder { transition: color .3s var(--ease-smooth); }
        .upload-box:hover .upload-placeholder { color: #14B8A6; }
        .upload-box .upload-icon { transition: transform .3s var(--ease-smooth); }
        .upload-box:hover .upload-icon { transform: scale(1.12) translateY(-2px); }
        .upload-box img { transition: transform .3s var(--ease-smooth); }
        .upload-box:hover img { transform: scale(1.05); }

        /* ===== VALUE / VISI-MISI CARD ===== */
        .value-card { border: 1px solid #E2E8F0; border-radius: 1rem; transition: transform .35s var(--ease-smooth), box-shadow .35s var(--ease-smooth), border-color .35s var(--ease-smooth); }
        .value-card:hover { transform: translateY(-8px); box-shadow: 0 26px 48px -22px rgba(15,23,42,0.22); border-color: transparent; }
        .value-icon { transition: transform .35s var(--ease-smooth); }
        .value-card:hover .value-icon { transform: rotate(8deg) scale(1.12); }
        .value-actions { opacity: 0; transform: translateY(6px); transition: opacity .25s var(--ease-smooth), transform .25s var(--ease-smooth); }
        .value-card:hover .value-actions { opacity: 1; transform: translateY(0); }
        .value-actions button { transition: transform .2s var(--ease-smooth); }
        .value-actions button:hover { transform: scale(1.1); }

        /* ===== MISI ROW ===== */
        .mission-row { border: 1px solid #E2E8F0; border-radius: 0.75rem; transition: border-color .3s var(--ease-smooth); }
        .mission-row .mission-delete { opacity: 0; transition: opacity .2s var(--ease-smooth), transform .2s var(--ease-smooth); }
        .mission-row:hover .mission-delete { opacity: 1; }
        .mission-row .mission-delete:hover { transform: scale(1.1); }
        .mission-number { transition: transform .3s var(--ease-smooth); }
        .mission-row:hover .mission-number { transform: scale(1.1); }
        .add-mission-btn { transition: color .25s var(--ease-smooth), gap .25s var(--ease-smooth); }
        .add-mission-btn:hover { color: #0d9488; gap: 0.75rem; }
        .add-mission-badge { transition: transform .3s var(--ease-smooth), background-color .3s var(--ease-smooth), color .3s var(--ease-smooth); }
        .add-mission-btn:hover .add-mission-badge { transform: rotate(90deg); background-color: #14B8A6; color: #fff; }

        .modal-close-btn { transition: color .2s var(--ease-smooth), background-color .2s var(--ease-smooth); }
        .modal-close-btn:hover { color: #1f2937; background-color: #f1f5f9; }
    </style>

    <div x-data="profilePerusahaan()" class="space-y-8">

        @if(session('success'))
            <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)" x-transition
                 class="flex items-center gap-3 bg-brand-mint/10 border border-brand-mint/30 text-brand-mint px-5 py-3.5 rounded-xl text-sm font-medium">
                <i class="fa-solid fa-circle-check text-base"></i>
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white rounded-2xl shadow-sm border border-slate-100">
            <div class="px-8 py-7 border-b border-slate-100">
                <h3 class="text-lg font-bold text-brand-dark">Profil Perusahaan</h3>
                <p class="text-sm text-slate-400 mt-1.5">Kelola informasi profil perusahaan yang ditampilkan di website.</p>
            </div>

            <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 lg:grid-cols-[240px_1fr] gap-0">

                    <div class="border-b lg:border-b-0 lg:border-r border-slate-100 p-6 space-y-2">
                        <template x-for="item in tabs" :key="item.key">
                            <button type="button" @click="tab = item.key"
                                    class="tab-btn w-full flex items-center gap-3 px-4 py-3 text-sm font-medium"
                                    :class="tab === item.key ? 'is-active' : 'text-slate-500'">
                                <i :class="item.icon" class="tab-icon text-sm w-4"></i>
                                <span class="flex-1 text-left" x-text="item.label"></span>
                                <i class="tab-chevron fa-solid fa-chevron-right text-[10px]"></i>
                            </button>
                        </template>
                    </div>

                    <div class="p-6 lg:p-12">

                        {{-- TAB: INFO UMUM --}}
                        <div x-show="tab === 'info'" x-cloak x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100">
                            <div class="flex items-center gap-3 mb-10">
                                <span class="h-11 w-11 rounded-xl bg-brand-mint/10 flex items-center justify-center text-brand-mint">
                                    <i class="fa-solid fa-circle-info"></i>
                                </span>
                                <div>
                                    <p class="font-semibold text-brand-dark">Info Umum</p>
                                    <p class="text-xs text-slate-400 mt-1">Kelola informasi dasar perusahaan.</p>
                                </div>
                            </div>

                            <div class="space-y-8 max-w-2xl">
                                <div>
                                    <label class="text-sm font-medium text-brand-dark mb-2.5 block">Nama Perusahaan</label>
                                    <div class="field-ring">
                                        <input type="text" name="company_name" value="{{ old('company_name', $profile->company_name) }}"
                                               class="w-full bg-transparent border-0 focus:ring-0 text-sm px-4 py-3" required>
                                    </div>
                                    @error('company_name') <p class="text-xs text-red-500 mt-1.5">{{ $message }}</p> @enderror
                                </div>

                                <div>
                                    <label class="text-sm font-medium text-brand-dark mb-2.5 block">Tagline</label>
                                    <div class="field-ring">
                                        <input type="text" name="tagline" value="{{ old('tagline', $profile->tagline) }}"
                                               class="w-full bg-transparent border-0 focus:ring-0 text-sm px-4 py-3">
                                    </div>
                                </div>

                                <div>
                                    <label class="text-sm font-medium text-brand-dark mb-2.5 block">Deskripsi</label>
                                    <div class="field-ring">
                                        <textarea name="description" rows="4"
                                                  class="w-full bg-transparent border-0 focus:ring-0 text-sm px-4 py-3">{{ old('description', $profile->description) }}</textarea>
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                                    <div>
                                        <label class="text-sm font-medium text-brand-dark mb-2.5 block">No. Telepon</label>
                                        <div class="field-ring">
                                            <input type="text" name="phone" value="{{ old('phone', $profile->phone) }}"
                                                   class="w-full bg-transparent border-0 focus:ring-0 text-sm px-4 py-3">
                                        </div>
                                    </div>
                                    <div>
                                        <label class="text-sm font-medium text-brand-dark mb-2.5 block">Email</label>
                                        <div class="field-ring">
                                            <input type="email" name="email" value="{{ old('email', $profile->email) }}"
                                                   class="w-full bg-transparent border-0 focus:ring-0 text-sm px-4 py-3">
                                        </div>
                                        @error('email') <p class="text-xs text-red-500 mt-1.5">{{ $message }}</p> @enderror
                                    </div>
                                </div>

                                <div>
                                    <label class="text-sm font-medium text-brand-dark mb-2.5 block">Alamat</label>
                                    <div class="field-ring">
                                        <textarea name="address" rows="3"
                                                  class="w-full bg-transparent border-0 focus:ring-0 text-sm px-4 py-3">{{ old('address', $profile->address) }}</textarea>
                                    </div>
                                </div>

                                <div>
                                    <p class="text-sm font-medium text-brand-dark mb-3.5">Media Identitas</p>
                                    <div class="max-w-sm">
                                        <p class="text-xs text-slate-400 mb-2">Logo Utama</p>
                                        <label class="upload-box relative flex flex-col items-center justify-center h-40 cursor-pointer overflow-hidden bg-brand-cream/40">
                                            <template x-if="!logoPreview && !'{{ $profile->logo }}'">
                                                <div class="upload-placeholder flex flex-col items-center text-slate-300">
                                                    <i class="upload-icon fa-solid fa-image text-3xl mb-2"></i>
                                                    <span class="text-xs font-medium">Klik untuk unggah</span>
                                                </div>
                                            </template>
                                            <img :src="logoPreview || '{{ $profile->logo ? asset('storage/'.$profile->logo) : '' }}'"
                                                 x-show="logoPreview || '{{ $profile->logo }}'"
                                                 class="max-h-full max-w-full object-contain p-3">
                                            <input type="file" name="logo" accept="image/*" class="hidden"
                                                   @change="logoPreview = URL.createObjectURL($event.target.files[0])">
                                        </label>
                                        <p class="text-[11px] text-slate-300 mt-2">Format PNG transparan, maks. 2MB.</p>
                                        @error('logo') <p class="text-xs text-red-500 mt-1.5">{{ $message }}</p> @enderror
                                    </div>
                                </div>

                                <div class="flex justify-end gap-3 pt-6 border-t border-slate-100">
                                    <button type="button" class="btn-ghost px-5 py-2.5 text-sm font-medium text-slate-500">Batal</button>
                                    <button type="submit" class="btn-fill px-6 py-2.5 rounded-lg text-sm font-semibold text-white bg-brand-mint">
                                        <span class="fill-layer bg-brand-teal"></span>
                                        <span class="btn-label"><i class="fa-solid fa-floppy-disk mr-2"></i>Simpan Perubahan</span>
                                    </button>
                                </div>
                            </div>
                        </div>

                        {{-- TAB: HERO BERANDA --}}
                        <div x-show="tab === 'hero'" x-cloak x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100">
                            <div class="flex items-center gap-3 mb-10">
                                <span class="h-11 w-11 rounded-xl bg-brand-mint/10 flex items-center justify-center text-brand-mint">
                                    <i class="fa-solid fa-tv"></i>
                                </span>
                                <div>
                                    <p class="font-semibold text-brand-dark">Hero Beranda</p>
                                    <p class="text-xs text-slate-400 mt-1">Kelola tampilan utama halaman depan website.</p>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 lg:grid-cols-[1fr_300px] gap-10">
                                <div class="space-y-8">
                                    <div>
                                        <label class="text-sm font-medium text-brand-dark mb-2.5 block">Badge / Label</label>
                                        <div class="field-ring">
                                            <input type="text" name="hero_badge" value="{{ old('hero_badge', $profile->hero_badge) }}"
                                                   class="w-full bg-transparent border-0 focus:ring-0 text-sm px-4 py-3">
                                        </div>
                                    </div>
                                    <div>
                                        <label class="text-sm font-medium text-brand-dark mb-2.5 block">Judul Utama</label>
                                        <div class="field-ring">
                                            <textarea name="hero_title" rows="2"
                                                      class="w-full bg-transparent border-0 focus:ring-0 text-sm px-4 py-3">{{ old('hero_title', $profile->hero_title) }}</textarea>
                                        </div>
                                    </div>
                                    <div>
                                        <label class="text-sm font-medium text-brand-dark mb-2.5 block">Sub Judul / Deskripsi</label>
                                        <div class="field-ring">
                                            <textarea name="hero_subtitle" rows="3"
                                                      class="w-full bg-transparent border-0 focus:ring-0 text-sm px-4 py-3">{{ old('hero_subtitle', $profile->hero_subtitle) }}</textarea>
                                        </div>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-brand-dark mb-3.5">Tombol Aksi (CTA)</p>
                                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                            <div class="field-ring">
                                                <input type="text" name="cta_1_label" placeholder="Jelajahi Layanan"
                                                       value="{{ old('cta_1_label', $profile->cta_1_label) }}"
                                                       class="w-full bg-transparent border-0 focus:ring-0 text-sm px-4 py-3">
                                            </div>
                                            <div class="field-ring">
                                                <input type="text" name="cta_1_url" placeholder="/layanan"
                                                       value="{{ old('cta_1_url', $profile->cta_1_url) }}"
                                                       class="w-full bg-transparent border-0 focus:ring-0 text-sm px-4 py-3 text-slate-400">
                                            </div>
                                            <div class="field-ring">
                                                <input type="text" name="cta_2_label" placeholder="Hubungi Kami"
                                                       value="{{ old('cta_2_label', $profile->cta_2_label) }}"
                                                       class="w-full bg-transparent border-0 focus:ring-0 text-sm px-4 py-3">
                                            </div>
                                            <div class="field-ring">
                                                <input type="text" name="cta_2_url" placeholder="/contact"
                                                       value="{{ old('cta_2_url', $profile->cta_2_url) }}"
                                                       class="w-full bg-transparent border-0 focus:ring-0 text-sm px-4 py-3 text-slate-400">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <p class="text-sm font-medium text-brand-dark mb-3.5">Gambar Visual</p>
                                    <label class="upload-box relative flex flex-col items-center justify-center h-52 cursor-pointer overflow-hidden bg-brand-cream/40">
                                        <template x-if="!heroPreview && !'{{ $profile->hero_image }}'">
                                            <div class="upload-placeholder flex flex-col items-center text-slate-300">
                                                <i class="upload-icon fa-solid fa-panorama text-3xl mb-2"></i>
                                                <span class="text-xs text-center px-6 leading-relaxed">Format JPG, PNG, WEBP. Maksimal 3MB.<br>Dimensi ideal: 1200x800px.</span>
                                            </div>
                                        </template>
                                        <img :src="heroPreview || '{{ $profile->hero_image ? asset('storage/'.$profile->hero_image) : '' }}'"
                                             x-show="heroPreview || '{{ $profile->hero_image }}'"
                                             class="max-h-full max-w-full object-cover w-full h-full">
                                        <input type="file" name="hero_image" accept="image/*" class="hidden"
                                               @change="heroPreview = URL.createObjectURL($event.target.files[0])">
                                    </label>
                                    <button type="button" onclick="this.previousElementSibling.querySelector('input').click()"
                                            class="btn-outline-fill w-full mt-4 px-4 py-2.5 rounded-lg text-sm font-medium text-brand-mint border border-brand-mint">
                                        <span class="fill-layer bg-brand-mint"></span>
                                        <span class="btn-label relative z-10"><i class="fa-solid fa-cloud-arrow-up mr-2"></i>Ubah Gambar Visual</span>
                                    </button>
                                    @error('hero_image') <p class="text-xs text-red-500 mt-1.5">{{ $message }}</p> @enderror
                                </div>
                            </div>

                            <div class="flex justify-end gap-3 pt-8 mt-2 max-w-2xl border-t border-slate-100">
                                <button type="button" class="btn-ghost px-5 py-2.5 text-sm font-medium text-slate-500">Batal</button>
                                <button type="submit" class="btn-fill px-6 py-2.5 rounded-lg text-sm font-semibold text-white bg-brand-mint">
                                    <span class="fill-layer bg-brand-teal"></span>
                                    <span class="btn-label"><i class="fa-solid fa-floppy-disk mr-2"></i>Simpan Perubahan</span>
                                </button>
                            </div>
                        </div>

                        {{-- TAB: VISI & MISI --}}
                        <div x-show="tab === 'visimisi'" x-cloak x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100">
                            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

                                <div class="value-card reveal bg-white p-7">
                                    <div class="flex items-center gap-3 mb-1.5">
                                        <span class="value-icon h-9 w-9 rounded-lg bg-brand-teal/10 flex items-center justify-center text-brand-teal">
                                            <i class="fa-solid fa-eye text-sm"></i>
                                        </span>
                                        <p class="font-semibold text-brand-dark">Visi</p>
                                    </div>
                                    <p class="text-xs text-slate-400 mb-5 ml-12">Tulis visi perusahaan.</p>

                                    <label class="text-[11px] uppercase tracking-wide text-slate-400 font-semibold">Visi Perusahaan</label>
                                    <div class="field-ring mt-2.5">
                                        <textarea name="vision" x-model="visionText" maxlength="500" rows="7"
                                                  class="w-full bg-transparent border-0 focus:ring-0 text-sm px-4 py-3 leading-relaxed">{{ old('vision', $profile->vision) }}</textarea>
                                    </div>
                                    <p class="text-[11px] text-slate-300 text-right mt-1.5" x-text="visionText.length + '/500'"></p>
                                </div>

                                <div class="value-card reveal bg-white p-7" style="transition-delay:.08s">
                                    <div class="flex items-center gap-3 mb-1.5">
                                        <span class="value-icon h-9 w-9 rounded-lg bg-brand-gold/10 flex items-center justify-center text-brand-gold">
                                            <i class="fa-solid fa-bullseye text-sm"></i>
                                        </span>
                                        <p class="font-semibold text-brand-dark">Misi</p>
                                    </div>
                                    <p class="text-xs text-slate-400 mb-5 ml-12">Kelola misi perusahaan dalam bentuk poin.</p>

                                    <div class="space-y-3">
                                        <template x-for="(point, i) in missionPoints" :key="i">
                                            <div class="mission-row flex items-center gap-3 bg-brand-cream/40 px-3 py-1">
                                                <span class="mission-number h-6 w-6 shrink-0 rounded-full bg-brand-mint/10 text-brand-mint text-[11px] flex items-center justify-center font-bold" x-text="i + 1"></span>
                                                <input type="text" :name="'mission[]'" x-model="missionPoints[i]"
                                                       class="w-full bg-transparent border-0 focus:ring-0 text-sm py-2">
                                                <button type="button" @click="missionPoints.splice(i, 1)"
                                                        class="mission-delete shrink-0 h-7 w-7 rounded-full flex items-center justify-center text-slate-300 hover:text-white hover:bg-red-500">
                                                    <i class="fa-solid fa-trash text-xs"></i>
                                                </button>
                                            </div>
                                        </template>
                                    </div>

                                    <button type="button" @click="missionPoints.push('')" class="add-mission-btn mt-4 flex items-center gap-2 text-sm font-medium text-brand-mint">
                                        <span class="add-mission-badge h-6 w-6 rounded-full bg-brand-mint/10 flex items-center justify-center">
                                            <i class="fa-solid fa-plus text-[10px]"></i>
                                        </span>
                                        Tambah Misi
                                    </button>

                                    <div class="flex justify-end mt-7 pt-5 border-t border-slate-100">
                                        <button type="submit" class="btn-fill px-6 py-2.5 rounded-lg text-sm font-semibold text-white bg-brand-mint">
                                            <span class="fill-layer bg-brand-teal"></span>
                                            <span class="btn-label"><i class="fa-solid fa-floppy-disk mr-2"></i>Simpan Perubahan</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- TAB: NILAI INTI --}}
                        <div x-show="tab === 'nilai'" x-cloak x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100">
                            <div class="flex items-center justify-between mb-10">
                                <div class="flex items-center gap-3">
                                    <span class="h-11 w-11 rounded-xl bg-brand-mint/10 flex items-center justify-center text-brand-mint">
                                        <i class="fa-solid fa-gem"></i>
                                    </span>
                                    <div>
                                        <p class="font-semibold text-brand-dark">Nilai Inti</p>
                                        <p class="text-xs text-slate-400 mt-1">Kelola nilai-nilai inti perusahaan.</p>
                                    </div>
                                </div>

                                <button type="button" @click="openAddNilai()" class="btn-fill flex items-center gap-2 text-sm font-semibold text-white bg-brand-mint px-5 py-2.5 rounded-lg">
                                    <span class="fill-layer bg-brand-teal"></span>
                                    <span class="btn-label flex items-center gap-2"><i class="fa-solid fa-plus text-xs"></i>Tambah Nilai</span>
                                </button>
                            </div>

                            @if($coreValues->isEmpty())
                                <div class="flex flex-col items-center justify-center py-16 text-center border-2 border-dashed border-slate-200 rounded-2xl">
                                    <div class="h-14 w-14 rounded-full bg-brand-cream flex items-center justify-center mb-3">
                                        <i class="fa-solid fa-gem text-slate-300 text-lg"></i>
                                    </div>
                                    <p class="text-sm text-slate-400">Belum ada nilai inti ditambahkan</p>
                                    <p class="text-xs text-slate-300 mt-1">Klik "Tambah Nilai" untuk mulai menambahkan.</p>
                                </div>
                            @else
                                @php
                                    $palette = [
                                        ['bg' => 'bg-blue-50', 'text' => 'text-blue-500'],
                                        ['bg' => 'bg-purple-50', 'text' => 'text-purple-500'],
                                        ['bg' => 'bg-amber-50', 'text' => 'text-amber-500'],
                                        ['bg' => 'bg-emerald-50', 'text' => 'text-emerald-500'],
                                        ['bg' => 'bg-rose-50', 'text' => 'text-rose-500'],
                                        ['bg' => 'bg-cyan-50', 'text' => 'text-cyan-500'],
                                    ];
                                @endphp
                                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-7">
                                    @foreach($coreValues as $value)
                                        @php $color = $palette[$loop->index % count($palette)]; @endphp
                                        <div class="value-card reveal relative bg-white p-6" style="transition-delay: {{ $loop->index * 0.06 }}s">
                                            <div class="value-actions absolute top-4 right-4 flex gap-1.5">
                                                <button type="button"
                                                        @click="openEditNilai({{ $value->id }}, '{{ $value->icon }}', '{{ addslashes($value->title) }}', '{{ addslashes($value->description) }}')"
                                                        class="h-8 w-8 rounded-full bg-brand-cream text-slate-400 hover:text-brand-mint hover:bg-brand-mint/10 flex items-center justify-center">
                                                    <i class="fa-solid fa-pen text-xs"></i>
                                                </button>
                                                <form action="{{ route('admin.profile.core-values.destroy', $value) }}" method="POST" onsubmit="return confirm('Hapus nilai ini?')">
                                                    @csrf @method('DELETE')
                                                    <button type="submit" class="h-8 w-8 rounded-full bg-brand-cream text-slate-400 hover:text-red-500 hover:bg-red-50 flex items-center justify-center">
                                                        <i class="fa-solid fa-trash text-xs"></i>
                                                    </button>
                                                </form>
                                            </div>
                                            <div class="value-icon h-14 w-14 rounded-xl {{ $color['bg'] }} {{ $color['text'] }} flex items-center justify-center text-xl mb-5">
                                                <i class="{{ $value->icon }}"></i>
                                            </div>
                                            <p class="font-bold text-brand-dark text-base mb-2">{{ $value->title }}</p>
                                            <p class="text-sm text-slate-500 leading-relaxed">{{ $value->description }}</p>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>

                    </div>
                </div>
            </form>
        </div>

        {{-- ===== MODAL TAMBAH / EDIT NILAI INTI (dikecilkan sesuai form) ===== --}}
        <div x-show="nilaiModal.open" x-cloak style="display:none"
             class="fixed inset-0 z-50 flex items-center justify-center p-4">
            <div x-show="nilaiModal.open" x-transition.opacity @click="nilaiModal.open = false"
                 class="absolute inset-0 bg-brand-dark/60 backdrop-blur-sm"></div>

            <div x-show="nilaiModal.open"
                 x-transition:enter="transition ease-out duration-250"
                 x-transition:enter-start="opacity-0 scale-95 translate-y-4"
                 x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-150"
                 x-transition:leave-start="opacity-100 scale-100"
                 x-transition:leave-end="opacity-0 scale-95"
                 class="relative bg-white rounded-2xl shadow-2xl w-full max-w-sm p-6 z-10">

                <div class="flex items-center justify-between mb-5 pb-4 border-b border-slate-100">
                    <h3 class="font-bold text-brand-dark text-base" x-text="nilaiModal.mode === 'edit' ? 'Edit Nilai Inti' : 'Tambah Nilai Inti'"></h3>
                    <button type="button" @click="nilaiModal.open = false" class="modal-close-btn h-7 w-7 rounded-full flex items-center justify-center text-slate-300">
                        <i class="fa-solid fa-xmark text-sm"></i>
                    </button>
                </div>

                <form :action="nilaiModal.mode === 'edit' ? '{{ url('admin/profile/core-values') }}/' + nilaiModal.id : '{{ route('admin.profile.core-values.store') }}'"
                      method="POST" class="space-y-4">
                    @csrf
                    <template x-if="nilaiModal.mode === 'edit'">
                        <input type="hidden" name="_method" value="PUT">
                    </template>
                    <input type="hidden" name="icon" x-model="nilaiModal.icon">

                    <div class="flex items-center gap-3 bg-brand-cream/50 rounded-xl border border-slate-100 p-3">
                        <div class="value-icon h-11 w-11 rounded-lg bg-brand-mint/10 text-brand-mint flex items-center justify-center text-lg shrink-0">
                            <i :class="nilaiModal.icon"></i>
                        </div>
                        <p class="text-[11px] text-slate-400 leading-relaxed">
                            Icon otomatis menyesuaikan judul yang diketik.
                        </p>
                    </div>

                    <div>
                        <label class="text-sm font-medium text-brand-dark mb-1.5 block">Judul</label>
                        <div class="field-ring">
                            <input type="text" name="title" x-model="nilaiModal.title"
                                   @input="nilaiModal.icon = guessIcon(nilaiModal.title)"
                                   placeholder="Contoh: Komitmen, Kualitas, Inovasi" required
                                   class="w-full bg-transparent border-0 focus:ring-0 text-sm px-3.5 py-2.5">
                        </div>
                    </div>

                    <div>
                        <label class="text-sm font-medium text-brand-dark mb-1.5 block">Deskripsi</label>
                        <div class="field-ring">
                            <textarea name="description" x-model="nilaiModal.description" rows="3"
                                      placeholder="Jelaskan nilai ini secara singkat..."
                                      class="w-full bg-transparent border-0 focus:ring-0 text-sm px-3.5 py-2.5"></textarea>
                        </div>
                    </div>

                    <div class="flex justify-end gap-2.5 pt-3 border-t border-slate-100">
                        <button type="button" @click="nilaiModal.open = false" class="btn-ghost px-4 py-2 text-sm font-medium text-slate-500">Batal</button>
                        <button type="submit" class="btn-fill px-5 py-2 rounded-lg text-sm font-semibold text-white bg-brand-mint">
                            <span class="fill-layer bg-brand-teal"></span>
                            <span class="btn-label">Simpan</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>

    <script>
        function profilePerusahaan() {
            return {
                tab: 'info',
                tabs: [
                    { key: 'info', label: 'Info Umum', icon: 'fa-solid fa-circle-info' },
                    { key: 'hero', label: 'Hero Beranda', icon: 'fa-solid fa-tv' },
                    { key: 'visimisi', label: 'Visi & Misi', icon: 'fa-solid fa-compass' },
                    { key: 'nilai', label: 'Nilai Inti', icon: 'fa-solid fa-gem' },
                ],
                logoPreview: null,
                heroPreview: null,
                visionText: @json(old('vision', $profile->vision) ?? ''),
                missionPoints: @json(old('mission', $profile->mission ?: [''])),
                nilaiModal: { open: false, mode: 'add', id: null, icon: 'fa-solid fa-gem', title: '', description: '' },
                openAddNilai() {
                    this.nilaiModal = { open: true, mode: 'add', id: null, icon: 'fa-solid fa-gem', title: '', description: '' };
                },
                openEditNilai(id, icon, title, description) {
                    this.nilaiModal = { open: true, mode: 'edit', id, icon, title, description };
                },
                guessIcon(title) {
                    const t = (title || '').toLowerCase();
                    const map = [
                        { keys: ['komitmen', 'dedikasi'], icon: 'fa-solid fa-shield-halved' },
                        { keys: ['kualitas', 'terbaik', 'unggul', 'prestasi'], icon: 'fa-solid fa-award' },
                        { keys: ['inovasi', 'kreatif', 'ide'], icon: 'fa-solid fa-lightbulb' },
                        { keys: ['integritas', 'jujur', 'adil'], icon: 'fa-solid fa-scale-balanced' },
                        { keys: ['percaya', 'kepercayaan', 'amanah'], icon: 'fa-solid fa-handshake' },
                        { keys: ['tim', 'kolaborasi', 'kerja sama', 'kerjasama'], icon: 'fa-solid fa-users' },
                        { keys: ['cepat', 'kecepatan', 'responsif'], icon: 'fa-solid fa-bolt' },
                        { keys: ['peduli', 'kasih', 'empati', 'cinta'], icon: 'fa-solid fa-heart' },
                        { keys: ['tumbuh', 'berkembang', 'pertumbuhan'], icon: 'fa-solid fa-rocket' },
                        { keys: ['lingkungan', 'hijau', 'ramah lingkungan'], icon: 'fa-solid fa-leaf' },
                        { keys: ['aman', 'keamanan', 'proteksi'], icon: 'fa-solid fa-lock' },
                        { keys: ['profesional', 'disiplin'], icon: 'fa-solid fa-briefcase' },
                        { keys: ['transparan', 'terbuka'], icon: 'fa-solid fa-eye' },
                        { keys: ['fokus', 'target', 'tujuan'], icon: 'fa-solid fa-bullseye' },
                    ];
                    for (const entry of map) if (entry.keys.some(k => t.includes(k))) return entry.icon;
                    return 'fa-solid fa-gem';
                },
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            const revealObserver = new IntersectionObserver((entries) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('is-visible');
                        revealObserver.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.12, rootMargin: '0px 0px -40px 0px' });

            document.querySelectorAll('.reveal').forEach((el) => revealObserver.observe(el));

            const mutationObserver = new MutationObserver(() => {
                document.querySelectorAll('.reveal:not(.is-visible)').forEach((el) => revealObserver.observe(el));
            });
            mutationObserver.observe(document.body, { attributes: true, attributeFilter: ['style'], subtree: true });
        });
    </script>
</x-app-layout>