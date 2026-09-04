{{-- resources/views/admin/services/edit.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <div>
            <p class="text-xs text-slate-400 mb-1.5">Layanan / {{ $service->is_completed ? 'Edit Layanan' : 'Tambah Layanan' }}</p>
            <h2 class="text-2xl font-bold text-slate-900">{{ $service->is_completed ? 'Edit Layanan' : 'Tambah Layanan' }}</h2>
        </div>
    </x-slot>

    @include('admin.services.partials.styles')

    <div class="px-4 md:px-6 py-6"
         x-data="{
            tab: '{{ session('tab', request('tab', 'informasi')) }}',
            categoryOpen: false, category: '{{ old('category', $service->category) }}',
            statusOpen: false, status: '{{ old('status', $service->status) }}',
            photoPreview: null,
            addAdvantage: false,
            editAdvantageId: null,
            addFeature: false,
            editFeatureId: null,
            confirmDelete: false,
            deleteUrl: '',
            selectedIcon: '',
            iconSearch: '',
            icons: [
                'fa-rocket','fa-chart-line','fa-shield-halved','fa-code','fa-mobile-screen',
                'fa-laptop-code','fa-cloud','fa-database','fa-gears','fa-lightbulb',
                'fa-users','fa-graduation-cap','fa-book','fa-briefcase','fa-globe',
                'fa-handshake','fa-chart-pie','fa-server','fa-network-wired','fa-lock',
                'fa-palette','fa-magnifying-glass','fa-bullhorn','fa-comments','fa-envelope',
                'fa-calendar','fa-clock','fa-star','fa-award','fa-certificate',
                'fa-file-lines','fa-folder','fa-desktop','fa-wifi','fa-plug',
                'fa-bolt','fa-puzzle-piece','fa-layer-group','fa-sitemap','fa-gauge',
                'fa-robot','fa-microchip','fa-brain','fa-fingerprint','fa-key',
                'fa-user-shield','fa-cart-shopping','fa-credit-card','fa-money-bill-wave','fa-coins',
                'fa-chart-simple','fa-clipboard-list','fa-list-check','fa-file-invoice','fa-print',
                'fa-headset','fa-phone','fa-video','fa-camera','fa-image',
                'fa-map-location-dot','fa-location-dot','fa-truck','fa-plane','fa-warehouse',
                'fa-building','fa-industry','fa-store','fa-shop','fa-boxes-stacked',
                'fa-people-group','fa-hand-holding-heart','fa-heart-pulse','fa-hospital','fa-stethoscope',
                'fa-flask','fa-microscope','fa-atom','fa-dna','fa-vial',
                'fa-chalkboard-user','fa-school','fa-pen-nib','fa-pen-ruler','fa-book-open',
                'fa-terminal','fa-keyboard','fa-mouse','fa-satellite-dish',
                'fa-arrows-rotate','fa-rotate','fa-scale-balanced','fa-thumbs-up','fa-medal',
                'fa-flag','fa-compass','fa-route','fa-signal','fa-battery-full'
            ]
         }">

        @if (session('success'))
            <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)" x-transition
                 class="bg-teal-50 border-l-4 border-teal-500 text-teal-700 px-6 py-4 rounded-lg text-sm font-medium mb-5">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-4 gap-6 items-start w-full">

            {{-- SIDEBAR TAB --}}
            <div class="reveal bg-white rounded-xl p-2 border border-slate-200 h-fit">
                <button type="button" @click="tab = 'informasi'" class="side-tab w-full text-left px-4 py-3 rounded-lg text-sm font-medium" :class="tab === 'informasi' ? 'is-active' : 'text-slate-600'">Informasi Layanan</button>
                <button type="button" @click="tab = 'keunggulan'" class="side-tab w-full text-left px-4 py-3 rounded-lg text-sm font-medium" :class="tab === 'keunggulan' ? 'is-active' : 'text-slate-600'">Keunggulan Layanan</button>
                <button type="button" @click="tab = 'fitur'" class="side-tab w-full text-left px-4 py-3 rounded-lg text-sm font-medium" :class="tab === 'fitur' ? 'is-active' : 'text-slate-600'">Fitur Layanan</button>
            </div>

            {{-- CONTENT --}}
            <div class="reveal card-hover lg:col-span-3 bg-white rounded-xl p-7 border border-slate-200" style="transition-delay:.05s">

                {{-- STEP INDICATOR --}}
                <div class="flex items-center gap-3 mb-7 text-sm">
                    <span class="flex items-center gap-2 font-semibold" :class="tab === 'informasi' ? 'text-teal-600' : 'text-slate-400'">
                        <span class="step-dot w-6 h-6 rounded-full flex items-center justify-center text-xs" :class="tab === 'informasi' ? 'bg-teal-600 text-white' : 'bg-slate-100'">1</span>Informasi Dasar
                    </span>
                    <span class="flex-1 h-px bg-slate-200"></span>
                    <span class="flex items-center gap-2 font-semibold" :class="tab === 'keunggulan' ? 'text-teal-600' : 'text-slate-400'">
                        <span class="step-dot w-6 h-6 rounded-full flex items-center justify-center text-xs" :class="tab === 'keunggulan' ? 'bg-teal-600 text-white' : 'bg-slate-100'">2</span>Keunggulan Layanan
                    </span>
                    <span class="flex-1 h-px bg-slate-200"></span>
                    <span class="flex items-center gap-2 font-semibold" :class="tab === 'fitur' ? 'text-teal-600' : 'text-slate-400'">
                        <span class="step-dot w-6 h-6 rounded-full flex items-center justify-center text-xs" :class="tab === 'fitur' ? 'bg-teal-600 text-white' : 'bg-slate-100'">3</span>Fitur Layanan
                    </span>
                </div>

                {{-- TAB 1: INFORMASI DASAR --}}
                <div x-show="tab === 'informasi'">
                    <form method="POST" action="{{ route('admin.services.update', $service) }}" enctype="multipart/form-data" class="space-y-5">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-2 gap-5">
                            <div>
                                <label class="block text-xs font-bold text-slate-700 mb-2 uppercase">Nama Layanan *</label>
                                <div class="field-ring flex items-center gap-3 px-4">
                                    <i class="fa-solid fa-briefcase field-icon text-slate-400 text-sm"></i>
                                    <input type="text" name="name" value="{{ old('name', $service->name) }}" class="w-full bg-transparent border-0 focus:ring-0 text-sm py-2.5" required>
                                </div>
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-slate-700 mb-2 uppercase">Kategori Layanan *</label>
                                <div class="dropdown-wrap" @click.outside="categoryOpen = false">
                                    <input type="hidden" name="category" :value="category">
                                    <button type="button" @click="categoryOpen = !categoryOpen; statusOpen = false"
                                            class="dropdown-trigger flex items-center gap-3 px-4 py-2.5" :class="categoryOpen && 'is-open'">
                                        <i class="fa-solid fa-layer-group text-slate-400 text-sm"></i>
                                        <span class="flex-1 text-sm text-left truncate text-slate-800" x-text="category"></span>
                                        <i class="fa-solid fa-chevron-down dropdown-chevron text-xs"></i>
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
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-2 uppercase">Icon / Gambar</label>
                            @if ($service->icon)
                                <img src="{{ Storage::url($service->icon) }}" class="w-16 h-16 rounded-lg object-cover mb-2 border border-slate-200">
                            @endif
                            <label class="upload-box relative flex flex-col items-center justify-center py-6 border-2 border-dashed border-slate-300 rounded-lg overflow-hidden">
                                <template x-if="!photoPreview">
                                    <div class="flex flex-col items-center">
                                        <i class="fa-solid fa-cloud-arrow-up upload-icon text-xl text-slate-400 mb-1"></i>
                                        <span class="text-sm text-slate-500">Klik untuk ganti gambar</span>
                                    </div>
                                </template>
                                <img :src="photoPreview" x-show="photoPreview" class="max-h-28 object-contain">
                                <input type="file" name="icon" accept="image/*" class="hidden"
                                       @change="photoPreview = URL.createObjectURL($event.target.files[0])">
                            </label>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-2 uppercase">Deskripsi Singkat *</label>
                            <div class="field-ring px-4 py-1">
                                <textarea name="short_description" rows="3" maxlength="500" class="w-full bg-transparent border-0 focus:ring-0 text-sm py-2 resize-none">{{ old('short_description', $service->short_description) }}</textarea>
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-2 uppercase">Status</label>
                            <div class="dropdown-wrap max-w-xs" @click.outside="statusOpen = false">
                                <input type="hidden" name="status" :value="status">
                                <button type="button" @click="statusOpen = !statusOpen; categoryOpen = false"
                                        class="dropdown-trigger flex items-center gap-3 px-4 py-2.5" :class="statusOpen && 'is-open'">
                                    <i class="fa-solid text-sm" :class="status === 'aktif' ? 'fa-toggle-on text-teal-600' : 'fa-toggle-off text-slate-400'"></i>
                                    <span class="flex-1 text-sm text-left text-slate-800" x-text="status === 'aktif' ? 'Aktif' : 'Nonaktif'"></span>
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
                                        <button type="button" @click="status = 'aktif'; statusOpen = false"
                                                class="dropdown-option flex items-center justify-between gap-2 px-3 py-2.5 text-sm" :class="status === 'aktif' ? 'is-selected' : ''">
                                            <span>Aktif</span>
                                            <i class="fa-solid fa-check dropdown-check text-xs" x-show="status === 'aktif'"></i>
                                        </button>
                                        <button type="button" @click="status = 'nonaktif'; statusOpen = false"
                                                class="dropdown-option flex items-center justify-between gap-2 px-3 py-2.5 text-sm" :class="status === 'nonaktif' ? 'is-selected' : ''">
                                            <span>Nonaktif</span>
                                            <i class="fa-solid fa-check dropdown-check text-xs" x-show="status === 'nonaktif'"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="flex justify-between pt-3">
                            <a href="{{ route('admin.services.index') }}" class="btn-ghost border-2 border-slate-200 rounded-lg px-5 py-2.5 text-sm font-semibold text-slate-600">Batal</a>
                            <button type="submit" class="btn-fill bg-teal-600 text-white font-semibold px-5 py-2.5 rounded-lg">
                                <span class="fill-layer bg-teal-700"></span>
                                <span class="btn-label">Simpan Perubahan</span>
                            </button>
                        </div>
                    </form>
                </div>

                {{-- TAB 2: KEUNGGULAN --}}
                <div x-show="tab === 'keunggulan'">
                    <div class="flex items-center justify-between mb-5">
                        <div>
                            <h3 class="font-bold text-slate-900">Keunggulan Layanan</h3>
                            <p class="text-xs text-slate-500">Kelola informasi keunggulan yang akan ditampilkan di website.</p>
                        </div>
                        <button type="button" @click="addAdvantage = true" class="btn-fill bg-teal-600 text-white text-sm font-semibold px-4 py-2.5 rounded-lg">
                            <span class="fill-layer bg-teal-700"></span>
                            <span class="btn-label">+ Tambah</span>
                        </button>
                    </div>

                    <div class="space-y-2">
                        @forelse ($service->advantages as $advantage)
                            <div class="item-row flex items-center justify-between px-4 py-3">
                                <div class="flex items-center gap-3">
                                    <i class="fa-solid fa-grip-vertical grip-icon text-slate-200"></i>
                                    <i class="fa-solid fa-circle-check text-teal-500 text-sm"></i>
                                    <span class="text-sm text-slate-700">{{ $advantage->title }}</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <button type="button" class="item-action-btn is-edit" @click="editAdvantageId = {{ $advantage->id }}">
                                        <i class="fa-solid fa-pen text-sm"></i>
                                    </button>
                                    <button type="button" class="item-action-btn is-delete" @click="confirmDelete = true; deleteUrl = '{{ route('admin.services.advantages.destroy', [$service, $advantage]) }}'">
                                        <i class="fa-solid fa-trash text-sm"></i>
                                    </button>
                                </div>
                            </div>
                        @empty
                            <p class="text-sm text-slate-400 text-center py-8">Belum ada keunggulan ditambahkan.</p>
                        @endforelse
                    </div>

                    <div class="flex justify-between pt-6">
                        <button type="button" @click="tab = 'informasi'" class="btn-ghost border-2 border-slate-200 rounded-lg px-5 py-2.5 text-sm font-semibold text-slate-600">← Kembali</button>
                        <button type="button" @click="tab = 'fitur'" class="btn-fill bg-teal-600 text-white font-semibold px-5 py-2.5 rounded-lg">
                            <span class="fill-layer bg-teal-700"></span>
                            <span class="btn-label">Selanjutnya →</span>
                        </button>
                    </div>
                </div>

                {{-- TAB 3: FITUR --}}
                <div x-show="tab === 'fitur'">
                    <div class="flex items-center justify-between mb-5">
                        <div>
                            <h3 class="font-bold text-slate-900">Fitur Layanan</h3>
                            <p class="text-xs text-slate-500">Kelola fitur-fitur yang tersedia dalam layanan ini.</p>
                        </div>
                        <button type="button" @click="addFeature = true; selectedIcon = ''" class="btn-fill bg-teal-600 text-white text-sm font-semibold px-4 py-2.5 rounded-lg">
                            <span class="fill-layer bg-teal-700"></span>
                            <span class="btn-label">+ Tambah Fitur</span>
                        </button>
                    </div>

                    <div class="space-y-2">
                        @forelse ($service->features as $feature)
                            <div class="item-row flex items-center justify-between px-4 py-3">
                                <div class="flex items-center gap-3">
                                    <div class="item-icon-box w-8 h-8 rounded-lg bg-teal-50 text-teal-600 flex items-center justify-center">
                                        <i class="fa-solid {{ $feature->icon }} text-sm"></i>
                                    </div>
                                    <div>
                                        <p class="text-sm font-semibold text-slate-700">{{ $feature->name }}</p>
                                        <p class="text-xs text-slate-400">{{ Str::limit($feature->description, 50) }}</p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-2">
                                    <button type="button" class="item-action-btn is-edit" @click="editFeatureId = {{ $feature->id }}">
                                        <i class="fa-solid fa-pen text-sm"></i>
                                    </button>
                                    <button type="button" class="item-action-btn is-delete" @click="confirmDelete = true; deleteUrl = '{{ route('admin.services.features.destroy', [$service, $feature]) }}'">
                                        <i class="fa-solid fa-trash text-sm"></i>
                                    </button>
                                </div>
                            </div>
                        @empty
                            <p class="text-sm text-slate-400 text-center py-8">Belum ada fitur ditambahkan.</p>
                        @endforelse
                    </div>

                    <div class="flex justify-between pt-6">
                        <button type="button" @click="tab = 'keunggulan'" class="btn-ghost border-2 border-slate-200 rounded-lg px-5 py-2.5 text-sm font-semibold text-slate-600">← Kembali</button>
                        <form method="POST" action="{{ route('admin.services.complete', $service) }}">
                            @csrf
                            <button type="submit" class="btn-fill bg-teal-600 text-white font-semibold px-5 py-2.5 rounded-lg">
                                <span class="fill-layer bg-teal-700"></span>
                                <span class="btn-label">Selesai</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        {{-- ================= SEMUA MODAL — masih di dalam x-data, tapi teleport ke <body> ================= --}}

        {{-- MODAL TAMBAH ADVANTAGE --}}
        <template x-teleport="body">
            <div x-show="addAdvantage" x-cloak x-transition.opacity class="modal-overlay bg-black/40 backdrop-blur-sm flex items-center justify-center p-4">
                <div x-show="addAdvantage" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                     class="modal-panel bg-white rounded-xl p-6 w-full max-w-sm" @click.outside="addAdvantage = false">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="font-bold text-slate-900">Tambah Keunggulan</h3>
                        <button type="button" @click="addAdvantage = false" class="modal-close-btn h-7 w-7 text-slate-400"><i class="fa-solid fa-xmark"></i></button>
                    </div>
                    <form method="POST" action="{{ route('admin.services.advantages.store', $service) }}">
                        @csrf
                        <label class="block text-xs font-bold text-slate-700 mb-2 uppercase">Nama Keunggulan *</label>
                        <div class="field-ring flex items-center gap-3 px-4 mb-4">
                            <input type="text" name="title" placeholder="Masukkan nama keunggulan layanan" class="w-full bg-transparent border-0 focus:ring-0 text-sm py-2.5" required>
                        </div>
                        <div class="flex gap-3">
                            <button type="button" @click="addAdvantage = false" class="btn-ghost flex-1 border-2 border-slate-200 rounded-lg py-2.5 text-sm font-semibold text-slate-600">Batal</button>
                            <button type="submit" class="btn-fill flex-1 bg-teal-600 text-white rounded-lg py-2.5 text-sm font-semibold">
                                <span class="fill-layer bg-teal-700"></span>
                                <span class="btn-label mx-auto">Simpan Keunggulan</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </template>

        {{-- MODAL EDIT ADVANTAGE --}}
        @foreach ($service->advantages as $advantage)
            <template x-teleport="body">
                <div x-show="editAdvantageId === {{ $advantage->id }}" x-cloak x-transition.opacity
                     class="modal-overlay bg-black/40 backdrop-blur-sm flex items-center justify-center p-4">
                    <div x-show="editAdvantageId === {{ $advantage->id }}"
                         x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                         class="modal-panel bg-white rounded-xl p-6 w-full max-w-sm" @click.outside="editAdvantageId = null">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="font-bold text-slate-900">Edit Keunggulan</h3>
                            <button type="button" @click="editAdvantageId = null" class="modal-close-btn h-7 w-7 text-slate-400"><i class="fa-solid fa-xmark"></i></button>
                        </div>
                        <form method="POST" action="{{ route('admin.services.advantages.update', [$service, $advantage]) }}">
                            @csrf @method('PUT')
                            <label class="block text-xs font-bold text-slate-700 mb-2 uppercase">Nama Keunggulan *</label>
                            <div class="field-ring flex items-center gap-3 px-4 mb-4">
                                <input type="text" name="title" value="{{ $advantage->title }}" class="w-full bg-transparent border-0 focus:ring-0 text-sm py-2.5" required>
                            </div>
                            <div class="flex gap-3">
                                <button type="button" @click="editAdvantageId = null" class="btn-ghost flex-1 border-2 border-slate-200 rounded-lg py-2.5 text-sm font-semibold text-slate-600">Batal</button>
                                <button type="submit" class="btn-fill flex-1 bg-teal-600 text-white rounded-lg py-2.5 text-sm font-semibold">
                                    <span class="fill-layer bg-teal-700"></span>
                                    <span class="btn-label mx-auto">Simpan</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </template>
        @endforeach

        {{-- MODAL TAMBAH FEATURE --}}
        <template x-teleport="body">
            <div x-show="addFeature" x-cloak x-transition.opacity class="modal-overlay bg-black/40 backdrop-blur-sm flex items-center justify-center p-4">
                <div x-show="addFeature" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                     class="modal-panel bg-white rounded-xl p-6 w-full max-w-md" @click.outside="addFeature = false">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="font-bold text-slate-900">Tambah Fitur Layanan</h3>
                        <button type="button" @click="addFeature = false" class="modal-close-btn h-7 w-7 text-slate-400"><i class="fa-solid fa-xmark"></i></button>
                    </div>
                    <form method="POST" action="{{ route('admin.services.features.store', $service) }}" class="space-y-4">
                        @csrf
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-2 uppercase">Nama Fitur *</label>
                            <div class="field-ring flex items-center gap-3 px-4">
                                <input type="text" name="name" placeholder="Masukkan nama fitur layanan" class="w-full bg-transparent border-0 focus:ring-0 text-sm py-2.5" required>
                            </div>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-2 uppercase">Deskripsi Fitur *</label>
                            <div class="field-ring px-4 py-1">
                                <textarea name="description" rows="2" maxlength="160" placeholder="Masukkan deskripsi fitur layanan" class="w-full bg-transparent border-0 focus:ring-0 text-sm py-2 resize-none"></textarea>
                            </div>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-2 uppercase">Icon Fitur *</label>
                            <div class="flex items-center gap-3">
                                <div class="field-ring flex-1 flex items-center gap-3 px-4">
                                    <i class="fa-solid fa-magnifying-glass text-slate-400 text-xs"></i>
                                    <input type="text" x-model="iconSearch" placeholder="Cari icon..." class="w-full bg-transparent border-0 focus:ring-0 text-sm py-2.5">
                                </div>
                                <div class="icon-preview-box w-10 h-10 rounded-lg bg-teal-50 text-teal-600 flex items-center justify-center flex-shrink-0">
                                    <i class="fa-solid" :class="selectedIcon || 'fa-shapes'"></i>
                                </div>
                            </div>
                            <input type="hidden" name="icon" :value="selectedIcon">
                            <p class="text-xs text-slate-400 mt-1">Pilih icon yang merepresentasikan fitur.</p>
                            <div class="grid grid-cols-7 gap-2 mt-2 max-h-44 overflow-y-auto border-2 border-slate-100 rounded-lg p-2">
                                <template x-for="ic in icons.filter(i => i.includes(iconSearch.toLowerCase()))" :key="ic">
                                    <button type="button" @click="selectedIcon = ic" class="icon-swatch w-9 h-9 rounded-lg flex items-center justify-center bg-slate-50 text-slate-500" :class="selectedIcon === ic ? 'is-selected' : ''">
                                        <i class="fa-solid" :class="ic"></i>
                                    </button>
                                </template>
                            </div>
                        </div>
                        @error('icon') <p class="text-xs text-red-500">{{ $message }}</p> @enderror
                        <div class="flex gap-3 pt-2">
                            <button type="button" @click="addFeature = false" class="btn-ghost flex-1 border-2 border-slate-200 rounded-lg py-2.5 text-sm font-semibold text-slate-600">Batal</button>
                            <button type="submit" class="btn-fill flex-1 bg-teal-600 text-white rounded-lg py-2.5 text-sm font-semibold">
                                <span class="fill-layer bg-teal-700"></span>
                                <span class="btn-label mx-auto">Simpan Fitur</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </template>

        {{-- MODAL EDIT FEATURE --}}
        @foreach ($service->features as $feature)
            <template x-teleport="body">
                <div x-show="editFeatureId === {{ $feature->id }}" x-cloak
                     x-data="{ localIcon: '{{ $feature->icon }}', localSearch: '' }"
                     x-transition.opacity
                     class="modal-overlay bg-black/40 backdrop-blur-sm flex items-center justify-center p-4">
                    <div x-show="editFeatureId === {{ $feature->id }}" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                         class="modal-panel bg-white rounded-xl p-6 w-full max-w-md" @click.outside="editFeatureId = null">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="font-bold text-slate-900">Edit Fitur Layanan</h3>
                            <button type="button" @click="editFeatureId = null" class="modal-close-btn h-7 w-7 text-slate-400"><i class="fa-solid fa-xmark"></i></button>
                        </div>
                        <form method="POST" action="{{ route('admin.services.features.update', [$service, $feature]) }}" class="space-y-4">
                            @csrf @method('PUT')
                            <div>
                                <label class="block text-xs font-bold text-slate-700 mb-2 uppercase">Nama Fitur *</label>
                                <div class="field-ring flex items-center gap-3 px-4">
                                    <input type="text" name="name" value="{{ $feature->name }}" class="w-full bg-transparent border-0 focus:ring-0 text-sm py-2.5" required>
                                </div>
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-slate-700 mb-2 uppercase">Deskripsi Fitur *</label>
                                <div class="field-ring px-4 py-1">
                                    <textarea name="description" rows="2" maxlength="160" class="w-full bg-transparent border-0 focus:ring-0 text-sm py-2 resize-none">{{ $feature->description }}</textarea>
                                </div>
                            </div>
                            <div class="relative">
                                <label class="block text-xs font-bold text-slate-700 mb-2 uppercase">Icon Fitur *</label>
                                <div class="flex items-center gap-3">
                                    <div class="field-ring flex-1 flex items-center gap-3 px-4">
                                        <i class="fa-solid fa-magnifying-glass text-slate-400 text-xs"></i>
                                        <input type="text" x-model="localSearch" placeholder="Cari icon..." class="w-full bg-transparent border-0 focus:ring-0 text-sm py-2.5">
                                    </div>
                                    <div class="icon-preview-box w-10 h-10 rounded-lg bg-teal-50 text-teal-600 flex items-center justify-center flex-shrink-0">
                                        <i class="fa-solid" :class="localIcon"></i>
                                    </div>
                                </div>
                                <input type="hidden" name="icon" :value="localIcon">
                                <div class="grid grid-cols-7 gap-2 mt-2 max-h-44 overflow-y-auto border-2 border-slate-100 rounded-lg p-2">
                                    <template x-for="ic in icons.filter(i => i.includes(localSearch.toLowerCase()))" :key="ic">
                                        <button type="button" @click="localIcon = ic" class="icon-swatch w-9 h-9 rounded-lg flex items-center justify-center bg-slate-50 text-slate-500" :class="localIcon === ic ? 'is-selected' : ''">
                                            <i class="fa-solid" :class="ic"></i>
                                        </button>
                                    </template>
                                </div>
                            </div>
                            <div class="flex gap-3 pt-2">
                                <button type="button" @click="editFeatureId = null" class="btn-ghost flex-1 border-2 border-slate-200 rounded-lg py-2.5 text-sm font-semibold text-slate-600">Batal</button>
                                <button type="submit" class="btn-fill flex-1 bg-teal-600 text-white rounded-lg py-2.5 text-sm font-semibold">
                                    <span class="fill-layer bg-teal-700"></span>
                                    <span class="btn-label mx-auto">Simpan</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </template>
        @endforeach

        {{-- MODAL KONFIRMASI DELETE --}}
        <template x-teleport="body">
            <div x-show="confirmDelete" x-cloak x-transition.opacity class="modal-overlay bg-black/40 backdrop-blur-sm flex items-center justify-center p-4">
                <div x-show="confirmDelete" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                     class="modal-panel bg-white rounded-xl p-6 w-full max-w-sm text-center" @click.outside="confirmDelete = false">
                    <div class="modal-danger-icon w-12 h-12 rounded-full bg-red-50 text-red-500 flex items-center justify-center mx-auto mb-4">
                        <i class="fa-solid fa-trash"></i>
                    </div>
                    <h3 class="font-bold text-slate-900 mb-1">Apakah Anda yakin ingin menghapus item ini?</h3>
                    <p class="text-xs text-slate-500 mb-5">Data yang dihapus tidak dapat dikembalikan.</p>
                    <div class="flex gap-3">
                        <button type="button" @click="confirmDelete = false" class="btn-ghost flex-1 border-2 border-slate-200 rounded-lg py-2.5 text-sm font-semibold text-slate-600">Batal</button>
                        <form :action="deleteUrl" method="POST" class="flex-1">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-fill w-full bg-red-500 text-white rounded-lg py-2.5 text-sm font-semibold">
                                <span class="fill-layer bg-red-600"></span>
                                <span class="btn-label mx-auto">Ya, Hapus</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </template>

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