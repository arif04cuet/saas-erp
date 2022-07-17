<b>@lang('labels.dear') @lang('hrm::job-circular.admit_card.applicant')</b>, <br>
<?php echo __('job-application.shortlist_email_body', ['circular' => $circular->title]) ?><br>
<p>
    <a href="{{$link}}" title="{{__('hrm::job-circular.admit_card.download')}}">
        @lang('hrm::job-circular.admit_card.download')
    </a>
</p>
<br><br>
@lang('labels.bangladesh_rural_development_academy') (@lang('labels.BARD ERP'))<br>
@lang('labels.bard_address.kotbari'), @lang('labels.bard_address.cumilla')
