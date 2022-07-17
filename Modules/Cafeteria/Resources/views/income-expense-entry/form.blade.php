{!! Form::open(['route' =>  'income-expense-entries.store',
        'class' => 'form cafeteria-journal-entry-form']) !!}


<!-- General Information -->
<h4 class="form-section"><i
        class="la la-tag"></i>
    @lang('accounts::accounts.general_information')
</h4>
<div class="col">
    <!-- Date  and  Journal Dropdown -->
    <div class="row">
        <!-- Title -->
        <div class="col-6">
            <div class="form-group">
                {!! Form::label('reference', trans('accounts::journal.entry.reference'), ['class' => 'form-label required']) !!}
                {!! Form::text('reference', old('reference') ?? null,
                ['class' => "form-control required", 
                "placeholder" => trans('accounts::journal.entry.reference'),
                'data-rule-maxlength' => 50,  
                'data-msg-required' => trans('labels.This field is required'),
                'data-msg-maxlength' => trans('labels.At most 255 characters')
                ]) !!}
                <div class="help-block"></div>
                <!-- error message -->
                @if ($errors->has('reference'))
                    <div class="help-block text-danger">
                        {{ $errors->first('reference') }}
                    </div>
                @endif
            </div>
        </div>

        <!-- Journal -->
        <div class="col-6">
            <div class="form-group">
                {!! Form::label('journal', trans('accounts::journal.title'), ['class' => 'form-label']) !!}
                {!! Form::select('journal_id', $journals, null,
                ['class' => "form-control dropdown-select select2", 
                "placeholder" => trans('ims::location.department'),
                ]) !!}
                <div class="help-block"></div>
            </div>
        </div>

        <!-- Date  -->
        <div class="col-6">
            <div class="form-group">
                {!! Form::label('date', trans('labels.date'), ['class' => 'form-label required']) !!}
                {{
                       Form::text('date', date('Y-m-d'), [
                            'class' => 'form-control required',
                            'placeholder'=>trans('labels.select'),
                            'data-msg-required'=> __('labels.This field is required'),
                       ])
                }}
            </div>
            <!-- error message -->
            @if ($errors->has('date'))
                <div class="help-block text-danger">
                    {{ $errors->first('date') }}
                </div>
            @endif
        </div>
    </div>
</div>
<!--/General Information -->

<!-- Journal entry detail -->
@include('cafeteria::income-expense-entry.form-repeater')


<!-- Save & Cancel Button -->
<div class="form-actions text-center">
    <button type="submit" class="btn btn-success">
        <i class="la la-check-square-o"></i>@lang('labels.save')
    </button>
    <a class="btn btn-warning mr-1" role="button" href="{{route('tms.journal-entries.index')}}">
        <i class="ft-x"></i> @lang('labels.cancel')
    </a>
</div>

{!! Form::close() !!}
