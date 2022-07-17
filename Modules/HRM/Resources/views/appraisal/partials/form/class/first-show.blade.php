{!! Form::open(['url' =>  route('appraisals.update', ['appraisal'=>$appraisal->id]), 'class' => 'wizard-circle appraisal-steps', 'enctype' => 'multipart/form-data']) !!}

@if($appraisal->status == 'initialized' && $appraisal->stateHistory()->get()->last()->from == "new")
    @include('hrm::appraisal.partials.form.class.first.show.step-1')
@endif
@if($appraisal->status == 'verified')
    @include('hrm::appraisal.partials.form.class.first.show.step-1')
    @include('hrm::appraisal.partials.form.class.first.show.step-2')
@endif

@if($appraisal->status == 'initialized' && $appraisal->stateHistory()->get()->last()->from == "verified")
    @include('hrm::appraisal.partials.form.class.first.show.step-1')
    @include('hrm::appraisal.partials.form.class.first.show.step-2')
    @include('hrm::appraisal.partials.form.class.first.show.step-3')
@endif

@if($appraisal->status == 'reported')
    @include('hrm::appraisal.partials.form.class.first.show.step-1')
    @include('hrm::appraisal.partials.form.class.first.show.step-2')
    @include('hrm::appraisal.partials.form.class.first.show.step-3')
    @include('hrm::appraisal.partials.form.class.first.show.step-4')
    @include('hrm::appraisal.partials.form.class.first.show.step-5')
    @include('hrm::appraisal.partials.form.class.first.show.step-6')
    @include('hrm::appraisal.partials.form.class.first.show.step-7')
@endif

@if($appraisal->status == 'signed')
    @include('hrm::appraisal.partials.form.class.first.show.step-1')
    @include('hrm::appraisal.partials.form.class.first.show.step-2')
    @include('hrm::appraisal.partials.form.class.first.show.step-3')
    @include('hrm::appraisal.partials.form.class.first.show.step-4')
    @include('hrm::appraisal.partials.form.class.first.show.step-5')
    @include('hrm::appraisal.partials.form.class.first.show.step-6')
    @include('hrm::appraisal.partials.form.class.first.show.step-7')
    @include('hrm::appraisal.partials.form.class.first.show.step-8')
@endif

@if($appraisal->status == 'completed')
    @include('hrm::appraisal.partials.form.class.first.show.step-1')
    @include('hrm::appraisal.partials.form.class.first.show.step-2')
    @include('hrm::appraisal.partials.form.class.first.show.step-3')
    @include('hrm::appraisal.partials.form.class.first.show.step-4')
    @include('hrm::appraisal.partials.form.class.first.show.step-5')
    @include('hrm::appraisal.partials.form.class.first.show.step-6')
    @include('hrm::appraisal.partials.form.class.first.show.step-7')
    @include('hrm::appraisal.partials.form.class.first.show.step-8')
    @include('hrm::appraisal.partials.form.class.first.show.step-9')
@endif


{{ Form::close() }}

@push('page-js')
    <script src="{{ asset('theme/vendors/js/pickers/pickadate/picker.js') }}"></script>
    <script src="{{ asset('theme/vendors/js/pickers/pickadate/picker.date.js') }}"></script>
    <script src="{{ asset('theme/js/scripts/pickers/dateTime/pick-a-datetime.js') }}"></script>
    <script src="{{ asset('theme/vendors/js/pickers/daterange/daterangepicker.js') }}"></script>
    <script src="{{ asset('theme/vendors/js/forms/validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('theme/vendors/js/ui/jquery.sticky.js') }}"></script>
    <script src="{{ asset('theme/vendors/js/extensions/jquery.steps.min.js') }}"></script>
    <script src="{{ asset('theme/vendors/js/pickers/dateTime/moment-with-locales.min.js') }}"></script>
    <script src="{{ asset('theme/js/core/app-menu.js') }}"></script>
    <script src="{{ asset('theme/vendors/js/scripts/tables/components/table-components.js') }}"></script>
    <script>
        let appraisalForm = '.appraisal-steps';
        var form = $(appraisalForm).show();

        $(appraisalForm).steps({
            headerTag: "h6",
            bodyTag: "fieldset",
            transitionEffect: "fade",
            titleTemplate: '<span class="step">#index#</span> #title#',
            labels: {
                finish: '{!! trans('labels.cancel') !!}',
                next: '{!! trans('labels.next') !!}',
                previous: '{!! trans('labels.previous') !!}',
            },
            onStepChanging: function (event, currentIndex, newIndex)
            {
                return true;
            },
            onFinished: function (event, currentIndex)
            {
                window.location = '{{ route('appraisals.index') }}';
            }
        });
    </script>
    <script src="{{ asset('theme/vendors/js/forms/icheck/icheck.min.js') }}"></script>
    <script src="{{ asset('theme/js/scripts/forms/checkbox-radio.js') }}"></script>
    <script>
        $( document ).ready(function() {

            $('select').select2();

            jQuery.validator.addMethod(
                "greaterThanOrEqual",
                function(value, elements, params) {
                    let comparingDate = params === '#start_date' ? $(params).val() : params;
                    return Date.parse(value) >= Date.parse(comparingDate);
                },
                '{{ trans('labels.greaterThanOrEqual', ['name' => trans('hrm::appraisal.start_date')]) }}'
            );

            $('.appraisal-steps').validate({
                ignore: 'input[type=hidden]', // ignore hidden fields
                errorClass: 'danger',
                successClass: 'success',
                highlight: function (element, errorClass) {
                    $(element).removeClass(errorClass);
                },
                unhighlight: function (element, errorClass) {
                    $(element).removeClass(errorClass);
                },
                errorPlacement: function (error, element) {
                    if (element.attr('type') === 'radio') {
                        console.log(element.parents().siblings('.radio-error'));
                        error.insertBefore(element.parents().siblings('.radio-error'));

                    } else if (element[0].tagName === "SELECT") {

                        error.insertAfter(element.siblings('.select2-container'));

                    } else if (element.attr('id') === 'start_date' || element.attr('id') === 'end_date') {

                        error.insertAfter(element.parents('.input-group'));

                    }else {

                        error.insertAfter(element);
                    }
                },
                rules: {
                    end_date: {
                        greaterThanOrEqual: '#start_date'
                    },
                    first_name: {
                        maxlength: 50
                    },
                    // 'room-show': {
                    //     CheckRoomValidation: 0
                    // },
                    contact: {
                        minlength: 11,
                        maxlength: 11
                    },
                    address: {
                        maxlength: 300
                    },
                    nid: {
                        minlength: 10,
                        maxlength: 10
                    },
                },
            });

            // datepicker
            $('#start_date, #end_date').pickadate();


            $('#rank').change(function(){
                var value = $(this).val();
                if (value == 1 || value == 4){
                    $('.employee_graph').hide();
                }else {
                    $('.employee_graph').show();
                }
            });
        });
    </script>
@endpush
