<td>
    <div class="form-group">
        {{ Form::text($inputName . '[start_time]', isset($entity)
            ? \Carbon\Carbon::parse($entity->start_time)->format($timeFormat)
            : null,
            [
                'class' => 'form-control',
            ]
        ) }}

        @error(['key' => $inputName . '.start_time'])@enderror
    </div>
</td>
<td>
    <div class="form-group">
        {{ Form::text($inputName . '[end_time]', isset($entity)
            ? \Carbon\Carbon::parse($entity->end_time)->format($timeFormat)
            : null,
            [
                'class' => 'form-control',
            ]
        ) }}

        @error(['key' => $inputName . '.end_time'])@enderror
    </div>
</td>
<td>
    <div class="form-group">
        {{ Form::select($inputName . '[training_cafeteria_id]', $cafeteriaDropdowns, isset($entity)
            ? $entity->training_cafeteria_id
            : null,
            [
                'class' => 'form-control',
                'placeholder' => trans('labels.select')
            ]
        ) }}

        @error(['key' => $inputName . '.training_cafeteria_id'])@enderror
    </div>
</td>