@extends('publication::layouts.master')
@section('title', trans('publication::publication-request.index'))


@section('content')
<section id="role-list">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{ trans('publication::publication-request.index') }}</h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                </div>

                <div class="card-content collapse show">
                    <div class="card-body card-dashboard">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered alt-pagination" id="Example1">
                                <thead>
                                    <tr>
                                        <th>{{trans('labels.serial')}}</th>
                                        <th>{{trans('labels.title')}}</th>
                                        <th>{{trans('publication::publication-request.researcher')}}</th>
                                        <th>{{trans('publication::publication-request.request_date')}}</th>
                                        <th>{{trans('labels.status')}}</th>
                                        <th>{{trans('labels.action')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $labelColors = ['draft' => 'primary', 'on_press' => 'success', 'back_to_researcher' => 'warning', 'completed' => 'danger']
                                    @endphp
                                    @foreach($requests as $request)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>
                                            {{ $request->research->title }}
                                        </td>
                                        <td>
                                            {{ $request->research->researchSubmittedByUser->name }}
                                        </td>
                                        <td>{{ date('d/m/Y,  h:iA', strtotime($request->created_at)) }}</td>
                                        <td>
                                            <span class="badge badge-{{$labelColors[strtolower($request->status)]}}">@lang('publication::publication-request.status.' .strtolower($request->status))</span>
                                        </td>
                                         <td>
                                             <a href="{{route('publication.publication-requests.show', $request->id) }}"
                                                class="btn btn-primary btn-sm"><i class="ft-eye"></i>&nbsp;@lang('labels.details')</a>
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
