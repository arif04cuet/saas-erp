@component('tms::trainee.partials.components.show_layout', ['trainee' => $trainee])
<table class="table">
    <tbody>
    <tr>
        <td colspan="2" align="center" style="border-top: none;">
            <img src="{{ url("/file/get?filePath=" .  $trainee->photo) }}"
                 width="200px" height="200px">
        </td>
    </tr>
    <tr>
        <th class="font-size">
            @lang('tms::training.full_name')
        </th>
        <td class="font-size">{{ $trainee->{trans('tms::trainee.name_locale')} }}</td>
    </tr>
    <tr>
        <th class="font-size">@lang('tms::training.gender')</th>
        <td class="font-size">
            {{$trainee->trainee_gender === 'male' ?
                trans('labels.male') : trans('labels.female')}}
        </td>
    </tr>
    <tr>
        <th class="font-size">@lang('tms::training.dob')</th>
        <td class="font-size">{{$trainee->dob}}</td>
    </tr>
    <tr>
        <th class="font-size">@lang('tms::training.email')</th>
        <td class="font-size">{{$trainee->email}}</td>
    </tr>
    <tr>
        <th class="font-size">@lang('tms::training.mobile')</th>
        <td class="font-size">{{$trainee->mobile}}</td>
    </tr>
    <tr>
        <th class="font-size">@lang('tms::training.short_name_for_name_badge')</th>
        <td class="font-size">{{$trainee->badge_name}}</td>
    </tr>
    <tr>
        <th class="font-size">@lang('tms::training.short_name_for_name_badge_bn')</th>
        <td class="font-size">{{$trainee->badge_name_bn}}</td>
    </tr>
    <tr>
        <th class="font-size">@lang('tms::training.joining_with_child')</th>
        <td class="font-size">{{$trainee->with_child == 1 ? trans('labels.yes') : trans('labels.no')}}</td>
    </tr>
    <tr>
        <th class="font-size">@lang('tms::training.phone')</th>
        <td class="font-size">{{$trainee->phone}}</td>
    </tr>
    <tr>
        <th class="font-size">@lang('tms::training.fax')</th>
        <td class="font-size">{{$trainee->fax}}</td>
    </tr>
    </tbody>
</table>
{{-- @if(Auth::user() && (!Auth::user()->can('tms-access-medical'))) --}}
    <div class="form-actions not-print hide">
        <a href="{{ route('trainee.edit', $trainee->id) }}" class="btn btn-primary"><i
                class="ft-edit-2"></i> {{trans('labels.edit')}}</a>
        <a href="{{route('trainee.index', $trainee->training_id)}}" class="btn btn-primary"><i
                class="ft-list"></i> {{trans('tms::training.trainee_card_title')}}</a>
    </div>
{{-- @endif --}}

@endcomponent
