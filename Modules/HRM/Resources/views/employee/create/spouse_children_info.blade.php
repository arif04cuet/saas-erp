@if($errors->spouseChildrenError->has('employee_id'))
    <div class="col-md-12">
        <div class="alert bg-danger alert-dismissible mb-2" role="alert">
            <button type="button" class="close" data-dismiss="alert"
                    aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            {{$errors->spouseChildrenError->first('employee_id')}}
        </div>
    </div>
@endif
<h4 class="form-section">
    <i class="la la-female"></i> @lang('hrm::spouse_children_info.spouse.detail')
</h4>
<div class="row">
    <div class="col-md-10">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="">@lang('hrm::spouse_children_info.fields.first_name')</label>
                    {{ Form::text(
                        'spouse[first_name]',
                        null,
                        [
                            'class' => 'form-control form-control-sm'
                        ]
                    ) }}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="">@lang('hrm::spouse_children_info.fields.last_name')</label>
                    {{ Form::text(
                        'spouse[last_name]',
                        null,
                        [
                            'class' => 'form-control form-control-sm'
                        ]
                    ) }}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="">@lang('hrm::spouse_children_info.fields.date_of_birth')</label>
                    {{ Form::text(
                        'spouse[date_of_birth]',
                        null,
                        [
                            'class' => 'form-control form-control-sm birth-date'
                        ]
                    ) }}
                </div>
            </div>
            {{ Form::hidden('spouse[id]', null) }}
            {{ Form::hidden('spouse[employee_id]', null) }}
        </div>
    </div>
</div>
<h4 class="form-section">
    <i class="la la-child"></i> @lang('hrm::spouse_children_info.children.detail')
</h4>
<div class="children-repeater">
    <div data-repeater-list="children">
        <div data-repeater-item>
            <div class="row">
                <div class="col-md-10">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>@lang('hrm::spouse_children_info.fields.first_name')</label>
                                {{ Form::text(
                                    'first_name',
                                    null,
                                    [
                                        'class' => 'form-control form-control-sm'
                                    ]
                                ) }}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>@lang('hrm::spouse_children_info.fields.last_name')</label>
                                {{ Form::text(
                                    'last_name',
                                    null,
                                    [
                                        'class' => 'form-control form-control-sm'
                                    ]
                                ) }}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">@lang('hrm::spouse_children_info.fields.date_of_birth')</label>
                                {{ Form::text(
                                    'date_of_birth',
                                    null,
                                    [
                                        'class' => 'required form-control form-control-sm birth-date',
                                        'data-msg-required' => trans('labels.This field is required')
                                    ]
                                ) }}
                            </div>
                        </div>
                        {{ Form::hidden('id', null) }}
                        {{ Form::hidden('employee_id', null) }}
                    </div>
                </div>
                <div class=" col-md-2 mt-2">
                    <div class="form-group col-sm-12 col-md-2" style="margin-top: 5px;">
                        <button type="button" class="btn btn-danger" data-repeater-delete=""><i class="ft-x"></i>
                            @lang('labels.remove')
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <button type="button" data-repeater-create="" class="btn btn-primary addMore"><i
                    class="ft-plus"></i> @lang('labels.add')
            </button>
        </div>
    </div>
</div>
<div class="form-actions col-md-12 mb-3">
    <div class="pull-right">
        {{ Form::button('<i class="la la-check-square-o"></i>'. trans('labels.save'), ['type' => 'submit', 'id' => 'SubmitButton', 'class' => 'master btn btn-primary'] )  }}
        <a href="{{ route('employee.index') }}">
            <button type="button" class="master btn btn-warning mr-1"><i class="la la-times"></i> @lang('labels.cancel')
            </button>
        </a>
    </div>
</div>
{{ Form::hidden('employee_id', null, ['class' =>'EmployeeId']) }}
@push('page-css')
    <style type="text/css">
        .content-body {
            min-height: 1200px;
        }
    </style>
@endpush
@push('page-js')
    <script src="{{ asset('theme/vendors/js/pickers/pickadate/picker.js')  }}"></script>
    <script src="{{ asset('theme/vendors/js/pickers/pickadate/picker.date.js') }}"></script>

    <script type="text/javascript">
        $(document).ready(function ($) {
            $('input,select,textarea').not('[type=submit]').jqBootstrapValidation('destroy');

            let employeeChildrenRepeaterContainer = $('.children-repeater');

            $('.birth-date').pickadate({
                selectMonths: true,
                selectYears: 500,
                min: new Date(1950, 1, 1),
                max: new Date(),
            });

            let childrenRepeater = employeeChildrenRepeaterContainer.repeater({
                show: function () {
                    $(this).find('.birth-date').removeClass('picker__input').removeAttr('aria-owns').removeAttr('id').attr('readOnly', false);
                    $(this).find('.picker').remove();
                    $(this).find('.picker__input').remove();

                    $(this).find('.birth-date').pickadate({
                        selectMonths: true,
                        selectYears: 500,
                        min: new Date(1950, 1, 1),
                        max: new Date(),
                    });
                    $(this).slideDown();
                },
                hide: function (deleteElement) {
                    $(this).slideUp(deleteElement);
                }
            });

            let hrmEmployeeCreateFormSpouseChildren = $('.hrm-employee-create-form-spouse-children');

            hrmEmployeeCreateFormSpouseChildren.validate({
                ignore: 'input[type=hidden]',
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

                        error.insertBefore(element.parents().siblings('.radio-error'));

                    } else if (element[0].tagName === "SELECT") {

                        error.insertAfter(element.siblings('.select2-container'));

                    } else if (element.attr('id') === 'start_date' || element.attr('id') === 'end_date') {

                        error.insertAfter(element.parents('.input-group'));

                    } else if (element.attr('type') === 'file') {

                        error.insertAfter(element.parent().parent().find('.avatar-preview'));

                    } else {

                        console.log(element);
                        error.insertAfter(element);
                    }
                },
                rules: {},
                submitHandler: function (form, event) {
                    form.submit();
                }
            })
        });
    </script>
@endpush
