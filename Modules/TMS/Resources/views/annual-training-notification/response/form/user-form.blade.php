{!! Form::open(['route' =>  'tms.annual-training-notification.response.user.store',
        'class' => 'form tms-annual-training-notification-response-form']) !!}

<!-- General Information -->
<h4 class="form-section"><i
        class="la la-tag"></i>
    @lang('accounts::accounts.general_information')
</h4>
<div class="col">
    <!-- User Name -->
    <div class="row">
        <div class="col-6">
            <div class="form-group">
                {!! Form::label('user_name',trans('labels.username'),
                    ['class' => 'form-label required'])
                !!}
                {!! Form::text('user_name',old('user_name') ?? $user->name ?? trans('labels.not_found'),
                [
                    'class' => "form-control",
                    'readonly',
                ]) !!}
            </div>
        </div>

        <!-- User Email -->
        <div class="col-6">
            <div class="form-group">
                {!!
                    Form::label('user_email', trans('labels.email_address'),
                                            ['class' => 'form-label'])
                !!}
                {{
                       Form::text('email', old('email') ?? $user->email ?? trans('labels.not_found'),
                       [
                            'class' => 'form-control',
                            'readonly'
                       ])
                }}
            </div>
        </div>
    </div>
</div>
<!--/General Information -->
{{Form::hidden('type',$type)}}
{{Form::hidden('annual_training_notification_id',$trainingNotificationId)}}
{{Form::hidden('user_id',$user->id)}}
<!-- Response Repeater -->
@include('tms::annual-training-notification.response.form.form-repeater')


<!-- Save & Cancel Button -->
<div class="form-actions text-center">
    <button type="submit" class="btn btn-success">
        <i class="la la-check-square-o"></i>@lang('labels.save')
    </button>
    <a class="btn btn-warning mr-1" role="button"
       href="{{route('annual-training-notification.show',$trainingNotificationId)}}">
        <i class="ft-x"></i> @lang('labels.cancel')
    </a>
</div>

{!! Form::close() !!}
