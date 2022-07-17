<div class="row">
    <div class="col-md-12 mt-2">
        <h4 class="form-section">
            <i class="la la-female"></i> @lang('hrm::spouse_children_info.spouse.detail')
        </h4>
    </div>
    <div class="col-md-12">
        @if($employeeSpouses->count())
            <div class="table-responsive">
                <table class="master table">
                    <thead>
                    <tr>
                        <th>@lang('hrm::spouse_children_info.fields.first_name')</th>
                        <th>@lang('hrm::spouse_children_info.fields.last_name')</th>
                        <th>@lang('hrm::spouse_children_info.fields.date_of_birth')</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($employeeSpouses as $key => $spouse)
                        <tr>
                            <td> {{ $spouse->first_name }}</td>
                            <td> {{ $spouse->last_name }}</td>
                            <td> {{ $spouse->date_of_birth }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
    <div class="col-md-12 mt-2">
        <h4 class="form-section">
            <i class="la la-female"></i> @lang('hrm::spouse_children_info.children.detail')
        </h4>
    </div>
    <div class="col-md-12">
        @if($employeeChildren->count())
            <div class="table-responsive">
                <table class="master table">
                    <thead>
                    <tr>
                        <th>@lang('hrm::spouse_children_info.fields.first_name')</th>
                        <th>@lang('hrm::spouse_children_info.fields.last_name')</th>
                        <th>@lang('hrm::spouse_children_info.fields.date_of_birth')</th>
                        <th>@lang('hrm::spouse_children_info.fields.is_attestation_letter_submitted')</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($employeeChildren as $key => $child)
                        <tr>
                            <td>{{ $child->first_name }}</td>
                            <td>{{ $child->last_name }}</td>
                            <td>{{ $child->date_of_birth }}</td>
                            <td>{{ trans(
                                    'hrm::spouse_children_info.results.is_attestation_letter_submitted.'
                                    . ($child->is_attestation_letter_submitted ? 'yes' : 'no')
                                ) }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>

<a class="master btn btn-small btn-info"
   href="{{ route('employee.edit', $employee->id) . '/#spouse-children' }}">@lang('labels.edit') </a>
