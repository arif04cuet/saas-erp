@component('tms::trainee.partials.components.show_layout', ['trainee' => $trainee])
    @if(empty($trainee->educations))
        <div class="form-actions hide">
            <a href="{{ route('trainee.add.education-info', $trainee) }}" class="btn btn-primary">
                <i class="ft-plus"></i> {{trans('labels.add')}}
            </a>
            <a href="{{ route('trainee.index', $trainee->training->id) }}" class="btn btn-primary">
                <i class="ft-list"></i> {{trans('tms::training.trainee_card_title')}}
            </a>
        </div>
    @else
        <table class="table Final_Education_Information_print">
            <tbody>
            <tr>
                <th style="border-top: none;">@lang('tms::training.degree_name')</th>
                <td style="border-top: none;">{{optional($trainee->educations)->degree}}</td>
            </tr>
            <tr>
                <th class="">@lang('tms::training.degree_subject')
                </th>
                <td>{{optional($trainee->educations)->subject}}</td>
            </tr>
            <tr>

                <th class="">@lang('tms::training.passing_year')
                </th>
                <td>{{optional($trainee->educations)->passing_year}}</td>
            </tr>
            <tr>
                <th class="">@lang('tms::training.education_board') / @lang('tms::training.university')</th>
                <td>{{optional($trainee->educations)->institution}}</td>
            </tr>
            </tbody>
        </table>
        @if(!Auth::user()->can('tms-access-medical'))
            <div class="form-actions hide">
                <a href="{{ route('trainee.edit.education-info', $trainee->id) }}" class="btn btn-primary"><i class="ft-edit-2"></i> {{trans('labels.edit')}}</a>
                <a href="{{route('trainee.index', $trainee->training_id)}}" class="btn btn-primary"><i class="ft-list"></i> {{trans('tms::training.trainee_card_title')}}</a>
            </div>
        @endif
    @endif
@endcomponent
