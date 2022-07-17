@component('tms::trainee.partials.components.show_layout', ['trainee' => $trainee])
    @if(empty($trainee->generalInfos))
        <div class="form-actions hide">
            <a href="{{ route('trainee.add.general-info', $trainee) }}" class="btn btn-primary">
                <i class="ft-plus"></i> {{trans('labels.add')}}
            </a>
            <a href="{{ route('trainee.index', $trainee->training->id) }}" class="btn btn-primary">
                <i class="ft-list"></i> {{trans('tms::training.trainee_card_title')}}
            </a>
        </div>
    @else
        <table class="table general_info">
            <tbody>
            <tr>
                <th style="border-top: none;">@lang('tms::training.fathers_name')</th>
                <td style="border-top: none;">{{optional($trainee->generalInfos)->fathers_name}}</td>
            </tr>
            <tr>
                <th style="border-top: none;">@lang('tms::training.fathers_name_bn')</th>
                <td style="border-top: none;">{{optional($trainee->generalInfos)->fathers_name_bn}}</td>
            </tr>
            <tr>
                <th class="">@lang('tms::training.mothers_name')
                </th>
                <td>{{optional($trainee->generalInfos)->mothers_name}}</td>
            </tr>
            <tr>
                <th class="">@lang('tms::training.mothers_name_bn')
                </th>
                <td>{{optional($trainee->generalInfos)->mothers_name_bn}}</td>
            </tr>
            <tr>
                <th class="">@lang('tms::training.birth_place')
                </th>
                <td>{{optional($trainee->generalInfos)->birth_place}}</td>
            </tr>
            <tr>
                <th class="">@lang('tms::training.marital_status')</th>
                <td>
                    {{optional($trainee->generalInfos)->marital_status === 'married' ?
                    trans('tms::training.married') : trans('tms::training.unmarried')}}
                </td>
            </tr>
            <tr>
                <th class="">@lang('tms::training.present_address')</th>
                <td>{{optional($trainee->generalInfos)->present_address}}</td>
            </tr>
            <tr>
                <th class="">@lang('tms::training.present_address_bn')</th>
                <td>{{optional($trainee->generalInfos)->present_address_bn}}</td>
            </tr>
            </tbody>
            
        </table>
        @if(!Auth::user()->can('tms-access-medical'))
            <div class="form-actions hide">
                <a href="{{ route('trainee.edit.general-info', $trainee->id) }}" class="btn btn-primary"><i class="ft-edit-2"></i> {{trans('labels.edit')}}</a>
                <a href="{{route('trainee.index', $trainee->training_id)}}" class="btn btn-primary"><i class="ft-list"></i> {{trans('tms::training.trainee_card_title')}}</a>
            </div>
        @endif
    @endif
@endcomponent
