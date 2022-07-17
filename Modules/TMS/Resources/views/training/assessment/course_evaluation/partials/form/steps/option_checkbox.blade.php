<div class="col-12 col-sm-6 col-md-12 col-lg-6">
    <div class="form-check form-check-inline ">
        <div class="skin skin-flat">
            <fieldset>
                {{ Form::checkbox("questionnaires[$questionnaire->id|$subSection->id]",
                $option->id,
                false,
                [
                'class'=>'checkbox-scores',
                'data-msg-required' => 'Select one of the values above',
                'data-questionnaire-group' => 'questionnaire-' . $questionnaire->id,
                'data-item-index' => $option->id,
                'id' => "id_$questionnaire->id$option->id"
                ]
                ) }}
            </fieldset>
        </div>
        <div class="form-check form-check-inline">
            <label style="margin-top: 5px;" for="id_{{ $questionnaire->id }}{{ $option->id }}">
                <h5 style="font-weight: 500;">{{ $option->title_en }}</h5>
            </label>
        </div>
    </div>
</div>
