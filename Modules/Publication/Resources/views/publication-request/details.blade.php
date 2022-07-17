@extends('publication::layouts.master')
@section('title', trans('rms::research_proposal.research_details'))

@section('content')

    <section>
        <div class="row match-height">
            <div class="col-sm-12 col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{ trans('rms::research_proposal.research_details') }}</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                                <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            {!! Form::open(['route' => ['publication.publication-requests.update', $details->id], 'class' => 'form']) !!}
                            @method('PUT')
                            <div class="card-text">
                                <dl class="row">
                                    <dt class="col-sm-3">@lang('labels.title')</dt>
                                    <dd class="col-sm-9">{{ $details->research->title }}</dd>
                                </dl>
                                <dl class="row">
                                    <dt class="col-sm-3">@lang('rms::research_proposal.submitted_by')</dt>
                                    <dd class="col-sm-9">{{ $details->research->researchSubmittedByUser->name }}</dd>
                                </dl>
                                <dl class="row">
                                    <dt class="col-sm-3">@lang('rms::research_proposal.submission_date')</dt>
                                    <dd class="col-sm-9">{{ date('d/m/Y,  h:mA', strtotime($details->created_at)) }}</dd>
                                </dl>
                                <dl class="row">
                                    <dt class="col-sm-3">@lang('labels.status')</dt>
                                    <dd class="col-sm-9"> <span
                                            class="badge badge-primary">@lang('publication::publication-request.status.'
                                            .strtolower($details->status))</span></dd>
                                </dl>
                                <hr>

                                <h4 class="card-title">{{ trans('rms::research.research_publication_info') }}</h4>
                                @if (is_null($details->research->publication))
                                    <dl class="row">
                                        <dt class="col-sm-3"></dt>
                                        <dd class="col-sm-9">{{ trans('labels.empty_table') }}</dd>
                                    </dl>
                                @else
                                    <dl class="row">
                                        <dt class="col-sm-3">@lang('rms::research.research_publication_short_desc')</dt>
                                        <dd class="col-sm-9">{{ $details->research->title }}</dd>
                                    </dl>
                                    <dl class="row">
                                        <dt class="col-sm-3">@lang('rms::research.research_publication_attachment')</dt>
                                        <dd class="col-sm-9">
                                            @if (is_null($details->research->publication->attachments))
                                                {{ trans('labels.no_doc_available') }}
                                            @else
                                                <ul class="list-inline">
                                                    @foreach ($details->research->publication->attachments as $attachment)
                                                        <li class="list-group-item">
                                                            <a href="{{ route('file.download', ['filePath' => $attachment->path, 'displayName' => $details->research->title . '-publication.' . $attachment->ext]) }}"
                                                                class="badge bg-info white"
                                                                style="overflow: hidden; max-width: 80px;"
                                                                title="{{ $attachment->name }}">
                                                                {{ $attachment->name }}</a><br><label
                                                                class="label"><strong>{{ $attachment->ext }}</strong>
                                                                file</label>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                        </dd>
                                    </dl>
                                @endif
                                @if ($details->remark)
                                    <dl class="row">
                                        <dt class="col-sm-3">@lang('labels.remarks')</dt>
                                        <dd class="col-sm-9">{{ $details->remark }}</dd>
                                    </dl>
                                @endif
                                @if ($details->researcher_remark)
                                    <dl class="row">
                                        <dt class="col-sm-3">@lang('publication::publication-request.researcher_remark')
                                        </dt>
                                        <dd class="col-sm-9">{{ $details->researcher_remark }}</dd>
                                    </dl>
                                @endif
                            </div>

                            @if ($details->research->submitted_by == auth()->user()->id && $details->status == 'send_back')
                                <dl class="row">
                                    <dt class="col-sm-3">@lang('labels.remarks')</dt>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            {!! Form::label('remark', trans('labels.remarks'), ['class' => 'form-label']) !!}
                                            {!! Form::textarea('researcher_remark', $details->researcher_remark, ['class' => 'form-control required', 'placeholder' => trans('labels.remarks'), 'rows' => 2]) !!}
                                            <div class="help-block"></div>
                                            @if ($errors->has('researcher_remark'))
                                                <span
                                                    class="invalid-feedback">{{ $errors->first('researcher_remark') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </dl>
                                <button type="submit" class="btn btn-success" name="status"
                                    value="pending">{{ trans('labels.submit') }}</button>
                            @endif

                            @if (auth()->user()->hasAnyRole('ROLE_PUBLICATION_COMMITTEE') &&
        $details->status == 'pending')
                                <dl class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            {!! Form::label('remark', trans('labels.remarks'), ['class' => 'form-label']) !!}
                                            {!! Form::textarea('remark', $details->remark, ['class' => 'form-control required', 'placeholder' => trans('labels.remarks'), 'rows' => 2]) !!}
                                            <div class="help-block"></div>
                                            @if ($errors->has('remark'))
                                                <span class="invalid-feedback">{{ $errors->first('remark') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </dl>
                                <button type="submit" class="btn btn-success" name="status"
                                    value="approved">{{ trans('labels.approve') }}</button>
                                <button type="submit" class="btn btn-info" name="status"
                                    value="send_back">{{ trans('publication::publication-request.send_back') }}</button>
                                <button type="submit" class="btn btn-danger" name="status"
                                    value="rejected">{{ trans('labels.reject') }}</button>
                            @endif

                            @if (auth()->user()->hasAnyRole('ROLE_PUBLICATION_SECTION_OFFICER') &&
        $details->status == 'approved')
                                <a href="{{ route('publication.published-research-papers.send_to_press', $details->id) }}"
                                    class="btn btn-success">{{ trans('publication::published-research-paper.send_to_press') }}</a>
                            @endif
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
