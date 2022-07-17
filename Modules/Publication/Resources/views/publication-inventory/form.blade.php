<div class="card-body">
    {!! Form::open(['route' => 'publication-inventories.store', 'class' => 'form press-form']) !!}
    <div id="invoice-items-details" class="">
        <h4 class="form-section"><i class="la la-tag"></i>@lang('publication::inventory.inventory')
            @lang('labels.form')
        </h4>
        <div class="row">

            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('Name (Bangla)', trans('publication::inventory.publication'), ['class' => 'form-label ']) !!}
                    <select name="published_research_paper_id" class="form-control select2 required">
                        <option value="" disabled selected> {{ trans('publication::inventory.select_publication') }}
                        </option>
                        @foreach ($researches as $research)
                            <option value="{{ $research->id }}">
                                {{ $research->publicationRequest->research->title }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('Name (Bangla)', trans('publication::inventory.amount'), ['class' => 'form-label ']) !!}
                    {!! Form::number('available_amount', null, ['class' => 'form-control required', 'min=1', 'placeholder' => 'Amount Of Publication', 'data-msg-required' => trans('labels.This field is required')]) !!}
                    <div class="help-block"></div>
                    @if ($errors->has('available_amount'))
                        <span class="invalid-feedback">{{ $errors->first('available_amount') }}</span>
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
        <a class="btn btn-warning mr-1" role="button" href="{{ route('publication-inventories.index') }}">
            <i class="ft-x"></i> @lang('labels.cancel')
        </a>
    </div>
    {!! Form::close() !!}
</div>
