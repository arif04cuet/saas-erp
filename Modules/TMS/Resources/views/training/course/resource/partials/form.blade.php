@php
$commonHtmlAttributes = ['class' => 'form-control form-control-sm', 'required' /*'maxlength' => 100*/];
$mobileHtmlAttributes = ['class' => 'form-control form-control-sm', 'required' /*'maxlength' => 11*/];
@endphp
{{ Form::hidden('training_course_id', $course->id) }}
@error(['key' => 'employee_resources'])
@enderror
<!-- Officer Repeater -->
<div class="resource-employee-repeater">
    <div data-repeater-list="employee_resources">
        <h3 class="text-center font-weight-bold mb-2">@lang('tms::course.employee')</h3>
        <!-- printing old resources -->
        @if (old('employee_resources'))
            @foreach (old('employee_resources') as $oldInput)
                {{-- {{ dd('how') }} --}}
                <div data-repeater-item>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">@lang('tms::course.employee')</label>
                                {{ Form::hidden('resource_id', $oldInput['resource_id'] ?? null) }}
                                {{ Form::select('employee_id', $employees, $oldInput['employee_id'], [
                                    'class' => 'form-control form-control-sm',
                                    'placeholder' => trans('labels.select'),
                                    'required',
                                ]) }}
                                @error(['key' => 'employee_resources.' . $loop->index . '.employee_id'])
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">@lang('labels.short_name')</label>
                                {{ Form::text('employee_short_name', $oldInput['employee_short_name'], $commonHtmlAttributes) }}
                                @error(['key' => 'employee_resources.' . $loop->index . '.employee_short_name'])
                                @enderror
                            </div>
                        </div>
                        <!--  speaker evaluation ignore checkbox -->
                        <div class="col-md-2 d-none">
                            <div class="form-group">
                                <label for="">@lang('tms::course.should_be_evaluated')</label>
                                {!! Form::checkbox(
                                    'should_be_evaluated', // name,value,checked/unchecked
                                    1,
                                    $oldInput['should_be_evaluated'] ?? false,
                                    ['class' => 'speaker-evaluation-ignore-checkbox'],
                                ) !!}
                            </div>
                        </div>
                        <!-- delete button -->
                        <div class="col-md-2">
                            <div class="form-group mt-2">
                                <button data-repeater-delete type="button" class="btn btn-danger">
                                    <i class="ft ft-x"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <hr>
                </div>
            @endforeach
        @else
            <!-- printing stored resources -->
            @if ($employeeResources->count())
                @foreach ($employeeResources as $employeeResource)
                    {{-- {{ dd('hi') }} --}}
                    <div data-repeater-item>
                        <div class="row">
                            <!-- Old Employee select box -->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">@lang('tms::course.employee')</label>
                                    {{ Form::hidden('resource_id', $employeeResource->id) }}
                                    {{ Form::select('employee_id', $employees, $employeeResource ? $employeeResource->reference_entity_id : null, [
                                        'class' => 'form-control form-control-sm',
                                        'placeholder' => trans('labels.select'),
                                        'required',
                                    ]) }}
                                </div>
                            </div>
                            <!-- old employee short name field -->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">@lang('labels.short_name')</label>
                                    {{ Form::text(
                                        'employee_short_name',
                                        $employeeResource ? $employeeResource->short_name : null,
                                        $commonHtmlAttributes,
                                    ) }}
                                </div>
                            </div>
                            <!--  old speaker evaluation ignore checkbox -->
                            <div class="col-md-2 d-none">
                                <div class="form-group">
                                    <label for="">@lang('tms::course.should_be_evaluated')</label>
                                    {!! Form::checkbox(
                                        'should_be_evaluated', // name,value,checked/unchecked
                                        1,
                                        $employeeResource->should_be_evaluated ?? false,
                                        ['class' => 'speaker-evaluation-ignore-checkbox'],
                                    ) !!}
                                </div>
                            </div>
                            <!-- old delete button -->
                            <div class="col-md-2">
                                <div class="form-group mt-2">
                                    <button data-repeater-delete type="button" class="btn btn-danger">
                                        <i class="ft ft-x"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <hr>
                    </div>
                @endforeach
            @else
                <!-- creating brand new resources -->
                <div data-repeater-item>
                    <div class="row">
                        <!-- employee select box -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">@lang('tms::course.employee')</label>
                                {{ Form::select('employee_id', $employees, null, [
                                    'class' => 'form-control form-control-sm',
                                    'placeholder' => trans('labels.select'),
                                    'required',
                                ]) }}
                            </div>
                        </div>
                        <!-- short name -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">@lang('labels.short_name')</label>
                                {{ Form::text('employee_short_name', null, $commonHtmlAttributes) }}
                            </div>
                        </div>
                        <!--  speaker evaluation ignore checkbox -->
                        <div class="col-md-2 d-none">
                            <div class="form-group">
                                <label for="">@lang('tms::course.should_be_evaluated')</label>
                                {!! Form::checkbox(
                                    'should_be_evaluated', // name,value,checked/unchecked
                                    1,
                                    1,
                                    ['class' => 'speaker-evaluation-ignore-checkbox'],
                                ) !!}
                            </div>
                        </div>
                        <!-- delete button -->
                        <div class="col-md-2">
                            <div class="form-group mt-2">
                                <button data-repeater-delete type="button" class="btn btn-danger">
                                    <i class="ft ft-x"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <hr>
                </div>
            @endif
        @endif
    </div>
    <div class="form-group overflow-hidden">
        <div class="pull-right">
            <button type="button" data-repeater-create class="master btn btn-sm btn-primary">
                <i class="ft-plus"></i> @lang('labels.add')
            </button>
        </div>
    </div>
