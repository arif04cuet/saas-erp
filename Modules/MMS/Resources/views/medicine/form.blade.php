<div class="card-body">
    @if ($page == "create")
        {!! Form::open(['route' => 'medicine.store', 'class' => 'form company-form']) !!}
    @else
        {!! Form::open(['route' => ['medicine.update', $medicine->id], 'class' => 'form company-form']) !!}
        @method('PUT')
    @endif
    <div id="invoice-items-details" class="">
        <h4 class="form-section"><i class="la la-tag"></i>@lang('mms::medicine.title') @lang('labels.form')</h4>
        <div class="row">

            <div class="col-md-6">
                <div class="form-group">
                {!! Form::label('name', trans('mms::medicine.name'),
                ['class' => 'form-label required']) !!}
                {!! Form::text('name', $page == "edit" ? $medicine->name : null, ['class' =>
                'form-control required',
                'placeholder' => trans('mms::medicine.name'),
                'data-msg-required'=> __('labels.This field is required'),
                'data-rule-maxlength' => 255,
                'data-msg-maxlength'=> trans('labels.At most 255 characters') ])!!}
                <!-- error message -->
                    @if ($errors->has('name'))
                        <div class="help-block text-danger">
                            {{ $errors->first('name') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="row">

            <div class="col-md-6">
                <div class="form-group">
                {!! Form::label('generic_name_lavel', trans('mms::medicine.generic_name'),
                ['class' => 'form-label required']) !!}
                {!! Form::text('generic_name', $page == "edit" ? $medicine->generic_name : null, ['class' =>
                'form-control required',
                'placeholder' => trans('mms::medicine.generic_name'),
                'data-msg-required'=> __('labels.This field is required'),
                'data-rule-maxlength' => 255,
                'data-msg-maxlength'=> trans('labels.At most 255 characters') ])!!}
                <!-- error message -->
                    @if ($errors->has('generic_name'))
                        <div class="help-block text-danger">
                            {{ $errors->first('generic_name') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="row" id="group_root_div">
            <div class="col-md-6 dropdown-div">
                <div class="form-group">
                    {!! Form::label('group_lavel', trans('mms::medicine.group'),
                    ['class' => 'form-label required']) !!}
                    {!! Form::select('group_id', $medicine_group, $page == "edit" ? $medicine_group ? $medicine->group_id : null : null,
                    ['class' => 'form-control  dropdown-name employee-select',
                    'data-msg-required'=> __('labels.This field is required'),
                    'id'=>'group-dropdown'
                    ]) !!}
                    <button type="button" id="add_more_btn" class="btn btn-sm btn-success pull-right mt-1">Add</button>
                </div>
            </div>
        </div>
        @if ($errors->has('group_name'))
            @push('page-js')
                <script>
                    $(document).ready(function () {
                        $('#group-dropdown').removeClass('required');
                        $('#group_name').addClass('required');

                        $('#group_root_div').addClass('hidden').removeClass('show');
                        $('#Add_group').addClass('show').removeClass('hidden');

                    });
                </script>
            @endpush
        @endif
        <div class="row hidden" id="Add_group">
            <div class="col-md-6">
                <div class="form-group">
                {!! Form::label('group_name_lavel', trans('mms::medicine.group'), ['class' => 'form-label required']) !!}
                {!! Form::text('group_name', $page == "edit" ? null : null, ['class' =>
                'form-control',
                'placeholder' => trans('mms::medicine.group'),
                 'data-msg-required'=> __('labels.This field is required'),
                'data-rule-maxlength' => 255,
                'data-msg-maxlength'=> trans('labels.At most 255 characters') ,'id'=>'group_name' ])!!}
                <!-- error message -->
                    @if ($errors->has('group_name'))
                        <div class="help-block text-danger">
                            {{ $errors->first('group_name') }}
                        </div>
                    @endif
                    <button type="button" id="remove_more_btn" class="btn btn-sm btn-danger pull-right mt-1">Remove
                    </button>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                {!! Form::label('company', trans('mms::medicine.company_name'),
                ['class' => 'form-label']) !!}
                {!! Form::text('company_name', $page == "edit" ? $medicine->company_name : null, ['class' =>
                'form-control',
                'placeholder' => trans('mms::medicine.company_name'),
                'data-msg-required'=> __('labels.This field is required'),
                'data-rule-maxlength' => 255,
                'data-msg-maxlength'=> trans('labels.At most 255 characters') ])!!}
                <!-- error message -->
                    @if ($errors->has('company_name'))
                        <div class="help-block text-danger">
                            {{ $errors->first('company_name') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                {!! Form::label('categories_lavel', trans('mms::medicine.category_name'),
                ['class' => 'form-label']) !!}
                {!! Form::select('category_id', $inventory_categories, $page == "edit" ? $inventory_categories ? $medicine->category_id : null : null,
                ['class' => 'form-control  dropdown-name select2',
                'id'=>'group-dropdown'
                ]) !!}
                <!-- error message -->
                    @if ($errors->has('category_id'))
                        <div class="help-block text-danger">
                            {{ $errors->first('category_id') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
        {{--        <div class="row">--}}
        {{--            <div class="col-md-6">--}}
        {{--                <div class="form-group">--}}
        {{--                {!! Form::label('company', trans('mms::medicine.company_name'), ['class' => 'form-label']) !!}--}}
        {{--                {!! Form::select('company_id', $medicine_company, $page == "edit" ? $medicine_company ? $medicine->company_id : null : null,--}}
        {{--                ['class' => 'form-control required',--}}
        {{--                'data-msg-required'=> __('labels.This field is required'),--}}
        {{--                'id'=>'company-dropdown'--}}
        {{--                ]) !!}--}}
        {{--                <!-- error message -->--}}
        {{--                    @if ($errors->has('contact_person_name'))--}}
        {{--                        <div class="help-block text-danger">--}}
        {{--                            {{ $errors->first('contact_person_name') }}--}}
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
            <a class="btn btn-warning mr-1" role="button" href="{{ route('medicine.index') }}">
                <i class="ft-x"></i> @lang('labels.cancel')
            </a>
        </div>
        {!! Form::close() !!}
        <br>
    </div>
</div>

@push('page-js')
    <script>
        $('#add_more_btn').on('click', function () {
            var rconfirm = confirm("<?php echo trans('mms::medicine.group_add_alert')?>");
            if (rconfirm == true) {
                $('#group-dropdown').removeClass('required');
                $('#group_name').addClass('required');

                $('#group_root_div').addClass('hidden').removeClass('show');
                $('#Add_group').addClass('show').removeClass('hidden');
            } else {

            }
        });

        $('#remove_more_btn').on('click', function () {
            $('#group-dropdown').addClass('required');
            $('#Add_group').addClass('hidden').removeClass('show');
            $('#group_root_div').addClass('show').removeClass('hidden');
            $('#group_name').removeClass('required');
            $('#group_name').val('');

        });

    </script>
@endpush
