@component('tms::training.partials.components.show_layout', ['training' => $training])
    <table class="master table table-bordered">
        <thead>
            <tr>
                <th>{{ trans('tms::training.training_code') }}</th>
                <th>{{ trans('tms::training.training_name') }}</th>
                <th>{{ trans('tms::training.training_type') }}</th>
                <th>{{ trans('tms::training.training_participant_no') }}</th>
                <th>{{ trans('tms::training.total_registered_trainees') }}</th>
                <th>{{ trans('tms::training.no_batches') }}</th>
                <th>{{ trans('tms::training.training_sponsors') }}</th>
                <th>{{ trans('tms::budget.budget') }}</th>
                <th>{{ trans('labels.status') }}</th>
                <th>@lang('labels.photo')</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                
                <td>{{ $training->uid }}</td>
                <td>{{ $training->getTitle() }}</td>
                <td>{{ $training->trainingCategory ? $training->trainingCategory->getName() : trans('labels.not_found') }}</td>
                <td>{{ $training->no_of_trainee }}</td>
                <td>{{ $training->totel_registered_trainee }}</td>
                <td>{{ $training->no_of_batches }}</td>
                <td>{{ $sponsors }}</td>
                <td>{{ $training->tmsBudget ? $training->tmsBudget->getName() : '' }}</td>
                <td>{{ $training->status }}</td>
                <td>
                    @if(!isset($training->photo) || empty($training->photo))
                    <img src="https://via.placeholder.com/150" class="img-fluid img-responsive">
                    @else
                    <img src="{{ url("/file/get?filePath=" .  $training->photo) }}" class="img-fluid img-responsive">
                    @endif
                </td>
            </tr>
        </tbody>
    </table>

    <div class="form-actions">
        <a href="{{ route('training.edit', $training->id) }}" class="master btn btn-primary"><i
                class="ft-edit-2"></i> {{ trans('labels.edit') }}</a>
    </div>
@endcomponent