</div>
<hr>

<!-- guest repeater -->
<h3 class="text-center font-weight-bold mb-2">@lang('tms::course.guest')</h3>

<div class="resource-guest-repeater">
    <div data-repeater-list="guest_resources">
        <!-- printing old resources -->
        @if (old('guest_resources'))
            {{-- {{ dd($guest_resources) }} --}}
            @foreach (old('guest_resources') as $oldInput)
                <div data-repeater-item>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="">@lang('labels.first_name')</label>
                                {{ Form::hidden('resource_id', $oldInput['resource_id'] ?? null) }}
                                {{ Form::hidden('guest_id', $oldInput['guest_id'] ?? null) }}
                                {{ Form::text('first_name', $oldInput['first_name'], $commonHtmlAttributes) }}
                                @error(['key' => 'guest_resources.' . $loop->index . '.first_name'])
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="">@lang('labels.last_name')</label>
                                {{ Form::text('last_name', $oldInput['last_name'], $commonHtmlAttributes) }}
                                @error(['key' => 'guest_resources.' . $loop->index . '.last_name'])
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="">@lang('labels.short_name')</label>
                                {{ Form::text('short_name', $oldInput['short_name'], $commonHtmlAttributes) }}
                                @error(['key' => 'guest_resources.' . $loop->index . '.short_name'])
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="">@lang('labels.mobile')</label>
                                {{ Form::text('mobile_no', $oldInput['mobile_no'], $mobileHtmlAttributes) }}
                                @error(['key' => 'guest_resources.' . $loop->index . '.mobile_no'])
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="">@lang('labels.email_address')</label>
                                {{ Form::text('email', $oldInput['email'], $commonHtmlAttributes) }}
                                @error(['key' => 'guest_resources.' . $loop->index . '.email'])
                                @enderror
                            </div>
                        </div>
                        <!--  speaker evaluation ignore checkbox -->
                        <div class="col-md-2 d-none">
                            <div class="form-group">
                                <label for="">@lang('tms::course.should_be_evaluated')</label>
                                {!! Form::checkbox(
                                    'should_be_evaluated', // name,value,checked/unchecked
                                    1,
                                    $oldInput['should_be_evaluated'] ?? false,
                                    ['class' => 'guest-speaker-evaluation-ignore-checkbox'],
                                ) !!}
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group mt-2">
                                <button data-repeater-delete type="button" class="btn btn-danger">
                                    <i class="ft ft-x"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <hr>
                </div>
                {{-- {{ dd('nnn') }} --}}
            @endforeach
        @else
            <!-- printing stored resources -->
            {{-- {{ dd($guestResources) }} --}}
            @if ($guestResources->count())
                @foreach ($guestResources as $key => $guestResource)
                    {{-- {{ dd($guestResource) }} --}}
                    <div data-repeater-item>
                        <div class="row">
                            <!-- first name -->
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="">@lang('labels.first_name')</label>
                                    {{ Form::hidden('resource_id', $guestResource->id) }}
                                    {{ Form::hidden('guest_id', $guestResource->reference_entity_id) }}
                                    {{ Form::text('first_name', $guestResource ? $guestResource->guest->first_name : null, $commonHtmlAttributes) }}
                                </div>
                            </div>
                            <!-- last name -->
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="">@lang('labels.last_name')</label>
                                    {{ Form::text('last_name', $guestResource ? $guestResource->guest->last_name : null, $commonHtmlAttributes) }}
                                </div>
                            </div>
                            <!-- short name -->
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="">@lang('labels.short_name')</label>
                                    {{ Form::text('short_name', $guestResource ? $guestResource->guest->short_name : null, $commonHtmlAttributes) }}
                                </div>
                            </div>
                            <!-- mobile number -->
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="">@lang('labels.mobile')</label>
                                    {{ Form::text('mobile_no', $guestResource ? $guestResource->guest->mobile_no : null, $commonHtmlAttributes) }}
                                </div>
                            </div>
                            <!-- Email address -->
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="">@lang('labels.email_address')</label>
                                    {{ Form::text('email', $guestResource ? $guestResource->guest->email : null, $commonHtmlAttributes) }}
                                </div>
                            </div>
                            <!-- Evaluation Checkbox -->
                            <div class="col-md-2 d-none">
                                <div class="form-group">
                                    <label for="">@lang('tms::course.should_be_evaluated')</label>
                                    {!! Form::checkbox(
                                        'should_be_evaluated', // name,value,checked/unchecked
                                        1,
                                        $guestResource->should_be_evaluated ?? false,
                                        ['class' => 'guest-speaker-evaluation-ignore-checkbox'],
                                    ) !!}
                                </div>
                            </div>
                            <!-- delete button -->
                            <div class="col-md-2">
                                <div class="form-group mt-2">
                                    <button data-repeater-delete type="button" class="btn btn-danger">
                                        <i class="ft ft-x"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <hr>
                    </div>
                    {{-- {{ dd('ddd') }} --}}
                @endforeach
            @else
                {{-- {{ dd('dddkk') }} --}}
                <!-- creating brand new -->
                <div data-repeater-item>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="">@lang('labels.first_name')</label>
                                {{ Form::text('first_name', null, $commonHtmlAttributes) }}
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="">@lang('labels.last_name')</label>
                                {{ Form::text('last_name', null, $commonHtmlAttributes) }}
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="">@lang('labels.short_name')</label>
                                {{ Form::text('short_name', null, $commonHtmlAttributes) }}
                            </div>
                        </div>
                        <!-- guest mobile field-->
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="">@lang('labels.mobile')</label>
                                {{ Form::text('mobile_no', null, $mobileHtmlAttributes) }}
                            </div>
                        </div>
                        <!-- guest email field -->
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="">@lang('labels.email_address')</label>
                                {{ Form::text('email', null, $commonHtmlAttributes) }}
                            </div>
                        </div>
                        <!--  speaker evaluation ignore checkbox -->
                        <div class="col-md-2 d-none">
                            <div class="form-group">
                                <label for="">@lang('tms::course.should_be_evaluated')</label>
                                {!! Form::checkbox(
                                    'should_be_evaluated', // name,value,checked/unchecked
                                    1,
                                    1,
                                    ['class' => 'guest-speaker-evaluation-ignore-checkbox'],
                                ) !!}
                            </div>
                        </div>
                        <!-- guest delete button -->
                        <div class="col-md-2">
                            <div class="form-group mt-2">
                                <button data-repeater-delete type="button" class="btn btn-danger">
                                    <i class="ft ft-x"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <hr>
                </div>
            @endif
        @endif
    </div>
    <div class="form-group overflow-hidden">
        <div class="pull-right">
            <button type="button" data-repeater-create class="btn btn-sm btn-primary">
                <i class="ft-plus"></i> @lang('labels.add')
            </button>
        </div>
    </div>
