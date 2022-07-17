@if($page == 'create')
    {!! Form::open(['route' =>  ['training.store'], 'class' => 'form wizard-circle training-form', 'novalidate', 'method' => 'post']) !!}
@else
    {!! Form::open(['route' =>  ['training.update', $training->id], 'class' => 'form wizard-circle training-form', 'novalidate', 'method' => 'put']) !!}
@endif

<div class="form-body">
    <h4 class="form-section"><i class="ft-user"></i> @lang('tms::training.create_card_title') @lang('labels.form')</h4>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="level" class="form-label required">@lang('tms::training.training_category')</label>
                <div class="row">
                    <div class="col-md-4">
                        <div class="skin skin-flat">
                            {!! Form::radio('level', 'national', false, [
                                'class' => 'required training_level',
                                'data-msg-required' => Lang::get('labels.This field is required')
                                ]) !!}
                            <label>Category 1</label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="skin skin-flat">
                            {!! Form::radio('level', 'international', false, [
                                'class' => 'required training_level',
                                'data-msg-required' => Lang::get('labels.This field is required')
                                ]) !!}
                            <label>Category 2</label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="skin skin-flat">
                            {!! Form::radio('level', 'international', false, [
                                'class' => 'required training_level',
                                'data-msg-required' => Lang::get('labels.This field is required')
                                ]) !!}
                            <label>Category 3</label>
                        </div>
                    </div>
                </div>

                <div class="row radio-error"></div>
                @if ($errors->has('level'))
                    <div class="small danger">
                        <strong>{{ $errors->first('level') }}</strong>
                    </div>
                @endif

            </div>
        </div>
    </div>
</div>
<div class="form-actions mb-lg-3">
    <a class="btn btn-warning pull-right" role="button" href="{{ route('training.index') }}" style="margin-left: 2px;">
        <i class="la la-times"></i> {{trans('labels.cancel')}}
    </a>
    <button type="submit" class="btn btn-primary pull-right">
        <i class="la la-check-square-o"></i> {{trans('labels.save')}}
    </button>
</div>

{!! Form::close() !!}
