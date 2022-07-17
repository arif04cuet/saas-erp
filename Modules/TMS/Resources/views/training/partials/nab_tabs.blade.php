<ul class="nav nav-tabs nav-underline no-hover-bg" id="training-tabs">
    <li class="nav-item">
        <a class="nav-link"
           href="{{ route('training.show', $training) }}">
           <i class="ft ft-file-text"></i> @lang('tms::training.general_info')
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link"
           href="{{ route('training.durationDeadline.show', $training) }}">
           <i class="ft ft-file-text"></i> @lang('tms::training.duration')
        </a> 
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('training.category.show', $training) }}">
            <i class="ft ft-file-text"></i> @lang('tms::training.category')
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('trainings.administrations.show', $training) }}">
            <i class="ft ft-file-text"></i> @lang('tms::training.training_administration')
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('trainings.cost-segmentation.show', $training) }}">
            <i class="ft ft-file-text"></i> @lang('tms::training.detailed_cost_segmentation')
        </a>
    </li>
    {{-- <li class="nav-item">
        <a class="nav-link" href="{{ route('trainings.courses.index', $training) }}">
            <i class="ft ft-file-text"></i> @lang('labels.details')
        </a>
    </li>  --}}

</ul>

@push('page-js')
    <script>
        $(document).ready(function () {
            let currentUrl = document.URL;

            $('#training-tabs').find('li a').each(function (index, anchorTag) {
                if (anchorTag.href === currentUrl) {
                    $(anchorTag).addClass('active');
                }
            });
        });
    </script>
@endpush
