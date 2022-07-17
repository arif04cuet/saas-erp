@extends('publication::layouts.master')
@section('title', trans('publication::research-paper-free-request.title'))


@section('content')
    <section id="role-list">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">@lang('publication::research-paper-free-request.title') @lang('labels.show')
                        </h4>
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
                                        <th>@lang('publication::publication.title')</th>
                                        <td>{{ $itemDetails->publication->publicationRequest->research->title }}</td>
                                    </tr>
                                    <tr>
                                        <th>{{ trans('publication::research-paper-free-request.reference_type') }}</th>
                                        <td>
                                            @if ($itemDetails->reference_type == 'employee')
                                                {{ trans('publication::research-paper-free-request.employee') }}
                                            @else
                                                {{ trans('publication::research-paper-free-request.organization') }}
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>{{ trans('publication::research-paper-free-request.emp_org_name') }}</th>
                                        <td>

                                            @if ($itemDetails->reference_type == 'employee')
                                                {{ $itemDetails->employee->getName() }}
                                            @else
                                                {{ $itemDetails->organization->name_bn }}
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>{{ trans('publication::research-paper-free-request.application_type') }}</th>
                                        <td>
                                            @if ($itemDetails->application_type == 'manual')
                                                <p>{{ trans('publication::research-paper-free-request.manual') }}</p>
                                            @else
                                                <p>{{ trans('publication::research-paper-free-request.application') }}</p>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>{{ trans('publication::research-paper-free-request.requester_id') }}</th>
                                        <td>

                                            @if ($itemDetails->requester_id == '')
                                                <p>{{ trans('publication::research-paper-free-request.not_found') }}</p>
                                            @else
                                                {{ $itemDetails->employee->getName() }}
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            <p>{{ trans('publication::research-paper-free-request.status') }}</p>
                                        </th>
                                        <td>
                                            @if ($itemDetails->status == 'approved')
                                                <span class="badge badge-success">
                                                    {{ trans('publication::research-paper-free-request.approved') }}
                                                </span>
                                            @elseif($itemDetails->status == 'pending')
                                                <span class="badge badge-secondary">
                                                    {{ trans('publication::research-paper-free-request.pending') }}
                                                </span>
                                            @else
                                                <span class="badge badge-warning">
                                                    {{ trans('publication::research-paper-free-request.rejected') }}
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>{{ trans('publication::research-paper-free-request.amount') }}</th>
                                        <td>{{ $itemDetails->quantity }}</td>
                                    </tr>
                                    <tr>
                                        <th>{{ trans('publication::research-paper-free-request.remark') }}</th>
                                        <td>
                                            {{ $itemDetails->remark }}
                                            @if ($itemDetails->remark == '')
                                                <p>{{ trans('publication::research-paper-free-request.not_found') }}</p>
                                            @endif
                                        </td>

                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <div class="col-md-12">
                            @if (auth()->user()->hasAnyRole('ROLE_PUBLICATION_SECTION_OFFICER') &&
        $itemDetails->status == 'pending')
                                <a href="{{ route('publication.accept-employee-paper-requests', $itemDetails->id) }}"
                                    class="btn btn-success mr-1"
                                    onclick="return confirm('{{ trans('publication::research-paper-free-request.warning') }}')">
                                    {{ trans('publication::research-paper-free-request.approve') }}
                                </a>
                            @endif
                            <a href="{{ url()->previous() }}" class="btn btn-danger">
                                <i class="la la-backward"></i> @lang('labels.back_page')
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
