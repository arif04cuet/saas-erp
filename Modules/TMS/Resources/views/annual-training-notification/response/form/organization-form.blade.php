{!! Form::open(['route' =>  'annual-training-notification.response.organization.store',
        'class' => 'form tms-annual-training-notification-response-form']) !!}

<!-- General Information -->
<h4 class="form-section"><i
        class="la la-tag"></i>
    @lang('accounts::accounts.general_information')
</h4>
<div class="col">
    <!-- Organization Name -->
    <div class="row">
        <div class="col-6">
            <div class="form-group">
                {!! Form::label('organization',trans('tms::annual_training.response.form_elements.organization'),
                    ['class' => 'form-label'])
                !!}
                {!! Form::text('organization',old('organization') ?? $organization->organization->name,
                [
                    'class' => "form-control",
                    'readonly',
                ]) !!}
                <div class="help-block"></div>
                <!-- error message -->
                @if ($errors->has('organization'))
                    <div class="help-block text-danger">
                        {{ $errors->first('organization') }}
                    </div>
                @endif
            </div>
        </div>

        <!-- Email -->
        <div class="col-6">
            <div class="form-group">
                {!!
                    Form::label('email', trans('labels.email_address'),
                                            ['class' => 'form-label'])
                !!}
                {{
                       Form::text('email', old('email') ?? $organization->organization->contact_person_email,
                       [
                            'class' => 'form-control',
                            'readonly'
                       ])
                }}
            </div>
            <!-- error message -->
            @if ($errors->has('email'))
                <div class="help-block text-danger">
                    {{ $errors->first('email') }}
                </div>
            @endif
        </div>
    </div>
</div>
<!--/General Information -->
{{Form::hidden('annual_training_notification_organization_id',$organization->id)}}
{{Form::hidden('annual_training_notification_id',$trainingNotificationId)}}
{{Form::hidden('type',$type)}}
{{Form::hidden('unique_key',$uniqueKey)}}
<!-- Response Repeater -->
@include('tms::annual-training-notification.response.form.form-repeater')


<!-- Save & Cancel Button -->
<div class="form-actions text-center">
    <button type="submit" class="btn btn-success">
        <i class="la la-check-square-o"></i>@lang('labels.save')
    </button>
    @if(\Illuminate\Support\Facades\Auth::user())
        <a class="btn btn-warning mr-1" role="button"
           href="{{route('annual-training-notification.show',$trainingNotificationId)}}">
            <i class="ft-x"></i> @lang('labels.cancel')
        </a>
    @else
        <a class="btn btn-warning mr-1" role="button" href="{{route('home')}}">
            <i class="ft-x"></i> @lang('labels.cancel')
        </a>
    @endif

</div>

{!! Form::close() !!}
