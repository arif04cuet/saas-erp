{!! Form::open(['route' =>  ['inventory-request.edit.initial', $type, $inventoryRequest->id], 'class' => 'form inventory-request-form']) !!}
@method('put')
<h4 class="form-section">
    <i class="la la-tag"></i>
    @lang('ims::inventory.inventory_request_form_title', ['type' =>
 __('ims::inventory.inventory_request_types.' . $type)])
</h4>
<div class="row">
    <div class="col-md-7">
        <div class="form-group">
            {!! Form::label('title', trans('ims::inventory.inventory_request_title'), ['class' => 'form-label required']) !!}
            {!! Form::text('title', $inventoryRequest->title,
                [
                    'class' => 'form-control'. ($errors->has('title') ? ' is-invalid' : ''),
                    "required",
                    "placeholder" => trans('ims::inventory.inventory_request_title'),
                    'data-msg-required' => trans('validation.required', ['attribute' => trans('ims::inventory.inventory_request_title')]),
                    'data-rule-maxlength' => 100,
                    'data-msg-maxlength'=> trans('labels.At most 100 characters'),
                ])
            !!}
            <div class="help-block"></div>
            @if ($errors->has('title'))
                <span class="invalid-feedback">{{ $errors->first('title') }}</span>
            @endif
        </div>
    </div>
    <div class="col-md-5">
        <table class="table table-striped">
            @if($inventoryRequest->type)
                <tr>
                    <th>@lang('ims::inventory.inventory_request_type')</th>
                    <td>{{ trans('ims::inventory.inventory_request_types.' . $inventoryRequest->type) }}</td>
                    {{--                <td>{{ $inventoryRequest->receiver_id }}</td>--}}
                </tr>
            @endif

            @if($inventoryRequest->receiver_id)
                <tr>
                    <th>@lang('labels.receiver')</th>
                    <td>{{ $inventoryRequest->receiver->name }}</td>
                    {{--                <td>{{ $inventoryRequest->receiver_id }}</td>--}}
                </tr>
            @endif

            @if($inventoryRequest->from_location_id)
                <tr>
                    <th>@lang('ims::location.from_location')</th>
                    <td>{{ $inventoryRequest->fromLocation->name }}</td>
                    {{--                <td>{{ $inventoryRequest->from_location_id }}</td>--}}
                </tr>
            @endif

            @if($inventoryRequest->to_location_id)
                <tr>
                    <th>@lang('ims::location.to_location')</th>
                    <td>{{ $inventoryRequest->toLocation->name }}</td>
                    {{--                <td>{{ $inventoryRequest->to_location_id }}</td>--}}
                </tr>
            @endif

            <tr>
                <th>@lang('ims::inventory.inventory_request_purpose')</th>
                <td>{{ __('ims::inventory.inventory_request_purposes.' . $inventoryRequest->purpose) }}</td>
            </tr>
        </table>
    </div>
</div>

<div class="form-actions text-center">
    <button type="submit" name="give_detail" value="1" class="btn btn-outline-primary">
        <i class="la la-chevron-right"></i> @lang('labels.update') @lang('labels.and') @lang('labels.next')
    </button>
    <button type="submit" name="give_detail" value="0" class="btn btn-primary">
        <i class="la la-check-square-o"></i> @lang('labels.update')
    </button>
    <a class="btn btn-warning mr-1" role="button" href="{{ route('inventory-request.index') }}">
        <i class="la la-close"></i> @lang('labels.cancel')
    </a>
</div>
{!! Form::close() !!}
