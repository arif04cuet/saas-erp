@component('tms::trainee.partials.components.show_layout', ['trainee' => $trainee])
    @if(empty($trainee->emergencyContacts))
        <div class="form-actions hide">
            <a href="{{ route('trainee.add.emergency-contact', $trainee) }}" class="btn btn-primary">
                <i class="ft-plus"></i> {{trans('labels.add')}}
            </a>
            <a href="{{ route('trainee.index', $trainee->training->id) }}" class="btn btn-primary">
                <i class="ft-list"></i> {{trans('tms::training.trainee_card_title')}}
            </a>
        </div>
    @else
        <table class="table Emergency_Contact_print">
            <tbody>
            <tr>
                <th style="border-top: none;">@lang('tms::training.name')</th>
                <td style="border-top: none;">{{optional($trainee->emergencyContacts)->name}}</td>
            </tr>
            <tr>
                <th class="">@lang('tms::training.mobile')
                </th>
                <td>{{optional($trainee->emergencyContacts)->mobile_no}}</td>
            </tr>
            <tr>

                <th class="">@lang('tms::training.relation')
                </th>
                <td>{{optional($trainee->emergencyContacts)->relation}}</td>
            </tr>
            <tr>
                <th class="">@lang('tms::training.address')</th>
                <td>{{optional($trainee->emergencyContacts)->contact_address}}</td>
            </tr>
            </tbody>
        </table>
        @if(!Auth::user()->can('tms-access-medical'))
            <div class="form-actions hide">
                <a href="{{ route('trainee.edit.emergency-contact', $trainee->id) }}" class="btn btn-primary"><i class="ft-edit-2"></i> {{trans('labels.edit')}}</a>
                <a href="{{route('trainee.index', $trainee->training_id)}}" class="btn btn-primary"><i class="ft-list"></i> {{trans('tms::training.trainee_card_title')}}</a>
            </div>
        @endif
    @endif
@endcomponent
