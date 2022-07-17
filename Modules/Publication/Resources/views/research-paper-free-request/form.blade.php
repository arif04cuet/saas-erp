<div class="card-body">
    {!! Form::open(['route' => 'research-paper-free-requests.store', 'class' => 'form research-paper-free-request-form']) !!}
    <div id="invoice-items-details" class="">
        <h4 class="form-section"><i class="la la-tag"></i>@lang('publication::research-paper-free-request.title')
            @lang('labels.form')</h4>
        <div class="row">

            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('Name (Bangla)', trans('publication::inventory.publication'), ['class' => 'form-label ']) !!}
                    <select name="published_research_paper_id"
                        class="form-control select2 published_research_paper required">
                        <option value="" disabled selected> {{ trans('publication::inventory.select_publication') }}
                        </option>
                        @foreach ($researches as $research)
                            @if ($research->inventory)
                                <option value="{{ $research->id }}">
                                    {{ $research->publicationRequest->research->title }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('available_amount', trans('publication::research-paper-free-request.amount'), ['class' => 'form-label ']) !!}
                    {!! Form::number('quantity', null, ['class' => 'form-control required quantity', 'readonly', 'min=1', 'placeholder' => 'Amount Of Publication', 'data-msg-required' => trans('labels.This field is required')]) !!}
                    <div class="help-block"></div>
                    @if ($errors->has('quantity'))
                        <span class="invalid-feedback">{{ $errors->first('quantity') }}</span>
                    @endif
                </div>
            </div>

            <!-- Type -->
            <div class="col-md-12">
                {!! Form::label('reference_type', trans('cafeteria::raw-material.type.title'), ['class' => 'form-label required']) !!}
                <p></p>
                <div class="form-check-inline skin skin-flat">
                    {!! Form::radio('reference_type', 'employee', false, ['class' => 'required']) !!}
                    <label>@lang('publication::research-paper-free-request.employee')</label>
                </div>
                <div class="form-check-inline skin skin-flat">
                    {!! Form::radio('reference_type', 'organization', false, ['class' => 'required']) !!}
                    <label>@lang('publication::research-paper-free-request.organization')</label>
                </div>
            </div>

            @include('publication::research-paper-free-request.reference-type-employee-form')
            @include('publication::research-paper-free-request.reference-type-organization-form')



            {{-- remark --}}
            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('remark', trans('labels.remarks'), ['class' => 'form-label']) !!}
                    {!! Form::textarea('remark', null, ['class' => 'form-control', 'rows' => 2, 'data-rule-maxlength' => 255, 'data-msg-maxlength' => trans('labels.At most 255 characters')]) !!}
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
        <a class="btn btn-warning mr-1" role="button" href="{{ route('research-paper-free-requests.index') }}">
            <i class="ft-x"></i> @lang('labels.cancel')
        </a>
    </div>
    {!! Form::close() !!}
</div>
