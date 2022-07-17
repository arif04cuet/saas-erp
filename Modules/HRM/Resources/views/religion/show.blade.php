@extends('hrm::layouts.master')
@section('title', trans('hrm::employee.religion.page.show.title'))

@section('content')
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">
                @lang('hrm::employee.religion.page.show.title')
            </h4>
            <a href="" class="heading-elements-toggle">
                <i class="la la-ellipsis-v font-medium-3"></i>
            </a>
            <div class="heading-elements">
                <ul class="list-inline mb-0">
                    <li>
                        <a href="{{ route('employees.religions.index') }}" class="btn btn-primary btn-sm">
                            <i class="ft-list white"></i>
                            @lang('labels.list')
                        </a>
                    </li>
                    <li><a href="" data-action="collapse"><i class="ft-minus"></i></a></li>
                    <li><a href="" data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                    <li><a href="" data-action="expand"><i class="ft-maximize"></i></a></li>
                </ul>
            </div>
        </div>
        <div class="card-content collapse show">
            <div class="card-body">
                <table class="table">
                    <tbody>
                    <tr>
                        <th>@lang('hrm::employee.religion.form.labels.bengali_title')</th>
                        <td>{{ $religion->bengali_title }}</td>
                    </tr>
                    <tr>
                        <th>@lang('hrm::employee.religion.form.labels.english_title')</th>
                        <td>{{ $religion->english_title }}</td>
                    </tr>
                    <tr>
                        <th>@lang('hrm::employee.religion.form.labels.description')</th>
                        <td>{{ $religion->description }}</td>
                    </tr>
                    </tbody>
                </table>
                <a class="btn btn-small btn-info" href="{{ route('employees.religions.edit', ['religion' => $religion->id]) }}">@lang('labels.edit')</a>
                <a class="btn btn-small btn-danger"
                   href="{{ route('employees.religions.index') }}">@lang('labels.back_page')</a>
            </div>
        </div>
    </div>
@endsection
