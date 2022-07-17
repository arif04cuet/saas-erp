<div class="col-12 col-sm-6 col-md-12 col-lg-6">
    <div class="form-check form-check-inline">
        <div class="skin skin-flat">
            <fieldset>
                {{ Form::radio("questionnaires[$questionnaire->id|$subSection->id]",
                    $option->id,
                    false,
                    [
                        'class'=>'radio-scores' . ($errors->has('questionnaires.' . $questionnaire->id) ? ' is-invalid' : ''),
                        'required',
                        'data-msg-required' => 'Select one of the values above',
                        'id' => "id_$questionnaire->id$option->id",
                    ]
                ) }}
            </fieldset>
        </div>
        <div class="form-check form-check-inline">
            <label for="id_{{ $questionnaire->id }}{{ $option->id }}">
                <h5 style="font-weight: 500;">{{ $option->title_en }}</h5>
            </label>
        </div>
    </div>
</div>
