<!-- General Information -->
<h4 class="form-section"><i
        class="la la-tag"></i>
    @lang('vms::vehicle.title') @lang('labels.select')
</h4>
<div class="col">
    <div class="table-responsive">
        <table class="table table-striped table-bordered text-center"
               id="journal_entry_table">
            <thead>
            <tr>
                <th>@lang('labels.name')</th>
                <th>@lang('vms::vehicle.form_elements.vehicle_type_id')</th>
                <th>@lang('vms::driver.title')</th>
                <th>@lang('labels.select')</th>
            </tr>
            </thead>
            <tbody>
            @foreach($vehicles as $vehicle)
                <tr>
                    <td>{{$vehicle->name ?? trans('labels.not_found')}}</td>
                    <td>{{$vehicle->vehicleType->getTitle() ?? trans('labels.not_found')}}</td>
                    <td>
                        @forelse($vehicle->drivers as $driver)
                            <li>
                                {{
                                    $driver->getName() ?? trans('labels.not_found')
                                 }}
                            </li>

                        @empty
                            {{trans('labels.not_found')}}
                        @endforelse

                    </td>
                    <td>
                        @if(in_array($vehicle->id,$assignedVehicles))
                            <a href="{{route('vms.trip.remove-vehicle',[$trip,$vehicle])}}"
                               class="btn btn-{{$statusCssArray['rejected']}} btn-sm">
                                {{trans('labels.remove')}}
                            </a>
                        @else
                            <a href="{{route('vms.trip.allocate-vehicle',[$trip,$vehicle])}}"
                               class="btn btn-{{$statusCssArray['completed']}} btn-sm">
                                {{trans('vms::trip.allocated')}}
                            </a>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
<!--/General Information -->


@push('page-js')
    <script>
        $(".vms-trip-apply-form").submit(function (e) {
            e.preventDefault();
            let passed = setSession();
            if (passed) {
                $(this).unbind('submit').submit();
            } else {
                alert(genericErrorMessage);
                return;
            }
        });

        function setSession() {
            const form = $('.vms-trip-apply-form').serializeArray();
            {{--const data = getSelectedVehicles(form);--}}
            {{--let url = '{{route('vms.trip.apply.set-vehicle-session')}}';--}}
            {{--return $.ajax({--}}
            {{--    url: url,--}}
            {{--    data: {'vehicles': data, '_token': "{{ csrf_token() }}"},--}}
            {{--    type: "post",--}}
            {{--    async: false,--}}
            {{--    success: function (data) {--}}
            {{--        if (!data) {--}}
            {{--            return false;--}}
            {{--        }--}}
            {{--        return true;--}}
            {{--    },--}}
            {{--    error: function (request, status, error) {--}}
            {{--        return false;--}}
            {{--    }--}}
            {{--}).responseText;--}}
        }

        function getSelectedVehicles(formInputs) {
            let selectedVehicles = [];
            const data = [...formInputs].reduce(function (r, e) {
                const [i, prop] = e.name.split(/\[(.*?)\]/g).slice(1).filter(Boolean)
                if (!r[i]) r[i] = {}
                r[i][prop] = e.value
                return r;
            }, [])
            for (i = 0; i < data.length; i++) {
                if (data[i]) {
                    if (data[i].hasOwnProperty('selected')) {
                        selectedVehicles.push(data[i].vehicle_id);
                    }
                }
            }
            return selectedVehicles;
        }
    </script>
@endpush

