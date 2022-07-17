<div class="search-view">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>
                        ({{ $startDate->format('j F, Y') }}) - ({{ $endDate->format('j F, Y') }})
                        @lang('hm::hostel.menu_title') @lang('labels.chart')
                    </h4>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                {!! Form::label('start_date', trans('labels.start'), ['class' => 'form-label']) !!}
                                {!! Form::text('start_date', $startDate ? $startDate->format('Y-m-d') : \Carbon\Carbon::now()->format('Y-m-d'), ['class' => 'form-control start-date']) !!}
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                {!! Form::label('end_date', trans('labels.end'), ['class' => 'form-label']) !!}
                                {!! Form::text('end_date', $endDate ? $endDate->format('Y-m-d') : \Carbon\Carbon::now()->format('Y-m-d'), ['class' => 'form-control end-date ']) !!}
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group" style="margin-top: 26px;">
                                {!! Form::button('<i class="ft-search"></i> ' . trans('labels.search'), [
    'class' => 'btn btn-success',
    'title' => trans('labels.search'),
    'onclick' => 'loadSearchView()',
]) !!}
                            </div>
                        </div>
                    </div>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-content collapse show">
                    <div class="card-body">

                        <!-- show the booking request tables -->
                        <!-- show the hostelSummary Tables -->
                        <div class="table-responsive">
                            <table class="table table-bordered text-center">
                                <thead>
                                    <tr>
                                        <th>@lang('hm::hostel.menu_title')</th>
                                        <th>@lang('tms::training_hostel.floor') </th>
                                        <th>@lang('hm::hostel.total_rooms')</th>
                                        <th>@lang('hm::hostel.available_rooms')</th>
                                        <th>@lang('hm::hostel.partially_available')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($hostelSummary as $hostel)
                                        <tr>
                                            <th>
                                                <label
                                                    class="text-info text-capitalize">{{ $hostel->name ?? trans('labels.not_found') }}</label>
                                            </th>
                                            <th>
                                                <h4>{{ $hostel->floor ?? 0 }}</h4>
                                            </th>
                                            <th>
                                                <h4>{{ $hostel->total_rooms ?? 0 }}</h4>
                                            </th>
                                            <th>
                                                <h4>{{ $hostel->total_available ?? 0 }}</h4>
                                            </th>
                                            <th>
                                                <h4>{{ $hostel->partially_available ?? 0 }}</h4>
                                            </th>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<!--  plug this js to the parent view -->

{{-- <script type="text/javascript"> --}}
{{-- let genericErrorMessage = '{!! trans('labels.generic_error_message') !!}'; --}}
{{-- initSearchDatePickers(); --}}
{{-- $('#hostel-vacancy-search-form').submit(function (eventObj) { --}}
{{-- eventObj.preventDefault(); --}}
{{-- let url = '{{route('hostels.get-vacancy-search-view')}}'; --}}
{{-- let message = '<div><h3>{{ trans('tms::schedule.message.submit.wait') }}</h3><br> <span class="ft-refresh-cw icon-spin font-medium-2"></span></div>'; --}}
{{-- let startDate = $('.start-date').val(); --}}
{{-- let endDate = $('.end-date').val(); --}}
{{-- let token = "{{csrf_token()}}"; --}}
{{-- // block the UI --}}
{{-- $.blockUI({ --}}
{{-- message: message, --}}
{{-- timeout: null, //unblock after 2 seconds --}}
{{-- overlayCSS: { --}}
{{-- backgroundColor: '#FFF', --}}
{{-- opacity: 0.8, --}}
{{-- cursor: 'wait' --}}
{{-- }, --}}
{{-- css: { --}}
{{-- border: 0, --}}
{{-- padding: 0, --}}
{{-- backgroundColor: 'transparent' --}}
{{-- } --}}
{{-- }); --}}
{{-- $.ajax({ --}}
{{-- url: url, --}}
{{-- data: { --}}
{{-- _token: token, --}}
{{-- start_date: startDate, --}}
{{-- end_date: endDate --}}
{{-- }, --}}
{{-- type: "POST", --}}
{{-- success: function (data) { --}}
{{-- if (data) { --}}
{{-- console.log(data); --}}
{{-- $('.search-view').html(data); --}}
{{-- initSearchDatePickers(); --}}
{{-- $.unblockUI(); --}}
{{-- return true; --}}
{{-- } else { --}}
{{-- alert(genericErrorMessage); --}}
{{-- $.unblockUI(); --}}
{{-- return false; --}}
{{-- } --}}
{{-- }, --}}
{{-- error: function (request, status, error) { --}}
{{-- alert(genericErrorMessage); --}}
{{-- $.unblockUI(); --}}
{{-- return false; --}}
{{-- } --}}
{{-- }) --}}
{{-- }); --}}

{{-- function initSearchDatePickers() { --}}
{{-- $('.start-date, .end-date').pickadate({ --}}
{{-- format: 'yyyy-mm-dd', --}}
{{-- }); --}}
{{-- $('.start-date').change(function () { --}}
{{-- $('.end-date').pickadate('picker').set('min', new Date($(this).val())); --}}
{{-- }); --}}
{{-- } --}}

{{-- </script> --}}
