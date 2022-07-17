<div class="card-body">
    {!! Form::open(['route' => 'publication.published-research-papers.store', 'class' => 'form send-press-form', 'enctype' => 'multipart/form-data']) !!}
    <div id="invoice-items-details" class="">
        <h4 class="form-section"><i class="la la-tag"></i>@lang('labels.form')</h4>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('Research Title', trans('publication::published-research-paper.research_title'), ['class' => 'form-label required']) !!}
                    {!! Form::text('title', $request->research->title, ['class' => 'form-control required', 'readonly']) !!}
                    {!! Form::hidden('publication_request_id', $request->id, ['class' => 'form-control required']) !!}
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('publication type', trans('publication::type.title'), ['class' => 'form-label required']) !!}
                    {!! Form::select('publication_type_id', $types, null, ['class' => 'form-control type-dropdown-select required', 'data-msg-required' => __('labels.This field is required')]) !!}
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('publication press', trans('publication::press.title'), ['class' => 'form-label required']) !!}
                    {!! Form::select('publication_press_id', $presses, null, ['class' => 'form-control press-dropdown-select required', 'data-msg-required' => __('labels.This field is required')]) !!}
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('quantity', trans('publication::published-research-paper.paper_quantity'), ['class' => 'form-label required']) !!}
                    {!! Form::number('quantity', null, ['class' => 'form-control required', 'placeholder' => trans('labels.amount'), 'data-msg-required' => __('labels.This field is required'), 'data-rule-maxlength' => 11, 'data-msg-maxlength' => trans('labels.At most 11 characters')]) !!}
                    <div class="help-block"></div>
                    @if ($errors->has('quantity'))
                        <span class="invalid-feedback">{{ $errors->first('quantity') }}</span>
                    @endif
                </div>
            </div>

            <div class="form-group mb-1 col-sm-6 col-md-6">
                <label class="required">{{ trans('publication::published-research-paper.attach_workorder') }}</label>
                {!! Form::file('workorder', ['class' => 'form-control required' . ($errors->has('attachments.*') ? ' is-invalid' : ''), 'data-msg-required' => Lang::get('labels.This field is required'), 'accept' => '.doc, .docx, .xlx, .xlsx, .csv, .pdf']) !!}

                @if ($errors->has('workorder'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('workorder') }}</strong>
                    </span>
                @endif
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('remark', trans('labels.remarks'), ['class' => 'form-label']) !!}
                    {!! Form::textarea('remark', null, ['class' => 'form-control', 'placeholder' => trans('labels.remarks'), 'rows' => 2]) !!}
                    <div class="help-block"></div>
                    @if ($errors->has('remark'))
                        <span class="invalid-feedback">{{ $errors->first('remark') }}</span>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Save & Cancel Button -->
    <div class="form-actions text-center">
        <button type="submit" class="btn btn-success">
            <i class="ft-check-square"></i>
            @lang('publication::published-research-paper.save_and_send')
        </button>
        <a class="btn btn-warning mr-1" role="button" href="{{ route('publication-types.index') }}">
            <i class="ft-x"></i> @lang('labels.cancel')
        </a>
    </div>
    {!! Form::close() !!}
</div>
