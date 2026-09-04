<x-app-layout>
    <x-slot name="header">
        <div>
            <p class="text-xs text-slate-400 mb-1.5">{{ __('Beranda') }} / {{ __('Pengaturan') }}</p>
            <h2 class="text-2xl font-bold text-slate-900">{{ __('Pengaturan Akun') }}</h2>
        </div>
    </x-slot>

    <style>
        [x-cloak] { display: none !important; }

        .reveal {
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.6s ease, transform 0.6s ease;
        }
        .reveal.is-visible {
            opacity: 1;
            transform: translateY(0);
        }

        .settings-card {
            transition: all 0.3s cubic-bezier(0.22, 1, 0.36, 1);
            border: 2px solid #e2e8f0;
        }
        .settings-card:hover {
            border-color: #14b8a6;
            box-shadow: 0 20px 50px rgba(20, 184, 166, 0.15);
            transform: translateY(-4px);
        }

        .header-icon {
            transition: all 0.3s ease;
        }
        .settings-card:hover .header-icon {
            transform: scale(1.15) rotate(-5deg);
            filter: drop-shadow(0 8px 16px rgba(20, 184, 166, 0.3));
        }

        .section-heading {
            transition: all 0.3s ease;
        }
        .settings-card:hover .section-heading {
            color: #0d9488;
            letter-spacing: 0.05em;
        }

        /* INPUT STYLING */
        .form-input, .form-select {
            transition: all 0.3s ease;
            border: 2px solid #cbd5e1;
            border-radius: 8px;
            padding: 12px 16px;
            font-weight: 500;
            color: #1e293b;
            background: white;
        }

        .form-input:hover, .form-select:hover {
            border-color: #99f6e4;
            box-shadow: 0 0 0 3px rgba(20, 184, 166, 0.1);
        }

        .form-input:focus, .form-select:focus {
            outline: none;
            border-color: #14b8a6;
            box-shadow: 0 0 0 4px rgba(20, 184, 166, 0.2);
        }

        .form-input.pl-11 {
            padding-left: 2.75rem;
        }

        /* DROPDOWN CUSTOM */
        .custom-select {
            position: relative;
        }

        .custom-select-btn {
            width: 100%;
            padding: 12px 16px;
            background: white;
            border: 2px solid #cbd5e1;
            border-radius: 8px;
            text-align: left;
            cursor: pointer;
            transition: all 0.3s ease;
            font-weight: 500;
            color: #1e293b;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .custom-select-btn:hover {
            border-color: #99f6e4;
            box-shadow: 0 0 0 3px rgba(20, 184, 166, 0.1);
        }

        .custom-select-btn.open {
            border-color: #14b8a6;
            box-shadow: 0 0 0 4px rgba(20, 184, 166, 0.2);
            border-radius: 8px 8px 0 0;
        }

        .custom-select-menu {
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            background: white;
            border: 2px solid #cbd5e1;
            border-top: none;
            border-radius: 0 0 8px 8px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
            z-index: 50;
        }

        .custom-select-item {
            padding: 12px 16px;
            cursor: pointer;
            transition: all 0.2s ease;
            border-left: 3px solid transparent;
            display: flex;
            align-items: center;
            gap: 10px;
            width: 100%;
            text-align: left;
            background: white;
            border: none;
        }

        .custom-select-item:hover {
            background: #f0fdfb;
            border-left-color: #14b8a6;
            padding-left: 16px;
        }

        .custom-select-item.active {
            background: #f0fdfb;
            color: #14b8a6;
            border-left-color: #14b8a6;
            font-weight: 600;
            padding-left: 16px;
        }

        .custom-select-item.active::before {
            content: '✓';
            color: #14b8a6;
            font-weight: bold;
        }

        /* THEME BUTTON */
        .theme-btn {
            transition: all 0.3s ease;
            border: 2px solid #e2e8f0;
            cursor: pointer;
            background: white;
            border-radius: 8px;
            padding: 16px 12px;
        }

        .theme-btn:hover:not(.active) {
            border-color: #99f6e4;
            box-shadow: 0 8px 20px rgba(20, 184, 166, 0.15);
            transform: translateY(-2px);
        }

        .theme-btn.active {
            border-color: #14b8a6;
            background: rgba(20, 184, 166, 0.05);
            box-shadow: 0 0 0 4px rgba(20, 184, 166, 0.1);
        }

        /* TOGGLE SWITCH */
        .toggle-switch {
            position: relative;
            width: 48px;
            height: 28px;
            background: #cbd5e1;
            border-radius: 999px;
            cursor: pointer;
            transition: all 0.3s ease;
            border: none;
            padding: 0;
            display: inline-block;
        }

        .toggle-switch:hover {
            background: #bfdbf7;
        }

        .toggle-switch.active {
            background: linear-gradient(135deg, #14b8a6 0%, #0d9488 100%);
            box-shadow: 0 4px 12px rgba(20, 184, 166, 0.3);
        }

        .toggle-switch-thumb {
            position: absolute;
            top: 3px;
            left: 3px;
            width: 22px;
            height: 22px;
            background: white;
            border-radius: 999px;
            transition: all 0.3s ease;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
        }

        .toggle-switch.active .toggle-switch-thumb {
            transform: translateX(20px);
        }

        /* BUTTON */
        .btn-primary {
            background: linear-gradient(135deg, #14b8a6 0%, #0d9488 100%);
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
            color: white;
            font-weight: bold;
            padding: 12px 24px;
            border-radius: 8px;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(20, 184, 166, 0.4);
        }

        .btn-primary:active {
            transform: translateY(0);
        }

        .btn-secondary {
            background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
            color: white;
            font-weight: bold;
            padding: 12px 24px;
            border-radius: 8px;
        }

        .btn-secondary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(139, 92, 246, 0.4);
        }

        /* ALERT */
        .success-toast {
            animation: slideInDown 0.3s ease;
        }

        @keyframes slideInDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* PASSWORD STRENGTH */
        .strength-bar {
            height: 4px;
            background: #e2e8f0;
            border-radius: 999px;
            overflow: hidden;
        }

        .strength-fill {
            height: 100%;
            border-radius: 999px;
            transition: all 0.3s ease;
        }
    </style>

    <div x-data="settingsPage()" class="space-y-6 px-4 md:px-6 py-6">

        {{-- SUCCESS ALERT --}}
        @if(session('success'))
            <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)" 
                 class="success-toast flex items-center gap-3 bg-gradient-to-r from-teal-50 to-cyan-50 border-l-4 border-teal-500 text-teal-700 px-6 py-4 rounded-lg text-sm font-medium shadow-lg">
                <i class="fa-solid fa-circle-check text-lg"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        {{-- GRID --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

            {{-- ===== PREFERENSI CARD ===== --}}
            <form method="POST" action="{{ route('admin.settings.preferences') }}" 
                  class="reveal settings-card bg-white rounded-xl p-7 space-y-6" style="transition-delay: 0.1s;">
                @csrf
                @method('PUT')

                {{-- HEADER --}}
                <div class="flex items-center gap-4 pb-5 border-b-2 border-slate-100">
                    <div class="header-icon w-14 h-14 rounded-xl bg-gradient-to-br from-teal-100 to-cyan-100 flex items-center justify-center">
                        <i class="fa-solid fa-palette text-teal-600 text-xl"></i>
                    </div>
                    <div>
                        <h3 class="section-heading text-lg font-bold text-slate-900">{{ __('Preferensi Tampilan') }}</h3>
                        <p class="text-xs text-slate-500 mt-0.5">{{ __('Kelola bahasa, tema, dan notifikasi') }}</p>
                    </div>
                </div>


                {{-- MODE TAMPILAN --}}
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-3 uppercase tracking-wide">
                        <i class="fa-solid fa-sun text-teal-500 mr-1"></i>{{ __('Mode Tampilan') }}
                    </label>
                    <input type="hidden" name="theme" x-model="theme" id="theme-input">
                    <div class="grid grid-cols-2 gap-3">
                        <button type="button" @click="theme = 'light'" class="theme-btn" :class="theme === 'light' && 'active'">
                            <div class="flex flex-col items-center gap-2">
                                <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-amber-100 to-yellow-100 flex items-center justify-center">
                                    <i class="fa-solid fa-sun text-amber-500 text-lg"></i>
                                </div>
                                <span class="text-sm font-semibold text-slate-700">{{ __('Terang') }}</span>
                                <span x-show="theme === 'light'" class="text-xs text-teal-600 bg-teal-50 px-2 py-1 rounded-full">✓ {{ __('Aktif') }}</span>
                            </div>
                        </button>

                        <button type="button" @click="theme = 'dark'" class="theme-btn" :class="theme === 'dark' && 'active'">
                            <div class="flex flex-col items-center gap-2">
                                <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-slate-700 to-slate-800 flex items-center justify-center">
                                    <i class="fa-solid fa-moon text-yellow-300 text-lg"></i>
                                </div>
                                <span class="text-sm font-semibold text-slate-700">{{ __('Gelap') }}</span>
                                <span x-show="theme === 'dark'" class="text-xs text-teal-600 bg-teal-50 px-2 py-1 rounded-full">✓ {{ __('Aktif') }}</span>
                            </div>
                        </button>
                    </div>
                </div>

                {{-- NOTIFIKASI --}}
                <div class="bg-gradient-to-r from-teal-50 to-cyan-50 rounded-lg p-4 flex items-center justify-between border-2 border-teal-100">
                    <div>
                        <p class="text-sm font-bold text-slate-900">
                            <i class="fa-solid fa-bell text-teal-500 mr-2"></i>{{ __('Notifikasi Sistem') }}
                        </p>
                        <p class="text-xs text-slate-600 mt-0.5">{{ __('Terima pemberitahuan penting') }}</p>
                    </div>
                    <input type="hidden" name="notify_enabled" :value="notifications ? 1 : 0" id="notify-input">
                    <button type="button" class="toggle-switch" :class="notifications && 'active'" @click.prevent="notifications = !notifications" id="notify-toggle">
                        <div class="toggle-switch-thumb"></div>
                    </button>
                </div>

                {{-- SUBMIT --}}
                <button type="submit" class="w-full btn-primary py-3 px-4 rounded-lg flex items-center justify-center gap-2">
                    <i class="fa-solid fa-save"></i>{{ __('Simpan Preferensi') }}
                </button>
            </form>

            {{-- ===== PASSWORD CARD ===== --}}
            <form method="POST" action="{{ route('admin.settings.password') }}" 
                  class="reveal settings-card bg-white rounded-xl p-7 space-y-5" style="transition-delay: 0.2s;">
                @csrf
                @method('PUT')

                {{-- HEADER --}}
                <div class="flex items-center gap-4 pb-5 border-b-2 border-slate-100">
                    <div class="header-icon w-14 h-14 rounded-xl bg-gradient-to-br from-purple-100 to-pink-100 flex items-center justify-center">
                        <i class="fa-solid fa-shield-halved text-purple-600 text-xl"></i>
                    </div>
                    <div>
                        <h3 class="section-heading text-lg font-bold text-slate-900">{{ __('Keamanan Akun') }}</h3>
                        <p class="text-xs text-slate-500 mt-0.5">{{ __('Perbarui password Anda') }}</p>
                    </div>
                </div>

                {{-- PASSWORD SAAT INI --}}
                <div>
                    <label for="current_password" class="block text-xs font-bold text-slate-700 mb-3 uppercase tracking-wide">
                        <i class="fa-solid fa-lock text-purple-500 mr-1"></i>{{ __('Password Saat Ini') }}
                    </label>
                    <div class="relative">
                        <i class="fa-solid fa-lock absolute left-4 top-3.5 text-slate-400 text-sm pointer-events-none"></i>
                        <input id="current_password" type="password" name="current_password" class="form-input pl-11 w-full" placeholder="{{ __('Masukkan password saat ini') }}">
                    </div>
                    @error('current_password') <p class="text-xs text-red-500 font-medium mt-2"><i class="fa-solid fa-exclamation-circle mr-1"></i>{{ $message }}</p> @enderror
                </div>

                {{-- PASSWORD BARU --}}
                <div>
                    <label for="new_password" class="block text-xs font-bold text-slate-700 mb-3 uppercase tracking-wide">
                        <i class="fa-solid fa-key text-purple-500 mr-1"></i>{{ __('Password Baru') }}
                    </label>
                    <div class="relative">
                        <i class="fa-solid fa-key absolute left-4 top-3.5 text-slate-400 text-sm pointer-events-none"></i>
                        <input id="new_password" type="password" name="new_password" x-model="newPassword" class="form-input pl-11 w-full" placeholder="{{ __('Buat password baru (min 8 karakter)') }}">
                    </div>
                    @error('new_password') <p class="text-xs text-red-500 font-medium mt-2"><i class="fa-solid fa-exclamation-circle mr-1"></i>{{ $message }}</p> @enderror

                    {{-- STRENGTH METER --}}
                    <div x-show="newPassword.length > 0" x-cloak class="mt-3 space-y-2">
                        <div class="flex gap-2">
                            <div class="flex-1">
                                <div class="strength-bar">
                                    <div class="strength-fill" :style="`width: ${strength().pct}%; background: ${strength().color};`"></div>
                                </div>
                            </div>
                            <span class="text-xs font-bold px-2.5 py-1 rounded-full" :class="strength().pct <= 33 ? 'bg-red-100 text-red-700' : strength().pct <= 66 ? 'bg-amber-100 text-amber-700' : 'bg-emerald-100 text-emerald-700'" x-text="strength().label"></span>
                        </div>
                    </div>
                </div>

                {{-- KONFIRMASI PASSWORD --}}
                <div>
                    <label for="new_password_confirmation" class="block text-xs font-bold text-slate-700 mb-3 uppercase tracking-wide">
                        <i class="fa-solid fa-check text-purple-500 mr-1"></i>{{ __('Konfirmasi Password') }}
                    </label>
                    <div class="relative">
                        <i class="fa-solid fa-check absolute left-4 top-3.5 text-slate-400 text-sm pointer-events-none"></i>
                        <input id="new_password_confirmation" type="password" name="new_password_confirmation" class="form-input pl-11 w-full" placeholder="{{ __('Ulangi password baru') }}">
                    </div>
                </div>

                {{-- SUBMIT --}}
                <button type="submit" class="w-full btn-secondary py-3 px-4 rounded-lg flex items-center justify-center gap-2">
                    <i class="fa-solid fa-save"></i>{{ __('Simpan Password') }}
                </button>
            </form>

        </div>
    </div>

    <script>
    function settingsPage() {
        return {
            language: '{{ auth()->user()->language ?? 'id' }}',
            theme: '{{ auth()->user()->theme ?? 'light' }}',
            notifications: {{ auth()->user()->notify_enabled ? 'true' : 'false' }},
            langOpen: false,
            newPassword: '',

            strength() {
                const p = this.newPassword;
                if (!p) return { pct: 0, label: '{{ __('-') }}', color: '#e5e7eb' };
                
                let score = 0;
                if (p.length >= 8) score++;
                if (p.length >= 12) score++;
                if (/[A-Z]/.test(p) && /[a-z]/.test(p)) score++;
                if (/[0-9]/.test(p)) score++;
                if (/[^A-Za-z0-9]/.test(p)) score++;
                
                if (score <= 2) return { pct: 33, label: '{{ __('Lemah') }}', color: '#ef4444' };
                if (score <= 3) return { pct: 66, label: '{{ __('Sedang') }}', color: '#f59e0b' };
                return { pct: 100, label: '{{ __('Kuat') }}', color: '#10b981' };
            }
        };
    }

    // Reveal animation
    document.addEventListener('DOMContentLoaded', () => {
        const io = new IntersectionObserver((entries) => {
            entries.forEach((e) => {
                if (e.isIntersecting) {
                    e.target.classList.add('is-visible');
                    io.unobserve(e.target);
                }
            });
        }, { threshold: 0.1, rootMargin: '0px 0px -30px 0px' });

        document.querySelectorAll('.reveal').forEach((el) => io.observe(el));
    });
    </script>
</x-app-layout>