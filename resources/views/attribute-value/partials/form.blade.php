<div class="form-body">
    <h4 class="form-section"><i
            class="ft-at-sign"></i>@lang('attribute.attribute_value_input_form')
    </h4>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="attribute"
                       class="form-label required">@lang('attribute.attribute')</label>
                {{ Form::select('attribute_id', $attributeDropdownOptions, null, [
                    'class' => 'select2 form-control' . ($errors->has('attribute_id') ? ' is-invalid' : ''),
                    'placeholder' => trans('labels.select'),
                    'required'
                ]) }}

                @if ($errors->has('attribute_id'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('attribute_id') }}</strong>
                    </span>
                @endif
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="date"
                       class="form-label required">@lang('labels.date')</label>
                <div class="input-group">
                    {!! Form::text('date', $pageType == 'create' ? null : \Carbon\Carbon::parse($attributeValue->date)->format('F Y'), [
                        'class' => 'form-control' . ($errors->has('date') ? ' is-invalid' : ''),
                        'required', $pageType == 'edit' ? 'disabled' : '',
                        'autocomplete' => 'off'
                    ]) !!}

                    @if ($errors->has('date'))
                        <span class="invalid-feedback">
                        <strong>{{ $errors->first('date') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="transaction_type"
                       class="form-label required">@lang('attribute.transaction_type')</label>
                @if ($errors->has('transaction_type'))
                    <strong
                        class="help-block danger small font-weight-bold">{{ $errors->first('transaction_type') }}</strong>
                @endif
                <div class="row">
                    <div class="col-md-6">
                        <label for="deposit" id="deposit-label">
                            @lang('attribute.deposit')
                        </label>
                        {{ Form::radio('transaction_type', 'deposit', null, ['required']) }}
                    </div>
                    <div class="col-md-6">
                        <label for="withdraw" id="withdraw-label">
                            @lang('attribute.withdraw')
                        </label>
                        {{ Form::radio('transaction_type', 'withdraw', null, ['required']) }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="achieved_value"
                       class="form-label required">@lang('attribute.achieved_value')
                </label>
                <div class="input-group">
                    {!! Form::number('achieved_value', $pageType == 'create' ? null : $attributeValue->achieved_value, [
                            'class' => 'form-control' . ($errors->has('achieved_value') ? ' is-invalid' : ''),
                            'required',
                            'min' => 0,
                            'max'=>9999999
                        ]) !!}

                    @if ($errors->has('achieved_value'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('achieved_value') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="form-actions">
        <button type="submit" class="btn btn-primary">
            <i class="la la-check-square-o"></i> {{trans('labels.save')}}
        </button>
        <a class="btn btn-warning mr-1" role="button"
           href="{{ route('organization-members.show', [$project->id, $organization->id, $member->id]) }}">
            <i class="ft-x"></i> {{trans('labels.cancel')}}
        </a>
    </div>
</div>

@push('page-js')
    <script>
        $(document).ready(function () {
            let purchaseShare = '{!! trans('attribute.purchase_share') !!}';
            let depositLabel = '{!! trans('attribute.deposit') !!}';
            let shareExchange = '{!! trans('attribute.share_exchange') !!}';
            let withdrawLabel = '{!! trans('attribute.withdraw') !!}';

            $('select[name=attribute_id]').on('change', function (e) {
                let selectedOptionText = $('option:selected', this).text();
                let depositLabelSelector = 'label[for=deposit]';
                let withdrawLabelSelector = 'label[for=withdraw]';

                if (selectedOptionText.includes('Share')) {
                    $(depositLabelSelector).html(purchaseShare);
                    $(withdrawLabelSelector).html(shareExchange);
                } else {
                    $(depositLabelSelector).html(depositLabel);
                    $(withdrawLabelSelector).html(withdrawLabel);
                }
            });
        });
    </script>
@endpush
