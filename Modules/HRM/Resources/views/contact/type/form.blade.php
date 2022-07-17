<div class="card-body">
    @if ($page == "create")
    {!! Form::open(['route' => 'contact-types.store', 'class' => 'form contact-type-form']) !!}
    @else
    {!! Form::open(['route' => ['contact-types.update', $type->id ], 'class' => 'form contact-type-form']) !!}
    @method('PUT')
    @endif
    <div id="invoice-items-details">
        <h4 class="form-section"><i class="ft-grid"></i>@lang('hrm::contact.type.title') @lang('labels.form')</h4>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('name',  trans('labels.name'), ['class' => 'form-label required']) !!}
                    {!! Form::text('name', $page == "edit" ? $type->name : null, 
                    [
                        'class' => "form-control required",
                        'placeholder' => trans('labels.name'),
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
                    {!! Form::label('Remark', trans('labels.remarks'), ['class' => 'form-label'])!!}
                    {!! Form::textarea('remark',  $page == "edit" ? $type->remark : null, ['class' => 'form-control', 'rows' => 2,
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
        <a class="btn btn-warning mr-1" role="button" href="{{route('contact-types.index')}}">
            <i class="ft-x"></i> @lang('labels.cancel')
        </a>
    </div>
    {!! Form::close() !!}
</div>