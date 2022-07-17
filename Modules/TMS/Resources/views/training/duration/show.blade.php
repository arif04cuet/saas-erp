@component('tms::training.partials.components.show_layout', ['training' => $training])
    @if(empty($training['start_date']))
        <div class="form-actions">
            <a href="{{ route('training.durationDeadline.edit', $training->id) }}" class="master btn btn-primary">
                <i class="ft-plus"></i> {{trans('labels.add')}}
            </a>
            <a href="{{route('training.index')}}" class="master btn btn-primary">
                <i class="ft-list"></i> {{trans('tms::training.training_list')}}
            </a>
        </div>
    @else
        <table class="master table table-bordered">
            <thead>
                <tr>
                    <th>{{trans('tms::training.start_date')}}</th>
                    <th>{{trans('tms::training.end_date')}}</th>
                    <th>{{trans('tms::training.training_period')}}</th>
                    <th>{{trans('tms::training.registration_deadline')}}</th>
                </tr>
            </thead>
            <tbody>
            <tr>
                <td>{{ \Carbon\Carbon::parse($training->start_date)->format('j F, Y') }}</td>
                <td>{{ \Carbon\Carbon::parse($training->end_date)->format('j F, Y') }}</td>
                <td>{{ \Carbon\Carbon::parse($training->end_date)->addDays(1)->diffInDays(\Carbon\Carbon::parse($training->start_date)) }} days</td>
                <td>{{ \Carbon\Carbon::parse($training->registration_deadline)->format('j F, Y') }}</td>
            </tr>

            </tbody>
        </table>

        <div class="form-actions">
            <a href="{{ route('training.durationDeadline.edit', $training) }}" class="master btn btn-primary"><i class="ft-edit-2"></i> {{trans('labels.edit')}}</a>
            <a href="{{route('training.index')}}" class="master btn btn-primary"><i class="ft-list"></i> {{trans('tms::training.training_list')}}</a>
        </div>

    @endif
@endcomponent
