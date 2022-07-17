@extends('publication::layouts.master')
@section('title', trans('publication::publication.title'))

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    @if ((auth()->user()->hasAnyRole('ROLE_PUBLICATION_COMMITTEE') ||
            auth()->user()->hasAnyRole('ROLE_PUBLICATION_SECTION_OFFICER')) &&
        count($publicationRequests))
                        <h4>@lang('publication::publication.publication_pending_item')</h4>
                        <table id="publicationRequest" class="table table-hover table-striped table-bordered">
                            <thead>
                                <th>@lang('labels.message')</th>
                                <th>@lang('labels.details')</th>
                                <th>@lang('labels.action')</th>
                            </thead>
                            <tbody>
                                @foreach ($publicationRequests as $publicationRequest)
                                    <tr>
                                        <td>{{ $publicationRequest->remark }}</td>
                                        <td>
                                            Research Title : {{ $publicationRequest->research->title }}<br />
                                            Initiator Name:
                                            {{ $publicationRequest->research->researchSubmittedByUser->name }}
                                        </td>
                                        <td> <a class="btn btn-primary btn-sm"
                                                href="{{ route('publication.publication-requests.show', $publicationRequest->id) }}">@lang('labels.details')</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif

                    @if (auth()->user()->hasAnyRole('ROLE_PUBLICATION_SECTION_OFFICER') &&
        count($researchPaperRequests))
                        <h4>@lang('publication::publication.research_paper_request')</h4>
                        <table id="paperRequest" class="table table-hover table-striped table-bordered">
                            <thead>
                                <th>@lang('labels.message')</th>
                                <th>@lang('labels.details')</th>
                                <th>@lang('labels.action')</th>
                            </thead>
                            <tbody>
                                @foreach ($researchPaperRequests as $researchPaperRequest)
                                    <tr>
                                        <td>{{ $researchPaperRequest->remark }}</td>
                                        <td>
                                            Research Title :
                                            {{ $researchPaperRequest->publication->publicationRequest->research->title }}<br />
                                            Requested By:
                                            {{ $researchPaperRequest->employee->getName() }}
                                        </td>
                                        <td> <a class="btn btn-primary btn-sm"
                                                href="{{ route('research-paper-free-requests.show', $researchPaperRequest->id) }}">@lang('labels.details')</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif


                    @if (count($publicationsOnPress))
                        <h4>@lang('publication::publication.proof_request')</h4>
                        <table id="forPressUser" class="table table-hover table-striped table-bordered">
                            <thead>

                                <th>@lang('labels.message')</th>
                                <th>@lang('labels.details')</th>
                                <th>@lang('labels.action')</th>
                            </thead>
                            <tbody>
                                @foreach ($publicationsOnPress as $publicatiosOnPress)
                                    <tr>
                                        @if (auth()->user()->id == $publicatiosOnPress->publicationPress->employee->id)
                                            <td>{{ $publicatiosOnPress->remark }}</td>
                                            <td>
                                                Research Title :
                                                {{ $publicatiosOnPress->publicationRequest->research->title }}<br />
                                                Initiator Name:
                                                {{ $publicatiosOnPress->publicationRequest->research->researchSubmittedByUser->name }}
                                            </td>
                                            <td> <a class="btn btn-primary btn-sm"
                                                    href="{{ route('publication.published-research-papers.show', $publicatiosOnPress->id) }}">@lang('labels.details')</a>
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif

                    @if (count($publicationsOnResearcher))
                        <h4>@lang('publication::publication.proof_request')</h4>
                        <table id="forResearcher" class="table table-hover table-striped table-bordered">
                            <thead>

                                <th>@lang('labels.message')</th>
                                <th>@lang('labels.details')</th>
                                <th>@lang('labels.action')</th>
                            </thead>
                            <tbody>
                                @foreach ($publicationsOnResearcher as $publicationOnResearcher)
                                    <tr>
                                        @if (auth()->user()->id == $publicationOnResearcher->publicationRequest->research->submitted_by)
                                            <td>{{ $publicationOnResearcher->remark }}</td>
                                            <td>
                                                Research Title :
                                                {{ $publicationOnResearcher->publicationRequest->research->title }}<br />
                                                Initiator Name:
                                                {{ $publicationOnResearcher->publicationRequest->research->researchSubmittedByUser->name }}
                                            </td>
                                            <td> <a class="btn btn-primary btn-sm"
                                                    href="{{ route('publication.published-research-papers.show', $publicationOnResearcher->id) }}">@lang('labels.details')</a>
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif

                </div>
            </div>
        </div>
    </div>
@endsection
@push('page-css')

    <style>
        .f-o {
            margin-top: -10px;
        }

    </style>
@endpush

@push('page-js')
    <script>
        let dataTableConfig = {
            "columnDefs": [{
                "orderable": false,
                "targets": 5
            }],
            "language": {
                "search": "{{ trans('labels.search') }}",
                "zeroRecords": "{{ trans('labels.No_matching_records_found') }}",
                "lengthMenu": "{{ trans('labels.show') }} _MENU_ {{ trans('labels.records') }}",
                "info": "{{ trans('labels.showing') }} _START_ {{ trans('labels.to') }} _END_ {{ trans('labels.of') }} _TOTAL_ {{ trans('labels.records') }}",
                "infoFiltered": "( {{ trans('labels.total') }} _MAX_ {{ trans('labels.infoFiltered') }} )",
                "paginate": {
                    "first": "First",
                    "last": "Last",
                    "next": "{{ trans('labels.next') }}",
                    "previous": "{{ trans('labels.previous') }}"
                },
            },
        };

        let publicationRequest = $('#publicationRequest').DataTable(dataTableConfig);
        let paperRequest = $('#paperRequest').DataTable(dataTableConfig);
        let forPressUser = $('#forPressUser').DataTable(dataTableConfig);
        let forResearcher = $('#forResearcher').DataTable(dataTableConfig);
    </script>
@endpush
