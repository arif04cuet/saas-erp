<script>
    /*
    *  Creation of js variables from php variables to be used in page.js and step.js
    * */
    // jquery step buttons localization
    let labels = {
        finish: '{!! trans('labels.submit') !!}',
        next: '{!! trans('labels.next') !!}',
        previous: '{!! trans('labels.previous') !!}',
    };
    //  localization
    let dateErrorMsg = '{!! trans('labels.greaterThanOrEqual', ['name' => trans('hm::booking-request.start_date')]) !!}';
    let male = '{!! trans('labels.male') !!}';
    let female = '{!! trans('labels.female') !!}';
    let firstNameLabel = '{!! trans('labels.first_name') !!}';
    let lastNameLabel = '{!! trans('labels.last_name') !!}';
    let genderLabel = '{!! trans('labels.gender') !!}';
    let mobileLabel = '{!! trans('labels.mobile') !!}';

    let minimum = '{!! trans('hm::checkin.minimum') !!}';
    let maximum = '{!! trans('hm::checkin.maximum') !!}';
    let minimum_message = '{!! trans('hm::checkin.minimum_message') !!}';
    let maximum_message = '{!! trans('hm::checkin.maximum_message') !!}';
    let room = '{!! trans('hm::checkin.room') !!}';
    let wrong_selection = '{!! trans('hm::checkin.wrong_selection') !!}';
    let at_least = '{!! trans('hm::checkin.at_least') !!}';
    let at_most = '{!! trans('hm::checkin.at_most') !!}';
    let room_selection = '{!! trans('hm::checkin.room_selection') !!}';
    let the = '{!! trans('hm::checkin.the') !!}';
    let current_lang = '{!!  Lang::locale()  !!}';
    let testabc = 'yes this is testing';
    let governmentOfficial = '{!! trans('hm::booking-request.government_official') !!}';
    let governmentPersonal = '{!! trans('hm::booking-request.government_personal') !!}';
    let nonGovernment = '{!! trans('hm::booking-request.non_government') !!}';
    let international = '{!! trans('hm::booking-request.international') !!}';
    let bard = '{!! trans('hm::booking-request.bard') !!}';
    let others = '{!! trans('hm::booking-request.others') !!}';

    // Relation Localization
    let guestRelations = {
        myself: '{!! trans('hm::booking-request.relation_myself') !!}',
        family: '{!! trans('hm::booking-request.relation_family') !!}',
        friend: '{!! trans('hm::booking-request.relation_friend') !!}',
        trainee: '{!! trans('hm::booking-request.relation_trainee') !!}',
        coworker: '{!! trans('hm::booking-request.relation_coworker') !!}',
    };

    // select2 placholder localization
    let selectPlaceholder = '{!! trans('labels.select') !!}';

    // entities variables passed from server
    let roomTypes = JSON.parse('{!! json_encode($roomTypes) !!}');
    let employees = JSON.parse('{!! json_encode($employees) !!}');
    let designations = JSON.parse('{!! json_encode($designations) !!}');
    let departments = JSON.parse('{!! json_encode($departments) !!}');
    let roomInfos = '{!! isset($roomBooking) ? json_encode($roomBooking->roomInfos) : null !!}';
    let oldRoomInfos = '{!! old('roomInfos') ? json_encode(old('roomInfos')) : null !!}';
    roomInfos = oldRoomInfos ? oldRoomInfos : roomInfos;
    let room_type_names = JSON.parse('{!! json_encode($roomTypes->pluck('name', 'id')) !!}');
    let pageType = JSON.parse('{!! json_encode($type) !!}');

    // url to get trainees of selected training
    let traineesUrl = '{!! url('/tms/get-trainees-of-training') !!}';
