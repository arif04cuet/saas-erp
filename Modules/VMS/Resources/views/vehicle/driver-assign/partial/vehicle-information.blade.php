<!-- vehicle information -->
<h4 class="form-section"><i
        class="la la-tag"></i>
    @lang('vms::vehicle.details')
</h4>
<div class="row">
    <div class="col-12 col-md-6">
        <table class="table table-borderless">

            <tr>
                <th>@lang('labels.name')</th>
                <td>{{optional($vehicle)->name ?? trans('labels.not_found')}}</td>
            </tr>
            <tr>
                <th>@lang('vms::vehicle.form_elements.price')</th>
                <td>{{optional($vehicle)->price ?? trans('labels.not_found')}}</td>
            </tr>
            <tr>
                <th>@lang('vms::vehicle.form_elements.seat')</th>
                <td>{{optional($vehicle)->seat ?? trans('labels.not_found')}}</td>
            </tr>
            <tr>
                <th>@lang('vms::vehicle.form_elements.purchase_date')</th>
                <td>{{optional($vehicle)->purchase_date ?? trans('labels.not_found')}}</td>
            </tr>

            <tr>
                <th>@lang('vms::driver.title')</th>
                @if(isset($vehicle))
                    <td>
                        @forelse($vehicle->drivers as $driver)
                            <li>{{$driver->getName() ?? trans('labels.not_found')}}</li>
                        @empty
                            {{trans('labels.not_found')}}
                        @endforelse
                    </td>
                @else
                    {{trans('labels.not_found')}}
                @endif
            </tr>
        </table>
    </div>
    <div class="col-12 col-md-6">
        <table class="table table-borderless">
            <tr>
                <th>@lang('vms::vehicle.form_elements.vehicle_type_id')</th>
                <td>{{ optional($vehicle)->vehicle_type ?? trans('labels.not_found')}}</td>
            </tr>
            <tr>
                <th>@lang('vms::vehicle.form_elements.model')</th>
                <td>{{optional($vehicle)->model ?? trans('labels.not_found')}}</td>
            </tr>
            <tr>
                <th>@lang('vms::vehicle.form_elements.cc')</th>
                <td>{{optional($vehicle)->cc ?? trans('labels.not_found')}}</td>
            </tr>
            <tr>
                <th>@lang('vms::vehicle.form_elements.chassis_number')</th>
                <td>{{optional($vehicle)->chassis_number ?? trans('labels.not_found')}}</td>
            </tr>
            <tr>
                <th>@lang('vms::vehicle.form_elements.registration_number')</th>
                <td>{{optional($vehicle)->registration_number ?? trans('labels.not_found')}}</td>
            </tr>
        </table>
    </div>
</div>
<!-- /Vehicle Information -->
