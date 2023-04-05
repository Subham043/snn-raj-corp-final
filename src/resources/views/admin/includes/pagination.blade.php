@if($data->total() > 0)
<div class="d-flex justify-content-end">
    <div class="pagination-wrap hstack gap-2">
        <a class="page-item pagination-prev {{ $data->currentPage() > 1 ? '' : 'disabled' }} " href="{{ $data->currentPage() > 1 ? $data->previousPageUrl() : '#' }}">
            Previous
        </a>
        <ul class="pagination listjs-pagination mb-0">
            @for ($i = 1; $i <= $data->lastPage(); $i++)
            <li class=" {{ $data->currentPage() == $i ? 'active' : '' }}"><a class="page" href="{{$data->url($i)}}">{{ $i }}</a></li>
            @endfor
        </ul>
        <a class="page-item pagination-next {{ $data->currentPage() == $data->lastPage() ? 'disabled' : '' }}" href="{{ $data->currentPage() == $data->lastPage() ? '#' : $data->nextPageUrl() }}">
            Next
        </a>
    </div>
</div>
@endif
