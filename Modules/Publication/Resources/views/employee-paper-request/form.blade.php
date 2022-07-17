<div class="card-body">
    @if ($page == 'create')
        {!! Form::open(['route' => 'employee-paper-requests.store', 'class' => 'form employee-paper-request-form']) !!}
    @else
        {!! Form::open(['route' => ['employee-paper-requests.update', $employeePaperRequest->id], 'class' => 'form employee-paper-request-form']) !!}
        @method('PUT')
    @endif
    <div id="invoice-items-details" class="">
        <h4 class="form-section"><i class="la la-tag"></i>@lang('publication::research-paper-free-request.title')
            @lang('labels.form')</h4>
        <div class="row">

            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('Name (Bangla)', trans('publication::inventory.publication'), ['class' => 'form-label ']) !!}
                    <select name="published_research_paper_id"
                        class="form-control select2 published_research_paper required">
                        @if ($page == 'create')
                            <option value="" disabled selected>
                                {{ trans('publication::inventory.select_publication') }}
                            </option>
                            @foreach ($researches as $research)
                                @if ($research->inventory)
                                    <option value="{{ $research->id }}">
                                        {{ $research->publicationRequest->research->title }}</option>
                                @endif
                            @endforeach
                        @else
                            @foreach ($researches as $research)
                                @if ($research->inventory)
                                    @if ($employeePaperRequest->published_research_paper_id == $research->id)
                                        <option value="{{ $research->id }}" selected>
                                            {{ $research->publicationRequest->research->title }}</option>
                                    @else
                                        <option value="{{ $research->id }}">
                                            {{ $research->publicationRequest->research->title }}</option>
                                    @endif
                                @endif
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('available_amount', trans('publication::research-paper-free-request.amount'), ['class' => 'form-label ']) !!}
                    {!! Form::number('quantity', $page == 'edit' ? $employeePaperRequest->quantity : null, ['class' => 'form-control required quantity', 'readonly', 'min=1', 'placeholder' => 'Amount Of Publication', 'data-msg-required' => trans('labels.This field is required')]) !!}
                    <div class="help-block"></div>
                    @if ($errors->has('quantity'))
                        <span class="invalid-feedback">{{ $errors->first('quantity') }}</span>
                    @endif
                </div>
            </div>
            {{-- remark --}}
            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('remark', trans('labels.remarks'), ['class' => 'form-label']) !!}
                    {!! Form::textarea('remark', $page == 'edit' ? $employeePaperRequest->remark : null, ['class' => 'form-control', 'rows' => 2, 'data-rule-maxlength' => 255, 'data-msg-maxlength' => trans('labels.At most 255 characters')]) !!}
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
        <button type="submit" class="btn {{ $page == 'edit' ? 'btn-primary' : 'btn-success' }}">
            <i class="ft-check-square"></i>
            @lang('labels.save')
        </button>
        <a class="btn btn-warning mr-1" role="button" href="{{ route('employee-paper-requests.index') }}">
            <i class="ft-x"></i> @lang('labels.cancel')
        </a>
    </div>
    {!! Form::close() !!}
</div>
