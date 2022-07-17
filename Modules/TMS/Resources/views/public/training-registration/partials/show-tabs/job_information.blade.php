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
