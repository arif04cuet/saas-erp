@component('tms::trainee.partials.components.show_layout', ['trainee' => $trainee])
    <table class="table Health_Examination_Report_print">
        <tbody>
        <tr>
            <th style="border-top: none;">@lang('tms::training.present_deseases')</th>
            <td style="border-top: none;">{{optional($trainee->healthExaminations)->present_deseases}}</td>
        </tr>
        <tr>
            <th class="">@lang('tms::training.physical_disability')
            </th>
            <td>{{optional($trainee->healthExaminations)->physical_disability}}</td>
        </tr>
        <tr>

            <th class="">@lang('tms::training.temperature')
            </th>
            <td>{{optional($trainee->healthExaminations)->temperature}} @lang('tms::training.degree')</td>
        </tr>
        <tr>
            <th class="">@lang('tms::training.pulse')</th>
            <td>{{optional($trainee->healthExaminations)->pulse}}</td>
        </tr>
        <tr>
            <th class="">@lang('tms::training.respiration')</th>
            <td>{{optional($trainee->healthExaminations)->respiration}}</td>
        </tr>
        <tr>
            <th class="">@lang('tms::training.conjunctiva')</th>
            <td>{{optional($trainee->healthExaminations)->conjunctiva}}</td>
        </tr>
        <tr>
            <th class="">@lang('tms::training.oral_cavity')</th>
            <td>{{optional($trainee->healthExaminations)->oral_cavity}}</td>
        </tr>
        <tr>
            <th class="">@lang('tms::training.denture')</th>
            <td>{{optional($trainee->healthExaminations)->denture}}</td>
        </tr>
        <tr>
            <th class="">@lang('tms::training.blood_pressure')</th>
            <td>
                @if(optional($trainee->healthExaminations)->blood_pressure == 1)
                    @lang('tms::training.yes')
                @else
                    @lang('tms::training.no')
                @endif
            </td>
        </tr>
        <tr>
            <th class="">@lang('tms::training.anaemia')</th>
            <td>
                @if(optional($trainee->healthExaminations)->anaemia == 1)
                    @lang('tms::training.yes')
                @else
                    @lang('tms::training.no')
                @endif
            </td>
        </tr>
        <tr>
            <th class="">@lang('tms::training.oedema')</th>
            <td>
                @if(optional($trainee->healthExaminations)->oedema == 1)
                    @lang('tms::training.yes')
                @else
                    @lang('tms::training.no')
                @endif
            </td>
        </tr>
        <tr>
            <th class="">@lang('tms::training.heart')</th>
            <td>{{optional($trainee->healthExaminations)->heart}}</td>
        </tr>
        <tr>
            <th class="">@lang('tms::training.lung')</th>
            <td>{{optional($trainee->healthExaminations)->lung}}</td>
        </tr>
        <tr>
            <th class="">@lang('tms::training.abdomen')</th>
            <td>{{optional($trainee->healthExaminations)->abdomen}}</td>
        </tr>
        <tr>
            <th class="">@lang('tms::training.eye_sight')</th>
            <td>{{optional($trainee->healthExaminations)->eye_sight}}</td>
        </tr>
        <tr>
            <th class="">@lang('tms::training.left_eye')</th>
            <td>{{optional($trainee->healthExaminations)->left_eye}}</td>
        </tr>
        <tr>
            <th class="">@lang('tms::training.right_eye')</th>
            <td>{{optional($trainee->healthExaminations)->right_eye}}</td>
        </tr>
        </tbody>
        
    </table>
    @if(Auth::user()->can('tms-access-medical'))
    {{-- @if(Auth::user()->employee->designation->short_name == 'MO') --}}
        <div class="form-actions hide">
            <a href="{{ route('trainee.edit.healthExam', $trainee->id) }}" class="btn btn-primary"><i class="ft-edit-2"></i> {{trans('labels.edit')}}</a>
            {{-- <a href="{{route('trainee.index', $trainee->training_id)}}" class="btn btn-primary"><i class="ft-list"></i> {{trans('tms::training.trainee_card_title')}}</a> --}}
        </div>
    @endif
@endcomponent
