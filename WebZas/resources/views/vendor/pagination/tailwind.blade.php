@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}">

        {{-- Mobile --}}
        <div class="flex gap-2 items-center justify-between sm:hidden">

            @if ($paginator->onFirstPage())
                <span class="inline-flex items-center px-4 py-2 text-sm font-medium text-zas-dark bg-white border border-zas-light cursor-not-allowed rounded-md">
                    {!! __('pagination.previous') !!}
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" rel="prev"
                   class="inline-flex items-center px-4 py-2 text-sm font-medium text-zas-gray bg-white border border-zas-gray rounded-md hover:bg-zas-light transition">
                    {!! __('pagination.previous') !!}
                </a>
            @endif

            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" rel="next"
                   class="inline-flex items-center px-4 py-2 text-sm font-medium text-zas-gray bg-white border border-zas-gray rounded-md hover:bg-zas-light transition">
                    {!! __('pagination.next') !!}
                </a>
            @else
                <span class="inline-flex items-center px-4 py-2 text-sm font-medium text-zas-dark bg-white border border-zas-light cursor-not-allowed rounded-md">
                    {!! __('pagination.next') !!}
                </span>
            @endif

        </div>

        {{-- Desktop --}}
        <div class="hidden sm:flex sm:items-center sm:justify-between">

            <div>
                <p class="text-sm text-zas-primary">
                    {!! __('Showing') !!}
                    @if ($paginator->firstItem())
                        <span class="font-semibold">{{ $paginator->firstItem() }}</span>
                        {!! __('to') !!}
                        <span class="font-semibold">{{ $paginator->lastItem() }}</span>
                    @else
                        {{ $paginator->count() }}
                    @endif
                    {!! __('of') !!}
                    <span class="font-semibold">{{ $paginator->total() }}</span>
                    {!! __('results') !!}
                </p>
            </div>

            <div>
                <span class="inline-flex shadow-sm rounded-md">

                    {{-- Previous --}}
                    @if ($paginator->onFirstPage())
                        <span class="inline-flex items-center px-2 py-2 text-zas-primary bg-white border border-zas-primary cursor-not-allowed rounded-l-md">
                            ‹
                        </span>
                    @else
                        <a href="{{ $paginator->previousPageUrl() }}" rel="prev"
                           class="inline-flex items-center px-2 py-2 text-zas-primary bg-white border border-zas-primary rounded-l-md hover:bg-zas-light transition">
                            ‹
                        </a>
                    @endif

                    {{-- Pages --}}
                    @foreach ($elements as $element)

                        @if (is_string($element))
                            <span class="inline-flex items-center px-4 py-2 text-sm text-zas-dark bg-white border border-zas-light">
                                {{ $element }}
                            </span>
                        @endif

                        @if (is_array($element))
                            @foreach ($element as $page => $url)

                                @if ($page == $paginator->currentPage())
                                    <span class="inline-flex items-center px-4 py-2 text-sm font-semibold text-white bg-zas-primary border border-zas-primary">
                                        {{ $page }}
                                    </span>
                                @else
                                    <a href="{{ $url }}"
                                       class="inline-flex items-center px-4 py-2 text-sm font-medium text-zas-primary bg-white border border-zas-primary hover:bg-zas-light transition">
                                        {{ $page }}
                                    </a>
                                @endif

                            @endforeach
                        @endif

                    @endforeach

                    {{-- Next --}}
                    @if ($paginator->hasMorePages())
                        <a href="{{ $paginator->nextPageUrl() }}" rel="next"
                           class="inline-flex items-center px-2 py-2 text-zas-primary bg-white border border-zas-primary rounded-r-md hover:bg-zas-light transition">
                            ›
                        </a>
                    @else
                        <span class="inline-flex items-center px-2 py-2 text-zas-primary bg-white border border-zas-primary cursor-not-allowed rounded-r-md">
                            ›
                        </span>
                    @endif

                </span>
            </div>
        </div>
    </nav>
@endif