@if(count($pagination))
    @php
        extract($pagination);
    @endphp
    <ul class="page-numbers nav-pagination links text-center">
        @if ($current_page > 1 && $total_page > 1)
            <li>
                <a class="next page-number" href="{!! url()->current() !!}?page={!! $total_page-1 !!}">
                    <i class="icon-angle-left"></i>
                </a>
            </li>
        @endif
        @for ($i = 1; $i <= $total_page; $i++)
            @if ($i == $current_page)
                <li>
                    <span aria-current="page" class="page-number current">{!! $i !!}</span>
                </li>
            @else
                <li>
                    <a class="page-number" href="{!! url()->current() !!}?page={!! $i !!}">{!! $i !!}</a>
                </li>
            @endif
        @endfor

        @if ($current_page < $total_page && $total_page > 1)
            <li>
                <a class="next page-number" href="{!! url()->current() !!}?page={!! $total_page+1 !!}">
                    <i class="icon-angle-right"></i>
                </a>
            </li>
        @endif
    </ul>
@endif
