@component('tms::trainee.partials.components.edit_layout', [
            'trainee' => $trainee
            ])
    {!! Form::open(['url' =>  route('trainee.education-info.update', $trainee->id),
                                'class' => 'form trainee-edit-form',
                                'novalidate',
                                'method' => 'put'
                            ]) !!}
    <div class="form-body">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            {{ Form::label('degree', trans('tms::training.degree_name'), ['class' => 'required']) }}
                            <br/>
                            {!! Form::text('degree', optional($trainee->educations)->degree, [
                                'class' => 'form-control required' . ($errors->has('degree') ? ' is-invalid' : ''),
                                'data-msg-required' => Lang::get('labels.This field is required'),
                                'placeholder' => 'Bachelor of Science', 'data-rule-maxlength' => 50,
                                'data-msg-maxlength'=>Lang::get('labels.At most 50 characters'),
                                'data-rule-no-white-space' => '^(\s|\S)*(\S)+(\s|\S)*$',
                                ]) !!}

                            @if ($errors->has('degree'))
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('degree') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {{ Form::label('subject', trans('tms::training.degree_subject'), ['class' => 'required']) }}
                            <br/>
                            {!! Form::text('subject', optional($trainee->educations)->subject, [
                                'class' => 'form-control required' . ($errors->has('subject') ? ' is-invalid' : ''),
                                'data-msg-required' => Lang::get('labels.This field is required'),
                                'placeholder' => 'Computer Science',
                                'data-rule-maxlength' => 50,
                                'data-msg-maxlength'=>Lang::get('labels.At most 50 characters'),
                                'data-rule-no-white-space' => '^(\s|\S)*(\S)+(\s|\S)*$',
                                ]) !!}

                            @if ($errors->has('subject'))
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('subject') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            {{ Form::label('passing_year', trans('tms::training.passing_year'), ['class' => 'required']) }}
                            {!! Form::text(
                                'passing_year',
                                optional($trainee->educations)->passing_year,
                                [
                                    'class' => 'form-control required' . ($errors->has('passing_year') ? ' is-invalid' : ''),
                                    'data-msg-required' => Lang::get('labels.This field is required'),
                                    'placeholder' => 'xxxx',
                                    'data-rule-number' => 'true',
                                    'data-msg-number' => trans('labels.Please enter a valid number'),
                                    'data-rule-maxlength' => 4,
                                    'data-msg-maxlength'=>Lang::get('labels.At least 4 characters'),
                                    'data-rule-no-white-space' => '^(\s|\S)*(\S)+(\s|\S)*$',
                                ]
                            )!!}

                            @if ($errors->has('passing_year'))
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('passing_year') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {{ Form::label('institution',
                                trans('tms::training.education_board'). ' / ' .trans('tms::training.university'),
                                ['class' => 'required']
                                ) }}
                            <br/>
                            {!! Form::text('institution', optional($trainee->educations)->institution, [
                                'class' => 'form-control required' . ($errors->has('institution') ? ' is-invalid' : ''),
                                'data-msg-required' => Lang::get('labels.This field is required'),
                                'placeholder' => 'University of Dhaka',
                                'data-rule-maxlength' => 50,
                                'data-msg-maxlength'=>Lang::get('labels.At most 50 characters'),
                                'data-rule-no-white-space' => '^(\s|\S)*(\S)+(\s|\S)*$',
                                ]) !!}

                            @if ($errors->has('institution'))
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('institution') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="form-actions">
        <button type="submit" class="btn btn-primary">
            <i class="ft-check-square"></i> {{trans('labels.save')}}
        </button>
        <button class="btn btn-warning" type="button"
                onclick="window.location.href= '{{route('trainee.index', $trainee->training->id)}}'">
            <i class="ft-x"></i> {{trans('labels.cancel')}}
        </button>
    </div>
    {!! Form::close() !!}
@endcomponent
