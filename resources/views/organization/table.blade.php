<div class="table-responsive">
    <div class="pull-left">
        <h4 class="card-title">@lang('organization.organization_list')</h4>
    </div>
    <div class="pull-right">
        <a href="{{ $url }}" class="btn btn-sm btn-primary"><i
                    class="ft ft-plus"></i> @lang('organization.add_organization')</a>
    </div>
    <br><br>
    <table class="table table-striped table-bordered organization-table">
        <thead>
        <tr>
            <th>@lang('labels.serial')</th>
            <th>@lang('organization.organization')</th>
            <th>@lang('member.member')</th>
            <th>Deposit</th>
            <th>Loan</th>
            <th>Share</th>
        </tr>
        </thead>
        <tbody>
        @foreach($organizable->organizations as $organization)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>
                    <a href="{{ $organizationShowRoute($organizable->id, $organization->id) }}">{{ $organization->name }}</a>
                </td>
                <td>{{ $organization->members->count() }}</td>
                @foreach($organizable->attributes->take(3) as $attribute)
                    <td>{{ $organization->attributeValues->where('attribute_id', $attribute->id)->sum('achieved_value') }}</td>
                @endforeach
            </tr>
        @endforeach
        </tbody>
        <tfoot>
        <tr class="font-weight-bold">
            <td colspan="2" class="text-center">@lang('labels.total')</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        </tfoot>
    </table>
</div>