</script>
<script>
    // no of guest inputs in step-1 blade
    $(document).ready(function () {
        $('input[name=is_own_request]').on('ifChanged', function (e) {
            let isRequestForSomeoneElse = e.target.checked;

            let noOfGuestLabel = '{!! trans('hm::booking-request.no_of_guests') !!}';
            let includingMeLabel = '{!! trans('hm::booking-request.includingMe') !!}';

            let noOfGuestInputLabelSelector = 'label[for="no_guests"]';
            if (isRequestForSomeoneElse) {
                $(noOfGuestInputLabelSelector).html(noOfGuestLabel);
            } else {
                $(noOfGuestInputLabelSelector).html(`${noOfGuestLabel} ${includingMeLabel}`);
            }
        });

        $('input[name=no_of_guests]').on('change', function () {
            let previousGuestCount = Number($(this).data('guest-count'));
            let currentGuestCount = Number($(this).val());
            let guestRepeaterSelector = '.repeater-guest-information';
            let difference = Math.abs(currentGuestCount - previousGuestCount);

            if (currentGuestCount < 1) {
                $(this).val(previousGuestCount);
                return;
            }
            if (currentGuestCount > 300) {
                $(this).val(previousGuestCount);
                return;

            }

            if (currentGuestCount > previousGuestCount) {
                let guestIndex = $('.repeater-guest-information').find('div[data-repeater-item]').length;
                for (let index = guestIndex; index < (difference + guestIndex); index++) {
                    $(guestRepeaterSelector).find('div[data-repeater-list]').append(`<div data-repeater-item="" style="">
                        <div class="form">
                            <div class="row">
                                <div class="form-group mb-1 col-sm-12 col-md-3">
                                    <label class="required">{{ trans('hm::booking-request.first_name') }}</label>
                                    <br>
                                    <input class="form-control required" data-msg-required="{{ trans('labels.This field is required') }}" placeholder="John Doe" data-rule-maxlength="50" data-msg-maxlength="{{ trans('labels.At most 50 characters') }}" name="guests[${index}][first_name]" type="text">
                                </div>
                                <div class="form-group mb-1 col-sm-12 col-md-3">
                                    <label>{{ trans('hm::booking-request.middle_name') }}</label>
                                    <br>
                                    <input class="form-control" placeholder="John Doe" data-rule-maxlength="50" data-msg-maxlength="{{ trans('labels.At most 50 characters') }}" name="guests[${index}][middle_name]" type="text">
                                </div>
                                <div class="form-group mb-1 col-sm-12 col-md-3">
                                    <label class="required">{{ trans('hm::booking-request.last_name') }}</label>
                                    <br>
                                    <input class="form-control required" data-msg-required="{{ trans('labels.This field is required') }}" placeholder="John Doe" data-rule-maxlength="50" data-msg-maxlength="{{ trans('labels.At most 50 characters') }}" name="guests[${index}][last_name]" type="text">
                                </div>
                                <div class="form-group mb-1 col-sm-12 col-md-3">
                                    <label class="required">{{ trans('hm::booking-request.age') }}</label>
                                    <br>
                                    <input class="form-control required" placeholder="e.g. 18" data-msg-required="{{ trans('labels.This field is required') }}" min="1" data-msg-min="{{ trans('Field can\'t be geater than 1') }}" max="100" data-msg-max="{{ trans('Field can\'t be geater than 100') }}" name="guests[${index}][age]" type="number">
                                </div>
                                <div class="form-group mb-1 col-sm-12 col-md-3">
                                    <label class="required">{{ trans('hm::booking-request.nationality') }}</label>
                                    <br>
                                    <input placeholder="{{ trans('hm::booking-request.nationality') }}" class="form-control required" data-msg-required="{{ trans('labels.This field is required') }}" data-rule-regex="^([^\\x00-\\x7F]|[a-zA-Z ])+$" data-msg-regex="{{ trans('labels.letters_only') }}" name="guests[${index}][nationality]" type="text">
                                </div>
                                <div class="form-group mb-1 col-sm-12 col-md-3">
                                    <label class="required">{{ trans('hm::booking-request.gender') }}</label>
                                    <br>
                                    <select class="form-control guest-gender-select required" data-msg-required="{{ trans('labels.This field is required') }}" name="guests[${index}][gender]" aria-hidden="true"><option value="" selected="selected"></option><option value="male">{{ trans('hm::booking-request.male') }}</option><option value="female">{{ trans('hm::booking-request.female') }}</option></select>
                                </div>
                                <div class="form-group mb-1 col-sm-12 col-md-3">
                                    <label class="required">{{ trans('hm::booking-request.relation') }}</label>
                                    <br>
                                    <select class="form-control relation-select required" data-msg-required="{{ trans('labels.This field is required') }}" name="guests[${index}][relation]" aria-hidden="true"><option value="" selected="selected"></option><option value="myself">{{ trans('hm::booking-request.relation_myself') }}</option><option value="family">{{ trans('hm::booking-request.relation_family') }}</option><option value="friend">{{ trans('hm::booking-request.relation_friend') }}</option><option value="coworker">{{ trans('hm::booking-request.relation_coworker') }}</option></select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group mb-1 col-sm-12 col-md-3">
                                    <label>{{ trans('hm::booking-request.nid_copy') }} ( {{ trans('hm::booking-request.maximum') }} {{ trans('hm::booking-request.size') }} - {{ trans('hm::booking-request.3mb') }} )</label>
                                    <br>
                                    <input class="form-control" accept=".png, .jpg, .jpeg" name="guests[${index}][nid_doc]" type="file">
                                </div>
                                <div class="form-group mb-1 col-sm-12 col-md-3">
                                    <label>{{ trans('hm::booking-request.nid') }}</label>
                                    <br>
                                    <input class="form-control" placeholder="Nid number" data-rule-number="true" data-msg-number="{{ trans('labels.Please enter a valid number') }}" data-rule-nid-validation-count="10,13,17" data-msg-nid-validation-count="{{ trans('labels.nid_validation_count_error_msg') }}" name="guests[${index}][nid_no]" type="text">
                                </div>
                                <div class="form-group mb-1 col-sm-12 col-md-4">
                                    <label class="required">{{ trans('hm::booking-request.address') }}</label>
                                    <br>
                                    <textarea class="form-control required" data-msg-required="{{ trans('labels.This field is required') }}" placeholder="address" cols="30" rows="5" data-rule-maxlength="300" data-msg-maxlength="{{ trans('labels.At most 300 characters') }}" name="guests[${index}][address]"></textarea>
                                </div>
                                <div class="form-group col-sm-12 col-md-2 text-center mt-2">
                                    <button type="button" class="btn btn-outline-danger" data-repeater-delete=""><i class="ft-x"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <hr>
                    </div>`);
                }
                $('select[name*=gender], select[name*=relation]').select2({
                    placeholder: selectPlaceholder
                });
            } else {
                let guestIndex = $('.repeater-guest-information').find('div[data-repeater-item]').length;
                for (let index = guestIndex; index < (difference + guestIndex); index++) {
                    $(guestRepeaterSelector).find('div[data-repeater-item]').last().remove();
                }
            }

            $(this).data('guest-count', $(this).val());
        });
    });
</script>
