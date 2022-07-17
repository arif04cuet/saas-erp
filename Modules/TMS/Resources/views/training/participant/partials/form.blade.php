@if($page == 'create')
    {!! Form::open([
        'route' => 'trainee-type.store',
        'class' => 'form training-organization-form',
        'novalidate', 'method' => 'post'])
    !!}
@else
    {!! Form::open([
    'route' => ['trainee-type.update', $participant->id],
    'class' => 'form training-organization-form',
    'novalidate', 'method' => 'put'])
    !!}
@endif
@if($page == 'create')
    @php echo '<fieldset>'; @endphp
@endif
<div class="form-body">
    <div class="row">
        <!-- title -->
        <div class="col-md-6">
            <div class="form-group">
                <label for="name" class="form-label required">
                    {{trans('tms::training.participant_title')}}
                </label>

                {{ Form::text('title',
                $page == 'create' ? null : $participant->title,
                [
                    'class' => 'form-control form-control-sm',
                    'placeholder' => '',
                    'required' => 'required',
                    'data-msg-required' => trans('labels.This field is required'),
                    'data-rule-minlength' => 3,
                    'data-msg-minlength'=> trans('labels.At least 3 characters'),
                    'data-rule-maxlength' => 100,
                    'data-msg-maxlength'=> trans('labels.At most 100 characters'),
                ])
                }}
                <div class="help-block"></div>
                @if ($errors->has('title'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('title') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <!-- bangla title -->
        <div class="col-md-6">
            <div class="form-group">
                <label for="bangla_title" class="form-label required">
                    {{trans('tms::training.participant_bangla_title')}}
                </label>

                {{ Form::text('bangla_title',
                $page == 'create' ? null : $participant->bangla_title ?? null,
                [
                    'class' => 'form-control form-control-sm',
                    'placeholder' => '',
                    'required' => 'required',
                    'data-msg-required' => trans('labels.This field is required'),
                    'data-rule-minlength' => 3,
                    'data-msg-minlength'=> trans('labels.At least 3 characters'),
                    'data-rule-maxlength' => 100,
                    'data-msg-maxlength'=> trans('labels.At most 100 characters'),
                ])
                }}
                <div class="help-block"></div>
                @if ($errors->has('bangla_title'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('bangla_title') }}</strong>
                    </span>
                @endif
            </div>
        </div>
    </div>
</div>
<div class="form-actions mb-lg-3">
    <button type="submit" class="master btn btn-primary">
        <i class="la la-check-square-o"></i> {{trans('labels.save')}}
    </button>
    @if($page == 'edit')
        @include('tms::venue.partials.buttons.cancel',['route_name'=>'trainee-type.index','id'=>null])
    @endif
</div>
@if($page == 'create')
@php echo '</fieldset>'; @endphp
@endif
{!! Form::close() !!}
