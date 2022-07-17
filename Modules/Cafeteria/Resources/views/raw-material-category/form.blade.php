<div class="card-body">
    @if ($page == "create")
    {!! Form::open(['route' => 'raw-material-categories.store', 'class' => 'form category-form']) !!}
    @else
    {!! Form::open(['route' => ['raw-material-categories.update', $category->id ], 'class' => 'form category-form']) !!}
    @method('PUT')
    @endif
    <div id="invoice-items-details" class="">
        <h4 class="form-section"><i class="la la-tag"></i>@lang('cafeteria::raw-material-category.title') @lang('labels.form')</h4>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('Name (Bangla)',  trans('cafeteria::cafeteria.bangla_name'), ['class' => 'form-label required']) !!}
                    {!! Form::text('bn_name', $page == "edit" ? $category->bn_name : null, ['class' =>
                    "form-control required",
                    'placeholder' => trans('cafeteria::cafeteria.bangla_name'),
                    'data-msg-required'=> __('labels.This field is required'),
                    'data-rule-maxlength' => 50,
                    'data-msg-maxlength'=> trans('labels.At most 50 characters'),
                     ])!!}
                    <div class="help-block"></div>
                    @if ($errors->has('bn_name'))
                        <span class="invalid-feedback">{{ $errors->first('bn_name') }}</span>
                    @endif
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('Name (English)', trans('cafeteria::cafeteria.english_name'), ['class' => 'form-label required']) !!}
                    {!! Form::text('en_name',  $page == "edit" ? $category->en_name : null, ['class' =>
                    'form-control required',
                    'placeholder' => trans('cafeteria::cafeteria.english_name'),
                    'data-msg-required'=> __('labels.This field is required'),
                    'data-rule-maxlength' => 50,
                    'data-msg-maxlength'=> trans('labels.At most 50 characters'),
                     ])!!}
                    <div class="help-block"></div>
                    @if ($errors->has('en_name'))
                        <span class="invalid-feedback">{{ $errors->first('en_name') }}</span>
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
        <a class="btn btn-warning mr-1" role="button" href="{{route('units.index')}}">
            <i class="ft-x"></i> @lang('labels.cancel')
        </a>
    </div>
    {!! Form::close() !!}
</div>