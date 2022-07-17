@extends('hm::layouts.master')
@section('title', 'Approved Booking Request')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <!-- Form wizard with number tabs section start -->
                <section id="number-tabs">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Approved Booking Request Details</h4>
                                    <a class="heading-elements-toggle"><i
                                                class="la la-ellipsis-h font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-content collapse show">
                                    <div class="card-body">
                                        <form action="#" class="number-tab-steps wizard-circle">
                                            <!-- Step 1 -->
                                            <h6>Step 1</h6>
                                            <fieldset>
                                                <h4 class="form-section"><i class="la  la-building-o"></i>Booking
                                                    Details</h4>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="" class="required">Start Date</label>
                                                            <input id="start_date" type="text" class="form-control" placeholder="Pick start date">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="" class="required">End Date</label>
                                                            <input id="end_date" type="text" class="form-control" placeholder="Pick end date">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="">Booking Date</label>
                                                            <input type="text" class="form-control"
                                                                   value="{{ date('d-m-Y') }}" disabled>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="form-group col-md-6">
                                                        <label for="">Booking Type</label>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="skin skin-flat">
                                                                    <fieldset>
                                                                        <input type="checkbox"
                                                                               id="booking-type">
                                                                        <label for="">General Purpose</label>
                                                                    </fieldset>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="skin skin-flat">
                                                                    <fieldset>
                                                                        <input type="checkbox"
                                                                               id="booking-type">
                                                                        <label for="">Training</label>
                                                                    </fieldset>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <h4 class="form-section"><i class="la  la-building-o"></i>Room
                                                    Details</h4>
                                                <div class="repeater-room-types">
                                                    <div data-repeater-list="rooms">
                                                        <div data-repeater-item="" style="">
                                                            <div class="form row">
                                                                <div class="form-group mb-1 col-sm-12 col-md-5">
                                                                    <label>Room Type <span
                                                                                class="danger">*</span></label>
                                                                    <br>
                                                                    <select name="room_type" id=""
                                                                            class="form-control room-type-select"
                                                                            required>
                                                                        <option value=""></option>
                                                                        <option value="1">Room Type 1</option>
                                                                        <option value="2">Room Type 2</option>
                                                                        <option value="3">Room Type 3</option>
                                                                        <option value="4">Room Type 4</option>
                                                                    </select>
                                                                </div>
                                                                <div class="form-group mb-1 col-sm-12 col-md-5">
                                                                    <label>Quantity <span
                                                                                class="danger">*</span></label>
                                                                    <br>
                                                                    <input type="number" name="quantity" min="1" id=""
                                                                           class="form-control" placeholder="e.g 2">
                                                                </div>
                                                                <div class="form-group col-sm-12 col-md-2 text-center mt-2">
                                                                    <button type="button" class="btn btn-outline-danger"
                                                                            data-repeater-delete=""><i
                                                                                class="ft-x"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                            <hr>
                                                        </div>
                                                    </div>
                                                    <div class="form-group overflow-auto">
                                                        <div class="col-12">
                                                            <button type="button" data-repeater-create=""
                                                                    class="pull-right btn btn-sm btn-outline-primary">
                                                                <i class="ft-plus"></i> Add
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </fieldset>
                                            <!-- Step 2 -->
                                            <h6>Step 2</h6>
                                            <fieldset>
                                                <h4 class="form-section"><i class="la  la-building-o"></i>Personal
                                                    Information</h4>
                                                <div class="row">
                                                    <!-- Start of .col-md-6 -->
                                                    <div class="col-md-6">
                                                        <div class="row">
                                                            <div class="form-group col-md-12">
                                                                <label for="">Name <span class="danger">*</span></label>
                                                                <input type="text" class="form-control"
                                                                       placeholder="John Doe">
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="form-group col-md-12">
                                                                <label for="">Email</label>
                                                                <input type="email" class="form-control"
                                                                       placeholder="john@example.com">
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="form-group col-md-12">
                                                                <label for="">NID</label>
                                                                <input type="text" class="form-control"
                                                                       placeholder="10 digit number">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- End of .col-md-6 -->
                                                    <!-- Start of .col-md-6 -->
                                                    <div class="col-md-6">
                                                        <div class="row">
                                                            <div class="form-group col-md-12">
                                                                <label for="">Gender <span
                                                                            class="danger">*</span></label>
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="skin skin-square">
                                                                            <fieldset>
                                                                                <input type="radio"
                                                                                       name="input-radio-3"
                                                                                       id="input-radio-11">
                                                                                <label for="input-radio-11" class="">Male</label>
                                                                            </fieldset>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="skin skin-square">
                                                                            <fieldset>
                                                                                <input type="radio"
                                                                                       name="input-radio-3"
                                                                                       id="input-radio-11">
                                                                                <label for="input-radio-11" class="">Female</label>
                                                                            </fieldset>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="form-group col-md-12">
                                                                <label for="">Contact <span
                                                                            class="danger">*</span></label>
                                                                <input type="text" class="form-control"
                                                                       placeholder="e.g 0167XXXXXXX">
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="form-group col-md-12">
                                                                <label for="">Passport No</label>
                                                                <input type="text" class="form-control">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- End of .col-md-6 -->
                                                </div>
                                                <h4 class="form-section"><i class="la  la-building-o"></i>Occupation
                                                    Detials</h4>
                                                <div class="row">
                                                    <!-- Start of .col-md-6 -->
                                                    <div class="col-md-6">
                                                        <div class="row">
                                                            <div class="form-group col-md-12">
                                                                <label for="">Organization</label>
                                                                <input type="text" class="form-control" id=""
                                                                       value="">
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="form-group col-md-12">
                                                                <label for="">Organization Type</label>
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="skin skin-flat">
                                                                            <fieldset>
                                                                                <input type="checkbox"
                                                                                       id="organization-type">
                                                                                <label for="">Government</label>
                                                                            </fieldset>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="skin skin-flat">
                                                                            <fieldset>
                                                                                <input type="checkbox"
                                                                                       id="organization-type">
                                                                                <label for="">Private</label>
                                                                            </fieldset>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="skin skin-flat">
                                                                            <fieldset>
                                                                                <input type="checkbox"
                                                                                       id="organization-type">
                                                                                <label for="">Foreign</label>
                                                                            </fieldset>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="skin skin-flat">
                                                                            <fieldset>
                                                                                <input type="checkbox"
                                                                                       id="organization-type">
                                                                                <label for="">Others</label>
                                                                            </fieldset>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- End of .col-md-6 -->
                                                    <!-- Start of .col-md-6 -->
                                                    <div class="col-md-6">
                                                        <div class="row">
                                                            <div class="form-group col-md-12">
                                                                <label for="">Designation</label>
                                                                <input type="text" class="form-control">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- End of .col-md-6 -->
                                                </div>
                                                <h4 class="form-section"><i class="la  la-building-o"></i>Documents</h4>
                                                <div class="row">
                                                    <!-- Start of .col-md-6 -->
                                                    <div class="col-md-6">
                                                        <div class="row">
                                                            <div class="form-group col-md-12">
                                                                <label for="">Your Photo <span
                                                                            class="danger">*</span></label>
                                                                <input type="file" name="" id="" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="form-group col-md-12">
                                                                <label for="">NID Copy</label>
                                                                <input type="file" name="" id="" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="form-group col-md-12">
                                                                <label for="">Passport Copy</label>
                                                                <input type="file" name="" id="" class="form-control">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- End of .col-md-6 -->
                                                </div>
                                            </fieldset>
                                            <!-- Step 3 -->
                                            <h6>Step 3</h6>
                                            <fieldset>
                                                <h4 class="form-section"><i class="la  la-building-o"></i>Guest
                                                    Information</h4>
                                                <div class="repeater-guest-information">
                                                    <div data-repeater-list="guests">
                                                        <div data-repeater-item="" style="">
                                                            <div class="form">
                                                                <div class="row">
                                                                    <div class="form-group mb-1 col-sm-12 col-md-3">
                                                                        <label>Name <span
                                                                                    class="danger">*</span></label>
                                                                        <br>
                                                                        <input type="text" class="form-control"
                                                                               placeholder="John Doe">
                                                                    </div>
                                                                    <div class="form-group mb-1 col-sm-12 col-md-3">
                                                                        <label>Age <span class="danger">*</span></label>
                                                                        <br>
                                                                        <input type="number" min="0"
                                                                               class="form-control" placeholder="27">
                                                                    </div>
                                                                    <div class="form-group mb-1 col-sm-12 col-md-3">
                                                                        <label>Gender <span
                                                                                    class="danger">*</span></label>
                                                                        <br>
                                                                        <select name="gender" id="guest-gender-select"
                                                                                class="form-control">
                                                                            <option value=""></option>
                                                                            <option value="male">Male</option>
                                                                            <option value="female">Female</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group mb-1 col-sm-12 col-md-3">
                                                                        <label>Relation <span
                                                                                    class="danger">*</span></label>
                                                                        <br>
                                                                        <input type="text" class="form-control"
                                                                               placeholder="Colleague">
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="form-group mb-1 col-sm-12 col-md-3">
                                                                        <label>NID Copy <span
                                                                                    class="danger">*</span></label>
                                                                        <br>
                                                                        <input type="file" name="" id=""
                                                                               class="form-control">
                                                                    </div>
                                                                    <div class="form-group mb-1 col-sm-12 col-md-3">
                                                                        <label>NID <span class="danger">*</span></label>
                                                                        <br>
                                                                        <input type="text" class="form-control"
                                                                               placeholder="10 digit">
                                                                    </div>
                                                                    <div class="form-group mb-1 col-sm-12 col-md-4">
                                                                        <label>Address <span
                                                                                    class="danger">*</span></label>
                                                                        <br>
                                                                        <textarea name="" id="" cols="30" rows="5"
                                                                                  class="form-control"></textarea>
                                                                    </div>
                                                                    <div class="form-group col-sm-12 col-md-2 text-center mt-2">
                                                                        <button type="button"
                                                                                class="btn btn-outline-danger"
                                                                                data-repeater-delete=""><i
                                                                                    class="ft-x"></i>
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <hr>
                                                        </div>
                                                    </div>
                                                    <div class="form-group overflow-auto">
                                                        <div class="col-12">
                                                            <button type="button" data-repeater-create=""
                                                                    class="pull-right btn btn-sm btn-outline-primary">
                                                                <i class="ft-plus"></i> Add
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>

                                                <h4 class="form-section"><i class="la  la-building-o"></i>BARD
                                                    Reference</h4>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <div class="row col-md-12">
                                                            <label for="">Department</label>
                                                            <select name="" id="department-select" class="form-control">
                                                                <option value=""></option>
                                                                <option value="1">Dept 1</option>
                                                                <option value="2">Dept 2</option>
                                                                <option value="3">Dept 3</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="row col-md-12">
                                                            <label for="">Employee Name</label>
                                                            <input type="text" class="form-control"
                                                                   placeholder="John Doe">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="row col-md-12">
                                                            <label for="">Contact</label>
                                                            <input type="text" class="form-control"
                                                                   placeholder="11 digits">
                                                        </div>
                                                    </div>
                                                </div>
                                            </fieldset>
                                            <!-- Step 4 -->
                                            <h6>Step 4</h6>
                                            <fieldset>
                                                <h4 class="form-section"><i class="la  la-building-o"></i>Billing
                                                    Information</h4>
                                                <div class="row">
                                                    <div class="table-responsive">
                                                        <table class="table table-bordered table-striped">
                                                            <thead>
                                                            <tr>
                                                                <th>Room Type</th>
                                                                <th>Quantity</th>
                                                                <th>Duration</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            <tr>
                                                                <td>AC room</td>
                                                                <td>2</td>
                                                                <td>{{ \Carbon\Carbon::today()->addDays(7)->format('d-m-Y') . ' to ' . \Carbon\Carbon::today()->addDays(14)->format('d-m-Y') }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Non ac room</td>
                                                                <td>3</td>
                                                                <td>{{ \Carbon\Carbon::today()->addDays(7)->format('d-m-Y') . ' to ' . \Carbon\Carbon::today()->addDays(14)->format('d-m-Y') }}</td>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </fieldset>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- Form wizard with number tabs section end -->
            </div>
        </div>
    </div>
@endsection

@push('page-css')
    <link rel="stylesheet" href="{{ asset('theme/vendors/css/forms/icheck/icheck.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/css/plugins/forms/checkboxes-radios.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/css/plugins/forms/wizard.css') }}">

    <link rel="stylesheet" type="text/css" href="{{  asset('theme/vendors/css/pickers/pickadate/pickadate.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/vendors/css/pickers/daterange/daterangepicker.css')  }}">
    <link rel="stylesheet" href="{{ asset('theme/css/plugins/pickers/daterange/daterange.css')  }}">
@endpush

@push('page-js')
    <script src="{{ asset('theme/js/scripts/pickers/dateTime/pick-a-datetime.js')  }}"></script>
    <script src="{{ asset('theme/vendors/js/pickers/pickadate/picker.js')  }}"></script>
    <script src="{{ asset('theme/vendors/js/pickers/pickadate/picker.date.js') }}"></script>

    <script src="{{ asset('theme/vendors/js/pickers/daterange/daterangepicker.js') }}"></script>
    <script src="{{ asset('theme/vendors/js/extensions/jquery.steps.min.js') }}"></script>
    <script src="{{ asset('theme/vendors/js/forms/validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('theme/js/scripts/forms/wizard-steps.js') }}"></script>
    <script src="{{ asset('theme/vendors/js/forms/icheck/icheck.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('theme/js/scripts/forms/checkbox-radio.js') }}"></script>

    <script src="{{ asset('theme/vendors/js/forms/repeater/jquery.repeater.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('theme/js/scripts/forms/form-repeater.js') }}" type="text/javascript"></script>
    <script>
        $(document).ready(function () {

            $('#start_date, #end_date').pickadate();
            $('#guest-gender-select').select2({
                placeholder: 'Select Gender'
            });
            $('.repeater-guest-information').repeater({
                show: function () {
                    $(this).find('.select2-container').remove();
                    $(this).find('select').select2({
                        placeholder: 'Select Gender'
                    });
                    $(this).slideDown();
                }
            });
            $('.repeater-room-types').repeater({
                show: function () {
                    $(this).find('.select2-container').remove();
                    $(this).find('select').select2({
                        placeholder: 'Select room type'
                    });
                    $(this).slideDown();
                }
            });
            $('#department-select').select2({
                placeholder: 'Select Department'
            });
            $('.room-type-select').select2({
                placeholder: 'Select Room Type'
            });
        });
    </script>
@endpush