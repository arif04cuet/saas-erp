{!! Form::open(['route' =>  ['inventory-request.store.detail.edit', $type, $data['id']], 'class' => 'form inventory-request-form']) !!}

<h4 class="title"><i class="la la-tag"></i>@lang('ims::inventory.inventory_request') @lang('labels.details')</h4>
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

@foreach($bladesName as $bladeName)
    @include('ims::inventory.request.partials.component.'. $bladeName)
@endforeach

<div class="form-actions text-center">
    <button type="submit" class="btn btn-primary">
        <i class="la la-check-square-o"></i>@lang('labels.save')
    </button>
    <a class="btn btn-warning mr-1" role="button" href="{{ route('inventory-request.index') }}">
        <i class="ft-x"></i> @lang('labels.cancel')
    </a>
</div>

{!! Form::close() !!}
