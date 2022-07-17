@extends('hrm::layouts.master')

@section('title', trans('hrm::circular.title'))

@push('page-css')
@endpush

@section('content')
    <section id="card-footer-options">
        <div class="row">
            <div class="col-sm-8">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">
                            <h5 class="font-weight-800 mb-1">@lang('labels.title'):</h5>
                            {{ $circular->title }}
                        </h4>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body p-2">
                            <div class="card-text">
                                <h5 class="font-weight-800 mb-1">@lang('labels.description'):</h5>
                                {!! $circular->details  !!}
                            </div>
                            <div class="card-text">
                                @if(!empty($circular->attachment->id))
                                    <h5 class="font-weight-800 mb-1">@lang('labels.attachments'):</h5>
                                    <a href="{{ route('circularAttachment.download', $circular->attachment->id) }}">{!! $circular->attachment->file_name  !!}</a>
                                @endif
                            </div>
                            <div class="card-footer text-muted mt-2 pl-0">
                                <span>@lang('hrm::circular.expiry_date') {{ $circular->expiry_date }}</span>
                                <span class="float-none"></span>
                            </div>
                            <div>
                                <table class="table">
                                    <tr>
                                        <td class="pl-0">@lang('hrm::circular.sender')</td>
                                        <td>{{ $circular->initiators->getName() }}</td>
                                    </tr>
                                    <tr>
                                        <td class="pl-0">@lang('labels.designation')</td>
                                        <td>{{ $circular->initiators->designation->name }}</td>
                                    </tr>
                                    <tr>
                                        <td class="pl-0">@lang('hrm::circular.department')</td>
                                        <td>{{ $circular->initiators->employeeDepartment->name }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </section>


@endsection

@push('page-js')
@endpush