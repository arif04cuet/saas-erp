<div class="card-body">
    @if ($page == "create")
    {!! Form::open(['route' => 'house-details.store', 'class' => 'form house-details-form']) !!}
    @else
    {!! Form::open(['route' => ['house-details.update', $house->id ], 'class' => 'form house-details-form']) !!}
    @method('PUT')
    @endif
    <div id="invoice-items-details" class="">
        <h4 class="form-section"><i class="ft-grid"></i>@lang('hrm::house-details.house_details') @lang('labels.form')</h4>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('house_id',  trans('hrm::house-details.house_id'), ['class' => 'form-label required']) !!}
                    {!! Form::text('house_id', $page == "edit" ? $house->house_id : null,
                    [
                        'class' => "form-control required",
                        'placeholder' => trans('hrm::house-details.house_id'),
                        'data-msg-required'=> __('labels.This field is required'),
                        'data-rule-maxlength' => 50,
                        'data-msg-maxlength'=> trans('labels.At most 50 characters'),
                     ])!!}
                    <!-- error message -->
                    @if ($errors->has('house_id'))
                        <div class="help-block text-danger">
                            {{ $errors->first('house_id') }}
                        </div>
                    @endif
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('house_type', trans('hrm::house-details.house_type'), ['class' => 'form-label required']) !!}
                    {!! Form::select('house_type',  $houseCategories, $page == "edit" ? $house->house_type : null,
                    [
                        'class' => 'form-control required select2',
                        'placeholder' => trans('labels.select'),
                        'data-msg-required'=> __('labels.This field is required'),
                     ])!!}
                    <!-- error message -->
                    @if ($errors->has('house_type'))
                        <div class="help-block text-danger">
                            {{ $errors->first('house_type') }}
                        </div>
                    @endif
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                {!! Form::label('status', trans('labels.status'), ['class' => 'form-label required']) !!}
                {!! Form::select('status',  Config::get('constants.house_allocate.status'), $page == "edit" ? $house->status : null,
                [
                    'class' => 'form-control select2 required',
                    'placeholder' => trans('labels.select'),
                    'data-msg-required'=> __('labels.This field is required')
                 ])!!}
                <!-- error message -->
                    @if ($errors->has('status'))
                        <div class="help-block text-danger">
                            {{ $errors->first('status') }}
                        </div>
                    @endif
                </div>
            </div>

            <div class="col-md-6 allocated_to_div">
                <div class="form-group">
                    {!! Form::label('allocated_to', trans('hrm::house-details.allocated_to'), ['class' => 'form-label']) !!}
                    {!! Form::select('allocated_to',  $employees, $page == "edit" ? $house->allocated_to : null,
                    [
                        'class' => 'form-control select2',
                        'placeholder' => trans('labels.select'),
                     ])!!}
                    <!-- error message -->
                    @if ($errors->has('allocated_to'))
                        <div class="help-block text-danger">
                            {{ $errors->first('allocated_to') }}
                        </div>
                    @endif
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('location', trans('hrm::house-details.location'), ['class' => 'form-label required']) !!}
                    {!! Form::text('location',  $page == "edit" ? $house->location : null,
                    [
                        'class' => 'form-control required',
                        'placeholder' => trans('hrm::house-details.location'),
                        'data-msg-required'=> __('labels.This field is required'),
                        'data-rule-maxlength' => 255,
                        'data-msg-maxlength'=> trans('labels.At most 255 characters'),
                     ])!!}
                    <!-- error message -->
                    @if ($errors->has('location'))
                        <div class="help-block text-danger">
                            {{ $errors->first('location') }}
                        </div>
                    @endif
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('capacity', trans('hrm::house-details.capacity'), ['class' => 'form-label']) !!}
                    {!! Form::number('capacity',  $page == "edit" ? $house->capacity : null,
                    [
                        'class' => 'form-control',
                        'placeholder' => trans('hrm::house-details.capacity'),
                        'max' => 1000,
                        'data-msg-max'=> trans('labels.Please enter a value less than or equal to 1000'),
                        'min' => 1,
                        'data-msg-min' => trans('labels.Please enter a value less than or equal to 1')
                     ])!!}
                     <!-- error message -->
                     @if ($errors->has('capacity'))
                        <div class="help-block text-danger">
                            {{ $errors->first('capacity') }}
                        </div>
                    @endif
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('Remark', trans('labels.remarks'), ['class' => 'form-label'])!!}
                    {!! Form::textarea('remark',  $page == "edit" ? $house->remark : null, ['class' => 'form-control', 'rows' => 2,
                    'data-rule-maxlength' => 255,
                    'data-msg-maxlength'=> trans('labels.At most 255 characters'),
                     ])!!}
                     <!-- error message -->
                     @if ($errors->has('remark'))
                        <div class="help-block text-danger">
                            {{ $errors->first('remark') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Save & Cancel Button -->
    <div class="form-actions text-center">
        <button type="submit" class="btn {{ $page == "edit" ? 'btn-primary' : 'btn-success'}}">
            <i class="ft-check-square"></i>
            @lang('labels.save')
        </button>
        <a class="btn btn-warning mr-1" role="button" href="{{route('house-details.index')}}">
            <i class="ft-x"></i> @lang('labels.cancel')
        </a>
    </div>
    {!! Form::close() !!}
</div>
