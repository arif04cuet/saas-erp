<h6>@lang('hrm::appraisal.personal_features_and_performance')</h6>
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
                        <h2 class="text-center">@lang('hrm::appraisal.number_obtained_in_100') : <b id="totalPoint">{{ $appraisal->details->sum('marks') }}</b></h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <h3>@lang('hrm::appraisal.personal_features')</h3>
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th scope="col">@lang('labels.serial')</th>
                            <th scope="col">@lang('labels.details')</th>
                            <th scope="col" style="vertical-align: middle; text-align: center;">
                                @lang('hrm::appraisal.unique_general')
                                <span style="font-size: 16px;">(@lang('labels.digits.5'))</span>
                            </th>
                            <th scope="col" style="vertical-align: middle; text-align: center;">
                                @lang('hrm::appraisal.excellent')
                                <span style="font-size: 16px;">(@lang('labels.digits.4'))</span>
                            </th>
                            <th scope="col" style="vertical-align: middle; text-align: center;">
                                @lang('hrm::appraisal.good')
                                <span style="font-size: 16px;">(@lang('labels.digits.3'))</span>
                            </th>
                            <th scope="col" style="vertical-align: middle; text-align: center;">
                                @lang('hrm::appraisal.aggregate')
                                <span style="font-size: 16px;">(@lang('labels.digits.2'))</span>
                            </th>
                            <th scope="col" style="vertical-align: middle; text-align: center;">
                                @lang('hrm::appraisal.unsatisfactory')
                                <span style="font-size: 16px;">(@lang('labels.digits.1'))</span>
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($appraisal->details->filter(function ($detail) { return $detail->content->type == "personal_features"; }) as $detail)
                            <tr>
                                <th style="vertical-align: middle; text-align: left;"><h4><b>@lang('labels.digits.' . $loop->iteration)</b></h4></th>
                                <td style="vertical-align: middle; text-align: left;">
                                    <div>
                                        <div>
                                            <h4><b>@lang('hrm::appraisal.questionnaire.' . $detail->content->name)</b></h4>
                                        </div>
                                    </div>
                                </td>
                                <td style="vertical-align: middle; text-align: center;">
                                    <div class="card-body">
                                        <div class="skin skin-flat">
                                            @if($detail->marks == 5)
                                                <h5 style="color: green; font-size: 25px;"><b>@lang('labels.digits.5')</b></h5>
                                            @else
                                                <h5 style="color: grey; font-size: 25px;"><b>@lang('labels.digits.5')</b></h5>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td style="vertical-align: middle; text-align: center;">
                                    <div class="card-body">
                                        <div class="skin skin-flat">
                                            @if($detail->marks == 4)
                                                <h5 style="color: green; font-size: 25px;"><b>@lang('labels.digits.4')</b></h5>
                                            @else
                                                <h5 style="color: grey; font-size: 25px;"><b>@lang('labels.digits.4')</b></h5>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td style="vertical-align: middle; text-align: center;">
                                    <div class="card-body">
                                        <div class="skin skin-flat">
                                            @if($detail->marks == 3)
                                                <h5 style="color: green; font-size: 25px;"><b>@lang('labels.digits.3')</b></h5>
                                            @else
                                                <h5 style="color: grey; font-size: 25px;"><b>@lang('labels.digits.3')</b></h5>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td style="vertical-align: middle; text-align: center;">
                                    <div class="card-body">
                                        <div class="skin skin-flat">
                                            @if($detail->marks == 2)
                                                <h5 style="color: green; font-size: 25px;"><b>@lang('labels.digits.2')</b></h5>
                                            @else
                                                <h5 style="color: grey; font-size: 25px;"><b>@lang('labels.digits.2')</b></h5>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td style="vertical-align: middle; text-align: center;">
                                    <div class="card-body">
                                        <div class="skin skin-flat">
                                            @if($detail->marks == 1)
                                                <h5 style="color: green; font-size: 25px;"><b>@lang('labels.digits.1')</b></h5>
                                            @else
                                                <h5 style="color: grey; font-size: 25px;"><b>@lang('labels.digits.1')</b></h5>
                                            @endif
                                        </div>
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
    <h3>@lang('hrm::appraisal.performance')</h3>
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th scope="col">@lang('labels.serial')</th>
                            <th scope="col">@lang('labels.details')</th>
                            <th scope="col" style="vertical-align: middle; text-align: center;">@lang('hrm::appraisal.unique_general')</th>
                            <th scope="col" style="vertical-align: middle; text-align: center;">@lang('hrm::appraisal.excellent')</th>
                            <th scope="col" style="vertical-align: middle; text-align: center;">@lang('hrm::appraisal.good')</th>
                            <th scope="col" style="vertical-align: middle; text-align: center;">@lang('hrm::appraisal.aggregate')</th>
                            <th scope="col" style="vertical-align: middle; text-align: center;">@lang('hrm::appraisal.unsatisfactory')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($appraisal->details->filter(function ($detail) { return $detail->content->type == "performance"; }) as $detail)
                            <tr>
                                <th style="vertical-align: middle; text-align: left;"><h4><b>@lang('labels.digits.' . $loop->iteration)</b></h4></th>
                                <td style="vertical-align: middle; text-align: left;">
                                    <div>
                                        <div>
                                            <h4><b>@lang('hrm::appraisal.questionnaire.' . $detail->content->name)</b></h4>
                                        </div>
                                    </div>
                                </td>
                                <td style="vertical-align: middle; text-align: center;">
                                    <div class="card-body">
                                        <div class="skin skin-flat">
                                            @if($detail->marks == 5)
                                                <h5 style="color: green; font-size: 25px;"><b>@lang('labels.digits.5')</b></h5>
                                            @else
                                                <h5 style="color: grey; font-size: 25px;"><b>@lang('labels.digits.5')</b></h5>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td style="vertical-align: middle; text-align: center;">
                                    <div class="card-body">
                                        <div class="skin skin-flat">
                                            @if($detail->marks == 4)
                                                <h5 style="color: green; font-size: 25px;"><b>@lang('labels.digits.4')</b></h5>
                                            @else
                                                <h5 style="color: grey; font-size: 25px;"><b>@lang('labels.digits.4')</b></h5>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td style="vertical-align: middle; text-align: center;">
                                    <div class="card-body">
                                        <div class="skin skin-flat">
                                            @if($detail->marks == 3)
                                                <h5 style="color: green; font-size: 25px;"><b>@lang('labels.digits.3')</b></h5>
                                            @else
                                                <h5 style="color: grey; font-size: 25px;"><b>@lang('labels.digits.3')</b></h5>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td style="vertical-align: middle; text-align: center;">
                                    <div class="card-body">
                                        <div class="skin skin-flat">
                                            @if($detail->marks == 2)
                                                <h5 style="color: green; font-size: 25px;"><b>@lang('labels.digits.2')</b></h5>
                                            @else
                                                <h5 style="color: grey; font-size: 25px;"><b>@lang('labels.digits.2')</b></h5>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td style="vertical-align: middle; text-align: center;">
                                    <div class="card-body">
                                        <div class="skin skin-flat">
                                            @if($detail->marks == 1)
                                                <h5 style="color: green; font-size: 25px;"><b>@lang('labels.digits.1')</b></h5>
                                            @else
                                                <h5 style="color: grey; font-size: 25px;"><b>@lang('labels.digits.1')</b></h5>
                                            @endif
                                        </div>
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
