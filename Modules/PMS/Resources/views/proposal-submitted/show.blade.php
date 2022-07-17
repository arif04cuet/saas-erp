@extends('pms::layouts.master')
@section('title', trans('pms::project_proposal.menu_title'))

@section('content')
    <section id="organization list">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">@lang('pms::project_proposal.organization_name_for_project')</h4>
                    </div>

                    <div class="card-content collapse show">
                        <div class="card-body card-dashboard">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered alt-pagination">
                                    <thead>
                                    <tr>

                                        <th scope="col">@lang('labels.serial')</th>
                                        <th scope="col">@lang('pms::project_proposal.organization_name')</th>
                                        <th scope="col">@lang('labels.email_address')</th>
                                        <th scope="col">@lang('labels.mobile')</th>
                                        <th scope="col">@lang('labels.address')</th>
                                        <th scope="col">@lang('labels.action')</th>
                                    </tr>
                                    </thead>
                                    <tbody>


                                    @if(count($proposal->organizations)>0)
                                        @foreach($proposal->organizations as $organization)
                                            <tr>
                                                <th scope="row">{{$loop->iteration}}</th>
                                                <td>{{ $organization->name }}</td>
                                                <td>{{ $organization->email }}</td>
                                                <td>{{ $organization->mobile }}</td>
                                                <td>{{ $organization->address }}</td>
                                                {{--<td>{{ $projectResearchOrganization->organization->email }}</td>--}}
                                                {{--<td>{{ $projectResearchOrganization->organization->mobile }}</td>--}}
                                                {{--<td>{{ $projectResearchOrganization->organization->address }}</td>--}}
                                                <td>


                                                <span class="dropdown">
                                                    <button id="btnSearchDrop2" type="button" data-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false" class="btn btn-info dropdown-toggle"><i class="la la-cog"></i></button>
                                                    <span aria-labelledby="btnSearchDrop2" class="dropdown-menu mt-1 dropdown-menu-right">
                                                        <a href="{{route('member.add-member', $organization->id)}}" class="dropdown-item"><i class="ft-plus"></i>@lang('pms::member.add_member')</a>
                                                    </span>
                                                </span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection