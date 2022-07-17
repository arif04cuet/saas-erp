<div class="card-body">
    @if($page == "create")
        {!! Form::open(['route' => 'venue-selections.store', 'class' => 'form venue-selection-form']) !!}
    @else
        {!! Form::open(['route' => ['venue-selections.update', $venue->id], 'class' => 'form venue-selection-form']) !!}
        @method('put')
    @endif
    <div id="invoice-items-details" class="">
        <h4 class="form-section"><i class="la la-tag"></i>@lang('cafeteria::venue-selection.title') @lang('labels.form')</h4>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('Training',  trans('cafeteria::venue-selection.training'), ['class' => 'form-label required']) !!}
                    {!! Form::select('training_id', $trainings, $page == "edit" ? $venue->training_id : null, ['class' =>
                    "form-control required training-dropdown",
                    'placeholder' => trans('labels.select'),
                    'data-msg-required'=> __('labels.This field is required')
                     ])!!}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('Selection date',  trans('labels.date'), ['class' => 'form-label required']) !!}
                    {!! Form::text('selection_date', $page == "edit" ? $venue->selection_date : date('Y-m-d'), ['class' =>
                    "form-control required selection-date",
                    'placeholder' => trans('labels.date'),
                    'data-msg-required'=> __('labels.This field is required')
                     ])!!}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('Food Type', trans('cafeteria::venue-selection.food_type'), ['class' => 'form-label required']) !!}
                    {!! Form::text('food_type',  $page == "edit" ? $venue->food_type : null, ['class' =>
                    'form-control required',
                    'placeholder' => trans('cafeteria::venue-selection.type_ex'),
                    'data-msg-required'=> __('labels.This field is required'),
                    'data-rule-maxlength' => 50,
                    'data-msg-maxlength'=> trans('labels.At most 50 characters'),
                     ])!!}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('total_trainee', trans('cafeteria::venue-selection.total_trainee'), ['class' => 'form-label required']) !!}
                    {!! Form::text('total_trainee',  $page == "edit" ? $venue->total_trainee : null, ['class' =>
                    'form-control required',
                    'placeholder' => trans('cafeteria::venue-selection.total_trainee'),
                    'data-msg-required'=> __('labels.This field is required'),
                    'data-rule-maxlength' => 7,
                    'data-msg-maxlength'=> trans('labels.At most 7 characters'),
                     ])!!}
                </div>
            </div>
           <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('venues',  trans('cafeteria::venue-selection.venue'), ['class' => 'form-label required']) !!}
                    {!! Form::select('cafeteria_venue_id', $venues, $page == "edit" ? $venue->cafeteria_venue_id : null, ['class' =>
                    "form-control required venue-dropdown",
                    'placeholder' => trans('labels.select'),
                    'data-msg-required'=> __('labels.This field is required')
                    ])!!}
                </div>
           </div>
            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('Remark', trans('labels.remarks'), ['class' => 'form-label'])!!}
                    {!! Form::textarea('remark', $page == "edit" ? $venue->remark : null, ['class' => 'form-control', 'rows' => 2,
                    'data-rule-maxlength' => 255,
                    'data-msg-maxlength'=> trans('labels.At most 255 characters'),
                     ])!!}
                    <div class="help-block"></div>
                    @if ($errors->has('remark'))
                        <span class="invalid-feedback">{{ $errors->first('remark') }}</span>
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
        <a class="btn btn-warning mr-1" role="button" href="{{route('venue-selections.index')}}">
            <i class="ft-x"></i> @lang('labels.cancel')
        </a>
    </div>
    {!! Form::close() !!}
</div>