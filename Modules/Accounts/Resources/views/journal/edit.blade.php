@extends('accounts::layouts.master')
@section('title', trans('accounts::journal.title'))
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"
                            id="basic-layout-form">@lang('accounts::journal.title')</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                                <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body">

                            {!! Form::open(['route' => ['journal.update',$journal->id], 'class' => 'form', 'novalidate']) !!}
                            @method('PUT')
                            <h4 class="form-section"><i
                                    class="la la-tag"></i>@lang('accounts::journal.edit')</h4>

                            <!-- Name and Department -->
                            <div class="row">
                                <!-- Name -->
                                <div class="col-6">
                                    <div class="form-group">
                                        {!! Form::label('name', trans('labels.name'), ['class' => 'form-label required']) !!}
                                        {!! Form::text('name', $journal->name,
                                        ['class' => "form-control", "required ", "placeholder" => __('labels.name'),
                                        'data-rule-maxlength' => 100, 'data-msg-maxlength'=>Lang::get('labels.At most 100 characters'),
                                        'data-msg-required' => Lang::get('labels.This field is required')]) !!}
                                        <div class="help-block"></div>

                                        <!-- error message -->
                                        @if ($errors->has('name'))
                                            <div class="help-block text-danger">
                                                {{ $errors->first('name') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <!-- Department -->
                                <div class="col-6">
                                    <div class="form-group">
                                        {!! Form::label('department', trans('ims::location.department'), ['class' => 'form-label']) !!}
                                        {!! Form::select('department_id', $departments, $journal->department_id,
                                        ['class' => "form-control department-select", "required ", "placeholder" => trans('ims::location.department'),
                                        ]) !!}
                                        <div class="help-block"></div>
                                    </div>
                                </div>
                            </div>

                            <!-- Debit/Credit Account -->

                            <div class="row">
                                <!-- Debit Account -->
                                <div class="col-6">
                                    <div class="form-group">
                                        {!! Form::label('debit_account_id', trans('accounts::journal.debit'), ['class' => 'form-label required']) !!}
                                        {!! Form::select('debit_account_id', $economyCodes, $journal->debit_account_id,
                                        ['class' => "form-control debit-account-select", "required ", "placeholder" => trans('accounts::journal.label.debit'),
                                        'data-msg-required' => Lang::get('labels.This field is required')]) !!}
                                        <div class="help-block"></div>
                                        <!-- error message -->
                                        @if ($errors->has('debit_account_id'))
                                            <div class="help-block text-danger">
                                                {{ $errors->first('debit_account_id') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <!--  Credit Account  -->
                                <div class="col-6">
                                    <div class="form-group">
                                        {!! Form::label('credit_account_id', trans('accounts::journal.credit'), ['class' => 'form-label required']) !!}
                                        {!! Form::select('credit_account_id', $economyCodes, $journal->credit_account_id,
                                        ['class' => "form-control credit-account-select", "required ", "placeholder" => trans('accounts::journal.label.credit'),
                                        'data-msg-required' => Lang::get('labels.This field is required')]) !!}
                                        <div class="help-block"></div>

                                        <!-- error message -->
                                        @if ($errors->has('credit_account_id'))
                                            <div class="help-block text-danger">
                                                {{ $errors->first('credit_account_id') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <!-- Types -->
                            <div class="row">
                                <div class="col-md-12">

                                    {!! Form::label('type_id', trans('ims::location.type'), ['class' => 'form-label required']) !!}
                                    @foreach($journalTypes as $journalType)
                                        <div class="form-check-inline">
                                            @if($journalType->id == $journal->type_id)
                                                {!! Form::radio('type_id', $journalType->id, true,
                                                ['class' => 'required','data-msg-required' => trans('labels.This field is required')]) !!}
                                            @else
                                                {!! Form::radio('type_id', $journalType->id,false,
                                                ['class' => 'required','data-msg-required' => trans('labels.This field is required')]) !!}
                                            @endif
                                            <label>@lang('accounts::journal.type.'.strtolower($journalType->name))</label>
                                        </div>
                                    @endforeach
                                <!-- error message -->
                                    @if ($errors->has('type_id'))
                                        <div class="help-block text-danger">
                                            {{ $errors->first('type_id') }}
                                        </div>
                                    @endif
                                </div>
                            </div>


                            <!-- Save / Cancel Button -->
                            <div class="form-actions text-center">
                                <button type="submit" class="btn btn-primary">
                                    <i class="la la-check-square-o"></i>{{ trans('accounts::journal.edit') }}
                                </button>
                                <a class="btn btn-warning mr-1" role="button"
                                   href="{{url(route('journal.index'))}}">
                                    <i class="ft-x"></i> @lang('labels.cancel')
                                </a>
                            </div>
                            {!! Form::close() !!}

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('page-css')

@endpush

@push('page-js')

    <script type="text/javascript">

        let debitFieldPlaceholder = '{!!trans('accounts::journal.label.debit')!!}';
        let creditFieldPlaceholder = '{!!trans('accounts::journal.label.credit')!!}';
        let deptFieldPlaceholder = '{!!trans('labels.select')!!}';

        $('.debit-account-select').select2({
            placeholder: debitFieldPlaceholder
        });

        $('.credit-account-select').select2({
            placeholder: creditFieldPlaceholder
        });

        $('.department-select').select2({
            placeholder: deptFieldPlaceholder
        });

    </script>
@endpush
