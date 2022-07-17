@component('tms::training.partials.components.edit_layout', ['training' => $training])
    <div class="col-md-8">
        {{ Form::open(['route' => ['trainings.administrations.update', $training->id],
            'method' => 'PUT'
        ]) }}

        @include('tms::training.administration.partial.form')

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">
                <i class="ft-check-square"></i> {{ trans('labels.save') }}
            </button>
            <a href="{{ route('trainings.administrations.show', [$training->id]) }}"
               class="btn btn-warning">
                <i class="ft-x"></i> {{ trans('labels.cancel') }}
            </a>
        </div>
        {{ Form::close() }}
    </div>
@endcomponent
