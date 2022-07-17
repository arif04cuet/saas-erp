<h6>{{ trans('hrm::appraisal.standard') }}</h6>
<fieldset>
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="table-responsive">
                    <table class="table table-bordered mb-0">
                        <thead>
                        <tr>
                            <th scope="col">@lang('labels.serial')</th>
                            <th scope="col">@lang('labels.details')</th>
                            <th scope="col">@lang('hrm::appraisal.unique_general')</th>
                            <th scope="col">@lang('hrm::appraisal.excellent')</th>
                            <th scope="col">@lang('hrm::appraisal.good')</th>
                            <th scope="col">@lang('hrm::appraisal.aggregate')</th>
                            <th scope="col">@lang('hrm::appraisal.unsatisfactory')</th>
                            <th scope="col">@lang('labels.remarks')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($appraisalContents as $appraisalContent)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>@lang('hrm::appraisal.' . $appraisalContent->name)</td>
                                <td>
                                    <div class="card-body">
                                        <div class="skin skin-flat">
                                            <fieldset>
                                                @php
                                                    $fieldName = 'content['.$appraisalContent->id.']';
                                                @endphp
                                                {{ Form::radio($fieldName.'[value]', 5) }}
                                            </fieldset>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="card-body">
                                        <div class="skin skin-flat">
                                            <fieldset>
                                                {{ Form::radio($fieldName.'[value]', 4) }}
                                            </fieldset>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="card-body">
                                        <div class="skin skin-flat">
                                            <fieldset>
                                                {{ Form::radio($fieldName.'[value]', 3) }}
                                            </fieldset>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="card-body">
                                        <div class="skin skin-flat">
                                            <fieldset>
                                                {{ Form::radio($fieldName.'[value]', 2) }}
                                            </fieldset>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="card-body">
                                        <div class="skin skin-flat">
                                            <fieldset>
                                                {{ Form::radio($fieldName.'[value]', 1) }}
                                            </fieldset>
                                        </div>
                                    </div>
                                </td>
                                <td class="width-350">
                                    <div class="card-body">
                                        {{ Form::text($fieldName . '[remarks]', null, ['class' => ($errors->has('intelligence_emotional_alert')) ? 'form-control is-invalid' : 'form-control']) }}
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <h3>@lang('hrm::appraisal.overall_evaluation')</h3>
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>@lang('hrm::appraisal.number_obtained_in_100'):</label>&nbsp <span class="badge badge-primary">80</span>
                    </div>
                </div>
                <div class="col-6">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="skin skin-flat">
                                <fieldset>
                                    {!! Form::radio('overall_evaluation', 'unique_general', ['class' => 'required', 'data-msg-required' => Lang::get('labels.This field is required')]) !!}
                                    <label>@lang('hrm::appraisal.unique_general')</label>
                                </fieldset>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="skin skin-flat">
                                <fieldset>
                                    {!! Form::radio('overall_evaluation', 'excellent',  ['class' => 'required', 'data-msg-required' => Lang::get('labels.This field is required')]) !!}
                                    <label>@lang('hrm::appraisal.excellent')</label>
                                </fieldset>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="skin skin-flat">
                                <fieldset>
                                    {!! Form::radio('overall_evaluation', 'good', ['class' => 'required', 'data-msg-required' => Lang::get('labels.This field is required')]) !!}
                                    <label>@lang('hrm::appraisal.good')</label>
                                </fieldset>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="skin skin-flat">
                                <fieldset>
                                    {!! Form::radio('overall_evaluation', 'aggregate', ['class' => 'required', 'data-msg-required' => Lang::get('labels.This field is required')]) !!}
                                    <label>@lang('hrm::appraisal.aggregate')</label>
                                </fieldset>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="skin skin-flat">
                                <fieldset>
                                    {!! Form::radio('overall_evaluation', 'unsatisfactory', ['class' => 'required', 'data-msg-required' => Lang::get('labels.This field is required')]) !!}
                                    <label>@lang('hrm::appraisal.unsatisfactory')</label>
                                </fieldset>
                            </div>
                        </div>
                    </div>
                    <div class="row radio-error"></div>
                    @if ($errors->has('overall_evaluation'))
                        <div class="small danger">
                            <strong>{{ $errors->first('overall_evaluation') }}</strong>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="suitable_logic" class="required">@lang('hrm::appraisal.suitable_logic')</label>
                {{ Form::textarea('suitable_logic', null, ['class' => 'form-control', 'placeholder' => '']) }}
                <div class="help-block"></div>
            </div>
        </div>
    </div>
    {{--<hr>
    <h3>@lang('hrm::appraisal.reporter_officer_signature_seal')</h3>
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="reporter_officer_signature" class="required">@lang('hrm::appraisal.signature'):</label>
                        {!! Form::file('reporter_officer_signature',[
                                        'class' => 'form-control required',
                                        'accept' => '.png, .jpg, .jpeg',
                                        'id' => 'imageUpload',
                                        'data-msg-required' => trans('labels.Picture field is required')
                                        ]) !!}
                        <div class="help-block"></div>
                        @if ($errors->has('signature'))
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('signature') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="reporter_officer_seal" class="required">@lang('hrm::appraisal.seal'):</label>
                        {!! Form::file('reporter_officer_seal',[
                                        'class' => 'form-control ',
                                        'accept' => '.png, .jpg, .jpeg',
                                        'id' => 'imageUpload',
                                        'data-msg-required' => trans('labels.Picture field is required')
                                        ]) !!}
                        <div class="help-block"></div>
                        @if ($errors->has('seal'))
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('seal') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="date" class="required">@lang('labels.date'):</label>
                        {{ Form::text('date', date('j F, Y'), [
                            'id' => 'date',
                            'class' => 'form-control required' . ($errors->has('date') ? ' is-invalid' : ''),
                            'placeholder' => 'Pick start date',
                            'required' => 'required',
                            'disabled'
                        ]) }}
                        <div class="help-block"></div>
                        @if ($errors->has('date'))
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('date') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>--}}
</fieldset>



