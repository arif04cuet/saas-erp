<!-- Project Assigned Roles -->
<h4 class="form-section"><i
        class="la la-briefcase"></i> {{trans('pms::project.project_assigned_role_title')}}
</h4>

<!-- Project Assigned Role Form -->
<div class="row">
    <div class="col-md-12">
        <fieldset>
            <!-- detail proposal -->
            <div class="form-group col-md-6 offset-2 ">
                <label class="">@lang('pms::project.project_director_id')</label>
                <br>
                {{ Form::select('project_director_id', $employees ?? null,
                        isset($project) ? optional($project->projectAssignedRole)->project_director_id : null,
                        [
                            'class' => 'select2 form-control '.($errors->has('project_director_id') ? ' is-invalid' : ''),
                        ])
                 }}
                @if ($errors->has('project_director_id'))
                    <span class="invalid-feedback" role="alert">
                                      <strong>{{ $errors->first('project_director_id') }}</strong>
                              </span>
                @endif
            </div>
            <!-- detail proposal -->
            <div class="form-group col-md-6 offset-2 ">
                <label class="">@lang('pms::project.project_sub_director_id')</label>
                <br>
                {{ Form::select('project_sub_director_id', $employees ?? [],
                         isset($project) ? optional($project->projectAssignedRole)->project_sub_director_id : null,
                         [
                             'class' => 'select2 form-control '.($errors->has('project_sub_director_id') ? ' is-invalid' : ''),
                         ]
                 )
                }}
                @if ($errors->has('project_sub_director_id'))
                    <span class="invalid-feedback" role="alert">
                                      <strong>{{ $errors->first('project_sub_director_id') }}</strong>
                    </span>
                @endif
            </div>
        </fieldset>
    </div>
</div>
