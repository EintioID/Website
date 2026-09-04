{{-- resources/views/admin/Teams/create.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <div>
            <p class="text-xs text-slate-400 mb-1.5">Beranda / Tim / Tambah</p>
            <h2 class="text-xl font-bold text-brand-dark tracking-tight">Tim</h2>
        </div>

        <div class="flex items-center gap-5">
            <button type="button" class="notif-btn relative p-2 rounded-full">
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

    <div class="space-y-6">

        <form action="{{ route('admin.teams.store') }}" method="POST" enctype="multipart/form-data"
              x-data="teamsForm()" class="space-y-6">
            @csrf

            <div class="reveal card-hover flex items-center justify-between bg-white rounded-2xl shadow-sm border border-slate-100 px-8 py-7">
                <div>
                    <h3 class="text-lg font-bold text-brand-dark">Tambah Anggota</h3>
                    <p class="text-sm text-slate-400 mt-1.5">Kelola tim dan informasi divisi perusahaan.</p>
                </div>
                <a href="{{ route('admin.teams.index') }}"
                   class="modal-close-btn h-9 w-9 rounded-full flex items-center justify-center text-slate-400 border border-slate-100">
                    <i class="fa-solid fa-xmark"></i>
                </a>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-[1fr_320px] gap-6 items-start">

                <div class="reveal card-hover bg-white rounded-2xl shadow-sm border border-slate-100 p-8 space-y-7" style="transition-delay:.05s">
                    <div>
                        <label class="text-sm font-medium text-brand-dark mb-2 block">Nama Lengkap <span class="text-red-500">*</span></label>
                        <div class="field-ring flex items-center gap-3 px-4">
                            <i class="fa-solid fa-user field-icon text-slate-400 text-sm"></i>
                            <input type="text" name="name" value="{{ old('name') }}" placeholder="Masukkan nama lengkap" required
                                   class="w-full bg-transparent border-0 focus:ring-0 text-sm py-3">
                        </div>
                        @error('name') <p class="text-xs text-red-500 mt-1.5">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="text-sm font-medium text-brand-dark mb-2 block">Jabatan / Posisi <span class="text-red-500">*</span></label>
                        <div class="field-ring flex items-center gap-3 px-4">
                            <i class="fa-solid fa-id-badge field-icon text-slate-400 text-sm"></i>
                            <input type="text" name="position" value="{{ old('position') }}" placeholder="Contoh: Chief Executive Officer" required
                                   class="w-full bg-transparent border-0 focus:ring-0 text-sm py-3">
                        </div>
                        @error('position') <p class="text-xs text-red-500 mt-1.5">{{ $message }}</p> @enderror
                    </div>

                    {{-- Custom dropdown: Divisi --}}
                    <div>
                        <label class="text-sm font-medium text-brand-dark mb-2 block">Divisi / Kategori <span class="text-red-500">*</span></label>
                        <div class="dropdown-wrap" @click.outside="divisionOpen = false">
                            <input type="hidden" name="division_id" :value="divisionId">
                            <button type="button" @click="divisionOpen = !divisionOpen; statusOpen = false"
                                    class="dropdown-trigger flex items-center gap-3 px-4 py-3" :class="divisionOpen && 'is-open'">
                                <i class="fa-solid fa-layer-group dropdown-icon text-sm"></i>
                                <span class="flex-1 text-sm truncate" :class="divisionId ? 'text-brand-dark' : 'text-slate-400'" x-text="divisionLabel()"></span>
                                <i class="fa-solid fa-chevron-down dropdown-chevron text-xs"></i>
                            </button>

                            <div x-show="divisionOpen" x-cloak
                                 x-transition:enter="transition ease-out duration-150"
                                 x-transition:enter-start="opacity-0 scale-95 -translate-y-1"
                                 x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                                 x-transition:leave="transition ease-in duration-100"
                                 x-transition:leave-start="opacity-100 scale-100"
                                 x-transition:leave-end="opacity-0 scale-95"
                                 class="dropdown-panel absolute mt-2 w-full bg-white z-20">
                                <div class="dropdown-list">
                                    @forelse($divisions as $division)
                                        <button type="button" @click="divisionId = '{{ $division->id }}'; divisionOpen = false"
                                                class="dropdown-option flex items-center justify-between gap-2 px-3 py-2.5 text-sm"
                                                :class="divisionId === '{{ $division->id }}' ? 'is-selected' : ''">
                                            <span>{{ $division->name }}</span>
                                            <i class="fa-solid fa-check dropdown-check text-xs" x-show="divisionId === '{{ $division->id }}'"></i>
                                        </button>
                                    @empty
                                        <p class="dropdown-empty px-3 py-2.5 text-sm">Belum ada divisi</p>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                        @error('division_id') <p class="text-xs text-red-500 mt-1.5">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="text-sm font-medium text-brand-dark mb-2 block">Bio <span class="text-slate-400 font-normal">(Opsional)</span></label>
                        <div class="field-ring flex items-start gap-3 px-4 py-3">
                            <i class="fa-solid fa-align-left field-icon text-slate-400 text-sm mt-1"></i>
                            <textarea name="bio" rows="3" placeholder="Deskripsi singkat anggota tim"
                                      class="w-full bg-transparent border-0 focus:ring-0 text-sm resize-none">{{ old('bio') }}</textarea>
                        </div>
                        @error('bio') <p class="text-xs text-red-500 mt-1.5">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="text-sm font-medium text-brand-dark mb-2 block">Foto Profil <span class="text-slate-400 font-normal">(Rekomendasi 800x800px)</span></label>
                        <label class="upload-box relative flex flex-col items-center justify-center h-40 cursor-pointer overflow-hidden bg-brand-cream/40">
                            <template x-if="!photoPreview">
                                <div class="flex flex-col items-center text-slate-400">
                                    <span class="upload-icon h-11 w-11 rounded-full bg-brand-mint/10 text-brand-mint flex items-center justify-center mb-2">
                                        <i class="fa-solid fa-camera text-sm"></i>
                                    </span>
                                    <span class="text-sm font-medium text-brand-dark">Klik untuk upload foto</span>
                                    <span class="text-xs text-slate-400 mt-1">atau drag and drop file ke sini</span>
                                    <span class="text-[11px] text-slate-300 mt-1">Format .JPG, .PNG, maks 2MB</span>
                                </div>
                            </template>
                            <img :src="photoPreview" x-show="photoPreview" class="max-h-full max-w-full object-contain p-3">
                            <input type="file" name="photo" accept="image/*" class="hidden"
                                   @change="photoPreview = URL.createObjectURL($event.target.files[0])">
                        </label>
                        @error('photo') <p class="text-xs text-red-500 mt-1.5">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="space-y-6">
                    <div class="side-card reveal bg-white p-6" style="transition-delay:.1s">
                        <p class="font-semibold text-brand-dark text-sm mb-5 flex items-center gap-2">
                            <i class="fa-solid fa-share-nodes text-brand-mint"></i> Link Sosial Media
                        </p>
                        <div class="space-y-4">
                            <div>
                                <label class="text-xs font-medium text-slate-500 mb-2 block">LinkedIn URL</label>
                                <div class="field-ring flex items-center gap-2 px-3">
                                    <span class="h-7 w-7 rounded-md bg-blue-50 text-blue-500 flex items-center justify-center shrink-0">
                                        <i class="fa-brands fa-linkedin-in text-xs"></i>
                                    </span>
                                    <input type="url" name="linkedin" value="{{ old('linkedin') }}" placeholder="https://linkedin.com/in/username"
                                           class="w-full bg-transparent border-0 focus:ring-0 text-xs py-2.5">
                                </div>
                                @error('linkedin') <p class="text-xs text-red-500 mt-1.5">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label class="text-xs font-medium text-slate-500 mb-2 block">Instagram URL</label>
                                <div class="field-ring flex items-center gap-2 px-3">
                                    <span class="h-7 w-7 rounded-md bg-rose-50 text-rose-500 flex items-center justify-center shrink-0">
                                        <i class="fa-brands fa-instagram text-xs"></i>
                                    </span>
                                    <input type="url" name="instagram" value="{{ old('instagram') }}" placeholder="https://instagram.com/username"
                                           class="w-full bg-transparent border-0 focus:ring-0 text-xs py-2.5">
                                </div>
                                @error('instagram') <p class="text-xs text-red-500 mt-1.5">{{ $message }}</p> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="side-card reveal bg-white p-6" style="transition-delay:.15s">
                        <p class="font-semibold text-brand-dark text-sm mb-5 flex items-center gap-2">
                            <i class="fa-solid fa-sliders text-brand-mint"></i> Pengaturan Tampilan
                        </p>
                        <div class="space-y-4">
                            <div>
                                <label class="text-xs font-medium text-slate-500 mb-2 block">Urutan Tampil <span class="text-slate-300">(Opsional)</span></label>
                                <div class="field-ring flex items-center gap-2 px-3">
                                    <i class="fa-solid fa-list-ol field-icon text-slate-400 text-xs"></i>
                                    <input type="number" name="order" value="{{ old('order', 0) }}" min="0"
                                           class="w-full bg-transparent border-0 focus:ring-0 text-sm py-2.5">
                                </div>
                            </div>

                            {{-- Custom dropdown: Status --}}
                            <div>
                                <label class="text-xs font-medium text-slate-500 mb-2 block">Status Anggota</label>
                                <div class="dropdown-wrap" @click.outside="statusOpen = false">
                                    <input type="hidden" name="is_active" :value="status">
                                    <button type="button" @click="statusOpen = !statusOpen; divisionOpen = false"
                                            class="dropdown-trigger flex items-center gap-2 px-3 py-2.5" :class="statusOpen && 'is-open'">
                                        <i class="fa-solid dropdown-icon text-sm" :class="status === '1' ? 'fa-toggle-on text-brand-mint' : 'fa-toggle-off'"></i>
                                        <span class="flex-1 text-sm text-brand-dark truncate" x-text="status === '1' ? 'Aktif (Tampil di Website)' : 'Nonaktif (Disembunyikan)'"></span>
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
                                            <button type="button" @click="status = '1'; statusOpen = false"
                                                    class="dropdown-option flex items-center justify-between gap-2 px-3 py-2.5 text-sm"
                                                    :class="status === '1' ? 'is-selected' : ''">
                                                <span>Aktif (Tampil di Website)</span>
                                                <i class="fa-solid fa-check dropdown-check text-xs" x-show="status === '1'"></i>
                                            </button>
                                            <button type="button" @click="status = '0'; statusOpen = false"
                                                    class="dropdown-option flex items-center justify-between gap-2 px-3 py-2.5 text-sm"
                                                    :class="status === '0' ? 'is-selected' : ''">
                                                <span>Nonaktif (Disembunyikan)</span>
                                                <i class="fa-solid fa-check dropdown-check text-xs" x-show="status === '0'"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="reveal card-hover flex justify-end gap-3 bg-white rounded-2xl shadow-sm border border-slate-100 px-8 py-6" style="transition-delay:.2s">
                <a href="{{ route('admin.teams.index') }}" class="btn-ghost px-5 py-2.5 text-sm font-medium text-slate-500">Batal</a>
                <button type="submit" class="btn-fill px-6 py-2.5 rounded-lg text-sm font-semibold text-white bg-brand-mint">
                    <span class="fill-layer bg-brand-teal"></span>
                    <span class="btn-label"><i class="fa-solid fa-floppy-disk mr-2"></i>Simpan Anggota</span>
                </button>
            </div>
        </form>
    </div>

    <script>
        function teamsForm() {
            return {
                photoPreview: null,
                divisionId: '{{ old('division_id') }}',
                divisionOpen: false,
                status: '{{ old('is_active', '1') }}',
                statusOpen: false,
                divisionNames: @js($divisions->pluck('name', 'id')),
                divisionLabel() {
                    if (!this.divisionId) return 'Pilih divisi...';
                    return this.divisionNames[this.divisionId] || 'Pilih divisi...';
                },
            };
        }

        document.addEventListener('DOMContentLoaded', () => {
            const revealObserver = new IntersectionObserver((entries) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('is-visible');
                        revealObserver.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.1, rootMargin: '0px 0px -30px 0px' });
            document.querySelectorAll('.reveal').forEach((el) => revealObserver.observe(el));
        });
    </script>
</x-app-layout>