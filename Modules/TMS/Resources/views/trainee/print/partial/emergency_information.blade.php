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
