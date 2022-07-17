@extends('cafeteria::layouts.master')
@section('title', trans('cafeteria::venue.lists'))


@section('content')
<section id="role-list">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{ trans('cafeteria::venue.title') }}</h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                    <div class="heading-elements">
                        <a href="{{route('venues.create')}}" class="btn btn-primary btn-sm"><i
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
                                        <th>{{trans('cafeteria::venue.name_en')}}</th>
                                        <th>{{trans('cafeteria::venue.name_bn')}}</th>
                                        <th>{{trans('cafeteria::venue.location')}}</th>
                                        <th>{{trans('cafeteria::venue.priority_level')}}</th>
                                        <th>{{trans('cafeteria::venue.description')}}</th>
                                        <th>{{trans('labels.action')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($venues as $venue)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>
                                            {{ $venue->name_en }}
                                        </td>
                                        <td>
                                            {{ $venue->name_bn }}
                                        </td>
                                        <td>
                                            {{ $venue->location }}
                                        </td>
                                        <td>
                                            {{ $venue->priority_level }}
                                        </td>
                                        <td>
                                            {{ $venue->description }}
                                        </td>
                                        <td>
                                            <a href="{{ route('venues.edit', $venue->id) }}"
                                                class="btn btn-primary btn-sm">
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