<div class="form-body">
    <h4 class="form-section"><i class="ft-grid"></i> {{ trans('hm::hostel_budget.section_form') }}</h4>
    {{ Form::hidden('id', null) }}


    <div class="row">
        <!-- title - english -->
        <div class="col-md-6">
            <div class="form-group {{ $errors->has('title_english') ? ' error' : '' }}">
                {{ Form::label('title_english', trans('hm::hostel_budget.section_form_elements.title_english'), ['class' => 'required']) }}
                {{ Form::text('title_english', null, ['class' => 'form-control required',
                   'placeholder' => trans('hm::hostel_budget.section_form_elements.placeholder'),
                   'data-msg-required'=>trans('labels.This field is required',
                    ['attribute' => __('labels.name')]),
                    'data-rule-maxlength' => 100,
                    'data-msg-maxlength'=>trans('labels.At most 100 characters'),
                    'data-rule-no-white-space' => '^(\s|\S)*(\S)+(\s|\S)*$',
                    ])
                }}
                <div class="help-block"></div>
                @if ($errors->has('title_english'))
                    <div class="help-block">  {{ $errors->first('title_english') }}</div>
                @endif
            </div>
        </div>
        <!-- title-bangla -->
        <div class="col-md-6">
            <div class="form-group {{ $errors->has('name') ? ' error' : '' }}">
                {{ Form::label('title_bangla', trans('hm::hostel_budget.section_form_elements.title_bangla'), ['class' => 'required']) }}
                {{ Form::text('title_bangla', null, ['class' => 'form-control required',
                    'placeholder' => trans('hm::hostel_budget.section_form_elements.placeholder'),
                    'data-msg-required'=>trans('labels.This field is required',
                    ['attribute' => __('labels.name')]),
                    'data-rule-regex-bn' => config('regex.bn'),
                    'data-rule-maxlength' => 100,
                    'data-msg-maxlength'=>trans('labels.At most 100 characters'),
                    'data-rule-no-white-space' => '^(\s|\S)*(\S)+(\s|\S)*$',
                    ])

                }}
                <div class="help-block"></div>
                @if ($errors->has('title_bangla'))
                    <div class="help-block">  {{ $errors->first('title_bangla') }}</div>
                @endif
            </div>
        </div>
    </div>
    <div class="row">
        <!-- checkbox -->
        <div class="col-md-6">
            <div class="skin skin-flat">
                <fieldset>
                    {!!
                        Form::label('show_in_report',
                        trans('hm::hostel_budget.section_form_elements.show_in_report'))
                    !!}
                    {!! Form::checkbox('show_in_report',1, false ,[(isset($section->show_in_report) && ($section->show_in_report))  ? 'checked' : ''])!!}
                </fieldset>
            </div>
        </div>
        <!-- dropdown -->
        <div class="col-md-6 div-report-option">
            <div class="form-group {{ $errors->has('show_as') ? ' error' : '' }}">
                {!!
                    Form::label('show_as',
                    trans('hm::hostel_budget.section_form_elements.show_as'))
                !!}
                {!! Form::select('show_as',$reportShowOptions ?? [],$section->show_as ?? null,
                    ['class'=>'form-control select-report-option']
                    )!!}
                </fieldset>
            </div>
        </div>
    </div>


    <div class="form-actions text-center col-md-12 ">
        {{ Form::button('<i class="la la-check-square-o"></i> '. trans('labels.save'), ['type' => 'submit', 'class' => 'btn btn-primary'] )  }}
        <a href="{{ url('/hm/hostel-budget-section') }}">
            <button type="button" class="btn btn-warning mr-1">
                <i class="la la-times"></i> {{ trans('labels.cancel') }}
            </button>
        </a>
    </div>
</div>

