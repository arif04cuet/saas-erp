@php
    $timeFormat = 'h:i A';
@endphp
<div class="table-responsive">
    <table class="master table table-bordered">
        <thead>
        <tr>
            <th>Breaks</th>
            <th>Start Time</th>
            <th>End Time</th>
            <th>Cafeteria</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <th>Breakfast</th>
            @include('tms::training.course.break.partial.common_inputs', [
                'inputName' => 'breakfast',
                 'entity' => $breakfast
             ])
        </tr>
        <tr>
            <th>Lunch</th>
            @include('tms::training.course.break.partial.common_inputs', [
                'inputName' => 'lunch',
                 'entity' => $lunch
             ])
        </tr>
        <tr>
            <th>Tea Break</th>
            @include('tms::training.course.break.partial.common_inputs', [
                'inputName' => 'tea_break',
                'entity' => $teaBreak
            ])
        </tr>
        <tr>
            <th>Dinner</th>
            @include('tms::training.course.break.partial.common_inputs', [
                'inputName' => 'dinner',
                'entity' => $dinner
            ])
        </tr>
        </tbody>
    </table>
</div>

@push('page-css')
    <link rel="stylesheet" href="{{ asset('css/jquery.timepicker.min.css') }}">
@endpush

@push('page-js')
    <script src="{{ asset('js/jquery.timepicker.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('select').select2({
                placeholder: '{!! trans('labels.select') !!}'
            });

            $('input').timepicker({
                timeFormat: 'hh:mm p',
                interval: 30,
                minTime: '8',
                maxTime: '10:00pm',
                startTime: '08:00',
                dynamic: false,
                dropdown: true,
                scrollbar: true
            });
        });
    </script>
@endpush
