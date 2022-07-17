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
                            <a href="{{ route('research-paper-free-requests.create') }}" class="btn btn-primary btn-sm"><i
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
                                            <th>{{ trans('publication::research-paper-free-request.reference_type') }}
                                            </th>
                                            <th>{{ trans('publication::research-paper-free-request.emp_org_name') }}</th>
                                            <th>{{ trans('publication::research-paper-free-request.amount') }}</th>
                                            <th>{{ trans('labels.action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($researchPaperRequests as $researchPaperRequest)
                                            <tr>
                                                <th scope="row">{{ $loop->iteration }}</th>
                                                <td>
                                                    {{ $researchPaperRequest->publication->publicationRequest->research->title }}
                                                </td>
                                                <td>
                                                    @if ($researchPaperRequest->reference_type == 'employee')
                                                        {{ trans('publication::research-paper-free-request.employee') }}
                                                    @else
                                                        {{ trans('publication::research-paper-free-request.organization') }}
                                                    @endif
                                                </td>
                                                <td>

                                                    @if ($researchPaperRequest->reference_type == 'employee')
                                                        {{ $researchPaperRequest->employee->getName() }}
                                                    @else
                                                        {{ $researchPaperRequest->organization->name_bn }}
                                                    @endif
                                                </td>
                                                <td>
                                                    {{ $researchPaperRequest->quantity }}
                                                </td>
                                                <td>
                                                    <a href="{{ route('research-paper-free-requests.show', $researchPaperRequest->id) }}"
                                                        class="btn btn-primary btn-sm">
                                                        <i class="la la-eye"></i>
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
