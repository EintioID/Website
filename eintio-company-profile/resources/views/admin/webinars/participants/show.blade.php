{{-- resources/views/admin/webinars/participants/show.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <div>
            <p class="text-xs text-slate-400 mb-1.5">Beranda / Webinar / Peserta / Detail</p>
            <h2 class="text-xl font-bold text-brand-dark tracking-tight">Detail Peserta</h2>
        </div>
    </x-slot>

    @include('admin.webinars.partials.styles')

    <div class="space-y-6 w-full">

        {{-- SECTION 1: Header --}}
        <div class="reveal-section flex items-center justify-between flex-wrap gap-4" data-delay="1">
            <div>
                <h3 class="font-bold text-brand-dark text-lg">Detail Peserta</h3>
                <p class="text-sm text-slate-400 mt-1">Informasi lengkap peserta webinar.</p>
            </div>
            <a href="{{ route('admin.webinars.participants.index', $webinar) }}"
               class="inline-flex items-center gap-2 px-4 py-2.5 rounded-lg text-sm font-medium text-slate-600 border border-slate-200 transition-all duration-200 hover:bg-slate-50 hover:border-slate-300">
                <i class="fa-solid fa-arrow-left text-xs"></i> Kembali
            </a>
        </div>

        {{-- SECTION 2: Dua kolom info --}}
        <div class="reveal-section grid grid-cols-1 md:grid-cols-2 gap-5" data-delay="2">

            {{-- Informasi Peserta --}}
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 px-6 py-6 transition-all duration-300 hover:shadow-md">
                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-4">Informasi Peserta</p>
                <div class="space-y-4">
                    @foreach ([
                        ['label' => 'Nama Lengkap', 'value' => $participant->name],
                        ['label' => 'Email', 'value' => $participant->email],
                        ['label' => 'Nomor WhatsApp', 'value' => $participant->whatsapp],
                        ['label' => 'Instansi / Pekerjaan', 'value' => $participant->institution],
                        ['label' => 'Tanggal Daftar', 'value' => $participant->created_at?->translatedFormat('d M Y, H:i') . ' WIB'],
                    ] as $field)
                        <div class="p-3 rounded-xl border border-slate-100 transition-all duration-200 hover:border-brand-mint/50 hover:bg-brand-cream/30">
                            <p class="text-xs text-slate-400 uppercase font-semibold mb-1">{{ $field['label'] }}</p>
                            <p class="text-sm font-medium text-brand-dark">{{ $field['value'] ?? '-' }}</p>
                        </div>
                    @endforeach

                    <div class="p-3 rounded-xl border border-slate-100 transition-all duration-200 hover:border-brand-mint/50 hover:bg-brand-cream/30">
                        <p class="text-xs text-slate-400 uppercase font-semibold mb-1">Catatan</p>
                        <p class="text-sm text-slate-500">{{ $participant->notes ?? 'Belum ada catatan tambahan.' }}</p>
                    </div>
                </div>
            </div>

            {{-- Informasi Webinar --}}
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden transition-all duration-300 hover:shadow-md">
                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider px-6 pt-6 mb-3">Informasi Webinar</p>
                <div class="relative h-40 mx-6 rounded-xl overflow-hidden bg-slate-100">
                    @if($webinar->thumbnail)
                        <img src="{{ Storage::url($webinar->thumbnail) }}" class="h-full w-full object-cover transition-transform duration-500 hover:scale-105" alt="{{ $webinar->title }}">
                    @else
                        <div class="h-full w-full flex items-center justify-center bg-gradient-to-br from-brand-mint/10 to-brand-teal/10">
                            <i class="fa-solid fa-video text-slate-300 text-3xl"></i>
                        </div>
                    @endif
                </div>
                <div class="px-6 py-5">
                    <h4 class="font-semibold text-brand-dark text-sm mb-3">{{ $webinar->title }}</h4>
                    <div class="space-y-2 text-xs text-slate-500">
                        <div class="flex items-center gap-2"><i class="fa-regular fa-calendar text-brand-mint w-3.5"></i>{{ $webinar->webinar_date?->translatedFormat('d M Y') }}</div>
                        <div class="flex items-center gap-2"><i class="fa-regular fa-clock text-brand-mint w-3.5"></i>{{ $webinar->webinar_time }} WIB</div>
                        <div class="flex items-center gap-2"><i class="fa-solid fa-users text-brand-mint w-3.5"></i>{{ $webinar->participants_count ?? $webinar->participants()->count() }} / {{ $webinar->quota ?? '∞' }} Peserta</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>