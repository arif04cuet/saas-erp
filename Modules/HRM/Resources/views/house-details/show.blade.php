@extends('hrm::layouts.master')
@section('title', trans('hrm::house-details.title'))

@section('content')
<section id="role-list">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">@lang('hrm::house-details.house_details')</h4>
                    <a class="heading-elements-toggle" href=""><i class="la la-ellipsis-v font-medium-3"></i></a>
                    <div class="heading-elements" style="top: 5px;">
                        <ul class="list-inline mb-1">
                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                        </ul>
                    </div>

                </div>
                <div class="card-content show">
                    <div class="card-body">
                        <div class="col-md-8">
                            <table class="table">
                                <tr>
                                    <th>@lang('hrm::house-details.house_id')</th>
                                    <td>{{ $house->house_id }}</td>
                                </tr>
                                <tr>
                                    <th>@lang('hrm::house-details.house_type')</th>
                                    <td>{{ $house->category->name }}</td>
                                </tr>
                                <tr>
                                    <th>@lang('hrm::house-details.location')</th>
                                    <td>{{ $house->location }}</td>
                                </tr>
                                <tr>
                                    <th>@lang('hrm::house-details.capacity')</th>
                                    <td>{{ $house->capacity }}</td>
                                </tr>
                                <tr>
                                    <th>@lang('hrm::house-details.allocated_to')</th>
                                    <td>{{ $house->employee ? $house->employee->getName() : '' }}</td>
                                </tr>
                                <tr>
                                    <th>@lang('labels.remarks')</th>
                                    <td>{{ $house->remark }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <div class="col-md-12">
                        <a href="{{route('house-details.index')}}" class="btn btn-danger">
                            <i class="la la-backward"></i> @lang('labels.back_page')
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection