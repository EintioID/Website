{{-- resources/views/admin/webinars/edit.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <div>
            <p class="text-xs text-slate-400 mb-1.5">Beranda / Blog & Artikel / Webinar / Edit</p>
            <h2 class="text-xl font-bold text-brand-dark tracking-tight">Edit Webinar</h2>
        </div>

        <div class="flex items-center gap-5">
            <button type="button" class="notif-btn relative p-2 rounded-full">
                <i class="fa-solid fa-bell text-slate-500 text-lg notif-icon"></i>
                <span class="absolute top-1.5 right-1.5 h-2 w-2 rounded-full bg-red-500 animate-ping"></span>
                <span class="absolute top-1.5 right-1.5 h-2 w-2 rounded-full bg-red-500"></span>
            </button>
            <div class="flex items-center gap-3 pl-4 border-l border-slate-200">
                <div class="h-9 w-9 rounded-full bg-brand-mint flex items-center justify-center text-white text-sm font-semibold">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
                <div class="text-sm hidden sm:block text-left">
                    <p class="font-medium text-brand-dark leading-none">{{ Auth::user()->name }}</p>
                    <p class="text-slate-400 text-xs mt-1">Superadmin</p>
                </div>
            </div>
        </div>
    </x-slot>

    @include('admin.webinars.partials.styles')

    <div x-data="webinarForm()" class="space-y-6 w-full">

        @if ($errors->any())
            <div class="bg-red-50 border border-red-200 text-red-600 px-5 py-3.5 rounded-xl text-sm">
                <p class="font-semibold mb-1">Terjadi kesalahan input:</p>
                <ul class="list-disc list-inside space-y-0.5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('admin.webinars.update', $webinar) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="reveal card-hover bg-white rounded-2xl shadow-sm border border-slate-100 px-8 py-7">

                <div class="flex items-center justify-between mb-6 flex-wrap gap-4">
                    <div>
                        <h3 class="font-bold text-brand-dark text-lg">Edit Webinar</h3>
                        <p class="text-sm text-slate-400 mt-1">Perbarui informasi webinar.</p>
                    </div>
                    <div class="flex items-center gap-3">
                        <a href="{{ route('admin.webinars.index') }}"
                           class="btn-ghost px-5 py-2.5 rounded-lg text-sm font-medium text-slate-500 border border-slate-200">
                            Batal
                        </a>
                        <button type="submit" class="btn-fill inline-flex items-center gap-2 px-5 py-2.5 rounded-lg text-sm font-semibold text-white bg-brand-mint">
                            <span class="fill-layer bg-brand-teal"></span>
                            <span class="btn-label">Simpan Perubahan</span>
                        </button>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                    {{-- KOLOM 1 --}}
                    <div class="space-y-5">
                        <h4 class="font-bold text-brand-dark text-sm uppercase tracking-wide text-slate-400">Informasi Dasar</h4>

                        <div>
                            <label class="block text-sm font-medium text-brand-dark mb-2">Judul Webinar <span class="text-red-500">*</span></label>
                            <div class="field-ring flex items-center px-4">
                                <input type="text" name="title" x-model="title" @input="generateSlug()"
                                       value="{{ old('title', $webinar->title) }}" placeholder="Masukkan judul webinar"
                                       class="w-full border-0 focus:ring-0 text-sm py-2.5 bg-transparent" required>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-brand-dark mb-2">Slug</label>
                            <div class="field-ring flex items-center px-4 bg-slate-50">
                                <input type="text" x-model="slug" readonly
                                       class="w-full border-0 focus:ring-0 text-sm py-2.5 bg-transparent text-slate-400">
                            </div>
                            <p class="text-xs text-slate-400 mt-1.5">Otomatis dibentuk dari judul.</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-brand-dark mb-2">Tipe Webinar <span class="text-red-500">*</span></label>
                            <div class="flex items-center gap-6">
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="radio" name="type" value="live" {{ old('type', $webinar->type) === 'live' ? 'checked' : '' }}
                                           class="h-4 w-4 text-brand-mint focus:ring-brand-mint border-slate-300">
                                    <span class="text-sm text-slate-600">Live Webinar</span>
                                </label>
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="radio" name="type" value="recorded" {{ old('type', $webinar->type) === 'recorded' ? 'checked' : '' }}
                                           class="h-4 w-4 text-brand-mint focus:ring-brand-mint border-slate-300">
                                    <span class="text-sm text-slate-600">Pre-recorded</span>
                                </label>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-brand-dark mb-2">Deskripsi Singkat <span class="text-red-500">*</span></label>
                            <div class="field-ring px-4">
                                <textarea name="short_description" x-model="shortDescription" maxlength="200" rows="4"
                                          class="w-full border-0 focus:ring-0 text-sm py-2.5 bg-transparent resize-none">{{ old('short_description', $webinar->short_description) }}</textarea>
                            </div>
                            <p class="text-xs text-slate-400 mt-1.5 text-right" x-text="shortDescription.length + ' / 200'"></p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-brand-dark mb-2">Deskripsi Lengkap</label>
                            <div class="field-ring px-4">
                                <textarea name="description" rows="5"
                                          class="w-full border-0 focus:ring-0 text-sm py-2.5 bg-transparent resize-none">{{ old('description', $webinar->description) }}</textarea>
                            </div>
                        </div>
                    </div>

                    {{-- KOLOM 2 --}}
                    <div class="space-y-5">
                        <h4 class="font-bold text-brand-dark text-sm uppercase tracking-wide text-slate-400">Detail Webinar</h4>

                        <div class="grid grid-cols-2 gap-3">
                            <div>
                                <label class="block text-sm font-medium text-brand-dark mb-2">Tanggal <span class="text-red-500">*</span></label>
                                <div class="field-ring flex items-center px-4">
                                    <i class="fa-regular fa-calendar text-slate-400 text-sm field-icon mr-2"></i>
                                    <input type="date" name="webinar_date"
                                           value="{{ old('webinar_date', $webinar->webinar_date?->format('Y-m-d')) }}"
                                           class="w-full border-0 focus:ring-0 text-sm py-2.5 bg-transparent" required>
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-brand-dark mb-2">Waktu <span class="text-red-500">*</span></label>
                                <div class="field-ring flex items-center px-4">
                                    <i class="fa-regular fa-clock text-slate-400 text-sm field-icon mr-2"></i>
                                    <input type="text" name="webinar_time" value="{{ old('webinar_time', $webinar->webinar_time) }}"
                                           placeholder="10.00 - 12.00"
                                           class="w-full border-0 focus:ring-0 text-sm py-2.5 bg-transparent" required>
                                </div>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-brand-dark mb-2">Durasi</label>
                            <div class="field-ring flex items-center px-4">
                                <input type="text" name="duration" value="{{ old('duration', $webinar->duration) }}"
                                       placeholder="Contoh: 2 jam"
                                       class="w-full border-0 focus:ring-0 text-sm py-2.5 bg-transparent">
                            </div>
                        </div>

                        <div class="dropdown-wrap" @click.outside="platformOpen = false">
                            <label class="block text-sm font-medium text-brand-dark mb-2">Platform <span class="text-red-500">*</span></label>
                            <input type="hidden" name="platform" x-model="platform">
                            <button type="button" @click="platformOpen = !platformOpen"
                                    class="dropdown-trigger flex items-center gap-3 px-4 py-2.5 text-sm" :class="platformOpen && 'is-open'">
                                <span class="flex-1 text-left truncate text-slate-600" x-text="platform || 'Pilih platform'"></span>
                                <i class="fa-solid fa-chevron-down dropdown-chevron text-xs"></i>
                            </button>
                            <div x-show="platformOpen" x-cloak
                                 x-transition:enter="transition ease-out duration-150"
                                 x-transition:enter-start="opacity-0 scale-95 -translate-y-1"
                                 x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                                 class="dropdown-panel absolute mt-2 w-full bg-white z-20">
                                <div class="dropdown-list">
                                    @foreach (['Zoom', 'Google Meet', 'Microsoft Teams', 'YouTube Live', 'Lainnya'] as $p)
                                        <button type="button" @click="platform = '{{ $p }}'; platformOpen = false"
                                                class="dropdown-option flex items-center justify-between gap-2 px-3 py-2.5 text-sm" :class="platform === '{{ $p }}' ? 'is-selected' : ''">
                                            <span>{{ $p }}</span>
                                            <i class="fa-solid fa-check dropdown-check text-xs" x-show="platform === '{{ $p }}'"></i>
                                        </button>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-brand-dark mb-2">Link / Meeting URL <span class="text-red-500">*</span></label>
                            <div class="field-ring flex items-center px-4">
                                <i class="fa-solid fa-link text-slate-400 text-sm field-icon mr-2"></i>
                                <input type="url" name="link" value="{{ old('link', $webinar->link) }}"
                                       class="w-full border-0 focus:ring-0 text-sm py-2.5 bg-transparent" required>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-brand-dark mb-2">Kuota Peserta</label>
                            <div class="field-ring flex items-center px-4">
                                <i class="fa-solid fa-users text-slate-400 text-sm field-icon mr-2"></i>
                                <input type="number" name="quota" value="{{ old('quota', $webinar->quota) }}" min="1"
                                       class="w-full border-0 focus:ring-0 text-sm py-2.5 bg-transparent">
                            </div>
                            <p class="text-xs text-slate-400 mt-1.5">Kosongkan jika tidak dibatasi.</p>
                        </div>

                        <div class="dropdown-wrap" @click.outside="statusOpen = false">
                            <label class="block text-sm font-medium text-brand-dark mb-2">Status <span class="text-red-500">*</span></label>
                            <input type="hidden" name="status" x-model="status">
                            <button type="button" @click="statusOpen = !statusOpen"
                                    class="dropdown-trigger flex items-center gap-3 px-4 py-2.5 text-sm" :class="statusOpen && 'is-open'">
                                <span class="flex-1 text-left truncate text-slate-600" x-text="statusLabel()"></span>
                                <i class="fa-solid fa-chevron-down dropdown-chevron text-xs"></i>
                            </button>
                            <div x-show="statusOpen" x-cloak
                                 x-transition:enter="transition ease-out duration-150"
                                 x-transition:enter-start="opacity-0 scale-95 -translate-y-1"
                                 x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                                 class="dropdown-panel absolute mt-2 w-full bg-white z-20">
                                <div class="dropdown-list">
                                    @foreach (['draft' => 'Draft', 'scheduled' => 'Scheduled', 'published' => 'Published'] as $key => $label)
                                        <button type="button" @click="status = '{{ $key }}'; statusOpen = false"
                                                class="dropdown-option flex items-center justify-between gap-2 px-3 py-2.5 text-sm" :class="status === '{{ $key }}' ? 'is-selected' : ''">
                                            <span>{{ $label }}</span>
                                            <i class="fa-solid fa-check dropdown-check text-xs" x-show="status === '{{ $key }}'"></i>
                                        </button>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- KOLOM 3 --}}
                    <div class="space-y-5">
                        <h4 class="font-bold text-brand-dark text-sm uppercase tracking-wide text-slate-400">Media & Klasifikasi</h4>

                        <div>
                            <label class="block text-sm font-medium text-brand-dark mb-2">Gambar Cover</label>
                            <label class="upload-box flex flex-col items-center justify-center gap-2 border-2 border-dashed border-slate-200 rounded-xl py-10 px-4 cursor-pointer"
                                   :class="thumbPreview && 'border-brand-mint'">
                                <template x-if="!thumbPreview">
                                    <div class="flex flex-col items-center gap-2">
                                        <div class="h-11 w-11 rounded-full bg-brand-mint/10 flex items-center justify-center">
                                            <i class="fa-solid fa-cloud-arrow-up upload-icon text-brand-mint"></i>
                                        </div>
                                        <p class="text-sm font-medium text-slate-600">Upload gambar cover</p>
                                        <p class="text-xs text-slate-400">atau drag & drop di sini</p>
                                        <span class="text-xs font-semibold text-brand-mint mt-1">Ganti Gambar</span>
                                    </div>
                                </template>
                                <template x-if="thumbPreview">
                                    <img :src="thumbPreview" class="w-full h-32 object-cover rounded-lg">
                                </template>
                                <input type="file" name="thumbnail" accept="image/*" class="hidden" @change="previewThumb($event)">
                            </label>
                            @if($webinar->thumbnail)
                                <p class="text-xs text-slate-400 mt-1.5">Kosongkan jika tidak ingin mengganti gambar cover.</p>
                            @endif
                        </div>

                        <div class="dropdown-wrap" @click.outside="categoryOpen = false">
                            <label class="block text-sm font-medium text-brand-dark mb-2">Kategori <span class="text-red-500">*</span></label>
                            <input type="hidden" name="category" x-model="category">
                            <button type="button" @click="categoryOpen = !categoryOpen"
                                    class="dropdown-trigger flex items-center gap-3 px-4 py-2.5 text-sm" :class="categoryOpen && 'is-open'">
                                <span class="flex-1 text-left truncate text-slate-600" x-text="category || 'Pilih kategori'"></span>
                                <i class="fa-solid fa-chevron-down dropdown-chevron text-xs"></i>
                            </button>
                            <div x-show="categoryOpen" x-cloak
                                 x-transition:enter="transition ease-out duration-150"
                                 x-transition:enter-start="opacity-0 scale-95 -translate-y-1"
                                 x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                                 class="dropdown-panel absolute mt-2 w-full bg-white z-20">
                                <div class="dropdown-list">
                                    @foreach (['Technology', 'Bisnis', 'Marketing', 'Design', 'Development', 'Lainnya'] as $c)
                                        <button type="button" @click="category = '{{ $c }}'; categoryOpen = false"
                                                class="dropdown-option flex items-center justify-between gap-2 px-3 py-2.5 text-sm" :class="category === '{{ $c }}' ? 'is-selected' : ''">
                                            <span>{{ $c }}</span>
                                            <i class="fa-solid fa-check dropdown-check text-xs" x-show="category === '{{ $c }}'"></i>
                                        </button>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-brand-dark mb-2">Tag</label>
                            <input type="hidden" name="tags" x-model="tagsValue">
                            <div class="field-ring flex flex-wrap items-center gap-2 px-3 py-2">
                                <template x-for="(tag, i) in tags" :key="i">
                                    <span class="inline-flex items-center gap-1.5 bg-brand-mint/10 text-brand-mint text-xs font-medium px-2.5 py-1 rounded-full">
                                        <span x-text="tag"></span>
                                        <i class="fa-solid fa-xmark cursor-pointer text-[10px]" @click="removeTag(i)"></i>
                                    </span>
                                </template>
                                <input type="text" x-model="tagInput" @keydown.enter.prevent="addTag()"
                                       placeholder="Tambah tag..."
                                       class="flex-1 min-w-[100px] border-0 focus:ring-0 text-sm py-1 bg-transparent">
                            </div>
                            <p class="text-xs text-slate-400 mt-1.5">Tekan Enter untuk menambahkan.</p>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script>
        function webinarForm() {
            return {
                title: @js(old('title', $webinar->title)),
                slug: @js(old('title', $webinar->title) ? Str::slug(old('title', $webinar->title)) : ''),
                shortDescription: @js(old('short_description', $webinar->short_description)),
                platform: @js(old('platform', $webinar->platform)),
                status: @js(old('status', $webinar->status)),
                category: @js(old('category', $webinar->category)),
                tags: @js(old('tags') ? explode(',', old('tags')) : ($webinar->tags ? explode(',', $webinar->tags) : [])),
                tagInput: '',
                tagsValue: @js(old('tags', $webinar->tags)),
                thumbPreview: @js($webinar->thumbnail ? Storage::url($webinar->thumbnail) : null),
                platformOpen: false,
                statusOpen: false,
                categoryOpen: false,

                generateSlug() {
                    this.slug = this.title.toLowerCase().trim()
                        .replace(/[^a-z0-9\s-]/g, '')
                        .replace(/\s+/g, '-');
                },
                statusLabel() {
                    const map = { draft: 'Draft', scheduled: 'Scheduled', published: 'Published' };
                    return map[this.status] || 'Pilih status';
                },
                addTag() {
                    const val = this.tagInput.trim();
                    if (val && !this.tags.includes(val)) {
                        this.tags.push(val);
                        this.tagsValue = this.tags.join(',');
                    }
                    this.tagInput = '';
                },
                removeTag(i) {
                    this.tags.splice(i, 1);
                    this.tagsValue = this.tags.join(',');
                },
                previewThumb(e) {
                    const file = e.target.files[0];
                    if (file) this.thumbPreview = URL.createObjectURL(file);
                },
            }
        }
        document.addEventListener('DOMContentLoaded', () => {
            const io = new IntersectionObserver((entries) => {
                entries.forEach((e) => { if (e.isIntersecting) { e.target.classList.add('is-visible'); io.unobserve(e.target); } });
            }, { threshold: 0.1, rootMargin: '0px 0px -30px 0px' });
            document.querySelectorAll('.reveal').forEach((el) => io.observe(el));
        });
    </script>
</x-app-layout>