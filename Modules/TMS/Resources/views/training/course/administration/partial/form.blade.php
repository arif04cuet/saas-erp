<div class="form-group">
    <label for="">Coordinator</label>
    {{ Form::select('coordinator', $trainingDeptEmployeeDropdown, isset($coordinator) ? $coordinator->employee_id : null,
         [
            'class' => 'form-control form-control-sm',
            'placeholder' => trans('labels.select'),
            'required'
         ]
    ) }}

    @error(['key' => 'coordinator'])@enderror
</div>
<div class="form-group">
    <label for="">Director</label>
    {{ Form::select('director', $employeeDropdowns, isset($director) ? $director->employee_id : null, [
        'class' => 'form-control form-control-sm',
        'placeholder' => trans('labels.select'),
        'required'
    ]) }}

    @error(['key' => 'director'])@enderror
</div>
<div class="form-group">
    <label for="">Associate Director</label>
    {{ Form::select('associate_director', $employeeDropdowns, isset($associateDirector)
        ? $associateDirector->employee_id
        : null,
        [
            'class' => 'form-control form-control-sm',
            'placeholder' => trans('labels.select'),
        ]
    ) }}

    @error(['key' => 'associate_director'])@enderror
</div>
<div class="form-group">
    <label for="">Assistant Director</label>
    {{ Form::select('assistant_director', $employeeDropdowns, isset($assistantDirector)
        ? $assistantDirector->employee_id
        : null,
        [
            'class' => 'form-control form-control-sm',
            'placeholder' => trans('labels.select'),
        ]
    ) }}

    @error(['key' => 'assistant_director'])@enderror
</div>

@push('page-js')
    <script>
        $(document).ready(function () {
            $('select').select2({
                placeholder: '{!! trans('labels.select') !!}'
            });
        });
    </script>
@endpush