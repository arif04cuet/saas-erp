@extends('hrm::layouts.master')
@section('title', trans('hrm::complaint.complaint_invitation_form'))

@section('content')
    <div class="col-md-7">
        <div class="card">
            <div class="card-header">
                <h5 class="font-weight-bold">@lang('hrm::complaint.complaint_invitation_form')</h5>
            </div>
            <div class="card-content">
                <div class="card-body">
                    {{ Form::open(['route' => 'complaints.invitations.store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) }}
                    <div class="form-body">
                        <h4 class="form-section"><i
                                    class="ft-user"></i> @lang('hrm::complaint.complaint_invitation_form')</h4>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="complainer_id"
                                           class="required">@lang('hrm::complaint.complainer')</label>
                                    {{ Form::select('complainer_id', $employees, null, [
                                        'class' => 'form-control select2',
                                        'placeholder' => trans('labels.select'),
                                        'required'
                                    ]) }}

                                    @if($errors->has('complainer_id'))
                                        <span class="help-block danger">{{ $errors->first('complainer_id') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="complainee_id"
                                           class="required">@lang('hrm::complaint.against_whom')</label>
                                    {{ Form::select('complainee_id', $employees, null, [
                                        'class' => 'form-control select2',
                                        'placeholder' => trans('labels.select'),
                                        'required'
                                    ]) }}

                                    @if($errors->has('complainee_id'))
                                        <span class="help-block danger">{{ $errors->first('complainee_id') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="reason" class="required">@lang('hrm::complaint.reason')</label>
                                    {{ Form::textarea('reason', null, ['class' => 'form-control', 'required']) }}

                                    @if($errors->has('reason'))
                                        <span class="help-block danger">{{ $errors->first('reason') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="remark" class="required">@lang('labels.remarks')</label>
                                    {{ Form::textarea('remark', null, ['class' => 'form-control', 'required']) }}

                                    @if($errors->has('remark'))
                                        <span class="help-block danger">{{ $errors->first('remark') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="attachments">@lang('labels.attachments')</label>
                                    {{ Form::file('attachments[]', ['class' => 'form-control', 'multiple']) }}

                                    @if($errors->has('attachments'))
                                        <span class="help-block danger">{{ $errors->first('attachments') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="employee_id" class="required">@lang('labels.share')</label>
                                    {{ Form::select('employee_id', $employees, null, [
                                        'class' => 'form-control select2',
                                        'placeholder' => trans('labels.select'),
                                        'required'
                                    ]) }}

                                    @if($errors->has('employee_id'))
                                        <span class="help-block danger">{{ $errors->first('employee_id') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary">
                            <i class="la la-share-square-o"></i> @lang('labels.share')
                        </button>
                        <button type="button" type="reset" class="btn btn-warning mr-1">
                            <i class="ft-x"></i> @lang('labels.cancel')
                        </button>
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@endsection