<div class="table-responsive">
    <div class="pull-left">
        <h4 class="card-title">@lang('organization.organization_list')</h4>
    </div>
    <div class="pull-right">
        <a href="{{ $url }}" class="btn btn-sm btn-primary">@lang('organization.add_organization')</a>
    </div>
    <br><br>
    <table class="table table-striped table-bordered organization-table">
        <thead>
        <tr>
            <th>@lang('labels.serial')</th>
            <th>@lang('organization.organization')</th>
            <th>@lang('division.division')</th>
            <th>@lang('district.district')</th>
            <th>@lang('thana.thana')</th>
            <th>@lang('union.union')</th>
            <th>@lang('member.member')</th>
        </tr>
        </thead>
        <tbody>
        @foreach($organizable->organizations as $organization)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>
                    <a href="{{ $organizationShowRoute($organizable->id, $organization->id) }}">{{ $organization->name }}</a>
                </td>
                <td>{{ $organization->division->name }}</td>
                <td>{{ $organization->district->name }}</td>
                <td>{{ $organization->thana->name }}</td>
                <td>{{ $organization->union->name }}</td>
                <td>{{ $organization->members->count() }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
