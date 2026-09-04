{{-- resources/views/admin/blog-posts/edit.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <div>
            <p class="text-xs text-slate-400 mb-1.5">Beranda / Blog & Artikel / Artikel / Edit</p>
            <h2 class="text-xl font-bold text-brand-dark tracking-tight">Edit Artikel</h2>
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

    @include('admin.blog-posts.partials.styles')

    <div x-data="articleForm()" class="space-y-6 w-full">

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

        <form method="POST" action="{{ route('admin.blog-posts.update', $blogPost) }}" enctype="multipart/form-data" x-ref="mainForm">
            @csrf
            @method('PUT')
            <input type="hidden" name="action" x-model="action">

            <div class="reveal form-modal-card bg-white shadow-sm border border-slate-100 px-8 py-7">

                {{-- ===== HEADER ===== --}}
                <div class="flex items-center justify-between mb-6 flex-wrap gap-4 pb-5 border-b border-slate-100">
                    <div>
                        <h3 class="font-bold text-brand-dark text-lg">Edit Artikel</h3>
                        <p class="text-sm text-slate-400 mt-1">Perbarui informasi artikel.</p>
                    </div>
                    <div class="flex items-center gap-3">
                        <a href="{{ route('admin.blog-posts.show', $blogPost) }}"
                           class="btn-ghost px-5 py-2.5 rounded-lg text-sm font-medium text-slate-500 border border-slate-200">
                            <i class="fa-regular fa-eye mr-1.5"></i> Lihat Detail
                        </a>
                        <a href="{{ route('admin.blog-posts.index') }}"
                           class="btn-ghost px-5 py-2.5 rounded-lg text-sm font-medium text-slate-500 border border-slate-200">
                            Batal
                        </a>
                        <button type="button" @click="submitForm('draft')"
                                class="btn-ghost px-5 py-2.5 rounded-lg text-sm font-medium text-slate-500 border border-slate-200">
                            Simpan Draft
                        </button>
                        <button type="button" @click="submitForm('publish')"
                                class="btn-fill inline-flex items-center gap-2 px-5 py-2.5 rounded-lg text-sm font-semibold text-white bg-brand-mint">
                            <span class="fill-layer bg-brand-teal"></span>
                            <span class="btn-label">Simpan Perubahan</span>
                        </button>
                    </div>
                </div>

                {{-- ===== INFORMASI DASAR ===== --}}
                <h4 class="font-bold text-brand-dark text-sm uppercase tracking-wide text-slate-400 mb-5">Informasi Dasar</h4>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-6">
                    {{-- Kolom kiri --}}
                    <div class="space-y-5">
                        <div>
                            <label class="block text-sm font-medium text-brand-dark mb-2">Judul Artikel <span class="text-red-500">*</span></label>
                            <div class="field-ring flex items-center px-4">
                                <input type="text" name="title" x-model="title" @input="generateSlug()"
                                       placeholder="Masukkan judul artikel"
                                       class="w-full border-0 focus:ring-0 text-sm py-2.5 bg-transparent">
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-brand-dark mb-2">Slug</label>
                            <div class="field-ring flex items-center px-4 bg-slate-50">
                                <input type="text" x-model="slug" readonly
                                       class="w-full border-0 focus:ring-0 text-sm py-2.5 bg-transparent text-slate-400">
                            </div>
                            <p class="text-xs text-slate-400 mt-1.5">Otomatis dihasilkan dari judul.</p>
                        </div>

                        <div class="dropdown-wrap" @click.outside="categoryOpen = false">
                            <label class="block text-sm font-medium text-brand-dark mb-2">Kategori <span class="text-red-500">*</span></label>
                            <input type="hidden" name="category_id" x-model="categoryId">
                            <button type="button" @click="categoryOpen = !categoryOpen; authorOpen = false"
                                    class="dropdown-trigger flex items-center gap-3 px-4 py-2.5 text-sm" :class="categoryOpen && 'is-open'">
                                <span class="flex-1 text-left truncate text-slate-600" x-text="categoryLabel()"></span>
                                <i class="fa-solid fa-chevron-down dropdown-chevron text-xs"></i>
                            </button>
                            <div x-show="categoryOpen" x-cloak
                                 x-transition:enter="transition ease-out duration-150"
                                 x-transition:enter-start="opacity-0 scale-95 -translate-y-1"
                                 x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                                 class="dropdown-panel absolute mt-2 w-full bg-white z-20">
                                <div class="dropdown-list">
                                    @foreach ($categories as $cat)
                                        <button type="button" @click="categoryId = '{{ $cat->id }}'; categoryOpen = false"
                                                class="dropdown-option flex items-center justify-between gap-2 px-3 py-2.5 text-sm" :class="categoryId == '{{ $cat->id }}' ? 'is-selected' : ''">
                                            <span>{{ $cat->name }}</span>
                                            <i class="fa-solid fa-check dropdown-check text-xs" x-show="categoryId == '{{ $cat->id }}'"></i>
                                        </button>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div>
                            <div class="flex items-center justify-between mb-2">
                                <label class="block text-sm font-medium text-brand-dark">
                                    Penulis <span class="text-red-500" x-show="!isAnonymous">*</span>
                                </label>
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="checkbox" name="is_anonymous" value="1" x-model="isAnonymous"
                                           class="h-3.5 w-3.5 text-brand-mint focus:ring-brand-mint border-slate-300 rounded">
                                    <span class="text-xs text-slate-500">Tulis sebagai Anonim</span>
                                </label>
                            </div>

                            <div class="dropdown-wrap" :class="isAnonymous && 'opacity-40 pointer-events-none'" @click.outside="authorOpen = false">
                                <input type="hidden" name="author_id" x-model="authorId">
                                <button type="button" @click="authorOpen = !authorOpen; categoryOpen = false"
                                        class="dropdown-trigger flex items-center gap-3 px-4 py-2.5 text-sm" :class="authorOpen && 'is-open'"
                                        :disabled="isAnonymous">
                                    <span class="flex-1 text-left truncate text-slate-600" x-text="isAnonymous ? 'Anonim' : authorLabel()"></span>
                                    <i class="fa-solid fa-chevron-down dropdown-chevron text-xs"></i>
                                </button>
                                <div x-show="authorOpen" x-cloak
                                     x-transition:enter="transition ease-out duration-150"
                                     x-transition:enter-start="opacity-0 scale-95 -translate-y-1"
                                     x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                                     class="dropdown-panel absolute mt-2 w-full bg-white z-20">
                                    <div class="dropdown-list">
                                        @foreach ($authors as $author)
                                            <button type="button" @click="authorId = '{{ $author->id }}'; authorOpen = false"
                                                    class="dropdown-option flex items-center justify-between gap-2 px-3 py-2.5 text-sm" :class="authorId == '{{ $author->id }}' ? 'is-selected' : ''">
                                                <span>{{ $author->name }}</span>
                                                <i class="fa-solid fa-check dropdown-check text-xs" x-show="authorId == '{{ $author->id }}'"></i>
                                            </button>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center justify-between px-4 py-3.5 bg-slate-50 rounded-xl">
                            <div>
                                <p class="text-sm font-medium text-brand-dark">Featured</p>
                                <p class="text-xs text-slate-400">Tampilkan di halaman utama</p>
                            </div>
                            <label class="toggle-switch">
                                <input type="checkbox" name="featured" value="1" x-model="featured">
                                <span class="toggle-slider"></span>
                            </label>
                        </div>

                        <div class="px-4 py-3.5 bg-slate-50 rounded-xl">
                            <p class="text-sm font-medium text-brand-dark mb-1">Status Saat Ini</p>
                            @if ($blogPost->is_published)
                                <span class="badge inline-flex items-center text-xs font-bold text-brand-mint"><span class="status-dot h-1.5 w-1.5 rounded-full bg-brand-mint mr-1.5"></span>Published</span>
                                <p class="text-xs text-slate-400 mt-1">Dipublikasikan pada {{ $blogPost->published_at?->translatedFormat('d M Y, H:i') }}</p>
                            @else
                                <span class="badge inline-flex items-center text-xs font-bold text-slate-400"><span class="status-dot h-1.5 w-1.5 rounded-full bg-slate-300 mr-1.5"></span>Draft</span>
                            @endif
                        </div>
                    </div>

                    {{-- Kolom kanan --}}
                    <div class="space-y-5">
                        <div>
                            <label class="block text-sm font-medium text-brand-dark mb-2">Gambar Cover</label>
                            <div class="upload-box flex flex-col items-center justify-center gap-2 border-2 border-dashed border-slate-200 rounded-xl py-8 px-4 cursor-pointer overflow-hidden"
                                 :class="thumbPreview && 'border-brand-mint p-0'"
                                 @click="!thumbPreview && $refs.thumbInput.click()">
                                <template x-if="!thumbPreview">
                                    <div class="flex flex-col items-center gap-2">
                                        <div class="h-11 w-11 rounded-full bg-brand-mint/10 flex items-center justify-center">
                                            <i class="fa-solid fa-cloud-arrow-up upload-icon text-brand-mint"></i>
                                        </div>
                                        <p class="text-sm font-medium text-slate-600">Upload gambar cover</p>
                                        <p class="text-xs text-slate-400">Rekomendasi ukuran 1200x630px</p>
                                        <button type="button" @click.stop="$refs.thumbInput.click()"
                                                class="text-xs font-semibold text-brand-mint mt-1">Pilih Gambar</button>
                                    </div>
                                </template>
                                <div x-show="thumbPreview" class="relative w-full">
                                    <img :src="thumbPreview" class="w-full h-44 object-cover">
                                    <button type="button" @click.stop="removeThumb()"
                                            class="absolute top-2 right-2 h-7 w-7 rounded-full bg-brand-dark/70 text-white flex items-center justify-center">
                                        <i class="fa-solid fa-xmark text-xs"></i>
                                    </button>
                                    <button type="button" @click.stop="$refs.thumbInput.click()"
                                            class="absolute bottom-2 right-2 text-xs font-semibold text-white bg-brand-dark/70 px-2.5 py-1 rounded-md">Ganti Gambar</button>
                                </div>
                                <input type="file" name="thumbnail" x-ref="thumbInput" accept="image/*" class="hidden" @change="previewThumb($event)">
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-brand-dark mb-2">Ringkasan Singkat <span class="text-red-500">*</span></label>
                            <div class="field-ring px-4">
                                <textarea name="excerpt" x-model="excerpt" maxlength="200" rows="6"
                                          placeholder="Tulis ringkasan singkat artikel..."
                                          class="w-full border-0 focus:ring-0 text-sm py-2.5 bg-transparent resize-none"></textarea>
                            </div>
                            <p class="text-xs text-slate-400 mt-1.5 text-right" x-text="excerpt.length + ' / 200'"></p>
                        </div>
                    </div>
                </div>

                {{-- ===== ISI ARTIKEL (SECTIONS) ===== --}}
                <div class="pt-5 border-t border-slate-100">
                    <div class="flex items-center justify-between mb-4">
                        <h4 class="font-bold text-brand-dark text-sm uppercase tracking-wide text-slate-400">Isi Artikel</h4>

                        <div class="relative">
                            <button type="button" @click="addSectionMenuOpen = !addSectionMenuOpen"
                                    class="add-section-link text-sm font-semibold text-brand-mint flex items-center gap-1.5">
                                <i class="fa-solid fa-plus text-xs"></i> Tambah Section
                            </button>
                            <div x-show="addSectionMenuOpen" x-cloak @click.outside="addSectionMenuOpen = false"
                                 x-transition class="section-type-menu absolute right-0 mt-2 bg-white z-30">
                                <template x-for="(opt, i) in sectionTypeOptions" :key="opt.type">
                                    <button type="button" @click="addSection(opt.type)"
                                            class="section-type-option flex items-center gap-3 w-full px-4 py-2.5 text-sm text-left">
                                        <span class="section-type-num" x-text="(i + 1) + '.'"></span>
                                        <i :class="opt.icon" class="text-brand-mint w-4"></i>
                                        <span x-text="opt.label"></span>
                                    </button>
                                </template>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-2.5">
                        <template x-for="(section, index) in sections" :key="section.key">
                            <div>
                                <input type="hidden" :name="'sections['+index+'][type]'" x-model="section.type">
                                <input type="hidden" :name="'sections['+index+'][title]'" x-model="section.title">
                                <input type="hidden" :name="'sections['+index+'][badge]'" x-model="section.badge">
                                <input type="hidden" :name="'sections['+index+'][data]'" :value="JSON.stringify(section.data)">

                                <div class="section-item flex items-center gap-3 px-4 py-3.5"
                                     draggable="true"
                                     @dragstart="dragIndex = index"
                                     @dragover.prevent
                                     @drop="reorderSection(dragIndex, index)">
                                    <i class="fa-solid fa-grip-vertical section-grip"></i>
                                    <span class="section-num" x-text="String(index + 1).padStart(2, '0')"></span>
                                    <span class="section-type-chip" x-text="section.badge"></span>
                                    <span class="flex-1 text-sm font-medium text-brand-dark truncate" x-text="section.title || 'Tanpa judul'"></span>

                                    <div class="flex items-center gap-1">
                                        <button type="button" class="section-action-btn is-view" title="Lihat" @click="openSectionModal(index, 'edit')">
                                            <i class="fa-regular fa-eye text-sm"></i>
                                        </button>
                                        <button type="button" class="section-action-btn is-edit" title="Edit" @click="openSectionModal(index, 'edit')">
                                            <i class="fa-solid fa-pen text-sm"></i>
                                        </button>
                                        <button type="button" class="section-action-btn is-delete" title="Hapus" @click="removeSection(index)">
                                            <i class="fa-solid fa-trash text-sm"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </template>

                        <template x-if="sections.length === 0">
                            <div class="text-center py-10 text-sm text-slate-400">
                                Belum ada section. Klik "Tambah Section" untuk mulai menulis isi artikel.
                            </div>
                        </template>
                    </div>
                </div>

                {{-- ===== ZONA BAHAYA: HAPUS ARTIKEL ===== --}}
                <div class="pt-5 mt-5 border-t border-slate-100 flex items-center justify-between">
                    <div>
                        <p class="text-sm font-semibold text-red-500">Hapus Artikel</p>
                        <p class="text-xs text-slate-400">Artikel yang dihapus tidak dapat dikembalikan.</p>
                    </div>
                    <button type="button" @click="deleteModalOpen = true"
                            class="btn-ghost px-5 py-2.5 rounded-lg text-sm font-medium text-red-500 border border-red-200 hover:bg-red-50">
                        <i class="fa-solid fa-trash mr-1.5"></i> Hapus Artikel
                    </button>
                </div>
            </div>
        </form>

        {{-- MODAL KONFIRMASI DELETE ARTIKEL --}}
        <template x-teleport="body">
            <div x-show="deleteModalOpen" x-cloak style="display:none" class="modal-overlay flex items-center justify-center p-4">
                <div x-show="deleteModalOpen" x-transition.opacity @click="deleteModalOpen = false" class="absolute inset-0 bg-brand-dark/60 backdrop-blur-sm"></div>
                <div x-show="deleteModalOpen"
                     x-transition:enter="transition ease-out duration-250" x-transition:enter-start="opacity-0 scale-95 translate-y-4" x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                     x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                     class="modal-panel relative bg-white rounded-2xl shadow-2xl p-7 w-full max-w-sm text-center z-10">
                    <button type="button" @click="deleteModalOpen = false" class="modal-close-btn absolute top-4 right-4 h-7 w-7 text-slate-300">
                        <i class="fa-solid fa-xmark text-sm"></i>
                    </button>
                    <div class="modal-danger-icon h-14 w-14 rounded-full bg-red-50 text-red-500 flex items-center justify-center mx-auto mb-4">
                        <i class="fa-solid fa-trash text-lg"></i>
                    </div>
                    <p class="font-semibold text-brand-dark">Apakah anda yakin ingin menghapus artikel ini?</p>
                    <p class="text-xs text-slate-400 mt-1.5">Data yang dihapus tidak dapat dikembalikan.</p>
                    <div class="flex gap-3 mt-6">
                        <button type="button" @click="deleteModalOpen = false" class="btn-ghost flex-1 px-4 py-2.5 rounded-lg text-sm font-medium text-slate-500 border border-slate-200">Batal</button>
                        <form action="{{ route('admin.blog-posts.destroy', $blogPost) }}" method="POST" class="flex-1">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn-fill w-full px-4 py-2.5 rounded-lg text-sm font-semibold text-white bg-red-500">
                                <span class="fill-layer bg-red-600"></span>
                                <span class="btn-label mx-auto">Ya, Hapus</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </template>

        {{-- ===== MODAL EDIT SECTION + MODAL ITEM (berdampingan) ===== --}}
        <template x-teleport="body">
            <div x-show="sectionModalOpen" x-cloak style="display:none" class="modal-overlay flex items-center justify-center gap-4 p-4">
                <div @click="sectionModalOpen = false; itemModalOpen = false" class="absolute inset-0 bg-brand-dark/60 backdrop-blur-sm"></div>

                <template x-if="activeSectionIndex !== null">
                    <div class="modal-panel section-modal-panel relative bg-white rounded-2xl shadow-2xl p-7 w-full max-w-lg z-10">
                        <div class="flex items-center justify-between mb-5">
                            <h3 class="font-bold text-brand-dark text-base"
                                x-text="sectionModalMode === 'add'
                                    ? 'Tambah Section'
                                    : ('Edit Section: ' + String(activeSectionIndex + 1).padStart(2,'0') + ' • ' + (sections[activeSectionIndex].title || '(Belum ada judul)'))">
                            </h3>
                            <button type="button" @click="sectionModalOpen = false; itemModalOpen = false" class="modal-close-btn h-7 w-7 text-slate-300">
                                <i class="fa-solid fa-xmark text-sm"></i>
                            </button>
                        </div>

                        <div class="space-y-4 max-h-[65vh] overflow-y-auto pr-1">
                            <div>
                                <label class="block text-xs font-medium text-slate-400 mb-1.5">Badge (Optional)</label>
                                <span class="section-badge-chip" x-text="sections[activeSectionIndex].badge"></span>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-brand-dark mb-1.5">Judul Section <span class="text-red-500">*</span></label>
                                <div class="field-ring flex items-center px-4">
                                    <input type="text" x-model="sections[activeSectionIndex].title" placeholder="Judul section..."
                                           class="w-full border-0 focus:ring-0 text-sm py-2.5 bg-transparent">
                                </div>
                            </div>

                            <template x-if="sections[activeSectionIndex].type === 'description'">
                                <div>
                                    <label class="block text-sm font-medium text-brand-dark mb-1.5">Deskripsi <span class="text-red-500">*</span></label>
                                    <div class="field-ring px-4">
                                        <textarea x-model="sections[activeSectionIndex].data.description" rows="5" placeholder="Tulis deskripsi..."
                                                  class="w-full border-0 focus:ring-0 text-sm py-2.5 bg-transparent resize-none"></textarea>
                                    </div>
                                </div>
                            </template>

                            <template x-if="sections[activeSectionIndex].type === 'quote'">
                                <div class="space-y-4">
                                    <div>
                                        <label class="block text-sm font-medium text-brand-dark mb-1.5">Quote <span class="text-red-500">*</span></label>
                                        <div class="quote-box field-ring px-4">
                                            <i class="fa-solid fa-quote-left text-brand-mint text-xs mb-1"></i>
                                            <textarea x-model="sections[activeSectionIndex].data.quote" rows="3" placeholder="Tulis kutipan..."
                                                      class="w-full border-0 focus:ring-0 text-sm py-2 bg-transparent resize-none"></textarea>
                                        </div>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-brand-dark mb-1.5">Author (Optional)</label>
                                        <div class="field-ring flex items-center px-4">
                                            <input type="text" x-model="sections[activeSectionIndex].data.author" placeholder="Nama author..."
                                                   class="w-full border-0 focus:ring-0 text-sm py-2.5 bg-transparent">
                                        </div>
                                    </div>
                                </div>
                            </template>

                            <template x-if="['list','columns','benefits','timeline'].includes(sections[activeSectionIndex].type)">
                                <div>
                                    <div class="flex items-center justify-between mb-2">
                                        <label class="block text-sm font-medium text-brand-dark">
                                            <span x-text="itemLabel()"></span> <span class="text-red-500">*</span>
                                        </label>
                                        <button type="button" @click="openItemModal('add')" class="add-section-link text-xs font-semibold text-brand-mint flex items-center gap-1">
                                            <i class="fa-solid fa-plus text-[10px]"></i>
                                            <span x-text="itemAddLabel()"></span>
                                        </button>
                                    </div>

                                    <div class="space-y-2">
                                        <template x-for="(item, i) in (sections[activeSectionIndex].data.items || [])" :key="i">
                                            <div class="item-row flex items-center gap-3 px-3.5 py-2.5">
                                                <template x-if="sections[activeSectionIndex].type === 'timeline'">
                                                    <span class="item-row-num" x-text="String(i+1).padStart(2,'0')"></span>
                                                </template>
                                                <template x-if="sections[activeSectionIndex].type !== 'timeline'">
                                                    <span class="item-row-icon"><i :class="item.icon" class="text-sm"></i></span>
                                                </template>
                                                <div class="flex-1 min-w-0">
                                                    <p class="text-sm font-medium text-brand-dark truncate" x-text="item.title"></p>
                                                    <p class="text-xs text-slate-400 truncate" x-text="item.description"></p>
                                                </div>
                                                <button type="button" class="section-action-btn is-edit" @click="openItemModal('edit', i)"><i class="fa-solid fa-pen text-xs"></i></button>
                                                <button type="button" class="section-action-btn is-delete" @click="removeItem(i)"><i class="fa-solid fa-trash text-xs"></i></button>
                                            </div>
                                        </template>
                                        <template x-if="!(sections[activeSectionIndex].data.items || []).length">
                                            <p class="text-xs text-slate-400 text-center py-4">Belum ada item.</p>
                                        </template>
                                    </div>
                                </div>
                            </template>
                        </div>

                        <div class="flex justify-end gap-3 mt-6 pt-5 border-t border-slate-100">
                            <button type="button" @click="sectionModalOpen = false; itemModalOpen = false" class="btn-ghost px-5 py-2.5 rounded-lg text-sm font-medium text-slate-500 border border-slate-200">Batal</button>
                            <button type="button" @click="saveSectionModal()" class="btn-fill px-5 py-2.5 rounded-lg text-sm font-semibold text-white bg-brand-mint">
                                <span class="fill-layer bg-brand-teal"></span>
                                <span class="btn-label">Simpan Perubahan</span>
                            </button>
                        </div>
                    </div>
                </template>

                <div x-show="itemModalOpen" x-cloak style="display:none" x-transition
                     class="modal-panel item-modal-panel relative bg-white rounded-2xl shadow-2xl p-6 w-full max-w-sm z-20">
                    <div class="flex items-center justify-between mb-4">
                        <h4 class="font-bold text-brand-dark text-sm" x-text="itemModalMode === 'edit' ? 'Edit Item' : itemAddLabel()"></h4>
                        <button type="button" @click="closeItemModal()" class="modal-close-btn h-6 w-6 text-slate-300"><i class="fa-solid fa-xmark text-xs"></i></button>
                    </div>

                    <div class="space-y-4">
                        <template x-if="activeSectionIndex !== null && sections[activeSectionIndex].type !== 'timeline'">
                            <div>
                                <label class="block text-xs font-medium text-slate-400 mb-2">Icon <span class="text-red-500">*</span></label>
                                <div class="icon-grid">
                                    <template x-for="ic in iconOptions" :key="ic">
                                        <button type="button" @click="itemDraft.icon = ic" class="icon-grid-option" :class="itemDraft.icon === ic && 'is-selected'">
                                            <i :class="ic"></i>
                                        </button>
                                    </template>
                                </div>
                            </div>
                        </template>

                        <div>
                            <label class="block text-xs font-medium text-slate-400 mb-1.5">Judul <span class="text-red-500">*</span></label>
                            <div class="field-ring flex items-center px-3.5">
                                <input type="text" x-model="itemDraft.title" placeholder="Masukkan judul..." class="w-full border-0 focus:ring-0 text-sm py-2 bg-transparent">
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-medium text-slate-400 mb-1.5">Deskripsi <span class="text-red-500">*</span></label>
                            <div class="field-ring px-3.5">
                                <textarea x-model="itemDraft.description" rows="3" placeholder="Masukkan deskripsi..." class="w-full border-0 focus:ring-0 text-sm py-2 bg-transparent resize-none"></textarea>
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-medium text-slate-400 mb-1.5">Urutan</label>
                            <div class="field-ring flex items-center px-3.5">
                                <input type="number" min="1" x-model="itemDraft.order" class="w-full border-0 focus:ring-0 text-sm py-2 bg-transparent">
                            </div>
                            <p class="text-[11px] text-slate-400 mt-1">Menentukan posisi item ini dalam urutan.</p>
                        </div>
                    </div>

                    <div class="flex justify-end gap-3 mt-6">
                        <button type="button" @click="closeItemModal()" class="btn-ghost px-4 py-2 rounded-lg text-sm font-medium text-slate-500 border border-slate-200">Batal</button>
                        <button type="button" @click="saveItem()" class="btn-fill px-4 py-2 rounded-lg text-sm font-semibold text-white bg-brand-mint">
                            <span class="fill-layer bg-brand-teal"></span>
                            <span class="btn-label">Simpan</span>
                        </button>
                    </div>
                </div>
            </div>
        </template>
    </div>

    <script>
        function articleForm() {
            return {
                title: @js($blogPost->title),
                slug: @js($blogPost->slug),
                categoryId: @js((string) $blogPost->category_id),
                authorId: @js((string) $blogPost->author_id),
                isAnonymous: @js((bool) $blogPost->is_anonymous),
                excerpt: @js($blogPost->excerpt),
                featured: @js((bool) $blogPost->featured),
                publishType: 'now',
                action: 'draft',
                thumbPreview: @js($blogPost->thumbnail ? \Illuminate\Support\Facades\Storage::url($blogPost->thumbnail) : null),
                categories: {!! $categories->pluck('name', 'id')->toJson() !!},
                authors: {!! $authors->pluck('name', 'id')->toJson() !!},
                categoryOpen: false,
                authorOpen: false,
                deleteModalOpen: false,

                sections: @js($blogPost->sections->map(fn($s, $i) => [
                    'key' => $i + 1,
                    'type' => $s->type,
                    'badge' => $s->badge,
                    'title' => $s->title,
                    'data' => $s->data ?? [],
                ])->values()),
                sectionCounter: {{ $blogPost->sections->count() }},
                dragIndex: null,

                addSectionMenuOpen: false,
                sectionModalOpen: false,
                sectionModalMode: 'add',
                activeSectionIndex: null,

                itemModalOpen: false,
                itemModalMode: 'add',
                itemEditIndex: null,
                itemDraft: { icon: 'fa-solid fa-gear', title: '', description: '', order: 1 },

                iconOptions: [
                    'fa-solid fa-gear',
                    'fa-solid fa-layer-group',
                    'fa-solid fa-chart-bar',
                    'fa-solid fa-users',
                    'fa-solid fa-rocket',
                    'fa-solid fa-lightbulb',
                    'fa-regular fa-circle',
                    'fa-solid fa-globe',
                ],

                sectionTypeOptions: [
                    { type: 'description', label: 'Deskripsi', badge: 'Pengenal', icon: 'fa-solid fa-align-left' },
                    { type: 'list', label: 'List dengan Ikon', badge: 'List dengan ikon', icon: 'fa-solid fa-list-check' },
                    { type: 'columns', label: '3 Kolom Card', badge: '3 Kolom Card', icon: 'fa-solid fa-table-columns' },
                    { type: 'benefits', label: 'Box Manfaat', badge: 'Box Manfaat', icon: 'fa-solid fa-gift' },
                    { type: 'timeline', label: 'Timeline Step', badge: 'Timeline', icon: 'fa-solid fa-timeline' },
                    { type: 'quote', label: 'Quote', badge: 'Quote', icon: 'fa-solid fa-quote-left' },
                ],

                generateSlug() {
                    this.slug = this.title.toLowerCase().trim()
                        .replace(/[^a-z0-9\s-]/g, '')
                        .replace(/\s+/g, '-');
                },
                categoryLabel() { return this.categories[this.categoryId] || 'Pilih Kategori'; },
                authorLabel() { return this.authors[this.authorId] || 'Pilih Penulis'; },

                addSection(type) {
                    this.sectionCounter++;
                    const preset = this.sectionTypeOptions.find(o => o.type === type);
                    let data = {};
                    if (type === 'description') data = { description: '' };
                    if (['list', 'columns', 'benefits', 'timeline'].includes(type)) data = { items: [] };
                    if (type === 'quote') data = { quote: '', author: '' };

                    this.sections.push({ key: this.sectionCounter, type, badge: preset.badge, title: '', data });
                    this.addSectionMenuOpen = false;
                    this.openSectionModal(this.sections.length - 1, 'add');
                },
                removeSection(index) { this.sections.splice(index, 1); },
                reorderSection(from, to) {
                    if (from === null || from === to) return;
                    const item = this.sections.splice(from, 1)[0];
                    this.sections.splice(to, 0, item);
                    this.dragIndex = null;
                },

                openSectionModal(index, mode = 'edit') {
                    this.activeSectionIndex = index;
                    this.sectionModalMode = mode;
                    this.sectionModalOpen = true;
                },
                saveSectionModal() {
                    const sec = this.sections[this.activeSectionIndex];
                    if (!sec.title) { alert('Judul section wajib diisi.'); return; }
                    if (sec.type === 'quote' && !sec.data.quote) { alert('Quote wajib diisi.'); return; }
                    if (sec.type === 'description' && !sec.data.description) { alert('Deskripsi wajib diisi.'); return; }
                    if (['list','columns','benefits','timeline'].includes(sec.type) && !(sec.data.items || []).length) {
                        alert('Minimal tambahkan 1 item.'); return;
                    }
                    this.sectionModalOpen = false;
                    this.itemModalOpen = false;
                    this.activeSectionIndex = null;
                },

                itemLabel() {
                    const map = { list: 'Item List', columns: 'Kolom Card', benefits: 'Item Manfaat', timeline: 'Timeline Step' };
                    return map[this.sections[this.activeSectionIndex]?.type] || 'Item';
                },
                itemAddLabel() {
                    const map = { list: 'Tambah Item', columns: 'Tambah Kolom', benefits: 'Tambah Manfaat', timeline: 'Tambah Step' };
                    return map[this.sections[this.activeSectionIndex]?.type] || 'Tambah Item';
                },

                openItemModal(mode, itemIndex = null) {
                    this.itemModalMode = mode;
                    this.itemEditIndex = itemIndex;
                    const sec = this.sections[this.activeSectionIndex];
                    if (mode === 'edit' && itemIndex !== null) {
                        const it = sec.data.items[itemIndex];
                        this.itemDraft = { icon: it.icon || this.iconOptions[0], title: it.title, description: it.description || '', order: itemIndex + 1 };
                    } else {
                        this.itemDraft = { icon: this.iconOptions[0], title: '', description: '', order: (sec.data.items?.length || 0) + 1 };
                    }
                    this.itemModalOpen = true;
                },
                closeItemModal() { this.itemModalOpen = false; this.itemEditIndex = null; },
                saveItem() {
                    if (!this.itemDraft.title) { alert('Judul wajib diisi.'); return; }
                    const sec = this.sections[this.activeSectionIndex];
                    if (!sec.data.items) sec.data.items = [];
                    const payload = { icon: this.itemDraft.icon, title: this.itemDraft.title, description: this.itemDraft.description };

                    if (this.itemModalMode === 'edit' && this.itemEditIndex !== null) {
                        sec.data.items.splice(this.itemEditIndex, 1);
                    }
                    let targetIndex = Math.max(1, parseInt(this.itemDraft.order) || (sec.data.items.length + 1)) - 1;
                    targetIndex = Math.min(targetIndex, sec.data.items.length);
                    sec.data.items.splice(targetIndex, 0, payload);
                    this.closeItemModal();
                },
                removeItem(index) { this.sections[this.activeSectionIndex].data.items.splice(index, 1); },

                previewThumb(e) {
                    const file = e.target.files[0];
                    if (file) this.thumbPreview = URL.createObjectURL(file);
                },
                removeThumb() { this.thumbPreview = null; this.$refs.thumbInput.value = ''; },

                submitForm(actionType) {
                    this.action = actionType;
                    if (!this.title) { alert('Judul artikel wajib diisi.'); return; }
                    if (!this.categoryId) { alert('Kategori wajib dipilih.'); return; }
                    if (!this.isAnonymous && !this.authorId) { alert('Penulis wajib dipilih, atau centang Anonim.'); return; }
                    if (!this.excerpt) { alert('Ringkasan singkat wajib diisi.'); return; }
                    this.$refs.mainForm.submit();
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