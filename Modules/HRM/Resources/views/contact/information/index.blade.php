@extends('hrm::layouts.master')
@section('title', trans('hrm::contact.list'))

@section('content')
<section id="role-list">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{ trans('hrm::contact.list') }}</h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                    <div class="heading-elements">
                        <a href="{{route('contacts.create')}}" class="btn btn-primary btn-sm"><i
                                class="ft-plus white"></i> {{ trans('labels.add') }}
                        </a>
                    </div>
                </div>

                <div class="card-content collapse show">
                    <div class="card-body card-dashboard">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered alt-pagination" id="Example1">
                                <thead>
                                    <tr>
                                        <th>{{trans('labels.serial')}}</th>
                                        <th>{{trans('labels.name')}}</th>
                                        <th>{{trans('hrm::contact.organaization')}}</th>
                                        <th>{{trans('hrm::contact.job_title')}}</th>
                                        <th>{{trans('hrm::contact.type.title')}}</th>
                                        <th>{{trans('hrm::contact.address')}}</th>
                                        <th>{{trans('hrm::contact.mobile_one')}}</th>
                                        <th>{{trans('hrm::contact.mobile_two')}}</th>
                                        <th>{{trans('hrm::contact.email')}}</th>
                                        <th>{{trans('hrm::contact.website')}}</th>
                                        <th>{{trans('labels.action')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($contacts as $contact)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>
                                            {{ $contact->first_name . ' ' . $contact->last_name }}
                                        </td>
                                        <td>
                                            {{ $contact->organaization }}
                                        </td>
                                        <td>
                                            {{ $contact->designation }}
                                        </td>
                                        <td>
                                            {{ $contact->contactType->name }}
                                        </td>
                                        <td>
                                            {{ $contact->address }}
                                        </td>
                                        <td>
                                            {{ $contact->mobile_one }}
                                        </td>
                                        <td>
                                            {{ $contact->mobile_two }}
                                        </td>
                                        <td>
                                            {{ $contact->email }}
                                        </td>
                                        <td>
                                            {{ $contact->website }}
                                        </td>
                                        <td>
                                            <a href="{{ route('contacts.edit', $contact->id) }}" class="btn btn-primary btn-sm" title="{{trans('labels.edit')}}">
                                                <i class="la la-pencil-square"></i>
                                            </a>
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
    </div>
</section>
@endsection