@extends('hrm::layouts.master')
@section('title', trans('labels.details'))


@section('content')
    {{--{{ dd($employee) }}--}}
    <div class="card">
        <div class="card-header">
            <h4 class="card-title" id="basic-layout-form">@lang('labels.details')</h4>
            <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
            <div class="heading-elements">
                <ul class="list-inline mb-0">
                    <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                    <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                    <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                    {{--<li><a data-action="close"><i class="ft-x"></i></a></li>--}}
                </ul>
            </div>
        </div>
        <div class="card-content collapse show" style="">
            <div class="card-body">
                <div class="tab-content ">
                    <div class="tab-pane active show" role="tabpanel" id="general" aria-labelledby="general-tab"
                         aria-expanded="true">
                        <table class="table ">
                            <tbody>
                            <tr>
                                <th class="">@lang('hrm::employee.applicant_name')</th>
                                <td>{{$cv['applicant_name']}}</td>
                            </tr>
                            <tr>
                                <th class="">@lang('hrm::employee.post_title')</th>
                                <td>{{$cv['applied_for']}}</td>
                            </tr>
                            <tr>
                                <th class="">@lang('hrm::employee.year_of_experience')</th>
                                <td>{{$cv['year_of_experience']}}</td>
                            </tr>
                            <tr>
                                <th class="">@lang('hrm::employee.apply_date')</th>
                                <td>{{$cv['apply_date']}}</td>
                            </tr>
                            <tr>
                                <th class="">@lang('labels.remarks')</th>
                                <td></td>
                            </tr>
                            <tr>
                                <th class="">@lang('hrm::employee.cv')</th>
                                <td>
                                    <object data="{{asset('/files/pdf-sample.pdf')}}" width="600" height="800"></object>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="card-footer">
                <form method="post" action="{{route('cv.update', 1)}}">
                    @csrf
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="marks" class="label">@lang('hrm::employee.marks')</label>
                            <input type="number" id="marks" name="marks" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="comment" class="label">@lang('hrm::employee.comment')</label>
                            <textarea id="comment" name="comment" class="form-control"></textarea>
                        </div>
                        {{--<a href="{{url('/hrm/employee/')}}"--}}
                        <button class="btn btn-small btn-success" type="submit" name="submit">@lang('hrm::employee.submit_marks') </button>
                        <a class="btn btn-small btn-danger" href="{{ route('cv.list') }}">@lang('labels.back_page') </a>
                        {{--<a class="btn btn-small btn-info" href="{{ route('photocopy-management.list') }}">@lang('labels.edit') </a>--}}
                    </div>
                </form>
            </div>
        </div>

        <div class="card-content collapse show">
            <div class="card-body">
            </div>
        </div>

    </div>

@endsection
