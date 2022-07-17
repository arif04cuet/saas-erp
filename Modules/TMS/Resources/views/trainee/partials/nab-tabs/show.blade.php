<ul class="nav nav-tabs nav-underline no-hover-bg" id="edit-trainee-tabs">
    <li class="nav-item">
        <a class="nav-link"
           href="{{ Auth::user() && Auth::user()->can('tms-access-medical') ? route('medical.trainee.show', $trainee->id) : route('trainee.show', $trainee->id) }}">
            @lang('tms::trainee.personal_info')
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link"
           href="{{ Auth::user() && Auth::user()->can('tms-access-medical') ? route('medical.trainee.general-info.show', $trainee->id) : route('trainee.general-info.show', $trainee->id) }}">
            @lang('tms::training.general_info')
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link"
           href="{{ Auth::user() && Auth::user()->can('tms-access-medical') ? route('medical.trainee.trainee-type.show', $trainee->id) : route('medical.trainee.trainee-type.show', $trainee->id) }}">
            @lang('tms::trainee_type.title')
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link"
           href="{{ Auth::user() && Auth::user()->can('tms-access-medical') ? route('medical.trainee.education-info.show', $trainee->id) : route('trainee.education-info.show', $trainee->id) }}"
        >@lang('tms::training.educational_info')</a>
    </li>
    <li class="nav-item">
        <a class="nav-link"
           href="{{ Auth::user() && Auth::user()->can('tms-access-medical') ? route('medical.trainee.service.show', $trainee->id) : route('trainee.service.show', $trainee->id) }}"
        >@lang('tms::training.trainee_service')</a>
    </li>
    <li class="nav-item">
        <a class="nav-link"
           href="{{ Auth::user() && Auth::user()->can('tms-access-medical') ? route('medical.trainee.emergency-contact.show', $trainee->id) : route('trainee.emergency-contact.show', $trainee->id) }}"
        >@lang('tms::training.emergency_contact')</a>
    </li>
    <li class="nav-item">
        <a class="nav-link"
           href="{{ Auth::user() &&  Auth::user()->can('tms-access-medical') ? route('medical.trainee.health-reports.show', $trainee->id) : route('trainee.health-reports.show', $trainee->id) }}"
        >@lang('tms::training.health_examination_report')</a>
    </li>
</ul>

@push('page-js')
    <script>
        $(document).ready(function () {
            let currentUrl = document.URL;

            $('#edit-trainee-tabs').find('li a').each(function (index, anchorTag) {
                if (anchorTag.href === currentUrl) {
                    $(anchorTag).addClass('active');
                }
            });
        });
    </script>
@endpush
