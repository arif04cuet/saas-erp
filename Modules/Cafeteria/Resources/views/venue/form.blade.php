<div class="card-body">
    @if ($page == "create")
    {!! Form::open(['route' => 'venues.store', 'class' => 'form venue-form']) !!}
    @else
    {!! Form::open(['route' => ['venues.update', $venue->id ], 'class' => 'form venue-form']) !!}
    @method('PUT')
    @endif
    <div id="invoice-items-details" class="">
        <h4 class="form-section"><i class="la la-tag"></i>@lang('cafeteria::venue.title') @lang('labels.form')</h4>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('Name (Bangla)',  trans('cafeteria::unit.bangla_name'), ['class' => 'form-label required']) !!}
                    {!! Form::text('name_bn', $page == "edit" ? $venue->name_bn : null, ['class' =>
                    "form-control required",
                    'placeholder' => trans('cafeteria::unit.bangla_name'),
                    'data-msg-required'=> __('labels.This field is required'),
                    'data-rule-maxlength' => 50,
                    'data-msg-maxlength'=> trans('labels.At most 50 characters'),
                     ])!!}
                    <div class="help-block"></div>
                    @if ($errors->has('name_bn'))
                        <span class="red">{{ $errors->first('name_bn') }}</span>
                    @endif
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('Name (English)', trans('cafeteria::unit.english_name'), ['class' => 'form-label required']) !!}
                    {!! Form::text('name_en',  $page == "edit" ? $venue->name_en : null, ['class' =>
                    'form-control required',
                    'placeholder' => trans('cafeteria::unit.english_name'),
                    'data-msg-required'=> __('labels.This field is required'),
                    'data-rule-maxlength' => 50,
                    'data-msg-maxlength'=> trans('labels.At most 50 characters'),
                     ])!!}
                    <div class="help-block"></div>
                    @if ($errors->has('name_en'))
                        <span class="red">{{ $errors->first('name_en') }}</span>
                    @endif 
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('Location', trans('cafeteria::venue.location'), ['class' => 'form-label required'])!!}
                    {!! Form::text('location',  $page == "edit" ? $venue->location : null, ['class' => 'form-control required',
                    'data-rule-maxlength' => 50,
                    'data-msg-required'=> __('labels.This field is required'),
                    'data-msg-maxlength'=> trans('labels.At most 50 characters'),
                     ])!!}
                    <div class="help-block"></div>
                    @if ($errors->has('location'))
                        <span class="red">{{ $errors->first('location') }}</span>
                    @endif
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('Priority Level', trans('cafeteria::venue.priority_level'), ['class' => 'form-label required'])!!}
                    {!! Form::number('priority_level',  $page == "edit" ? $venue->priority_level : null, ['class' => 'form-control required',
                    'min' => 1,
                    'max' => 10,
                    'data-msg-required'=> __('labels.This field is required'),
                     ])!!}
                    <div class="help-block"></div>
                    @if ($errors->has('priority_level'))
                        <span class="red">{{ $errors->first('priority_level') }}</span>
                    @endif
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('Description', trans('cafeteria::venue.description'), ['class' => 'form-label'])!!}
                    {!! Form::textarea('description',  $page == "edit" ? $venue->description : null, ['class' => 'form-control',
                    'data-rule-maxlength' => 255,
                    'data-msg-maxlength'=> trans('labels.At most 255 characters'),
                     ])!!}
                    <div class="help-block"></div>
                    @if ($errors->has('description'))
                        <span class="red">{{ $errors->first('description') }}</span>
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
        <a class="btn btn-warning mr-1" role="button" href="{{route('venues.index')}}">
            <i class="ft-x"></i> @lang('labels.cancel')
        </a>
    </div>
    {!! Form::close() !!}
</div>