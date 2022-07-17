@component('tms::trainee.partials.components.show_layout', ['trainee' => $trainee])
    @if(empty($trainee->traineeType))
        <div class="form-actions hide">
            <a href="{{ route('trainee.add.trainee-type', $trainee) }}" class="btn btn-primary">
                <i class="ft-plus"></i> {{trans('labels.add')}}
            </a>
            <a href="{{ route('trainee.index', $trainee->training->id) }}" class="btn btn-primary">
                <i class="ft-list"></i> {{trans('tms::training.trainee_card_title')}}
            </a>
        </div>
    @else
        <table class="table Final_Education_Information_print">
            <tbody>
                @if($trainee->traineeType->trainee_type == 'association')
                    <tr>
                        <th style="border-top: none;">@lang('tms::trainee_type.association_name')</th>
                        <td style="border-top: none;">{{optional($trainee->traineeType)->org_name}}</td>
                    </tr>
                    <tr>
                        <th style="border-top: none;">@lang('tms::trainee_type.association_member_id')</th>
                        <td style="border-top: none;">{{optional($trainee->traineeType)->org_id}}</td>
                    </tr>
                    <tr>
                        <th style="border-top: none;">@lang('tms::trainee_type.association_member_name')</th>
                        <td style="border-top: none;">{{optional($trainee->traineeType)->org_member_name}}</td>
                    </tr>
                    <tr>
                        <th style="border-top: none;">@lang('tms::trainee_type.association_join_date')</th>
                        <td style="border-top: none;">{{optional($trainee->traineeType)->org_member_join_date}}</td>
                    </tr>
                @else
                    <tr>
                        <th class="">@lang('tms::trainee_type.doptor_name')</th>
                        <td>{{optional($trainee->traineeType)->doptor_name}}</td>
                    </tr>
                    <tr>
                        <th class="">@lang('tms::trainee_type.doptor_service_id')</th>
                        <td>{{optional($trainee->traineeType)->doptor_service_id}}</td>
                    </tr>
                    <tr>
                        <th class="">@lang('tms::trainee_type.present_designation')</th>
                        <td>{{optional($trainee->traineeType)->doptor_present_designation}}</td>
                    </tr>
                    <tr>
                        <th class="">@lang('tms::trainee_type.doptor_join_date')</th>
                        <td>{{optional($trainee->traineeType)->doptor_join_date}}</td>
                    </tr>
                    <tr>
                        <th class="">@lang('tms::trainee_type.doptor_present_designation_join_date')</th>
                        <td>{{optional($trainee->traineeType)->doptor_present_designation_join_date}}</td>
                    </tr>
                @endif
            </tbody>
        </table>
        {{-- @if(!Auth::user()->can('tms-access-medical')) --}}
            <div class="form-actions hide">
                <a href="{{ route('trainee.edit.trainee-type', $trainee->id) }}" class="btn btn-primary"><i class="ft-edit-2"></i> {{trans('labels.edit')}}</a>
                <a href="{{route('trainee.index', $trainee->training_id)}}" class="btn btn-primary"><i class="ft-list"></i> {{trans('tms::training.trainee_card_title')}}</a>
            </div>
        {{-- @endif --}}
    @endif
@endcomponent
