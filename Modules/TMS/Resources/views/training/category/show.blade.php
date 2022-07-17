@component('tms::training.partials.components.show_layout', ['training' => $training])
    <h3>@lang('tms::training.category')</h3>
    @if(!isset($training->category_id))
        <div class="form-actions">
            <a href="{{ route('training.category.edit', ['training' => $training]) }}" class="btn btn-primary">
                <i class="ft-plus"></i> @lang('labels.add')
            </a>
            <a href="{{ url('tms/training') }}" class="btn btn-primary">
                <i class="ft-list"></i> @lang('tms::training.training_list')
            </a>
        </div>
    @else
        <h4><b>{{ $training->category->getName() }}</b></h4>
        <div class="form-actions">
            <a href="{{ route('training.category.edit', ['training' => $training]) }}" class="btn btn-primary"><i class="ft-edit-2"></i> {{trans('labels.edit')}}</a>
            <a href="{{ url('tms/training') }}" class="btn btn-primary"><i class="ft-list"></i> {{trans('tms::training.training_list')}}</a>
        </div>
    @endif
@endComponent
