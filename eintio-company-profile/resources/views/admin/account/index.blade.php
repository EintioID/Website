<x-app-layout>
    <x-slot name="header">
        <div>
            <p class="text-xs text-slate-400 mb-1">Beranda / Profile</p>
            <h2 class="text-xl font-bold text-brand-dark tracking-tight">Profil Saya</h2>
        </div>

        <div class="flex items-center gap-5">
            <button class="relative p-2 rounded-full hover:bg-brand-beige/50 transition-all duration-300 ease-smooth group">
                <i class="fa-solid fa-bell text-slate-500 text-lg transition-transform duration-300 ease-smooth group-hover:animate-wiggle"></i>
                <span class="absolute top-1.5 right-1.5 h-2 w-2 rounded-full bg-red-500"></span>
            </button>
            <div class="flex items-center gap-3 pl-4 border-l border-slate-200">
                <div class="h-9 w-9 rounded-full bg-brand-mint flex items-center justify-center text-white text-sm font-semibold">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
                <div class="text-sm hidden sm:block text-left">
                    <p class="font-medium text-brand-dark leading-none">{{ Auth::user()->name }}</p>
                    <p class="text-slate-400 text-xs mt-1">{{ ucfirst(Auth::user()->role ?? 'Admin') }}</p>
                </div>
            </div>
        </div>
    </x-slot>

    @include('admin.account.partials.styles')

    @php $user = Auth::user(); @endphp

    <div class="space-y-6 w-full">

        @if (session('success'))
            <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)" x-transition
                 class="reveal is-visible flex items-center gap-3 bg-brand-mint/10 border border-brand-mint/30 text-brand-mint px-5 py-3.5 rounded-xl text-sm font-medium">
                <i class="fa-solid fa-circle-check text-base"></i>
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="reveal is-visible flex items-start gap-3 bg-red-50 border border-red-200 text-red-500 px-5 py-3.5 rounded-xl text-sm font-medium">
                <i class="fa-solid fa-circle-exclamation text-base mt-0.5"></i>
                <ul class="space-y-0.5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

            {{-- ===== INFORMASI PRIBADI ===== --}}
            <div class="reveal profile-card bg-white rounded-2xl shadow-sm border border-slate-100 p-7">
                <p class="font-bold text-brand-dark">Informasi Pribadi</p>
                <p class="text-sm text-slate-400 mt-1 mb-6">Informasi dasar akun Anda.</p>

                <form method="POST" action="{{ route('admin.account.update-info') }}" class="space-y-5">
                    @csrf
                    @method('PATCH')

                    <div class="profile-field flex items-center gap-4">
                        <span class="profile-icon"><i class="fa-solid fa-user"></i></span>
                        <div class="flex-1">
                            <label class="text-xs text-slate-400">Nama Lengkap</label>
                            <input type="text" name="name" value="{{ old('name', $user->name) }}"
                                   class="w-full border-0 border-b border-transparent focus:border-brand-mint focus:ring-0 px-0 py-1 text-sm font-semibold text-brand-dark bg-transparent transition-colors duration-200 ease-smooth">
                        </div>
                    </div>

                    <div class="profile-field flex items-center gap-4">
                        <span class="profile-icon"><i class="fa-solid fa-envelope"></i></span>
                        <div class="flex-1">
                            <label class="text-xs text-slate-400">Email</label>
                            <input type="email" name="email" value="{{ old('email', $user->email) }}"
                                   class="w-full border-0 border-b border-transparent focus:border-brand-mint focus:ring-0 px-0 py-1 text-sm font-semibold text-brand-dark bg-transparent transition-colors duration-200 ease-smooth">
                        </div>
                    </div>

                    <div class="profile-field flex items-center gap-4">
                        <span class="profile-icon"><i class="fa-solid fa-at"></i></span>
                        <div class="flex-1">
                            <label class="text-xs text-slate-400">Username</label>
                            <input type="text" name="username" value="{{ old('username', $user->username ?? '') }}"
                                   class="w-full border-0 border-b border-transparent focus:border-brand-mint focus:ring-0 px-0 py-1 text-sm font-semibold text-brand-dark bg-transparent transition-colors duration-200 ease-smooth">
                        </div>
                    </div>

                    <div class="profile-field flex items-center gap-4">
                        <span class="profile-icon"><i class="fa-solid fa-phone"></i></span>
                        <div class="flex-1">
                            <label class="text-xs text-slate-400">No. Telepon</label>
                            <input type="text" name="phone" value="{{ old('phone', $user->phone ?? '') }}"
                                   class="w-full border-0 border-b border-transparent focus:border-brand-mint focus:ring-0 px-0 py-1 text-sm font-semibold text-brand-dark bg-transparent transition-colors duration-200 ease-smooth">
                        </div>
                    </div>

                    <div class="profile-field flex items-center gap-4">
                        <span class="profile-icon"><i class="fa-solid fa-user-shield"></i></span>
                        <div class="flex-1">
                            <label class="text-xs text-slate-400 block mb-1">Role</label>
                            <span class="role-badge">
                                <i class="fa-solid fa-star text-[10px]"></i>
                                {{ ucfirst($user->role ?? 'Admin') }}
                            </span>
                        </div>
                    </div>

                    <div class="pt-2 flex justify-end">
                        <button type="submit" class="btn-fill relative overflow-hidden inline-flex items-center gap-2 px-5 py-2.5 rounded-lg text-sm font-semibold text-white bg-brand-mint">
                            <span class="fill-layer bg-brand-teal"></span>
                            <span class="btn-label flex items-center gap-2">
                                <i class="fa-solid fa-floppy-disk text-xs"></i>
                                Simpan Perubahan
                            </span>
                        </button>
                    </div>
                </form>
            </div>

            {{-- ===== FOTO PROFIL ===== --}}
            <div class="reveal profile-card bg-white rounded-2xl shadow-sm border border-slate-100 p-7" style="transition-delay:.05s">
                <p class="font-bold text-brand-dark">Foto Profil</p>
                <p class="text-sm text-slate-400 mt-1 mb-6">Kelola foto profil akun Anda.</p>

                <div class="flex flex-col items-center text-center">
                    <div class="avatar-wrap relative mb-4">
                        @if (!empty($user->photo))
                            <img src="{{ Storage::url($user->photo) }}" class="avatar-img" alt="Foto profil">
                        @else
                            <div class="avatar-placeholder">
                                {{ substr($user->name, 0, 1) }}
                            </div>
                        @endif
                        <span class="avatar-dot"></span>
                    </div>

                    <p class="font-semibold text-brand-dark">{{ $user->name }}</p>
                    <p class="text-xs text-slate-400 mt-1 mb-6">JPG, PNG atau WEBP • Maks. 2 MB</p>

                    <form method="POST" action="{{ route('admin.account.update-photo') }}" enctype="multipart/form-data">
                        @csrf
                        <label class="btn-ghost-pill cursor-pointer inline-flex items-center gap-2 px-5 py-2.5 rounded-lg text-sm font-semibold">
                            <i class="fa-solid fa-camera text-xs"></i>
                            Ganti Foto
                            <input type="file" name="photo" class="hidden" accept="image/png, image/jpeg, image/webp"
                                   onchange="this.form.requestSubmit()">
                        </label>
                    </form>

                    @if (!empty($user->photo))
                        <form method="POST" action="{{ route('admin.account.delete-photo') }}" class="mt-3"
                              onsubmit="return confirm('Hapus foto profil?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-xs font-medium text-red-500 hover:text-red-600 hover:underline transition-colors duration-200 ease-smooth">
                                Hapus Foto
                            </button>
                        </form>
                    @endif
                </div>
            </div>

            {{-- ===== KEAMANAN AKUN ===== --}}
            <div class="reveal profile-card bg-white rounded-2xl shadow-sm border border-slate-100 p-7 lg:col-span-2" style="transition-delay:.1s">
                <div class="flex items-center justify-between mb-1">
                    <p class="font-bold text-brand-dark">Keamanan Akun</p>
                    <span class="security-icon"><i class="fa-solid fa-shield-halved"></i></span>
                </div>
                <p class="text-sm text-slate-400 mb-6">Perbarui password untuk menjaga keamanan akun.</p>

                <form method="POST" action="{{ route('admin.account.update-password') }}"
                      class="grid grid-cols-1 md:grid-cols-3 gap-5 max-w-3xl"
                      x-data="passwordForm()">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="text-xs text-slate-400 mb-1.5 block">Password Saat Ini</label>
                        <div class="field-ring flex items-center gap-2 px-3.5">
                            <i class="fa-solid fa-lock text-slate-300 text-xs"></i>
                            <input :type="showCurrent ? 'text' : 'password'" name="current_password"
                                   placeholder="Masukkan password saat ini"
                                   class="w-full border-0 focus:ring-0 text-sm py-2.5 bg-transparent">
                            <button type="button" @click="showCurrent = !showCurrent" class="text-slate-300 hover:text-slate-500 transition-colors duration-200 ease-smooth">
                                <i :class="showCurrent ? 'fa-eye-slash' : 'fa-eye'" class="fa-solid text-xs"></i>
                            </button>
                        </div>
                    </div>

                    <div>
                        <label class="text-xs text-slate-400 mb-1.5 block">Password Baru</label>
                        <div class="field-ring flex items-center gap-2 px-3.5">
                            <i class="fa-solid fa-key text-slate-300 text-xs"></i>
                            <input :type="showNew ? 'text' : 'password'" name="password" x-model="newPassword"
                                   placeholder="Buat password baru"
                                   class="w-full border-0 focus:ring-0 text-sm py-2.5 bg-transparent">
                            <button type="button" @click="showNew = !showNew" class="text-slate-300 hover:text-slate-500 transition-colors duration-200 ease-smooth">
                                <i :class="showNew ? 'fa-eye-slash' : 'fa-eye'" class="fa-solid text-xs"></i>
                            </button>
                        </div>
                        <div class="flex items-center gap-2 mt-2">
                            <div class="strength-bar flex-1 flex gap-1">
                                <span class="strength-seg" :class="strength() >= 1 && 'is-active'"></span>
                                <span class="strength-seg" :class="strength() >= 2 && 'is-active'"></span>
                                <span class="strength-seg" :class="strength() >= 3 && 'is-active'"></span>
                            </div>
                            <span class="text-[11px] text-slate-400" x-text="strengthLabel()"></span>
                        </div>
                    </div>

                    <div>
                        <label class="text-xs text-slate-400 mb-1.5 block">Konfirmasi Password Baru</label>
                        <div class="field-ring flex items-center gap-2 px-3.5">
                            <i class="fa-solid fa-key text-slate-300 text-xs"></i>
                            <input :type="showConfirm ? 'text' : 'password'" name="password_confirmation"
                                   placeholder="Ulangi password baru"
                                   class="w-full border-0 focus:ring-0 text-sm py-2.5 bg-transparent">
                            <button type="button" @click="showConfirm = !showConfirm" class="text-slate-300 hover:text-slate-500 transition-colors duration-200 ease-smooth">
                                <i :class="showConfirm ? 'fa-eye-slash' : 'fa-eye'" class="fa-solid text-xs"></i>
                            </button>
                        </div>
                    </div>

                    <div class="md:col-span-3 flex justify-end">
                        <button type="submit" class="btn-fill relative overflow-hidden inline-flex items-center gap-2 px-5 py-2.5 rounded-lg text-sm font-semibold text-white bg-brand-mint">
                            <span class="fill-layer bg-brand-teal"></span>
                            <span class="btn-label flex items-center gap-2">
                                <i class="fa-solid fa-rotate text-xs"></i>
                                Update Password
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <p class="text-center text-xs text-slate-300 pt-2">© {{ date('Y') }} PT. Eintio Academia & Technology. All rights reserved.</p>
    </div>

    <script>
        function passwordForm() {
            return {
                showCurrent: false, showNew: false, showConfirm: false,
                newPassword: '',
                strength() {
                    const p = this.newPassword;
                    if (!p) return 0;
                    let s = 0;
                    if (p.length >= 8) s++;
                    if (/[A-Z]/.test(p) && /[0-9]/.test(p)) s++;
                    if (/[^A-Za-z0-9]/.test(p) && p.length >= 10) s++;
                    return s;
                },
                strengthLabel() {
                    const map = { 0: '', 1: 'Lemah', 2: 'Sedang', 3: 'Kuat' };
                    return map[this.strength()] || '';
                }
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