@php
    $portfolio = $portfolio ?? null;
@endphp

<div x-data="portfolioForm()" class="space-y-8">

    <div class="reveal card-hover flex items-center justify-between bg-white rounded-2xl shadow-sm border border-slate-100 px-8 py-7">
        <div>
            <h3 class="text-lg font-bold text-brand-dark">{{ $portfolio ? 'Edit Portofolio' : 'Tambah Portofolio' }}</h3>
            <p class="text-sm text-slate-400 mt-1.5">Kelola semua portfolio proyek yang ditampilkan di website.</p>
        </div>
        <a href="{{ route('admin.portfolios.index') }}"
           class="modal-close-btn h-9 w-9 rounded-full flex items-center justify-center text-slate-400 border border-slate-100">
            <i class="fa-solid fa-xmark"></i>
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">

        {{-- KOLOM KIRI --}}
        <div class="lg:col-span-2 space-y-8">

            <div class="reveal card-hover bg-white rounded-2xl shadow-sm border border-slate-100 p-9 space-y-8" style="transition-delay:.05s">
                <div>
                    <label class="text-sm font-medium text-brand-dark mb-2.5 block">Judul Proyek <span class="text-red-500">*</span></label>
                    <div class="field-ring flex items-center gap-3 px-4">
                        <i class="fa-solid fa-briefcase text-slate-400 text-sm"></i>
                        <input type="text" name="title" value="{{ old('title', $portfolio?->title) }}"
                               placeholder="Contoh: Website Company Profile" required
                               class="w-full bg-transparent border-0 focus:ring-0 text-sm py-3.5">
                    </div>
                    @error('title') <p class="text-xs text-red-500 mt-2">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="text-sm font-medium text-brand-dark mb-2.5 block">Deskripsi Singkat</label>
                    <div class="field-ring flex items-start gap-3 px-4 py-3.5">
                        <i class="fa-solid fa-align-left text-slate-400 text-sm mt-1"></i>
                        <textarea name="description" rows="2" placeholder="Ringkasan singkat proyek untuk ditampilkan di daftar portofolio"
                                  class="w-full bg-transparent border-0 focus:ring-0 text-sm resize-none">{{ old('description', $portfolio?->description) }}</textarea>
                    </div>
                    @error('description') <p class="text-xs text-red-500 mt-2">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="text-sm font-medium text-brand-dark mb-2.5 block">Latar Belakang Proyek <span class="text-red-500">*</span></label>
                    <div class="field-ring px-4 py-3.5">
                        <textarea name="background" rows="4" placeholder="Tuliskan latar belakang proyek di sini..."
                                  class="w-full bg-transparent border-0 focus:ring-0 text-sm resize-none">{{ old('background', $portfolio?->background) }}</textarea>
                    </div>
                    @error('background') <p class="text-xs text-red-500 mt-2">{{ $message }}</p> @enderror
                </div>
            </div>

            {{-- KEBUTUHAN PROYEK --}}
            <div class="reveal card-hover bg-white rounded-2xl shadow-sm border border-slate-100 p-9 space-y-5" style="transition-delay:.1s">
                <label class="text-sm font-medium text-brand-dark block">Kebutuhan Proyek</label>

                <div class="space-y-3">
                    <template x-for="(item, index) in requirements" :key="index">
                        <div class="repeat-item flex items-center gap-3 px-4 py-3.5">
                            <i class="fa-solid fa-circle-check text-emerald-500 text-sm"></i>
                            <input type="text" :name="`requirements[${index}]`" x-model="requirements[index]"
                                   placeholder="Contoh: Sistem manajemen akademik terintegrasi"
                                   class="flex-1 bg-transparent border-0 focus:ring-0 text-sm py-1">
                            <button type="button" @click="requirements.splice(index, 1)"
                                    class="action-btn h-8 w-8 rounded-md flex items-center justify-center text-red-400 hover:bg-red-50 hover:text-red-600">
                                <i class="fa-solid fa-trash text-xs"></i>
                            </button>
                        </div>
                    </template>
                </div>

                <button type="button" @click="requirements.push('')"
                        class="btn-ghost border border-dashed border-slate-200 w-full py-3 rounded-lg text-sm font-medium text-brand-mint">
                    <i class="fa-solid fa-plus mr-1"></i> Tambah Kebutuhan
                </button>
                @error('requirements') <p class="text-xs text-red-500">{{ $message }}</p> @enderror
            </div>

            {{-- SOLUSI YANG DIKEMBANGKAN --}}
            <div class="reveal card-hover bg-white rounded-2xl shadow-sm border border-slate-100 p-9 space-y-5" style="transition-delay:.15s">
                <label class="text-sm font-medium text-brand-dark block">Solusi yang Dikembangkan</label>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <template x-for="(sol, index) in solutions" :key="index">
                        <div class="repeat-item relative p-5">
                            <button type="button" @click="solutions.splice(index, 1)"
                                    class="action-btn absolute top-3 right-3 h-6 w-6 rounded-md flex items-center justify-center text-red-400 hover:bg-red-50 hover:text-red-600">
                                <i class="fa-solid fa-trash text-[10px]"></i>
                            </button>

                            <div class="flex items-center gap-3 mb-4">
                                <div class="hover-icon h-10 w-10 rounded-lg bg-brand-mint/10 text-brand-mint flex items-center justify-center shrink-0">
                                    <i class="fa-solid" :class="sol.icon || 'fa-gear'"></i>
                                </div>
                                <input type="text" :name="`solutions[${index}][title]`" x-model="sol.title"
                                       placeholder="Judul solusi"
                                       class="flex-1 bg-transparent border-0 focus:ring-0 text-sm font-semibold text-brand-dark py-1">
                            </div>

                            <input type="hidden" :name="`solutions[${index}][icon]`" x-model="sol.icon">
                            <div class="grid grid-cols-8 gap-1.5 mb-4">
                                <template x-for="icon in iconOptions" :key="icon">
                                    <button type="button" @click="sol.icon = icon"
                                            class="icon-choice h-8 flex items-center justify-center"
                                            :class="sol.icon === icon ? 'is-active' : ''">
                                        <i class="fa-solid text-xs" :class="icon"></i>
                                    </button>
                                </template>
                            </div>

                            <textarea :name="`solutions[${index}][description]`" x-model="sol.description" rows="2"
                                      placeholder="Deskripsi singkat solusi"
                                      class="w-full bg-transparent border-0 border-t border-slate-100 focus:ring-0 text-xs text-slate-400 resize-none pt-3"></textarea>
                        </div>
                    </template>

                    <button type="button" @click="solutions.push({icon:'',title:'',description:''})"
                            class="repeat-item flex flex-col items-center justify-center gap-2.5 py-10 text-slate-400 hover:text-brand-mint">
                        <i class="fa-solid fa-plus"></i>
                        <span class="text-xs font-medium">Tambah Solusi Baru</span>
                    </button>
                </div>
            </div>

            {{-- GALERI --}}
            <div class="reveal card-hover bg-white rounded-2xl shadow-sm border border-slate-100 p-9 space-y-5" style="transition-delay:.2s">
                <label class="text-sm font-medium text-brand-dark block">Galeri Tampilan Proyek</label>

                <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                    <template x-for="(img, index) in existingGallery" :key="'old-'+index">
                        <div class="repeat-item relative h-28 overflow-hidden">
                            <img :src="img.url" class="w-full h-full object-cover">
                            <input type="hidden" name="keep_gallery[]" :value="img.path">
                            <button type="button" @click="existingGallery.splice(index, 1)"
                                    class="absolute top-1.5 right-1.5 h-6 w-6 rounded-full bg-white/90 text-red-500 flex items-center justify-center shadow hover:bg-red-500 hover:text-white transition">
                                <i class="fa-solid fa-xmark text-xs"></i>
                            </button>
                        </div>
                    </template>

                    <template x-for="(item, index) in newGalleryFiles" :key="'new-'+index">
                        <div class="repeat-item relative h-28 overflow-hidden">
                            <img :src="item.url" class="w-full h-full object-cover">
                            <button type="button" @click="removeNewGalleryFile(index)"
                                    class="absolute top-1.5 right-1.5 h-6 w-6 rounded-full bg-white/90 text-red-500 flex items-center justify-center shadow hover:bg-red-500 hover:text-white transition">
                                <i class="fa-solid fa-xmark text-xs"></i>
                            </button>
                        </div>
                    </template>

                    <label class="upload-box flex flex-col items-center justify-center h-28 cursor-pointer text-slate-400">
                        <i class="fa-solid fa-cloud-arrow-up text-sm mb-1.5"></i>
                        <span class="text-[11px] font-medium">Tambah Gambar</span>
                        <input type="file" accept="image/*" multiple class="hidden" x-ref="galleryInput" @change="handleGallery($event)">
                    </label>
                </div>
                <p class="text-[11px] text-slate-300">Klik ikon silang untuk menghapus gambar. Klik "Simpan" untuk menerapkan perubahan.</p>
            </div>
        </div>

        {{-- KOLOM KANAN --}}
        <div class="lg:col-span-1 space-y-8">

            <div class="side-card reveal card-hover bg-white p-7 border border-slate-100 rounded-2xl" style="transition-delay:.05s">
                <p class="font-semibold text-brand-dark text-sm mb-5">Gambar Utama Proyek</p>
                <label class="upload-box relative flex flex-col items-center justify-center h-44 cursor-pointer overflow-hidden bg-brand-cream/40">
                    <template x-if="!thumbPreview && !existingImage">
                        <div class="flex flex-col items-center text-slate-400">
                            <span class="hover-icon h-12 w-12 rounded-full bg-brand-mint/10 text-brand-mint flex items-center justify-center mb-3">
                                <i class="fa-solid fa-image text-sm"></i>
                            </span>
                            <span class="text-sm font-medium text-brand-dark">Klik untuk upload</span>
                            <span class="text-[11px] text-slate-300 mt-1.5">Format .JPG, .PNG, maks 2MB</span>
                        </div>
                    </template>
                    <img :src="thumbPreview || existingImage"
                         x-show="thumbPreview || existingImage"
                         class="max-h-full max-w-full object-contain p-3">
                    <input type="file" name="image" accept="image/*" class="hidden"
                           @change="thumbPreview = URL.createObjectURL($event.target.files[0])">
                </label>
                @error('image') <p class="text-xs text-red-500 mt-2">{{ $message }}</p> @enderror
            </div>

            <div class="side-card reveal card-hover bg-white p-7 border border-slate-100 rounded-2xl" style="transition-delay:.1s">
                <p class="font-semibold text-brand-dark text-sm mb-5">Detail Proyek</p>

                <div class="space-y-5">
                    <div>
                        <label class="text-xs font-medium text-slate-500 mb-2.5 block">Kategori</label>
                        <div class="dropdown-wrap" @click.outside="categoryOpen = false">
                            <input type="hidden" name="category_id" :value="categoryId">
                            <button type="button" @click="categoryOpen = !categoryOpen; statusOpen = false"
                                    class="dropdown-trigger flex items-center gap-3 px-4 py-3.5" :class="categoryOpen && 'is-open'">
                                <i class="fa-solid fa-layer-group text-slate-400 text-xs"></i>
                                <span class="flex-1 text-sm text-left truncate" :class="categoryId ? 'text-brand-dark font-medium' : 'text-slate-400'" x-text="categoryLabel()"></span>
                                <i class="fa-solid fa-chevron-down dropdown-chevron text-xs"></i>
                            </button>
                            <div x-show="categoryOpen" x-cloak
                                 x-transition:enter="transition ease-out duration-150"
                                 x-transition:enter-start="opacity-0 scale-95 -translate-y-1"
                                 x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                                 x-transition:leave="transition ease-in duration-100"
                                 x-transition:leave-start="opacity-100 scale-100"
                                 x-transition:leave-end="opacity-0 scale-95"
                                 class="dropdown-panel absolute mt-2 w-full z-20">
                                <div class="dropdown-list">
                                    @forelse($categories as $cat)
                                        <button type="button" @click="categoryId = '{{ $cat->id }}'; categoryOpen = false"
                                                class="dropdown-option flex items-center justify-between gap-2 px-4 py-3 text-sm"
                                                :class="categoryId === '{{ $cat->id }}' ? 'is-selected' : ''">
                                            <span>{{ $cat->name }}</span>
                                            <i class="fa-solid fa-check dropdown-check text-xs" x-show="categoryId === '{{ $cat->id }}'"></i>
                                        </button>
                                    @empty
                                        <p class="text-xs text-slate-400 px-4 py-3">Belum ada kategori.</p>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>

                    <div>
                        <label class="text-xs font-medium text-slate-500 mb-2.5 block">Client</label>
                        <div class="field-ring flex items-center gap-3 px-4">
                            <i class="fa-solid fa-building text-slate-400 text-xs"></i>
                            <input type="text" name="client" value="{{ old('client', $portfolio?->client) }}"
                                   placeholder="Nama klien" class="w-full bg-transparent border-0 focus:ring-0 text-sm py-3">
                        </div>
                        @error('client') <p class="text-xs text-red-500 mt-2">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="text-xs font-medium text-slate-500 mb-2.5 block">Tanggal Proyek</label>
                        <div class="field-ring flex items-center gap-3 px-4">
                            <i class="fa-solid fa-calendar text-slate-400 text-xs"></i>
                            <input type="date" name="project_date"
                                   value="{{ old('project_date', $portfolio?->project_date ? \Carbon\Carbon::parse($portfolio->project_date)->format('Y-m-d') : '') }}"
                                   class="w-full bg-transparent border-0 focus:ring-0 text-sm py-3">
                        </div>
                        @error('project_date') <p class="text-xs text-red-500 mt-2">{{ $message }}</p> @enderror
                    </div>
                </div>
            </div>

            <div class="side-card reveal card-hover bg-white p-7 border border-slate-100 rounded-2xl" style="transition-delay:.15s">
                <p class="font-semibold text-brand-dark text-sm mb-5 flex items-center gap-2">
                    <i class="fa-solid fa-sliders text-brand-mint"></i> Status Publikasi
                </p>
                <div class="dropdown-wrap" @click.outside="statusOpen = false">
                    <input type="hidden" name="status" :value="status">
                    <button type="button" @click="statusOpen = !statusOpen; categoryOpen = false"
                            class="dropdown-trigger flex items-center gap-3 px-4 py-3.5" :class="statusOpen && 'is-open'">
                        <span class="h-2.5 w-2.5 rounded-full" :class="status === 'published' ? 'bg-emerald-500' : 'bg-amber-400'"></span>
                        <span class="flex-1 text-sm text-left text-brand-dark font-medium truncate" x-text="status === 'published' ? 'Published' : 'Draft'"></span>
                        <i class="fa-solid fa-chevron-down dropdown-chevron text-xs"></i>
                    </button>
                    <div x-show="statusOpen" x-cloak
                         x-transition:enter="transition ease-out duration-150"
                         x-transition:enter-start="opacity-0 scale-95 -translate-y-1"
                         x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                         x-transition:leave="transition ease-in duration-100"
                         x-transition:leave-start="opacity-100 scale-100"
                         x-transition:leave-end="opacity-0 scale-95"
                         class="dropdown-panel absolute mt-2 w-full z-20">
                        <div class="dropdown-list">
                            <button type="button" @click="status = 'draft'; statusOpen = false"
                                    class="dropdown-option flex items-center gap-3 px-4 py-3 text-sm" :class="status === 'draft' ? 'is-selected' : ''">
                                <span class="h-2.5 w-2.5 rounded-full bg-amber-400"></span> Draft
                            </button>
                            <button type="button" @click="status = 'published'; statusOpen = false"
                                    class="dropdown-option flex items-center gap-3 px-4 py-3 text-sm" :class="status === 'published' ? 'is-selected' : ''">
                                <span class="h-2.5 w-2.5 rounded-full bg-emerald-500"></span> Published
                            </button>
                        </div>
                    </div>
                </div>
                <p class="text-[11px] text-slate-300 mt-3">Draft tidak akan tampil di website publik.</p>
            </div>
        </div>
    </div>

    <div class="reveal card-hover flex justify-end gap-3 bg-white rounded-2xl shadow-sm border border-slate-100 px-8 py-6" style="transition-delay:.25s">
        <a href="{{ route('admin.portfolios.index') }}" class="btn-ghost px-5 py-2.5 text-sm font-medium text-slate-500">
            {{ $portfolio ? 'Batal' : 'Kembali' }}
        </a>
        <button type="submit" class="btn-fill px-6 py-2.5 rounded-lg text-sm font-semibold text-white bg-brand-mint">
            <span class="fill-layer bg-brand-teal"></span>
            <span class="btn-label">
                <i class="fa-solid fa-floppy-disk mr-2"></i>{{ $portfolio ? 'Simpan Perubahan' : 'Simpan & Lanjutkan' }}
            </span>
        </button>
    </div>
