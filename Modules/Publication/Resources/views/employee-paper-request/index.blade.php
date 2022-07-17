@extends('publication::layouts.master')
@section('title', trans('publication::research-paper-free-request.index'))


@section('content')
    <section id="role-list">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{ trans('publication::research-paper-free-request.index') }}</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                        <div class="heading-elements">
                            <a href="{{ route('employee-paper-requests.create') }}" class="btn btn-primary btn-sm"><i
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
                                            <th>{{ trans('labels.serial') }}</th>
                                            <th>{{ trans('publication::publication.title') }}</th>
                                            <th>{{ trans('publication::research-paper-free-request.employee_name') }}</th>
                                            <th>{{ trans('publication::research-paper-free-request.status') }}</th>
                                            <th>{{ trans('publication::research-paper-free-request.amount') }}</th>
                                            <th>{{ trans('labels.action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($researchPaperRequests as $researchPaperRequest)
                                            @if (auth()->user()->hasAnyRole('ROLE_PUBLICATION_SECTION_OFFICER') ||
        $researchPaperRequest->requester_id == auth()->user()->id)
                                                <tr>
                                                    <th scope="row">{{ $loop->iteration }}</th>
                                                    <td>
                                                        {{ $researchPaperRequest->publication->publicationRequest->research->title }}
                                                    </td>
                                                    <td>
                                                        {{ $researchPaperRequest->employee->getName() }}
                                                    </td>
                                                    <td>
                                                        @if ($researchPaperRequest->status == 'approved')
                                                            <span class="badge badge-success">
                                                                {{ trans('publication::research-paper-free-request.approved') }}
                                                            </span>
                                                        @elseif($researchPaperRequest->status == 'pending')
                                                            <span class="badge badge-secondary">
                                                                {{ trans('publication::research-paper-free-request.pending') }}
                                                            </span>
                                                        @else
                                                            <span class="badge badge-warning">
                                                                {{ trans('publication::research-paper-free-request.rejected') }}
                                                            </span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        {{ $researchPaperRequest->quantity }}
                                                    </td>
                                                    <td>
                                                        @if ($researchPaperRequest->status != 'approved' && $researchPaperRequest->requester_id == auth()->user()->id)
                                                            <a href="{{ route('employee-paper-requests.edit', $researchPaperRequest->id) }}"
                                                                class="btn btn-primary btn-sm">
                                                                <i class="la la-pencil-square"></i>
                                                            </a>
                                                        @endif

                                                        @if (auth()->user()->hasAnyRole('ROLE_PUBLICATION_SECTION_OFFICER'))
                                                            <a href="{{ route('research-paper-free-requests.show', $researchPaperRequest->id) }}"
                                                                class="btn btn-primary btn-sm">
                                                                <i class="la la-eye"></i>
                                                            </a>
                                                        @endif

                                                        @if (auth()->user()->hasAnyRole('ROLE_PUBLICATION_SECTION_OFFICER') &&
        $researchPaperRequest->status != 'approved')
                                                            <a href="{{ route('publication.accept-employee-paper-requests', $researchPaperRequest->id) }}"
                                                                class="btn btn-success btn-sm"
                                                                title="{{ trans('labels.approve') }}"
                                                                onclick="return confirm('{{ trans('publication::research-paper-free-request.warning') }}')">
                                                                <i class="la la-check-circle"></i>

                                                            </a>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endif
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
