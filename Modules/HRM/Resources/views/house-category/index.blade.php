@extends('hrm::layouts.master')
@section('title', trans('hrm::house-details.category.list'))

@section('content')
<section id="role-list">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{ trans('hrm::house-details.category.list') }}</h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                    <div class="heading-elements">
                        <a href="{{route('house-categories.create')}}" class="btn btn-primary btn-sm"><i
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
                                        <th>{{trans('hrm::house-details.category.title')}}</th>
                                        <th>{{trans('hrm::house-details.category.eligible_from')}}</th>
                                        <th>{{trans('hrm::house-details.category.eligible_to')}}</th>
                                        <th>{{trans('labels.remarks')}}</th>
                                        <th>{{trans('labels.action')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($categories as $category)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>
                                            {{ $category->name }}
                                        </td>
                                        <td>
                                            {{ $category->eligible_from }}
                                        </td>
                                        <td>
                                            {{ $category->eligible_to }}
                                        </td>
                                        <td>
                                            {{ $category->remark }}
                                        </td>
                                        <td>
                                            <a href="{{ route('house-categories.edit', $category->id) }}"
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