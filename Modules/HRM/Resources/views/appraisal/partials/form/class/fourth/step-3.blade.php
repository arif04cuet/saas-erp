<h6>{{ trans('hrm::appraisal.standard') }}</h6>
<fieldset>
    <style type="text/css">
        .iradio_flat-green {
            margin-top: -10px;
        }
    </style>
    <div class="row mt-2">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <h2 class="text-center">@lang('hrm::appraisal.number_obtained_in_100') : <b id="totalPoint">0</b></h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if($class == "fourth")
        <h3>@lang('hrm::appraisal.employee_quality_evaluation_of_work')</h3>
    @else
        <h3>@lang('hrm::appraisal.officer_quality_evaluation_of_work')</h3>
    @endif
    <h3></h3>
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="table-responsive">
                    <table class="table table-bordered mb-0">
                        <thead>
                        <tr>
                            <th scope="col">@lang('labels.serial')</th>
                            <th scope="col">@lang('labels.details')</th>
                            <th scope="col" style="text-align: center;">
                                @lang('hrm::appraisal.unique_general')
                                <span style="font-size: 16px;">(@lang('labels.digits.5'))</span>
                            </th>
                            <th scope="col" style="text-align: center">
                                @lang('hrm::appraisal.excellent')
                                <span style="font-size: 16px;">(@lang('labels.digits.4'))</span>
                            </th>
                            <th scope="col" style="text-align: center">
                                @lang('hrm::appraisal.good')
                                <span style="font-size: 16px;">(@lang('labels.digits.3'))</span>
                            </th>
                            <th scope="col" style="text-align: center">
                                @lang('hrm::appraisal.aggregate')
                                <span style="font-size: 16px;">(@lang('labels.digits.2'))</span>
                            </th>
                            <th scope="col" style="text-align: center">
                                @lang('hrm::appraisal.unsatisfactory')
                                <span style="font-size: 16px;">(@lang('labels.digits.1'))</span>
                            </th>
                            <th scope="col" width="18%">@lang('labels.remarks')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($appraisalContents as $appraisalContent)
                            <tr>
                                <th style="vertical-align: middle; text-align: left;"><h5><b>@lang('labels.digits.' . $loop->iteration)</b></h5></th>
                                <td style="vertical-align: middle; text-align: left;">
                                    <div>
                                        <div>
                                            <h4><b>@lang('hrm::appraisal.' . $appraisalContent->name)</b></h4>
                                        </div>
                                        <div class="row radio-error" data-radio-field-name="{{ 'content['.$appraisalContent->id.']' . '[value]' }}"></div>
                                    </div>
                                </td>
                                <td style="vertical-align: middle; text-align: center;">
                                    <div class="card-body">
                                        <div class="skin skin-flat">
                                            <fieldset>
                                                @php
                                                    $fieldName = 'content['.$appraisalContent->id.']';
                                                @endphp
                                                {{ Form::radio($fieldName.'[value]', 5, false, ['style' => 'margin-top: -10px;', 'class' => 'required', 'data-msg-required' => trans('labels.This field is required')]) }}
                                            </fieldset>
                                        </div>
                                    </div>
                                </td>
                                <td style="vertical-align: middle; text-align: center;">
                                    <div class="card-body">
                                        <div class="skin skin-flat">
                                            <fieldset>
                                                {{ Form::radio($fieldName.'[value]', 4, false, ['style' => 'margin-top: -10px;', 'class' => 'required', 'data-msg-required' => Lang::get('labels.This field is required')]) }}
                                            </fieldset>
                                        </div>
                                    </div>
                                </td>
                                <td style="vertical-align: middle; text-align: center; height: 30px;">
                                    <div class="card-body">
                                        <div class="skin skin-flat">
                                            <fieldset>
                                                {{ Form::radio($fieldName.'[value]', 3, false, ['style' => 'margin-top: -10px;', 'class' => 'required', 'data-msg-required' => Lang::get('labels.This field is required')]) }}
                                            </fieldset>
                                        </div>
                                    </div>
                                </td>
                                <td style="vertical-align: middle; text-align: center;">
                                    <div class="card-body">
                                        <div class="skin skin-flat">
                                            <fieldset>
                                                {{ Form::radio($fieldName.'[value]', 2, false, ['style' => 'margin-top: -10px;', 'class' => 'required', 'data-msg-required' => Lang::get('labels.This field is required')]) }}
                                            </fieldset>
                                        </div>
                                    </div>
                                </td>
                                <td style="vertical-align: middle; text-align: center;">
                                    <div class="card-body">
                                        <div class="skin skin-flat">
                                            <fieldset>
                                                {{ Form::radio($fieldName.'[value]', 1, false, ['style' => 'margin-top: -10px;', 'class' => 'required', 'data-msg-required' => Lang::get('labels.This field is required')]) }}
                                            </fieldset>
                                        </div>
                                    </div>
                                </td>
                                <td style="vertical-align: middle; text-align: center;">
                                    <div class="card-body">
                                        {{ Form::text($fieldName . '[remarks]', null, ['class' => ($errors->has('intelligence_emotional_alert')) ? 'form-control is-invalid' : 'form-control', 'style' => 'width: 100%;']) }}
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
    <br>
</fieldset>

@push('page-js')
    <script type="text/javascript">
        $(document).ready(function () {
           $('.iCheck-helper').click(function () {

               let totalPoint = 0.00;

               $('input[type=radio][name*="[value]"]').each(function (index, element) {
                   if($(element).prop('checked') === true) {
                       totalPoint += parseInt($(element).val());
                   }
               });

               $('#totalPoint').text(totalPoint);
           })
        });
    </script>
@endpush
