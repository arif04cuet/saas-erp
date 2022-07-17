<ul class="nav nav-tabs nav-underline no-hover-bg" id="edit-trainee-tabs">
    {{-- @if(!Auth::user()->can('tms-access-medical')) --}}
    <li class="nav-item">
        <a class="nav-link"
           href="{{ route('trainee.edit', ['trainee' => $trainee]) }}">
            @lang('tms::trainee.personal_info')
        </a>
    </li>
    <li class="nav-item">
        @if(is_null($trainee->generalInfos))
            <a class="nav-link"
               href="{{ route('trainee.add.general-info', $trainee->id) }}"
            >@lang('tms::training.general_info')</a>
        @else
            <a class="nav-link"
               href="{{ route('trainee.edit.general-info', ['trainee' => $trainee]) }}"
            >@lang('tms::training.general_info')</a>
        @endif
    </li>
    <li class="nav-item">
        @if(is_null($trainee->traineeType))
            <a class="nav-link"
               href="{{ route('trainee.add.trainee-type', $trainee->id) }}"
            >@lang('tms::trainee_type.title')</a>
        @else
            <a class="nav-link"
               href="{{ route('trainee.edit.trainee-type', ['trainee' => $trainee]) }}"
            >@lang('tms::trainee_type.title')</a>
        @endif
    </li>
    <li class="nav-item">
        @if(is_null($trainee->educations))
            <a class="nav-link"
               href="{{ route('trainee.add.education-info', $trainee->id) }}"
            >@lang('tms::training.educational_info')</a>
        @else
            <a class="nav-link"
               href="{{ route('trainee.edit.education-info', ['trainee' => $trainee]) }}"
            >@lang('tms::training.educational_info')</a>
        @endif
    </li>
    <li class="nav-item">
        @if(is_null($trainee->services))
            <a class="nav-link"
               href="{{ route('trainee.add.service-info', $trainee->id) }}"
            >@lang('tms::training.trainee_service')</a>
        @else
            <a class="nav-link"
               href="{{ route('trainee.edit.service-info', ['trainee' => $trainee]) }}"
            >@lang('tms::training.trainee_service')</a>
        @endif
    </li>
    <li class="nav-item">
        @if(is_null($trainee->emergencyContacts))
            <a class="nav-link"
               href="{{ route('trainee.add.emergency-contact', $trainee->id) }}"
            >@lang('tms::training.emergency_contact')</a>
        @else
            <a class="nav-link"
               href="{{ route('trainee.edit.emergency-contact', ['trainee' => $trainee]) }}"
            >@lang('tms::training.emergency_contact')</a>
        @endif
    </li>
    {{-- @endif --}}
    @if(Auth::user()->can('tms-access-medical'))
    {{-- @if(Auth::user()->employee->designation->short_name == 'MO') --}}
        <li class="nav-item">
            <a class="nav-link"
               href="{{ route('trainee.edit.healthExam', $trainee->id) }}"
            >@lang('tms::training.health_examination_report')</a>
        </li>
    @endif
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
