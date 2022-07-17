{!! Form::model($publication, ['route' =>  ['research-re-initiated', $publication->id], 'class' => '', 'enctype' => 'multipart/form-data']) !!}
<div class="form-body">
    <h4 class="form-section"><i
                class="la la-briefcase"></i> {{trans('rms::research.research_publication_form')}}
    </h4>

    <div class="row">
        <div class="col-md-8 offset-2">
            <fieldset>
                <div class="form row">
                    {!! Form::hidden('auth_user_id', $auth_user_id) !!}
                    {{--{!! Form::hidden('research_request_id', $researchProposal->research_request_id) !!}--}}
                    {!! Form::hidden('research_id', $research->id) !!}
                    <div class="form-group mb-1 col-sm-12 col-md-12">
                        <label class="required">{{ trans('labels.title') }}</label>
                        <br>
                        {!! Form::text('title', $research->title, ['disabled' => true, 'class' => 'form-control required' . ($errors->has('title') ? ' is-invalid' : ''), 'data-msg-required' => Lang::get('labels.This field is required'), 'placeholder' => 'Title', 'data-rule-maxlength' => 100, 'data-msg-maxlength'=>Lang::get('labels.At most 100 characters')]) !!}

                        @if ($errors->has('title'))
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('title') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group mb-1 col-sm-12 col-md-12">
                        <label class="required">@lang('rms::research.research_publication_short_desc')</label>
                        <br>
                        {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
                        {{--<textarea class="form-control" name="description"></textarea>--}}
                        @if ($errors->has('description'))
                            <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $errors->first('description') }}</strong>
                                                                    </span>
                        @endif
                    </div>
                    {{--file repeater--}}
                    <div class="form-group mb-1 col-sm-12 col-md-12 file-repeater">
                        <div data-repeater-list="fileRepeater">

                            @if(isset($research->publication->attachments))
                                <div data-repeater-item style="display: none">
                                    <div class="row mb-1">
                                        <div class="col-9 col-xl-10">

                                            <input name="file" type="file" id="file" class="form-control">
                                            <span class="file-custom"></span>

                                        </div>
                                        <div class="col-2 col-xl-1">
                                            <button type="button" data-repeater-delete
                                                    class="btn btn-icon btn-danger mr-1">
                                                <i class="ft-x"></i></button>
                                        </div>
                                    </div>
                                </div>
                                @foreach($research->publication->attachments as $attachment)

                                    <div data-repeater-item>
                                        <input type="hidden" name="oldFiles[]" value="{{ $attachment->id }}"/>
                                        <div class="row mb-1">
                                            <div class="col-9 col-xl-10">
                                                <li class="list-group-item">
                                                    <a href="{{ route('file.download', ['filePath' => $attachment->path, 'displayName' => $research->title.'-publication.'.$attachment->ext]) }}"
                                                       class="badge bg-info white"
                                                       title="{{ $attachment->name }}">{{ $attachment->name  }}
                                                    </a><br>
                                                </li>
                                            </div>
                                            <div class="col-2 col-xl-1">
                                                <button type="button" data-repeater-delete=""
                                                        class="btn btn-icon btn-danger mr-1">
                                                    <i class="ft-x"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div data-repeater-item>
                                    <div class="row mb-1">
                                        <div class="col-9 col-xl-10">

                                            <input name="file" type="file" id="file" class="form-control">
                                            <span class="file-custom"></span>

                                        </div>
                                        <div class="col-2 col-xl-1">
                                            <button type="button" data-repeater-delete
                                                    class="btn btn-icon btn-danger mr-1">
                                                <i class="ft-x"></i></button>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <button type="button" data-repeater-create class="btn btn-primary">
                            <i class="ft-plus"></i> Add new file
                        </button>
                    </div>

                    <input type="hidden" name="type" id="type">
                </div>
            </fieldset>
        </div>
    </div>
</div>
<div class="form-actions">
    <div class="row">
        <div class="col-md-8 offset-2">
            <fieldset>
                <div class="form row">

                    <div class="form-group mb-1 col-sm-12 col-md-12">
                        <label class="">{{ trans('labels.message_to_receiver') }}</label>
                        <br>
                        {!! Form::textarea('message', null, ['class' => 'form-control',  'placeholder' => 'Message','rows'=>3]) !!}
                    </div>

                </div>
            </fieldset>
            <div class="form-group">
                {!! Form::button('<i class="la la-check-square-o"></i> '.trans('labels.submit') , ['type' => 'submit', 'class' => 'btn btn-primary', 'name' => 'type', 'value' => 'publish'] ) !!}

                <a class="btn btn-warning mr-1" role="button"
                   href="{{route('rms.index')}}">
                    <i class="ft-x"></i> {{trans('labels.cancel')}}
                </a>
            </div>
        </div>
    </div>


</div>
{!! Form::close() !!}

@push('page-js')

    <script src="{{ asset('theme/vendors/js/forms/repeater/jquery.repeater.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('theme/js/scripts/forms/form-repeater.js') }}" type="text/javascript"></script>
    <script>
        $('#add').click(function () {
            $('#repeat-attachments').append('<br><input type="file" class="form-control" name="attachments[]">');
        });

    </script>
@endpush