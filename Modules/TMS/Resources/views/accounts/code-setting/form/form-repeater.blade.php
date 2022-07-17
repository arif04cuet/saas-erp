<div class="col">
    <div class="tms-code-setting-repeater">
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
                            {!! Form::label('tms_sub_sector_id',
                                trans('tms::tms_code_setting.form_elements.tms_sub_sector_id'),
                                 ['class'=>'required'])
                            !!}
                            {!! Form::select('tms_sub_sector_id',
                                     $tmsSubSectors ?? [],
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
                            <button type="button" class="master btn btn-outline-danger" data-repeater-delete="">
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