</div>

@push('page-css')
    <link rel="stylesheet" href="{{ asset('theme/vendors/css/forms/icheck/icheck.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/css/plugins/forms/checkboxes-radios.css') }}">
@endpush

@push('page-js')
    <script src="{{ asset('theme/vendors/js/forms/repeater/jquery.repeater.min.js') }}"></script>
    <!-- Icheck and Checkbox -->
    <script src="{{ asset('theme/vendors/js/forms/icheck/icheck.min.js') }}"></script>
    <script src="{{ asset('theme/js/scripts/forms/checkbox-radio.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('select').select2({
                placeholder: '{!! trans('labels.select') !!}'
            });
            $('.resource-employee-repeater').repeater({
                show: function() {
                    $(this).find('.danger').remove();
                    $(this).find('.select2-container').remove();
                    $(this).find('select').select2({
                        placeholder: '{!! trans('labels.select') !!}',
                    });
                    $(this).slideDown();
                },
                defaultValues: {
                    'should_be_evaluated': 1
                },
            });

            $('.resource-guest-repeater').repeater({
                show: function() {
                    $(this).find('.danger').remove();
                    $(this).find('.select2-container').remove();
                    $(this).find('select').select2({
                        placeholder: '{!! trans('labels.select') !!}',
                    });
                    $(this).slideDown();
                },
                defaultValues: {
                    'should_be_evaluated': 1
                },
            });

        });
    </script>
@endpush
