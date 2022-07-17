@extends('rms::layouts.master')
@section('title', trans('rms::research_proposal.extend_date_request'))

@section('content')
    <section class="row">
        <div class=" col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{ trans('rms::research_proposal.extend_date_request_create') }}</h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                            <li><a data-action="close"><i class="ft-x"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        {!! Form::open(['route' =>  'invited-research-proposal.store-date-extend-request', 'class' => 'research-request-tab-steps wizard-circle']) !!}
                        {!! Form::hidden('research_request_id', $researchRequest->id) !!}
                        <div class="form-body">
                            <h4 class="form-section">
                                <i class="la la-briefcase"></i> {{trans('rms::research_proposal.extend_date_request_form')}}
                            </h4>
                            <div class="row">
                                <div class="col-md-8 offset-2">
                                    <h5 class="card-title">{{ trans('rms::research_proposal.res_pro_related_title') }}</h5>
                                    <pre>{{ $researchRequest->title }}</pre>
                                    <fieldset>
                                        <div class="form row">
                                            <div class="form-group mb-1 col-sm-12 col-md-12">
                                                <label class="required">{{ trans('rms::research_proposal.send_to') }}</label>
                                                <br>
                                                {!! Form::select('send_to', ['1' => 'Sahib Bin Ron - CTO', '2' => 'Shadman Ahmed - SE', '3' => 'Tanvir Hossain - SE'], null, ['class' => 'select2 form-control required'.($errors->has('send_to') ? ' is-invalid' : ''), 'data-msg-required' => Lang::get('labels.This field is required')]) !!}

                                                @if ($errors->has('send_to'))
                                                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('send_to') }}</strong>
                        </span>
                                                @endif
                                            </div>
                                            <div class="form-group mb-1 col-sm-12 col-md-12">
                                                <label for="remarks" class="form-label">{{trans('labels.remarks')}}</label>
                                                {!! Form::textarea('remarks', old('remarks'), ['class' => 'form-control' . ($errors->has('remarks') ? ' is-invalid' : ''), 'placeholder' => 'Write here...', 'cols' => 30, 'rows' => 5, 'data-rule-maxlength' => 5000, 'data-msg-maxlength'=>Lang::get('labels.At most 5000 characters')]) !!}

                                                @if ($errors->has('remarks'))
                                                    <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('remarks') }}</strong>
                            </span>
                                                @endif
                                            </div>
                                        </div>
                                </div>
                                </fieldset>
                            </div>
                        </div>
                        <div class="form-actions text-center">
                            {!! Form::button('<i class="la la-check-square-o"></i> '.trans('labels.save') , ['type' => 'submit', 'class' => 'btn btn-primary'] ) !!}

                            <a class="btn btn-warning mr-1" role="button" href="{{route('invited-research-proposal.index')}}">
                                <i class="ft-x"></i> {{trans('labels.cancel')}}
                            </a>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
                </div>
            </div>
    </section>
@endsection

