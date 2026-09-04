@props(['options' => ['Tahun ini', 'Tahun lalu']])

<div x-data="{ open: false, selected: '{{ $options[0] }}' }" class="relative">
    <button @click="open = !open" @click.outside="open = false"
            class="flex items-center gap-2 text-xs border border-slate-200 rounded-lg px-3 py-1.5 text-slate-500
                   transition-all duration-300 ease-smooth hover:border-brand-mint/40 hover:text-brand-dark hover:shadow-sm">
        <span x-text="selected"></span>
        <i class="fa-solid fa-chevron-down text-[10px] transition-transform duration-300 ease-smooth" :class="open && 'rotate-180'"></i>
    </button>

    <div x-show="open"
         x-transition:enter="transition ease-smooth duration-200"
         x-transition:enter-start="opacity-0 scale-95 -translate-y-1"
         x-transition:enter-end="opacity-100 scale-100 translate-y-0"
         x-transition:leave="transition ease-smooth duration-150"
         x-transition:leave-start="opacity-100 scale-100"
         x-transition:leave-end="opacity-0 scale-95"
         class="absolute right-0 mt-2 w-32 bg-white rounded-lg shadow-lg border border-slate-100 overflow-hidden z-20"
         style="display: none;">
        @foreach ($options as $opt)
            <button @click="selected = '{{ $opt }}'; open = false"
                    class="group/opt relative w-full text-left px-3 py-2 text-xs text-slate-600 overflow-hidden
                           transition-colors duration-200 ease-smooth hover:text-brand-dark hover:bg-brand-cream">
                <span x-show="selected === '{{ $opt }}'" class="absolute left-0 top-0 h-full w-1 bg-brand-mint"></span>
                {{ $opt }}
            </button>
        @endforeach
    </div>
</div>