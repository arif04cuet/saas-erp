<table class="table">
    <tbody>
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
