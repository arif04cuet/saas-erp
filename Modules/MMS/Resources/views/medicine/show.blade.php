@extends('mms::layouts.master')
@section('title', trans('mms::medicine.title'))

@section('content')
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">@lang('mms::medicine.medicine_info')</h4>
            <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
            <div class="heading-elements" style="top: 5px;">
                <ul class="list-inline mb-1">
                    <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                    <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                </ul>
            </div>
        </div>
        <div class="card-content ">
            <div class="card-body">
                <h4 class="form-section"><i class="la la-tag"></i> @lang('labels.details')</h4>
                <div class="row">
                    <div class="col-12 col-md-8">
                        <table class="table">
                            <tr>
                                <th>@lang('mms::medicine.name')</th>
                                <td>{{ $medicine->name }}</td>
                            </tr>
                            <tr>
                                <th>@lang('mms::medicine.group')</th>
                                <td>{{ $medicine->group->name }}</td>
                            </tr>
                            <tr>
                                <th>@lang('mms::medicine.company')</th>
                                <td>{{ $medicine->company_name }}</td>
                            </tr>
                            <tr>
                                <th>@lang('mms::patient.reg_date')</th>
                                <td>{{ date('d-m-Y', strtotime($medicine->created_at)) }}</td>
                            </tr>
                            <tr>
                                <th>@lang('mms::medicine.category_name')</th>
                                <td>{{ !empty($medicine->category->name)?$medicine->category->name:'NA' }}</td>
                            </tr>

                        </table>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="col-md-12">
                    <a href="{{route('medicine.index')}}" class="btn btn-danger">
                        <i class="la la-backward"></i> @lang('labels.back_page')
                    </a>
                </div>
            </div>
        </div>
    </div>

@endsection


@push('page-js')
@endpush
