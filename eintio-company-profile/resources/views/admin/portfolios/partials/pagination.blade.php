@if ($paginator->hasPages())
    <div class="flex flex-wrap items-center justify-between gap-4">
        <p class="text-xs text-slate-400">
            Menampilkan {{ $paginator->firstItem() }}–{{ $paginator->lastItem() }} dari {{ $paginator->total() }} data
        </p>

        <nav class="flex items-center gap-1.5">
            {{-- Tombol Prev --}}
            @if ($paginator->onFirstPage())
                <span class="page-arrow is-disabled">
                    <i class="fa-solid fa-chevron-left text-xs"></i>
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" class="page-arrow">
                    <i class="fa-solid fa-chevron-left text-xs"></i>
                </a>
            @endif

            {{-- Nomor Halaman --}}
            @foreach ($elements as $element)
                @if (is_string($element))
                    <span class="page-btn is-ellipsis">{{ $element }}</span>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span class="page-btn is-active">{{ $page }}</span>
                        @else
                            <a href="{{ $url }}" class="page-btn">{{ $page }}</a>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Tombol Next --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" class="page-arrow">
                    <i class="fa-solid fa-chevron-right text-xs"></i>
                </a>
            @else
                <span class="page-arrow is-disabled">
                    <i class="fa-solid fa-chevron-right text-xs"></i>
                </span>
            @endif
        </nav>
    </div>
@endif