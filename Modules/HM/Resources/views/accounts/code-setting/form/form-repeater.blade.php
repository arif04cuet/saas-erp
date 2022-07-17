<h4 class="form-section"><i
        class="la la-tag"></i>
    @lang('hm::hm_code_setting.form_elements.repeater_title')
</h4>
<div class="col">
    <div class="hm-code-setting-repeater">
        <div data-repeater-list="code_settings">
            <div data-repeater-item>
                <div class="row">
                    <!-- Economy Code Dropdown  -->
                    <div class="col-3">
                        <div class="form-group">
                            {!! Form::label('economy_code',
                                trans('tms::tms_code_setting.form_elements.economy_code'),
                                 ['class'=>'required'])
                            !!}
                            {!! Form::select('economy_code',
                                    $economyCodes ?? [],
                                    null,
                                    [
                                     'class' => "form-control form-control-sm required select2 ",
                                     'data-msg-required'=> trans('labels.This field is required'),
                                     'placeholder'=> trans('labels.select'),
                                    ]
                                 )
                             !!}
                        </div>
                    </div>
                    <!-- Journal Dropdown -->
                    <div class="col-3">
                        <div class="form-group">
                            {!! Form::label('journal_id',
                                trans('tms::tms_code_setting.form_elements.journal_id'),
                                 ['class'=>'required'])
                            !!}
                            {!! Form::select('journal_id',
                                  $journals ?? [],
                                  null,
                                  [
                                   'class' => "form-control form-control-sm required select2",
                                   'data-msg-required'=> trans('labels.This field is required'),
                                   'placeholder'=> trans('labels.select'),
                                  ]
                               )
                           !!}
                        </div>
                    </div>
                    <!-- Sub Sector Dropdown  -->
                    <div class="col-4">
                        <div class="form-group">
                            {!! Form::label('hostel_budget_section_id',
                                trans('hm::hostel_budget.section'),
                                 ['class'=>'required'])
                            !!}
                            {!! Form::select('hostel_budget_section_id',
                                     $hostelBudgetSections ?? [],
                                     null,
                                     [
                                      'class' => "form-control form-control-sm required select2",
                                      'multiple'=>'multiple',
                                      'data-msg-required'=> trans('labels.This field is required'),
                                     ]
                                  )
                              !!}
                        </div>
                    </div>
                    <!-- delete buttton -->
                    <div class="col-2">
                        <div class="form-group" style="margin-top: 25px">
                            <button type="button" class="btn btn-outline-danger" data-repeater-delete="">
                                <i class="ft-x"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <button type="button" data-repeater-create class="master btn btn-sm btn-primary ">
            <i class="ft-plus"
               style="cursor: pointer">
            </i>@lang('labels.add')
        </button>
    </div>
</div>

