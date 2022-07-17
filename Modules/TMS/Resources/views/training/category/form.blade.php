<div class="form-body">
    <!-- Training English & Bangla Name -->
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                {{-- {{ dd($trainingCategory->name_english) }} --}}
                {{ Form::label('name_english', trans('tms::training_type.form_elements.name_english'), ['class' => 'required'] ) }}
                {{ Form::text('name_english',
                    old('name_english') ?? $trainingCategory->name_english?? NULL,
                    [
                        'class' => 'form-control form-control-sm',
                        'placeholder' => '',
                        'required' => 'required',
                        'data-msg-required' => trans('labels.This field is required'),
                        'data-rule-minlength' => 3,
                        'data-msg-minlength'=> trans('labels.At least 3 characters'),
                        'data-rule-maxlength' => 100,
                        'data-msg-maxlength'=> trans('labels.At most 100 characters'),
                        'data-rule-regex-en' => config('regex.en'),
                        'data-rule-no-white-space' => '^(\s|\S)*(\S)+(\s|\S)*$',
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
                    old('name_bangla') ?? $trainingCategory->name_bangla?? NULL,
                    [
                        'class' => 'form-control form-control-sm',
                        'placeholder' => '',
                        'required' => 'required',
                        'data-msg-required' => trans('labels.This field is required'),
                        'data-rule-minlength' => 3,
                        'data-msg-minlength'=> trans('labels.At least 3 characters'),
                        'data-rule-maxlength' => 100,
                        'data-msg-maxlength'=> trans('labels.At most 100 characters'),
                        'data-rule-regex-bn' => config('regex.bn'),
                        'data-rule-no-white-space' => '^(\s|\S)*(\S)+(\s|\S)*$',
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
                {{ Form::label('parent_id', trans('tms::training_type.form_elements.parent')) }}
                {{ Form::select("parent_id", $categoriesDropdown, $trainingCategory ? $trainingCategory->parent_id : NULL,
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

