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
