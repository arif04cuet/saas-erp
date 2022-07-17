@extends('tms::layouts.master')
@section('title', trans('tms::organization.details'))

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title" id="basic-layout-form">{{__('tms::organization.show_form_title')}}</h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-content collapse show">
                    <div class="card-body">
                        <table class="table">
                            <tbody>
                            <tr>
                                <th>{{trans('tms::organization.organization_id')}}</th>
                                <td>{{ $trainingOrganization->unique_id ?? trans('labels.not_available') }}</td>
                            </tr>
                            <tr>
                                <th>{{trans('tms::organization.organization_name')}}</th>
                                <td>{{ $trainingOrganization->name ?? trans('labels.not_available') }}</td>
                            </tr>
                            <tr>
                                <th>{{trans('tms::organization.type')}}</th>
                                <td>{{ $trainingOrganization->type ?? trans('labels.not_available') }}</td>
                            </tr>
                            <tr>
                                <th>{{trans('tms::organization.contact_person')}}</th>
                                <td>{{ $trainingOrganization->contact_person ?? trans('labels.not_available') }}</td>
                            </tr>
                            <tr>
                                <th>{{trans('tms::organization.contact_person_email')}}</th>
                                <td>{{ $trainingOrganization->contact_person_email ?? trans('labels.not_available') }}</td>
                            </tr>
                            <tr>
                                <th>{{trans('tms::organization.phone')}}</th>
                                <td>{{ $trainingOrganization->contact_person_phone ?? trans('labels.not_available') }}</td>
                            </tr>
                            <tr>
                                <th>{{trans('tms::organization.CC')}}</th>
                                <td>{{ $trainingOrganization->contact_person_cc ?? trans('labels.not_available') }}</td></td>
                            </tr>
                            <tr>
                                <th>{{trans('tms::organization.address')}}</th>
                                <td>{{ $trainingOrganization->address ?? trans('labels.not_available') }}</td></td>
                            </tr>
                            <tr>
                                <th>{{trans('tms::organization.note')}}</th>
                                <td>{{ $trainingOrganization->note ?? trans('labels.not_available') }}</td></td>
                            </tr>

                            </tbody>
                        </table>
                        <div class="form-actions">
                            <a href="{{ route('trainingOrganization.edit', $trainingOrganization->id) }}" class="btn btn-primary"><i class="ft-edit-2"></i> {{trans('labels.edit')}}</a>
                            <a class="btn btn-warning mr-1" role="button" href="{{route('organization.index')}}">
                                <i class="ft-x"></i> {{trans('labels.back_page')}}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
