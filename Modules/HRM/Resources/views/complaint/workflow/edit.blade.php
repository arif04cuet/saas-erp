@extends('hrm::layouts.master')
@section('title', trans('hrm::complaint.title'))

@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5 class="font-weight-bold">@lang('hrm::complaint.title')</h5>
            </div>
            <div class="card-content">
                <div class="card-body">
                    <table class="table">
                        <tr>
                            <td>@lang('hrm::complaint.complainer')</td>
                            <td>{{ $complaint->complainer->getName() }}</td>
                        </tr>
                        <tr>
                            <td>@lang('hrm::complaint.accused')</td>
                            <td>{{ $complaint->complainee->getName() }}</td>
                        </tr>
                        <tr>
                            <td>@lang('hrm::complaint.author')</td>
                            <td>{{ $complaint->complainer->getName() }}</td>
                        </tr>
                        <tr>
                            <td>@lang('hrm::complaint.reason')</td>
                            <td>{{ $complaint->reason }}</td>
                        </tr>
                        <tr>
                            <td>@lang('labels.attachments')</td>
                            <td>
                                @foreach($complaint->attachments as $attachment)
                                    <span class="badge badge-pill badge-primary">{{ $attachment->file_name }}</span>
                                @endforeach
                            </td>
                        </tr>
                    </table>
                    <div class="row">
                        <div class="col-md-6">
                            {{ Form::open([
                                'route' => ['complaint.workflow.update', $complaint->id],
                                'method' => 'PUT'
                            ]) }}
                            @if(Auth::user()->employee->designation->short_name == 'DA')
                                <div class="form-group">
                                    <!-- user with whom complaint will be shared for approve or reject -->
                                    <label for="">@lang('labels.share')</label>
                                    {{ Form::select('employee_id', $employeeDropdown, null, [
                                        'class' => 'form-control select2',
                                        'placeholder' => trans('labels.select')
                                    ]) }}

                                    @if($errors->has('employee_id'))
                                        <span class="help-block danger">{{ $errors->first('employee_id') }}</span>
                                    @endif
                                </div>
                            @endif
                            <div class="form-group">
                                <label for="" class="required">@lang('labels.remarks')</label>
                                {{ Form::textarea('remark', null, ['class' => 'form-control', 'required']) }}

                                @if($errors->has('remark'))
                                    <span class="help-block danger">{{ $errors->first('remark') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="">@lang('labels.message')</label>
                                {{ Form::textarea('message', null, ['class' => 'form-control']) }}

                                @if($errors->has('message'))
                                    <span class="help-block danger">{{ $errors->first('message') }}</span>
                                @endif
                            </div>
                            <div class="form-actions">
                                @if($canApproveOrReject)
                                    @if(in_array('approve', $possibleTransitions))
                                        <button name="transition" value="approve" type="submit" class="btn btn-success mr-1">
                                            <i class="ft-check"></i> @lang('labels.approve')
                                        </button>
                                    @endif
                                    @if(in_array('reject', $possibleTransitions))
                                        <button name="transition" value="reject" type="submit" class="btn btn-danger mr-1">
                                            <i class="ft-check"></i> @lang('labels.reject')
                                        </button>
                                    @endif
                                    @if($complaint->status == 'checking')
                                        <button name="transition" value="review" type="submit" class="btn btn-primary">
                                            <i class="la la-share-square-o"></i> @lang('labels.share')
                                        </button>
                                    @endif
                                @else
                                    <button name="transition" value="review" type="submit" class="btn btn-primary">
                                        <i class="la la-share-square-o"></i> @lang('labels.share')
                                    </button>
                                @endif
                                <button type="button" type="reset" class="btn btn-warning mr-1" onclick="window.location ='{{ route('hrm-dashboard') }}'">
                                    <i class="ft-x"></i> @lang('labels.cancel')
                                </button>
                                {{ Form::close() }}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="black">@lang('labels.remarks'): </label>
                            <div class="media">
                                <div class="media-body">

                                    @foreach($complaint->stateDetails as $detail)
                                        <p class="text-bold-600 mb-0">
                                            {{ state_actor($detail->stateHistory->actor_id)->name }}
                                        </p>
                                        <p class="small m-0 comment-time">{{ date("j F, Y, g:i a",strtotime($detail->created_at)) }}</p>
                                        <p class="m-0 comment-text">{{ $detail->remark }}</p>
                                        <hr/>
                                    @endforeach

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection