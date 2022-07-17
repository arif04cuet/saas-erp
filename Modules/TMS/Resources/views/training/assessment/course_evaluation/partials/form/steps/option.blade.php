<div class="form-check form-check-inline">
    <div class="skin skin-flat">
        <fieldset>
            {{ Form::radio("questionnaire[$questionnaire->id]",
                $option->id,
                false,
                [
                    'class'=>'scores',
                    'required',
                    'data-msg-required' => trans('labels.choose_at_least_one_from_above'),
                    'id' => "id_$questionnaire->id$option->id"

                ]
            ) }}
        </fieldset>
    </div>
    <div class="form-check form-check-inline">
        <label for="id_{{ $questionnaire->id }}{{ $option->id }}">
            {{ $option->title_en }}
        </label>
    </div>
</div>
