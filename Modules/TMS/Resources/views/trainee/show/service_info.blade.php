@component('tms::trainee.partials.components.show_layout', ['trainee' => $trainee])
    @if(empty($trainee->services))
        <div class="form-actions hide">
            <a href="{{ route('trainee.add.service-info', $trainee) }}" class="btn btn-primary">
                <i class="ft-plus"></i> {{trans('labels.add')}}
            </a>
            <a href="{{ route('trainee.index', $trainee->training->id) }}" class="btn btn-primary">
                <i class="ft-list"></i> {{trans('tms::training.trainee_card_title')}}
            </a>
        </div>
    @else
        <table class="table Trainee_Service_print">
            <tbody>
            <tr>
                <th style="border-top: none;">@lang('tms::training.designation')</th>
                <td style="border-top: none;">{{optional($trainee->services)->designation}}</td>
            </tr>
            <tr>
                <th style="border-top: none;">@lang('tms::training.designation_bn')</th>
                <td style="border-top: none;">{{optional($trainee->services)->designation_bn}}</td>
            </tr>
            <tr>
                <th class="">@lang('tms::training.organization')
                </th>
                <td>{{optional($trainee->services)->organization}}</td>
            </tr>
            <tr>

                <th class="">@lang('tms::training.service_code')
                </th>
                <td>{{optional($trainee->services)->service_code}}</td>
            </tr>
            <tr>
                <th class="">@lang('tms::training.joining_date')</th>
                <td>{{optional($trainee->services)->joining_date}}</td>
            </tr>
            </tbody>
        </table>
        @if(!Auth::user()->can('tms-access-medical'))
            <div class="form-actions hide">
                <a href="{{ route('trainee.edit.service-info', $trainee->id) }}" class="btn btn-primary"><i class="ft-edit-2"></i> {{trans('labels.edit')}}</a>
                <a href="{{route('trainee.index', $trainee->training_id)}}" class="btn btn-primary"><i class="ft-list"></i> {{trans('tms::training.trainee_card_title')}}</a>
            </div>
        @endif
    @endif
@endcomponent
