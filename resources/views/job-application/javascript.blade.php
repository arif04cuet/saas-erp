<script>
    /*
    *  Creation of js variables from php variables to be used in page.js and step.js
    * */
    // jquery step buttons localization
    let labels = {
        finish: '{!! trans('labels.submit') !!}',
        next: '{!! trans('labels.next') !!}',
        previous: '{!! trans('labels.previous') !!}',
    };
    //  localization
    let formContainer = '.job-application-tab-steps';
    let nationalErrMsg = '{{trans('job-application.fill_at_least_one')}}';
    let eduErrMsg =  '{{trans('job-application.education_err')}}';
    let experienceErr =  '{{trans('job-application.experience_err')}}';
    let researchErr =  '{{trans('job-application.research_err')}}';
    let requiredMessage = '{!! __('labels.This field is required') !!}';
</script>

