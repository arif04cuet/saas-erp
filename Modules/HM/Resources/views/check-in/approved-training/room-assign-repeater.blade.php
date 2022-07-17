<h4 class="form-section">
    <i class="la  la-bed"></i>
    @lang('hm::checkin.training.repeater_title')
</h4>
<div class="room-assign-repeater">
    <div data-repeater-list="assign">
        <div data-repeater-item>
            <div class="col">
                <div class="row">
                    <!-- room type dropdown  -->
                    <div class="col-10">
                        <div class="form-group">

                            {!! Form::label('room_type_id',
                                   trans('hm::checkin.training.form_elements.select_room_type'),
                                   ['class' => ''])
                           !!}

                            {{ Form::select(
                                'room_type_id',
                                $roomTypes,
                                 0,
                                [
                                    'class' => 'form-control required room-type-select',
                                    'placeholder'=>trans('labels.select'),
                                    'data-msg-required'=> __('labels.This field is required'),
                                ]
                            ) }}
                        </div>
                    </div>

                    <!-- remove button -->
                    <div class="col-2">
                        <div class="form-group col-sm-12 col-md-2" style="margin-top: 26px;">
                            <button type="button" class="btn btn-danger" data-repeater-delete="">
                                <i
                                    class="ft-x"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <h4 class="form-section"><i class="la  la-user-plus"></i>
                    @lang('hm::checkin.training.inner_repeater_title')
                </h4>
                <div class="row">
                    <!-- inner repeater -->
                    <div class="col">
                        <div class="table-responsive inner-repeater">
                            <table class="table text-center table-bordered table-responsive-lg">
                                <thead>
                                <tr class="d-flex">
                                    <th class="col-2">@lang('hm::checkin.training.form_elements.select_room_number')</th>
                                    <th class="col-3">@lang('hm::checkin.training.form_elements.select_hostel')</th>
                                    <th class="col-2">@lang('hm::checkin.training.form_elements.checkbox_trainee_registered')</th>
                                    <th class="col-3">@lang('hm::checkin.training.form_elements.select_trainee')</th>
                                    <th class="col-3">@lang('hm::checkin.training.form_elements.guest_name')</th>
                                    <th class="col-3">@lang('hm::checkin.training.form_elements.guest_mobile_number')</th>
                                    <th class="col-1">
                                        <i data-repeater-create
                                           class="la la-plus-circle text-info"
                                           style="cursor: pointer">
                                        </i>
                                    </th>
                                </tr>
                                </thead>
                                <tbody data-repeater-list="room">
                                <tr data-repeater-item class="d-flex">
                                    <!-- room number  -->
                                    <td class="col-2">
                                        <div class="form-group">
                                        {!! Form::text('room_show', null,
                                            [
                                                'class' => 'form-control required rooms',
                                                'onclick'=>'showModal(this)',
                                                'data-msg-required'=> __('labels.This field is required'),
                                                'autocomplete' => 'off'
                                             ])
                                        !!}
                                        <!-- hidden room number field -->
                                            {{ Form::hidden('room_numbers', null,
                                                    ['class'=>'room-numbers']
                                                )
                                            }}
                                        </div>
                                    </td>
                                    <!-- hostel dropdown -->
                                    <td class="col-3">
                                        <div class="form-group">
                                            {{ Form::select(
                                                'hostel_id',
                                                $hostels,
                                                 null,
                                                [
                                                    'class' => 'form-control hostel-select required',
                                                     'data-msg-required'=> __('labels.This field is required'),
                                                    'disabled'
                                                ]
                                            ) }}
                                        </div>
                                    </td>
                                    <!-- checkbox for is_registered_trainee -->
                                    <td class="col-2">
                                        <div class="form-group">
                                            {!! Form::checkbox(
                                                    'is_trainee_registered',  // name,value,checked/unchecked
                                                    1,
                                                    1,
                                                    ['class'=>'trainee-checkbox']
                                                )
                                            !!}
                                        </div>
                                    </td>
                                    <!-- Trainee Dropdown -->
                                    <td class="col-3">
                                        <div class="form-group">
                                            {!! Form::select('trainees[]',
                                                        [],
                                                        null,
                                                        [
                                                            'class' => "form-control trainee-select required",
                                                            'multiple'=>'multiple',
                                                            'data-msg-required'=> __('labels.This field is required'),
                                                        ]
                                                     )
                                            !!}
                                        </div>
                                    </td>
                                    <!-- Guest Name -->
                                    <td class="col-3">
                                        <div class="form-group">

                                            {!! Form::text('name',
                                                        null,
                                                        [
                                                            'class' => "form-control required",
                                                            'disabled',
                                                            'data-msg-required'=> __('labels.This field is required'),
                                                            'data-rule-maxlength' => 50,
                                                            'data-msg-maxlength'=>Lang::get('labels.At most 50 characters')
                                                        ]
                                                     )
                                            !!}
                                            <div class="help-block"></div>
                                        </div>
                                    </td>
                                    <!-- Guest Mobile Number -->
                                    <td class="col-3">
                                        <div class="form-group">
                                            {!! Form::number('mobile_number',
                                                        null,
                                                        [
                                                            'class' => "form-control required",
                                                            'disabled',
                                                            'data-msg-required'=> __('labels.This field is required'),
                                                            'data-rule-minlength' => 11,
                                                            'data-msg-minlength'=> trans('labels.At least 11 characters'),
                                                            'data-rule-maxlength' => 11,
                                                            'data-msg-maxlength'=> trans('labels.At most 11 characters'),
                                                            'data-rule-number' => 'true',
                                                            'data-msg-number' => trans('labels.Please enter a valid number'),
                                                        ]
                                                     )
                                            !!}
                                            <div class="help-block"></div>
                                        </div>
                                    </td>
                                    <!-- repeater delete button -->
                                    <td class="col-1 repeater-delete-button">
                                        <i data-repeater-delete
                                           class="la la-trash-o text-danger"
                                           style="cursor: pointer">
                                        </i>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            <button type="button" data-repeater-create class="btn btn-sm btn-outline-primary ">
                                <i class="ft-plus"
                                   style="cursor: pointer">
                                </i>@lang('labels.add')
                            </button>
                        </div>

                    </div>
                </div>
                <!-- / inner repeater -->
            </div>
            <hr>
        </div>
    </div>
    <!-- / assign -->
    <div class="row">
        <div class="col-md-12">
            <button type="button" data-repeater-create="" class="btn btn-primary addMore"><i
                    class="ft-plus"></i> @lang('labels.add')
            </button>
        </div>
    </div>
</div>


<!-- Save & Cancel Button -->
<div class="form-actions text-center">
    <button type="submit" class="btn btn-success">
        <i class="la la-check-square-o"></i>@lang('labels.save')
    </button>
    <a class="btn btn-warning mr-1" role="button" href="{{route('check-in.create-options')}}">
        <i class="ft-x"></i> @lang('labels.cancel')
    </a>
</div>


@include('hm::check-in.approved-training.room-selection')
