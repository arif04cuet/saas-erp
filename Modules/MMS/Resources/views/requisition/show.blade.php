@extends('mms::layouts.master')
@section('title', trans('mms::requisition.site_title'))
@section('content')
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">@lang('mms::requisition.medicine')</h4>
            <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
            <div class="heading-elements" style="top: 5px;">
                <ul class="list-inline mb-1">
                    <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                    <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                </ul>
            </div>
            <div class="heading-elements mt-2" style="margin-right: 10px;">
                <a href="{{ route('requisition.index') }}" class="btn btn-primary btn-sm">
                    <i class="ft-list white"> @lang('mms::requisition.requisition_list')</i>
                </a>
            </div>
        </div>
        <div class="card-content ">
            <div class="card-body">
                <h4 class="form-section"><i class="la la-tag"></i> @lang('mms::requisition.requisition') @lang('labels.details')</h4>
                <div class="row">
                    <div class="col-12 col-md-5">
                        <table class="table">
                            <tr>
                                <th>@lang('mms::requisition.requisition_id')</th>
                                <td>{{$medicinelist['requisition']->requisition_id}}</td>

                            </tr>

                            <tr>
                                <th>@lang('mms::requisition.date')</th>
                                <td>{{ date('d-m-Y', strtotime($medicinelist['requisition']->date)) }}</td>
                            </tr>

                        </table>
                    </div>
                    <div class="col-12 col-md-7">
                        <table class="table mt-3 mt-md-0">
                            <tr>
                                <th>{{trans('mms::requisition.medicine')}}</th>
                                <th>{{trans('mms::requisition.piece')}}</th>
                            </tr>
                            @foreach($medicinelist['requisitionDetails'] as $info)
                            <tr>
                                <td>{{$info->medicine->name}}</td>
                                <td>{{$info->quantity}}</td>
                            </tr>
                            @endforeach

                        </table>

                    </div>




                </div>


            </div>
        </div>
    </div>
@endsection

@push('page-js')

@endpush
