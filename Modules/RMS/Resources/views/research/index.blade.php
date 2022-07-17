@extends('rms::layouts.master')
@section('title', trans('rms::research_proposal.research_list'))

@section('content')
    <section id="role-list">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{ trans('rms::research_proposal.research_list') }}</h4>
                        <div class="heading-elements">
                            <a href="{{route('research.create')}}" class="btn btn-primary btn-sm"><i
                                        class="ft-plus white"></i> {{ trans('rms::research_proposal.create_research') }}</a>

                        </div>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body card-dashboard">

                            <div class="table-responsive">
                                <table class="table table-striped table-bordered alt-pagination">
                                    <thead>
                                    <tr>
                                        <th scope="col">{{ trans('labels.serial')}}</th>
                                        <th scope="col">{{ trans('labels.title') }}</th>
                                        <th scope="col">{{ trans('rms::research_proposal.submitted_by') }}</th>
                                        <th scope="col">{{trans('rms::research_proposal.submission_date')}}</th>
                                        <th scope="col">{{trans('labels.status') }}</th>
                                        <th scope="col">{{trans('labels.action') }}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php
                                    $labelColors = ['pending' => 'primary', 'approved' => 'success', 'rejected' => 'warning', 'closed' => 'danger', 'reinitiated' => 'info']
                                    @endphp
                                    @foreach($researches as $research)
                                        <tr>
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            <td><a href="{{ route('research.show', $research->id) }}">{{ $research->title }}</a></td>
                                            <td>{{ $research->researchSubmittedByUser->name }}</td>
                                            <td>{{ date('d/m/Y,  h:iA', strtotime($research->created_at)) }}</td>

                                            <td>
                                                <span class="badge  badge-{{$labelColors[strtolower($research->status)]}}">@lang('rms::research_proposal.' .strtolower($research->status))</span></td>

                                            <td>
                                                <span class="dropdown">
                                                <button id="btnSearchDrop2" type="button" data-toggle="dropdown"
                                                        aria-haspopup="true" aria-expanded="false" class="btn btn-info dropdown-toggle">
                                                    <i class="la la-cog"></i>
                                                </button>
                                                <span aria-labelledby="btnSearchDrop2" class="dropdown-menu mt-1 dropdown-menu-right">
                                                    @if($research->publicationRequest)
                                                        <button class="dropdown-item" disabled><i class="ft-eye"></i>@lang('rms::research_proposal.already_requested')</button>
                                                        {!! Form::close() !!}
                                                    @else
                                                     @if(Auth::user()->hasAnyRole('ROLE_RESEARCH_DIRECTOR') && $research->status == "APPROVED")
                                                        {!! Form::open(['method'=>'post', 'url' => route('research.send_research_for_publish', $research->id),
                                                              'style' => 'display:inline' ]) !!}
                                                        @method('post')
                                                            <button class="dropdown-item" type="submit" onclick="return confirm('Are you sure?')"><i class="ft-eye"></i>@lang('rms::research_proposal.request_for_publish')</button>
                                                        {!! Form::close() !!}
                                                     @endif
                                                    @endif
                                                    <a href="{{route('research.show', $research->id) }}"
                                                       class="dropdown-item"><i class="ft-eye"></i>@lang('labels.details')</a>
                                                    <a href="{{route('research-budget.index', $research->id) }}"
                                                       class="dropdown-item"><i class="ft-folder"></i>@lang('rms::research_budget.title') @lang('labels.details')</a>
                                                </span>
                                            </span>
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
