<div class="card-body">
    @if ($page == "create")
    {!! Form::open(['route' => 'house-categories.store', 'class' => 'form house-category-form']) !!}
    @else
    {!! Form::open(['route' => ['house-categories.update', $category->id ], 'class' => 'form house-category-form']) !!}
    @method('PUT')
    @endif
    <div id="invoice-items-details">
        <h4 class="form-section"><i class="ft-grid"></i>@lang('hrm::house-details.category.title') @lang('labels.form')</h4>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('name',  trans('hrm::house-details.house_type'), ['class' => 'form-label required']) !!}
                    {!! Form::text('name', $page == "edit" ? $category->name : null, 
                    [
                        'class' => "form-control required",
                        'placeholder' => trans('hrm::house-details.house_type'),
                        'data-msg-required'=> __('labels.This field is required'),
                        'data-rule-maxlength' => 255,
                        'data-msg-maxlength'=> trans('labels.At most 255 characters'),
                     ])!!}
                    <!-- error message -->
                    @if ($errors->has('name'))
                        <div class="help-block text-danger">
                            {{ $errors->first('name') }}
                        </div>
                    @endif
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('eligible_from', trans('hrm::house-details.category.eligible_from'), ['class' => 'form-label required']) !!}
                    {!! Form::number('eligible_from',  $page == "edit" ? $category->eligible_from : null, 
                    [
                        'class' => 'form-control required',
                        'placeholder' => trans('hrm::house-details.category.eligible_from'),
                        'data-msg-required'=> __('labels.This field is required'),
                        'max' => 1000,
                        'data-msg-max'=> trans('labels.Please enter a value less than or equal to 1000'),
                        'min' => 1,
                        'data-msg-min' => trans('labels.Please enter a value less than or equal to 1')
                     ])!!}
                    <!-- error message -->
                    @if ($errors->has('eligible_from'))
                        <div class="help-block text-danger">
                            {{ $errors->first('eligible_from') }}
                        </div>
                    @endif
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('eligible_to', trans('hrm::house-details.category.eligible_to'), ['class' => 'form-label required']) !!}
                    {!! Form::number('eligible_to',  $page == "edit" ? $category->eligible_to : null, 
                    [
                        'class' => 'form-control required',
                        'placeholder' => trans('hrm::house-details.category.eligible_to'),
                        'data-msg-required'=> __('labels.This field is required'),
                        'max' => 1000,
                        'data-msg-max'=> trans('labels.Please enter a value less than or equal to 1000'),
                        'min' => 1,
                        'data-msg-min' => trans('labels.Please enter a value less than or equal to 1')
                     ])!!}
                     <!-- error message -->
                     @if ($errors->has('eligible_to'))
                        <div class="help-block text-danger">
                            {{ $errors->first('eligible_to') }}
                        </div>
                    @endif
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('Remark', trans('labels.remarks'), ['class' => 'form-label'])!!}
                    {!! Form::textarea('remark',  $page == "edit" ? $category->remark : null, ['class' => 'form-control', 'rows' => 2,
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
        <a class="btn btn-warning mr-1" role="button" href="{{route('house-categories.index')}}">
            <i class="ft-x"></i> @lang('labels.cancel')
        </a>
    </div>
    {!! Form::close() !!}
</div>