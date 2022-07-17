<div class="card-body">
    @if ($page == "create")
        {!! Form::open(['route' => 'vms.maintenance.item.store', 'class' => 'form company-form']) !!}
    @else
        {!! Form::open(['route' => ['vms.maintenance.item.update', $item->id], 'class' => 'form maintenanceIteForm']) !!}
        @method('PUT')
    @endif
    <div id="invoice-items-details" class="">
        <h4 class="form-section"><i class="la la-tag"></i>@lang('vms::maintenanceItem.menu.sub_menu_items') @lang('labels.form')</h4>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                {!! Form::label('name', 'requisition ID',
                ['class' => 'form-label required']) !!}
                {!! Form::text('item_name_en', $page == "edit" ? $item->item_name_en : null, ['class' =>
                'form-control required',
                'placeholder' => trans('vms::requisition.table.item_name_en'),
                'data-msg-required'=> __('labels.This field is required'),
                'data-rule-maxlength' => 255,
                'data-msg-maxlength'=> trans('labels.At most 255 characters') ])!!}
                <!-- error message -->
                    @if ($errors->has('item_name_en'))
                        <div class="help-block text-danger">
                            {{ $errors->first('item_name_en') }}
                        </div>
                    @endif
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                {!! Form::label('name', 'date',
                ['class' => 'form-label required']) !!}
                {!! Form::text('item_name_en', $page == "edit" ? $item->item_name_en : null, ['class' =>
                'form-control required',
                'placeholder' => trans('vms::requisition.table.item_name_en'),
                'data-msg-required'=> __('labels.This field is required'),
                'data-rule-maxlength' => 255,
                'data-msg-maxlength'=> trans('labels.At most 255 characters') ])!!}
                <!-- error message -->
                    @if ($errors->has('item_name_en'))
                        <div class="help-block text-danger">
                            {{ $errors->first('item_name_en') }}
                        </div>
                    @endif
                </div>
            </div>


            <div class="col-md-6">
                <div class="form-group">
                {!! Form::label('name','transport',
                ['class' => 'form-label required']) !!}
                {!! Form::text('item_name_en', $page == "edit" ? $item->item_name_en : null, ['class' =>
                'form-control required',
                'placeholder' => trans('vms::requisition.table.item_name_en'),
                'data-msg-required'=> __('labels.This field is required'),
                'data-rule-maxlength' => 255,
                'data-msg-maxlength'=> trans('labels.At most 255 characters') ])!!}
                <!-- error message -->
                    @if ($errors->has('item_name_en'))
                        <div class="help-block text-danger">
                            {{ $errors->first('item_name_en') }}
                        </div>
                    @endif
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                {!! Form::label('item_name_bn_lavel','User', ['class' => 'form-label']) !!}
                {!! Form::text('item_name_bn', $page == "edit" ? $item->item_name_en : null, ['class' =>
                'form-control',
                'placeholder' => trans('vms::requisition.table.item_name_bn'),
                 'data-msg-required'=> __('labels.This field is required'),
                'data-rule-maxlength' => 255,
                'data-msg-maxlength'=> trans('labels.At most 255 characters')  ])!!}
                <!-- error message -->
                    @if ($errors->has('item_name_bn'))
                        <div class="help-block text-danger">
                            {{ $errors->first('item_name_bn') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>

{{--        <div class="row">--}}
            @include('vms::requisition.itemTable')

{{--        </div>--}}

{{--        <div class="row">--}}
{{--            <div class="col-md-6">--}}
{{--                <div class="form-group">--}}
{{--                {!! Form::label('item_short_name_lavel', trans('vms::maintenanceItem.table.item_short_name'), ['class' => 'form-label']) !!}--}}
{{--                {!! Form::text('short_name', $page == "edit" ? $item->short_name : null, ['class' =>--}}
{{--                'form-control',--}}
{{--                'placeholder' => trans('vms::requisition.table.item_short_name'),--}}
{{--                 'data-msg-required'=> __('labels.This field is required'),--}}
{{--                'data-rule-maxlength' => 60,--}}
{{--                'data-msg-maxlength'=> trans('labels.At most 60 characters') ])!!}--}}
{{--                <!-- error message -->--}}
{{--                    @if ($errors->has('short_name'))--}}
{{--                        <div class="help-block text-danger">--}}
{{--                            {{ $errors->first('short_name') }}--}}
{{--                        </div>--}}
{{--                    @endif--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
        <!-- Save & Cancel Button -->
        <div class="form-actions text-center">
            <button type="submit" class="btn btn-success">
                <i class="ft-check-square"></i>
                @lang('labels.save')
            </button>
            <a class="btn btn-warning mr-1" role="button" href="{{ route('vms.requisition.index') }}">
                <i class="ft-x"></i> @lang('labels.cancel')
            </a>
        </div>
        {!! Form::close() !!}
        <br>
    </div>
</div>

@push('page-js')

@endpush
