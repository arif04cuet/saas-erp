<h6>{{ trans('hrm::appraisal.standard') }}</h6>
<fieldset>
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
    @if($appraisal->type == "fourth")
        <h3>@lang('hrm::appraisal.employee_quality_evaluation_of_work')</h3>
    @else
        <h3>@lang('hrm::appraisal.officer_quality_evaluation_of_work')</h3>
    @endif
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="table-responsive">
                    <table class="table table-bordered mb-0">
                        <thead>
                        <tr>
                            <th scope="col">@lang('labels.serial')</th>
                            <th scope="col">@lang('labels.details')</th>
                            <th scope="col">
                                @lang('hrm::appraisal.unique_general')
                                <span style="font-size: 16px;">(@lang('labels.digits.5'))</span>
                            </th>
                            <th scope="col">
                                @lang('hrm::appraisal.excellent')
                                <span style="font-size: 16px;">(@lang('labels.digits.4'))</span>
                            </th>
                            <th scope="col">
                                @lang('hrm::appraisal.good')
                                <span style="font-size: 16px;">(@lang('labels.digits.3'))</span>
                            </th>
                            <th scope="col">
                                @lang('hrm::appraisal.aggregate')
                                <span style="font-size: 16px;">(@lang('labels.digits.2'))</span>
                            </th>
                            <th scope="col">
                                @lang('hrm::appraisal.unsatisfactory')
                                <span style="font-size: 16px;">(@lang('labels.digits.1'))</span>
                            </th>
                            <th scope="col">@lang('labels.remarks')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($appraisal->details as $detail)
                            <tr>
                                <td style="vertical-align: middle; text-align: left;"><h4><b>@lang('labels.digits.' . $loop->iteration)</b></h4></td>
                                <td style="vertical-align: middle; text-align: left;">
                                    <div>
                                        <div>
                                            <h4><b>@lang('hrm::appraisal.' . $detail->content->name)</b></h4>
                                        </div>
                                    </div>
                                </td>
                                <td style="vertical-align: middle; text-align: center;">
                                    <div class="card-body text-center">
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
                                <td style="vertical-align: middle; text-align: center;">
                                    <div class="card-body">
                                        <b>{{ $detail->remarks }}</b>
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
