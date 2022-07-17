<div class="form-body">
    <!-- Training English & Bangla Name -->
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                {{ Form::label('name_english', trans('tms::training_type.form_elements.name_english'), ['class' => 'required'] ) }}
                {{ Form::text('name_english',
                    old('name_english') ?? $trainingType->name_english?? NULL,
                    [
                        'class' => 'form-control',
                        'placeholder' => '',
                        'required' => 'required',
                        'data-msg-required' => trans('labels.This field is required'),
                        'data-rule-minlength' => 3,
                        'data-msg-minlength'=> trans('labels.At least 3 characters'),
                        'data-rule-maxlength' => 100,
                        'data-msg-maxlength'=> trans('labels.At most 100 characters'),
                        'data-validation-regex-regex' => '^([\x3Aa-zA-Z0-9\u002D\u0028\u0029\u005F\u0020])+$',
                        'data-validation-regex-message' => trans('tms::training_type.msg.regex.eng')
                    ])
                }}
                <div class="help-block"></div>
                @if ($errors->has('name_english'))
                    <div class="help-block">  {{ $errors->first('name_english') }}</div>
                @endif
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {{ Form::label('name_bangla', trans('tms::training_type.form_elements.name_bangla'), ['class' => 'required'] ) }}
                {{ Form::text('name_bangla',
                    old('name_bangla') ?? $trainingType->name_bangla?? NULL,
                    [
                        'class' => 'form-control',
                        'placeholder' => '',
                        'required' => 'required',
                        'data-msg-required' => trans('labels.This field is required'),
                        'data-rule-minlength' => 3,
                        'data-msg-minlength'=> trans('labels.At least 3 characters'),
                        'data-rule-maxlength' => 100,
                        'data-msg-maxlength'=> trans('labels.At most 100 characters'),
                        'data-validation-regex-regex' => '^([\u0980-\u09FF\u005F\u0028\u0029\u0020\u002D])+$',
                        'data-validation-regex-message' => trans('tms::training_type.msg.regex.bn')
                    ])
                }}
                <div class="help-block"></div>
                @if ($errors->has('name_bangla'))
                    <div class="help-block">  {{ $errors->first('name_bangla') }}</div>
                @endif
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                {{ Form::label('parent_id', trans('tms::training_type.form_elements.parent'), ['class' => 'required'] ) }}
                {{ Form::select("parent_id", $parents, $trainingType->parent_id,
                    [
                        'class' => 'form-control select2',
                        'placeholder' => trans('labels.select'),
                    ])
                }}
                <div class="help-block"></div>
                @if ($errors->has('parent_id'))
                    <div class="help-block">  {{ $errors->first('parent_id') }}</div>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="form-actions mb-lg-3">
    <button type="submit" class="master btn btn-primary">
        <i class="la la-check-square-o"></i> {{trans('labels.save')}}
    </button>
    @if($page == 'edit')
        @include('tms::venue.partials.buttons.cancel',['route_name'=>'training-type.index','id'=>null])
    @endif
</div>

