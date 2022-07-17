@extends('hrm::layouts.master')
@section('title', trans('hrm::contact.type.list'))

@section('content')
<section id="role-list">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{ trans('hrm::contact.type.list') }}</h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                    <div class="heading-elements">
                        <a href="{{route('contact-types.create')}}" class="btn btn-primary btn-sm"><i
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
                                        <th>{{trans('labels.remarks')}}</th>
                                        <th>{{trans('labels.action')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($types as $type)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>
                                            {{ $type->name }}
                                        </td>
                                        <td>
                                            {{ $type->remark }}
                                        </td>
                                        <td>
                                            <a href="{{ route('contact-types.edit', $type->id) }}"
                                                class="btn btn-primary btn-sm" title="{{trans('labels.edit')}}">
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