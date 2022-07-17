@if ($details->proof_status == 'final_proof_done' && $details->publicationPress->press_user_id == auth()->user()->employee->id && $details->status != config('publication.status.completed'))

    <div class="col-md-5">
        <h4 class="card-title">{{ trans('publication::published-research-paper.proof_request') }}</h4>
        {!! Form::open(['route' => ['publication.published-research-papers.proof_request', $details->id], 'class' => 'form review-request-form', 'method' => 'post', 'enctype' => 'multipart/form-data']) !!}
        @method('PUT')
        <div class="form-group">
            {{ Form::hidden('published_research_paper_id', $details->id) }}

            <label class="required">{{ trans('publication::published-research-paper.final_paper_copy') }}</label>
            {!! Form::file('attachments[]', ['class' => 'form-control required' . ($errors->has('attachments.*') ? ' is-invalid' : ''), 'data-msg-required' => Lang::get('labels.This field is required'), 'accept' => '.doc, .docx, .xlx, .xlsx, .csv, .pdf', 'multiple' => 'multiple']) !!}

            @if ($errors->has('attachments.*'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('attachments.*') }}</strong>
                </span>
            @endif
        </div>

        <!-- Save & Cancel Button -->
        <div class="form-actions">
            <button type="submit" class="btn btn-success">
                <i class="ft-check-square"></i>
                @lang('publication::published-research-paper.save_and_send')
            </button>
        </div>
        {!! Form::close() !!}
    </div>

@else
    @if ((array_key_exists($details->proof_status, $status_for_press) && $details->publicationPress->press_user_id == auth()->user()->employee->id && $details->status != config('publication.status.completed')) || (array_key_exists($details->proof_status, $status_for_researcher) && $details->publicationRequest->research->submitted_by == auth()->user()->id))

        <div class="col-md-5">
            <h4 class="card-title">{{ trans('publication::published-research-paper.proof_request') }}</h4>
            {!! Form::open(['route' => ['publication.published-research-papers.proof_request', $details->id], 'class' => 'form review-request-form', 'method' => 'post']) !!}

            @method('PUT')

            @if (array_key_exists($details->proof_status, $status_for_press) && $details->publicationPress->press_user_id == auth()->user()->employee->id)

                <!-- Last Date -->
                <div class="form-group">
                    <label class="required">{{ trans('publication::published-research-paper.last_sub_date') }}</label>
                    {{ Form::text('last_date', date('j F, Y'), ['id' => 'last_date', 'class' => 'form-control required', 'placeholder' => 'Pick last date', 'data-msg-required' => __('labels.This field is required')]) }}
                    @if ($errors->has('last_date'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('last_date') }}</strong>
                        </span>
                    @endif
                </div>
            @endif

            <!-- Remark -->
            <div class="form-group">
                {{ Form::hidden('published_research_paper_id', $details->id) }}
                {!! Form::label('remark', trans('publication::published-research-paper.proof_status.' . $remarkLabel) . ' (' . trans('labels.remarks') . ')', ['class' => 'form-label required']) !!}
                {!! Form::textarea('remark', null, ['class' => 'form-control required', 'placeholder' => trans('labels.remarks'), 'rows' => 2, 'data-msg-required' => __('labels.This field is required'), 'data-rule-maxlength' => 255, 'data-msg-maxlength' => trans('labels.At most 255 characters')]) !!}

                <!-- Save & Cancel Button -->
                <div class="form-actions">
                    <button type="submit" class="btn btn-success">
                        <i class="ft-check-square"></i>
                        @lang('publication::published-research-paper.save_and_send')
                    </button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    @endif
@endif
