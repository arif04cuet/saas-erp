<h6>@lang('hrm::appraisal.overall_evaluation')</h6>
<fieldset>
    @php
        $metadata = $appraisal->metadata
            ->mapWithKeys(function($meta) {
                return [$meta->key => $meta->value];
            });
    @endphp
{{--    <h3>@lang('hrm::appraisal.overall_evaluation')</h3>--}}
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <h3>@lang('hrm::appraisal.number_obtained_in_100') : <b><input type="text" style="width: 50px;text-align: center" readonly value="{{ $appraisal->details->sum('marks') }}"></b></h3>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <h3>@lang('hrm::appraisal.signer_evaluation_value')</h3>
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="row skin skin-flat">
                            <div class="col-md-12 col-sm-12">
                                @if($metadata['reporter_officer_overall_evaluation'] == '91-100')
                                    <h4 style="color: green;">@lang('hrm::appraisal.unique_general_2') (@lang('hrm::appraisal.unique_general_key_2'))</h4>
                                @else
                                    <h4 style="color: grey;">@lang('hrm::appraisal.unique_general_2') (@lang('hrm::appraisal.unique_general_key_2'))</h4>
                                @endif
                                @if($metadata['reporter_officer_overall_evaluation'] == '76-90')
                                    <h4 style="color: green;">@lang('hrm::appraisal.excellent_2') (@lang('hrm::appraisal.excellent_key_2'))</h4>
                                @else
                                    <h4 style="color: grey;">@lang('hrm::appraisal.excellent_2') (@lang('hrm::appraisal.excellent_key_2'))</h4>
                                @endif
                                @if($metadata['reporter_officer_overall_evaluation'] == '56-75')
                                    <h4 style="color: green;">@lang('hrm::appraisal.good_2') (@lang('hrm::appraisal.good_key_2'))</h4>
                                @else
                                    <h4 style="color: grey;">@lang('hrm::appraisal.good_2') (@lang('hrm::appraisal.good_key_2'))</h4>
                                @endif
                                @if($metadata['reporter_officer_overall_evaluation'] == '40-55')
                                    <h4 style="color: green;">@lang('hrm::appraisal.aggregate_2') (@lang('hrm::appraisal.aggregate_key_2'))</h4>
                                @else
                                    <h4 style="color: grey;">@lang('hrm::appraisal.aggregate_2') (@lang('hrm::appraisal.aggregate_key_2'))</h4>
                                @endif
                                @if($metadata['reporter_officer_overall_evaluation'] == "01-39")
                                    <h4 style="color: green;">@lang('hrm::appraisal.unsatisfactory_2') (@lang('hrm::appraisal.unsatisfactory_key_2'))</h4>
                                @else
                                    <h4 style="color: grey;">@lang('hrm::appraisal.unsatisfactory_2') (@lang('hrm::appraisal.unsatisfactory_key_2'))</h4>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <h3>@lang('hrm::appraisal.suitable_logic_title')</h3>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <h5>@lang('hrm::appraisal.suitable_logic')</h5>
                {{ $metadata['reporter_officer_suitable_logic'] ?? null }}
            </div>
        </div>
    </div>
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
