@extends('tms::layouts.master')
@section('title', trans('tms::organization.organization_list'))

@section('content')
    <section id="user-list">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">@lang('tms::organization.organization_list')</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                        <div class="heading-elements">
                            <a href="{{ route('organization.create') }}" class="btn btn-primary btn-sm"><i
                                        class="ft-plus white"></i> {{trans('tms::organization.create_button')}}</a>
                        </div>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body card-dashboard">
                            <table class="table training-organization-table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>{{trans('labels.serial')}}</th>
                                    <th>{{trans('tms::organization.organization_id')}}</th>
                                    <th>{{trans('tms::organization.organization_name')}}</th>
                                    <th>{{trans('tms::organization.type')}}</th>
                                    <th>{{trans('tms::organization.contact_person')}}</th>
                                    <th>{{trans('tms::organization.contact_person_email')}}</th>
                                    <th>{{trans('tms::organization.phone')}}</th>
                                    <th>{{trans('labels.created_at')}}</th>
                                    <th>{{trans('labels.action')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($trainingOrganizations as $trainingOrganization)
                                        <tr>
                                            <th scope="row">1</th>
                                            <td>
                                                <a href="{{ route('trainingOrganization.show', $trainingOrganization->id) }}">
                                                    {{ $trainingOrganization->unique_id ?? trans('labels.not_available') }}
                                                </a>
                                            </td>
                                            <td>
                                                <a href="{{ route('trainingOrganization.show', $trainingOrganization->id) }}">
                                                    {{ $trainingOrganization->name ?? trans('labels.not_available') }}
                                                </a>
                                            </td>
                                            <td>
                                                {{ $trainingOrganization->type ?? trans('labels.not_available') }}
                                            </td>
                                            <td>
                                                {{ $trainingOrganization->contact_person ?? trans('labels.not_available') }}
                                            </td>
                                            <td>
                                                {{ $trainingOrganization->contact_person_email ?? trans('labels.not_available') }}
                                            </td>
                                            <td>
                                                {{ $trainingOrganization->contact_person_phone ?? trans('labels.not_available') }}
                                            </td>
                                            <td>
                                                {{ \Carbon\Carbon::parse($trainingOrganization->created_at)->format('j F, Y') }}
                                            </td>
                                            <td>
                                            <span class="dropdown">
                                            <button id="btnSearchDrop2" type="button" data-toggle="dropdown"
                                                    aria-haspopup="true"
                                                    aria-expanded="false" class="btn btn-info dropdown-toggle"><i
                                                    class="la la-cog"></i></button>
                                              <span aria-labelledby="btnSearchDrop2"
                                                    class="dropdown-menu mt-1 dropdown-menu-right">
                                                <a href="{{ route('trainingOrganization.show', $trainingOrganization->id) }}"
                                                   class="dropdown-item"><i class="ft-eye"></i> {{trans('labels.details')}}</a>
                                                <a href="{{ route('trainingOrganization.edit', $trainingOrganization->id) }}"
                                                   class="dropdown-item"><i class="ft-edit-2"></i> {{trans('labels.edit')}}</a>
                                              </span>
                                            </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('page-js')
    <script>
        $.fn.dataTable.ext.search.push(
            function (settings, data, dataIndex) {
                let filterValue = $('#filter-select').val() || 'public';
                if (data[3] == filterValue) {
                    return true;
                }
                return false;
            }
        );
        $(document).ready(function () {
            let table = $('.training-organization-table').DataTable({
                "columnDefs": [
                    {"orderable": false, "targets": 7}
                ],
                // scrollY:        500,
                scrollX:        true,
                scrollCollapse: true,
                // paging:         false,
                // fixedColumns:   true,
                fixedColumns: {
                    leftColumns: 3
                },
            });

            $("div.dataTables_length").append(`
                <label style="margin-left: 20px">
                    {{ trans('labels.filtered') }}
                    <select id="filter-select" class="form-control form-control-sm" style="width: 100px">
                        <option value="public">@lang('tms::organization.public')</option>
                        <option value="autonomous">@lang('tms::organization.autonomous')</option>
                        <option value="international">@lang('tms::organization.international')</option>
                        <option value="private">@lang('tms::organization.private')</option>
                        <option value="ngo">@lang('tms::organization.ngo')</option>
                        <option value="others">@lang('tms::organization.others')</option>
                     </select>
                    {{ trans('labels.records') }}
            </label>
`);

            $('#filter-select').on('change', function () {
                table.draw();
            });
        });
    </script>

@endpush