</div>

<script>
    function portfolioForm() {
        return {
            iconOptions: [
                'fa-plug', 'fa-shield-halved', 'fa-gauge-high', 'fa-database',
                'fa-cloud', 'fa-code', 'fa-mobile-screen', 'fa-palette',
                'fa-chart-line', 'fa-gears', 'fa-lock', 'fa-globe',
                'fa-server', 'fa-bug', 'fa-rocket', 'fa-layer-group',
            ],
            thumbPreview: null,
            existingImage: @js($portfolio?->image ? asset('storage/'.$portfolio->image) : ''),

            existingGallery: @js(collect($portfolio?->gallery ?? [])->map(fn($p) => ['path' => $p, 'url' => asset('storage/'.$p)])->values()),
            newGalleryFiles: [],

            categoryId: '{{ old('category_id', $portfolio?->category_id) }}',
            categoryOpen: false,
            status: '{{ old('status', $portfolio?->status ?? 'draft') }}',
            statusOpen: false,
            requirements: @js(old('requirements', $portfolio?->requirements ?? [''])),
            solutions: @js(old('solutions', $portfolio?->solutions ?? [])),
            categoryNames: @js($categories->pluck('name', 'id')),

            categoryLabel() {
                if (!this.categoryId) return 'Pilih kategori...';
                return this.categoryNames[this.categoryId] || 'Pilih kategori...';
            },

            handleGallery(e) {
                Array.from(e.target.files).forEach(file => {
                    this.newGalleryFiles.push({ file, url: URL.createObjectURL(file) });
                });
                this.syncGalleryInput();
            },

            removeNewGalleryFile(index) {
                this.newGalleryFiles.splice(index, 1);
                this.syncGalleryInput();
            },

            syncGalleryInput() {
                const dt = new DataTransfer();
                this.newGalleryFiles.forEach(item => dt.items.add(item.file));
                this.$refs.galleryInput.files = dt.files;
                this.$refs.galleryInput.name = 'gallery[]';
            },
        };
    }
</script>