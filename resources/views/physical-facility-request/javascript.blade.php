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
    let formContainer = '.facility-request-tab-steps';
    let requiredMessage = '{!! __('labels.This field is required') !!}';
    let invalidMobileMessage = '{!! __('hm::booking-request.facility.invalid_mobile') !!}';
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
    {{--let employees = JSON.parse('{!! json_encode($employees) !!}');--}}
    {{--let designations = JSON.parse('{!! json_encode($designations) !!}');--}}
    {{--let departments = JSON.parse('{!! json_encode($departments) !!}');--}}
    {{--let roomInfos = '{!! isset($roomBooking) ? json_encode($roomBooking->roomInfos) : null !!}';--}}
    {{--let oldRoomInfos = '{!! old('roomInfos') ? json_encode(old('roomInfos')) : null !!}';--}}
    {{--roomInfos = oldRoomInfos ? oldRoomInfos : roomInfos;--}}
    let room_type_names = JSON.parse('{!! json_encode($roomTypes->pluck('name', 'id')) !!}');
    {{--let pageType = JSON.parse('{!! json_encode($type) !!}');--}}

    // url to get trainees of selected training
    {{--let traineesUrl = '{!! url('/tms/get-trainees-of-training') !!}';--}}
</script>

