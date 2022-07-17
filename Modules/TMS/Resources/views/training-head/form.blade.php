<div class="form-body">
    <!-- Training English & Bangla Name -->
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                {{ Form::label('title_english', trans('tms::training_head.form_elements.title_english'), ['class' => 'required'] ) }}
                {{ Form::text('title_english',
                    old('title_english') ?? null,
                    [
                        'class' => 'form-control form-control-sm',
                        'placeholder' => '',
                        'required' => 'required',
                        'data-msg-required' => trans('labels.This field is required'),
                        'data-rule-minlength' => 3,
                        'data-msg-minlength'=> trans('labels.At least 3 characters'),
                        'data-rule-maxlength' => 100,
                        'data-msg-maxlength'=> trans('labels.At most 100 characters'),
                    ])
                }}
                <div class="help-block"></div>
                @if ($errors->has('title_english'))
                    <div class="help-block">  {{ $errors->first('title_english') }}</div>
                @endif
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {{ Form::label('title_bangla', trans('tms::training_head.form_elements.title_bangla'), ['class' => 'required'] ) }}
                {{ Form::text('title_bangla',
                    old('title_bangla') ?? null,
                    [
                        'class' => 'form-control form-control-sm',
                        'placeholder' => '',
                        'required' => 'required',
                        'data-msg-required' => trans('labels.This field is required'),
                        'data-rule-minlength' => 3,
                        'data-msg-minlength'=> trans('labels.At least 3 characters'),
                        'data-rule-maxlength' => 100,
                        'data-msg-maxlength'=> trans('labels.At most 100 characters'),
                    ])
                }}
                <div class="help-block"></div>
                @if ($errors->has('title_bangla'))
                    <div class="help-block">  {{ $errors->first('title_bangla') }}</div>
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
        @include('tms::venue.partials.buttons.cancel',['route_name'=>'training-name.index','id'=>null])
    @endif
</div>

