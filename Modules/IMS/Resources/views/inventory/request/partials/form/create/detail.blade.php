{!! Form::open(['route' =>  ['inventory-request.store.detail.create', $type, $data['id']], 'class' => 'form inventory-request-form']) !!}

<h4 class=""><i class="la la-tag"></i>@lang('ims::inventory.inventory_request')</h4>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <table class="table table-striped">
                <tr>
                    <th width="20%">@lang('ims::inventory.inventory_request_title')</th>
                    <td>{{$data->title}}</td>
                </tr>
                <tr>
                    <th width="20%">@lang('ims::location.from_location')</th>
                    <td>{{optional($data->fromLocation)->getName() ?? ""}}</td>
                </tr>
                <tr>
                    <th width="20%">@lang('ims::location.to_location')</th>
                    <td>{{optional($data->toLocation)->getName() ?? ""}}</td>
                </tr>
                <tr>
                    <th>@lang('ims::inventory.inventory_request_purpose')</th>
                    <td>{{ __('ims::inventory.inventory_request_purposes.' . $data->purpose) }}</td>
                </tr>
            </table>
        </div>
    </div>
</div>

@foreach($bladesName as $key => $bladeName)
    @if ($key == 1) @php $key = 2 @endphp 
        @elseif($key == 2)  @php $key = 1 @endphp 
    @endif
    
    @include('ims::inventory.request.partials.component.'. $bladesName[$key])
@endforeach

<div class="form-actions text-center">
    <button type="submit" class="btn btn-primary">
        <i class="la la-check-square-o"></i>@lang('labels.submit')
    </button>
    <a class="btn btn-warning mr-1" role="button" href="{{ route('inventory-request.index') }}">
        <i class="la la-times"></i> @lang('labels.cancel')
    </a>
</div>

{!! Form::close() !!}
