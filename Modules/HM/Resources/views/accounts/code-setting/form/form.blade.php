@if(!old('code_settings')->isEmpty())
    @include('hm::accounts.code-setting.form.old-form-repeater')
@else
    @include('hm::accounts.code-setting.form.form-repeater')
@endif

<!-- Save & Cancel Button -->
<div class="form-actions text-center">
    <button type="submit" class="master btn btn-success">
        <i class="la la-check-square-o"></i>@lang('labels.save')
    </button>
    <a class="master btn btn-warning mr-1" role="button" href="{{route('check-in.create-options')}}">
        <i class="ft-x"></i> @lang('labels.cancel')
    </a>
</div>


