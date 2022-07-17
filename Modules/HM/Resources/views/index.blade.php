@extends('hm::layouts.master')
@section('title', trans('hm::hostel.menu_title'))

@push('page-css')
    <style type="text/css">
        .hostel-level {
            background-color: #fdfbff;
            color: black;
        }

        .rooms {
            font-weight: bold;
            cursor: pointer;
        }

        .available {
            background-color: #28D094;
            color: black;
            text-shadow: 0px 0px 11px #c0ecc4;
        }

        .partially_available {
            background-color: #ffd162;
            color: #fcfcfc;
            text-shadow: 0px 0px 11px #8a8a8a;
        }

        .unavailable {
            background-color: #FF0000;
            color: #fcfcfc;
            text-shadow: 0px 0px 11px #8a8a8a;
        }

        .not-in-service {
            background-color: #FF4558;
            color: #fcfcfc;
            text-shadow: 0px 0px 11px #8a8a8a;
        }
    </style>
@endpush
@section('content')
    <div class="container">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12">

            </div>
            <div class="content-header-right col-md-6 col-12">
                <div class="btn-group float-md-right" role="group" aria-label="Button group with nested dropdown">
                    <div class="btn-group" role="group">
                        <a class="btn btn-outline-info round" href="{{ route('booking-requests.create') }}">
                            <i class="ft-book"></i> @lang('hm::booking-request.booking_request')
                        </a>
                        <a class="btn btn-outline-warning round" href="{{ route('check-in.create-options') }}">
                            <i class="ft-bookmark"></i> @lang('hm::booking-request.check_in')
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <br>
        @include('hm::dashboard.hostel-seat', ['hostels' => $hostels, 'roomDetails' => $roomDetails])
        {!! $searchView !!}
    </div>
@stop

{{-- <button onclick="addData()">Click me</button> --}}
@push('page-css')
    <link rel="stylesheet" href="{{ asset('theme/vendors/css/pickers/pickadate/pickadate.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/css/plugins/pickers/daterange/daterange.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/vendors/css/forms/icheck/icheck.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/css/plugins/forms/checkboxes-radios.css') }}">
@endpush

@push('page-js')
    <script src="{{ asset('theme/vendors/js/charts/chart.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('theme/vendors/js/pickers/pickadate/picker.js') }}"></script>
    <script src="{{ asset('theme/vendors/js/pickers/pickadate/picker.date.js') }}"></script>
    <script type="text/javascript">
        // Label localization
        let available = "{{ trans('hm::hostel.available') }}";
        let partiallyAvailable = "{{ trans('hm::hostel.partially_available') }}";
        let unavailable = "{{ trans('hm::hostel.booked') }}";

        let periodTo = $('input[name=booking_date]').pickadate({});
        let chartDatasetData = [
            {{ $allRoomsCountBasedOnStatus['available'] }}, // '#28D094'
            {{ $allRoomsCountBasedOnStatus['unavailable'] }}, // '#ffd162'
            {{ $allRoomsCountBasedOnStatus['partially_available'] }}, // '#00A5A8'
            {{-- {{$allRoomsCountBasedOnStatus['not_in_service']}} --}} // '#FF4558'
        ];

        var pieSimpleChart; // Pie Chart orbject

        /* # Pie Chart on Dom load
         ======================================= */

        $(window).on("load", function() {

            //Get the context of the Chart canvas element we want to select
            var ctx = $("#hostel-pie-chart");

            var chartOptions = {
                responsive: true,
                maintainAspectRatio: false,
                responsiveAnimationDuration: 800,
            };

            // Chart Data
            var chartData = {
                labels: [available, unavailable, partiallyAvailable],
                datasets: [{
                    label: "Hostel",
                    data: chartDatasetData,
                    backgroundColor: ['#28D094', '#FF0000', '#ffd162']
                }]
            };

            var config = {
                type: 'pie',
                options: chartOptions,
                data: chartData
            };

            // Create the chart
            pieSimpleChart = new Chart(ctx, config);

        });

        /* Rerender Pie Chart for new datasets
        ====================================== */
        function addData() {
            pieSimpleChart.data.datasets.forEach((dataset) => {
                dataset.data = [5, 1, 5];
            });
            pieSimpleChart.update();
        }
    </script>
    <!-- Needed For Hostel Search View -->
    <!-- Needed For Hostel Search View -->
    <script type="text/javascript">
        let genericErrorMessage = '{!! trans('labels.generic_error_message') !!}';
        initSearchDatePickers();

        function loadSearchView() {
            let url = '{{ route('hostels.get-vacancy-search-view') }}';
            let message =
                '<div><h3>{{ trans('tms::schedule.message.submit.wait') }}</h3><br> <span class="ft-refresh-cw icon-spin font-medium-2"></span></div>';
            let startDate = $('.start-date').val();
            let endDate = $('.end-date').val();
            let token = "{{ csrf_token() }}";
            // block the UI
            $.blockUI({
                message: message,
                timeout: null, //unblock after 2 seconds
                overlayCSS: {
                    backgroundColor: '#FFF',
                    opacity: 0.8,
                    cursor: 'wait'
                },
                css: {
                    border: 0,
                    padding: 0,
                    backgroundColor: 'transparent'
                }
            });
            $.ajax({
                url: url,
                data: {
                    _token: token,
                    start_date: startDate,
                    end_date: endDate
                },
                type: "POST",
                success: function(data) {
                    if (data) {
                        console.log(data);
                        $('.search-view').html(data);
                        initSearchDatePickers();
                        $.unblockUI();
                        return true;
                    } else {
                        alert(genericErrorMessage);
                        $.unblockUI();
                        return false;
                    }
                },
                error: function(request, status, error) {
                    alert(genericErrorMessage);
                    $.unblockUI();
                    return false;
                }
            })
        }

        function initSearchDatePickers() {
            $('.start-date, .end-date').pickadate({
                format: 'yyyy-mm-dd',
            });
            $('.start-date').change(function() {
                $('.end-date').pickadate('picker').set('min', new Date($(this).val()));
            });
        }
    </script>
@endpush
