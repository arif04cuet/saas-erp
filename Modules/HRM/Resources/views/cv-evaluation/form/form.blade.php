{!! Form::open(['url' =>  route('employee-punishment.store'), 'class' => 'form', 'novalidate', 'method' => 'post']) !!}
<div class="form-body">
    <h4 class="form-section"><i class="ft-grid"></i> @lang('hrm::photocopy_management.create_form_title') </h4>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="title" class="form-label required">@lang('hrm::photocopy_management.list_table_title')</label>
                <input type="text" name="title" id="title" class="form-control" required data-validation-required-message="{{trans('validation.required', ['attribute' => trans('hrm::photocopy_management.list_table_title')])}}">
                <div class="help-block"></div>
                @if ($errors->has('title'))
                    <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('title') }}</strong></span>
                @endif
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="type" class="form-label required">{{trans('hrm::photocopy_management.type')}}</label>
                <select name="type" id="type" class="form-control" required data-validation-required-message="{{trans('validation.required', ['attribute' => trans('hrm::photocopy_management.type')])}}">
                    <option value="">- @lang('labels.select') -</option>
                    <option value="Internal Documents">Internal Documents</option>
                    <option value="Office Documents">Office Documents</option>
                    <option value="Notice">Notice</option>
                    <option value="Others">Others</option>
                </select>
                <div class="help-block"></div>
                @if ($errors->has('type'))
                    <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('type') }}</strong></span>
                @endif
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="priority" class="form-label required">@lang('hrm::photocopy_management.priority')</label>
                <select name="priority" id="priority" class="form-control" data-validation-required-message="{{trans('validation.required', ['attribute' => trans('hrm::photocopy_management.priority')])}}">
                    <option value="">- @lang('labels.select') -</option>
                    <option value="high">High</option>
                    <option value="medium">Medium</option>
                    <option value="low">Low</option>
                </select>
                <div class="help-block"></div>
                @if ($errors->has('priority'))
                    <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('priority') }}</strong></span>
                @endif
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="department_id" class="form-label required">{{trans('hrm::photocopy_management.requester_dept')}}</label>
                <select name="department_id" id="department_id" class="form-control" data-validation-required-message="{{trans('validation.required', ['attribute' => trans('hrm::photocopy_management.requester_dept')])}}">
                    <option value="">- @lang('labels.select') -</option>
                    @foreach($departments as $department)
                        <option value="{{$department->id}}">{{$department->name}}</option>
                    @endforeach
                </select>
                <div class="help-block"></div>
                @if ($errors->has('department_id'))
                    <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('department_id') }}</strong></span>
                @endif
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="pages" class="form-label required">@lang('hrm::photocopy_management.no_of_pages')</label>
                <input type="number" name="pages" id="pages" class="form-control" >
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="remark" class="form-label" >@lang('labels.remarks')</label>
                <textarea name="remark" id="remark" class="form-control"></textarea>
            </div>
        </div>
    </div>
</div>

<div class="form-actions">
    <button type="submit" class="btn btn-primary">
        <i class="ft-check-square"></i> {{trans('hrm::photocopy_management.submit_request')}}
    </button>
    <button class="btn btn-warning" type="button" onclick="window.location = '{{route('photocopy-management.list')}}'">
        <i class="ft-x"></i> {{trans('labels.cancel')}}
    </button>
</div>

{!! Form::close() !!}
