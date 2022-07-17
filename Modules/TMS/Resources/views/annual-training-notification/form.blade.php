@if($page == 'create')
    {!! Form::open(['route' => 'annual-training-notification.store', 'class' => 'form notification-form', 'novalidate', 'enctype' => 'multipart/form-data']) !!}
@else
    {!! Form::open(['route' => 'annual-training-notification.update', 'class' => 'form notification-form', 'novalidate', 'enctype' => 'multipart/form-data']) !!}
    @method('PUT')
@endif
<div class="form-body">
    <h4 class="form-section"><i
            class="ft-user"></i> @lang('tms::annual_training.create_notification') @lang('labels.form')</h4>
    <div class="row">
        <!-- Organizations -->
        <div class="col-md-6">
            <div class="form-group">
                <label for="type" class="form-label required">@lang('tms::annual_training.organization')</label>
                {!! Form::select('organizations[]', $organizations, ($page == 'create') ? old('organizations')
: $notification->organizations, ['class' => 'form-control select2', 'multiple',
'required', 'data-validation-required-message' => __('labels.This field is required')]) !!}
                <div class="help-block"></div>
                @if ($errors->has('organizations'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('organizations') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <!-- Years -->
        <div class="col-md-6">
            <div class="form-group">
                {!! Form::label('year', __('tms::annual_training.year'), ['class' => 'form-label required']) !!}
                {!! Form::select('year', $years, ($page == 'create') ? old('year') : $notification->year,
['class' => 'form-control', 'required', 'data-validation-required-message' => __('labels.This field is required')]) !!}
                <div class="help-block"></div>
                @if ($errors->has('year'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('year') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <!-- Note -->
        <div class="col-md-4">
            <div class="form-group">
                <label for="attachment" class="form-label">{{trans('tms::annual_training.attachment')}}</label>
                <input type='file' name="attachment" accept=".xls, .doc, .pdf, .docx" class="form-control"/>
                <div class="help-block"></div>
                @if ($errors->has('attachment'))
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('attachment') }}</strong>
                        </span>
                @endif
            </div>
        </div>

        <!-- Send Divisional Director -->
        <div class="col-md-2">
            <div class="form-group">
                {!! Form::label('send_to_divisional_director', __('tms::annual_training.send_dd'),
['class' => 'form-label']) !!}
                <div class="skin skin-flat">
                    {!! Form::checkbox('send_to_divisional_director', true, ($page == 'create') ?
old('send_to_divisional_director') : $notification->send_to_divisional_director, ['class' => 'form-control']) !!}
                    <div class="help-block"></div>

                </div>
            </div>
        </div>

        <!-- Note -->
        <div class="col-md-6">
            <div class="form-group">
                <label for="note" class="form-label required">@lang('tms::annual_training.note')</label>
                <textarea id="note" name="note" class="form-control" rows="3" required maxlength="250"
                          data-validation-required-message="{{__('labels.This field is required')}}"></textarea>
                <div class="help-block"></div>
                @if ($errors->has('note'))
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('note') }}</strong>
                </span>
                @endif
            </div>
        </div>

        <!-- Email Body -->
        <div class="col-md-12">
            <div class="form-group">
                <label for="note" class="form-label required">@lang('tms::annual_training.email_body')</label>
                <textarea id="email_content" name="email_content" class="tinymce" rows="3" required
                          data-validation-required-message="{{__('labels.This field is required')}}">{{old('email_content') ?? "" }}</textarea>
                <div class="help-block"></div>
                @if ($errors->has('email_content'))
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('email_content') }}</strong>
                </span>
                @endif
            </div>
        </div>
    </div>
    <div class="form-actions">
        <button type="submit" class="btn btn-success">
            <i class="ft-check-square"></i> {{trans('labels.save')}}
        </button>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-backdrop="false" id="preview_button"
                data-target="#preview-modal">
            <i class="ft ft-monitor"></i>
            @lang('tms::annual_training.preview_button')
        </button>
        <button class="btn btn-warning" type="button"
                onclick="window.location = '{{route('annual-training-notification.index')}}'">
            <i class="ft-x"></i> {{trans('labels.cancel')}}
        </button>
    </div>
</div>
{!! Form::close() !!}

<!-- Email Preview Modal -->
<div class="modal fade text-left" id="preview-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel16"
     aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title white" id="myModalLabel16">
                    <i class="ft ft-monitor"></i>
                    @lang('tms::annual_training.preview')
                </h4>
                <button type="button" class="close white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @include('tms::annual-training-notification.preview', [
'url' => route('annual-training-notification.response.organization.create', 'unique-key'),
'lastDayOfResponse' => \Carbon\Carbon::parse()->format('d F, Y')
])
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal" id="preview_edit">
                    <i class="ft ft-x-square"></i> @lang('labels.edit')
                </button>
                <button type="button" class="btn btn-warning" data-dismiss="modal">
                    <i class="ft ft-x-square"></i> @lang('labels.cancel')
                </button>
            </div>
        </div>
    </div>
</div>
<!-- Modal End -->

@push('page-js')
    <script>
        $('.notification-form').submit(function () {
            return confirm("{{__("tms::annual_training.confirmation")}}");
        });

        $(document).ready(function () {
            $fiscalStart = "{{\Carbon\Carbon::parse()->format('Y')}}";
            $fiscalEnd = "{{\Carbon\Carbon::parse('next year')->format('Y')}}";
            $responseDate = "{{\Carbon\Carbon::parse()->addDays(7)->format('d F, Y')}}";
            $("#start_year").html($fiscalStart);
            $("#end_year").html($fiscalEnd);
            $("#response_date").html($responseDate);

            $('#email_content').html($('#preview_email_content').html());
        });

        $("#preview_button").on('click', function () {
            let emailContent = tinyMCE.activeEditor.getContent();
            $('#preview_email_content').html(emailContent);
            $fiscalYear = ($("#year").val()).split("-");
            $("#start_year").html($fiscalYear[0]);
            $("#end_year").html($fiscalYear[1]);

        });

        $("#year").on('change', function () {
            $('#preview_email_content').html(tinyMCE.activeEditor.getContent());
            $fiscalYear = ($("#year").val()).split("-");
            $("#start_year").html($fiscalYear[0]);
            $("#end_year").html($fiscalYear[1]);
            tinymce.activeEditor.setContent($('#preview_email_content').html());
        });

        $('#preview_edit').click(function () {
            setTimeout('try{tinymce.activeEditor.focus()}catch(e){}', 1000)
        });

    </script>
@endpush
