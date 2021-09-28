@php
    $params = null;
    $filters = request()->all();
    if (isset($filters['page'])) {
        unset($filters['page']);
    }
    foreach ($filters as $key => $r) {
        $params = $params.'&'.$key.'='.$r;
    }
@endphp
<div class="row">
    <div class="col-sm-12 col-md-5">
        <div class="dataTables_info" id="zero_config_info" role="status" aria-live="polite">
            Znaleziono {{ $data->total() }} rekordów
        </div>
    </div>
    <div class="col-sm-12 col-md-7">
        <div class="dataTables_paginate paging_simple_numbers" id="zero_config_paginate">
            <ul class="pagination float-right" style="overflow: scroll; max-width: 100%;">
                <li class="paginate_button page-item previous {{ ($data->currentPage() == 1) ? 'disabled' : '' }}" id="zero_config_previous">
                    <a href="{{ $data->url($data->currentPage() - 1) }}" aria-controls="zero_config" data-dt-idx="0" tabindex="0" class="page-link">
                        <i class="icon icon-left"></i>
                    </a>
                </li>
                @for($i = 1; $i <= $data->lastPage(); $i++)
                    <li class="paginate_button page-item {{ ($data->currentPage() == $i) ? 'active' : '' }}">
                        <a href="{{ $data->url($i) }}{{ $params }}" aria-controls="zero_config" data-dt-idx="1" tabindex="0" class="page-link">{{ $i }}</a>
                    </li>
                @endfor
                <li class="paginate_button page-item next {{ ($data->currentPage() == $data->lastPage()) ? 'disabled' : '' }}" id="zero_config_next">
                    <a href="{{ $data->url($data->currentPage()+1) }}" aria-controls="zero_config" data-dt-idx="7" tabindex="0" class="page-link">
                        <i class="icon icon-right"></i>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
