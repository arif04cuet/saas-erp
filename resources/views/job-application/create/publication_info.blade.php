<div class="repeater-default">

    <div data-repeater-list="publication">
        {{--publicationError--}}
        @php
            $oldPublications = old();
        @endphp
        @if(isset($oldPublications['publication']) && count($oldPublications['publication'])>0)
            @foreach($oldPublications['publication'] as $key => $publication)

                <div data-repeater-item="">
                    <div class="row">
                        <div class=" col-md-10">

                            <div class="row">

                                @if($errors->publicationError->has('employee_id'))
                                    <div class="col-md-12">
                                        <div class="alert bg-danger alert-dismissible mb-2" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            {{$errors->publicationError->first('employee_id')}}
                                        </div>
                                    </div>
                                @endif


                                <div class="col-md-6">
                                    <div class="form-group {{ $errors->publicationError->has("publication.".$key.".type_of_publication") ? ' error' : '' }}">
                                        {{ Form::label('type_of_publication', trans('hrm::publication.type_of_publication'), ['class' => 'required']) }}
                                        {{ Form::text('type_of_publication', $publication['type_of_publication'],
                                        ['class' => 'form-control', 'placeholder' => 'eg. Newsletters, Journals, Bulletins,  Reports etc',
                                        'data-validation-required-message'=>trans('labels.This field is required')]) }}
                                        <div class="help-block"></div>
                                        @if ($errors->publicationError->has("publication.".$key.".type_of_publication"))
                                            <div class="help-block">  {{ trans('labels.This field is required') }}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group {{ $errors->publicationError->has("publication.".$key.".author_name") ? ' error' : '' }}">
                                        {{ Form::label('author_name', trans('hrm::publication.author_name'), ['class' => 'required']) }}
                                        {{ Form::text('author_name',  $publication['author_name'],
                                        ['class' => 'form-control', 'placeholder' => 'eg. John Doe',
                                        'data-validation-required-message'=>trans('labels.This field is required')]) }}
                                        <div class="help-block"></div>
                                        @if ($errors->publicationError->has("publication.".$key.".author_name"))
                                            <div class="help-block">  {{ trans('labels.This field is required') }}</div>
                                        @endif

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group {{ $errors->publicationError->has("publication.".$key.".publication_title") ? ' error' : '' }}">

                                        {{ Form::label('publication_title', trans('hrm::publication.publication_title'), ['class' => 'required']) }}
                                        {{ Form::text('publication_title', $publication['publication_title'],
                                        ['class' => 'form-control', 'placeholder' => 'Population Database of Mexico',
                                        'data-validation-required-message'=>trans('labels.This field is required')]) }}
                                        <div class="help-block"></div>
                                        @if ($errors->publicationError->has("publication.".$key.".publication_title"))
                                            <div class="help-block">  {{ trans('labels.This field is required') }}</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group {{ $errors->publicationError->has("publication.".$key.".publication_company") ? ' error' : '' }}">

                                        {{ Form::label('publication_company', trans('hrm::publication.publication_company'), ['class' => 'required']) }}
                                        {{ Form::text('publication_company',  $publication['publication_company'],
                                        ['class' => 'form-control', 'placeholder' => 'eg. IEEE',
                                        'data-validation-required-message'=>trans('labels.This field is required')]) }}
                                        <div class="help-block"></div>
                                        @if ($errors->publicationError->has("publication.".$key.".publication_company"))
                                            <div class="help-block">  {{ trans('labels.This field is required') }}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {{ Form::label('publication_company_location', trans('hrm::publication.publication_company_location')) }}
                                        {{ Form::text('publication_company_location',  $publication['publication_company_location'],
                                        ['class' => 'form-control', 'placeholder' => 'eg. NYC']) }}
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group {{ $errors->publicationError->has("publication.".$key.".published_date") ? ' error' : '' }}">

                                        {{ Form::label('published_date', trans('hrm::publication.published_date'), ['class' => 'required']) }}
                                        {{ Form::date('published_date',  $publication['published_date'],
                                        ['class' => 'form-control DatePicker', 'placeholder' => 'Pick the date', 'data-validation-required-message'=>trans('labels.This field is required')]) }}
                                        <div class="help-block"></div>
                                        @if ($errors->publicationError->has("publication.".$key.".published_date"))
                                            <div class="help-block">  {{ trans('labels.This field is required') }}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group {{ $errors->publicationError->has("publication.".$key.".source_link") ? ' error' : '' }}">

                                        {{ Form::label('source_link',  trans('hrm::publication.published_source_link'), ['class' => 'required']) }}
                                        {{ Form::text('source_link',  $publication['source_link'],
                                        ['class' => 'form-control', 'placeholder' => 'http://www.example.com/your-publication-link',
                                        'data-validation-required-message'=>trans('labels.This field is required')]) }}
                                        <div class="help-block"></div>
                                        @if ($errors->publicationError->has("publication.".$key.".source_link"))
                                            <div class="help-block">  {{ trans('labels.This field is required') }}</div>
                                        @endif
                                    </div>
                                </div>
                                {{ Form::hidden('employee_id', isset($publication['employee_id']) ? $publication['employee_id'] : null, ['class' =>'EmployeeId']) }}

                                <hr>

                            </div>
                        </div>
                        <div class=" col-md-2">
                            <div class="form-group col-sm-12 col-md-2 mt-2">
                                <button type="button" class="btn btn-danger" data-repeater-delete=""><i
                                            class="ft-x"></i>
                                    Remove
                                </button>
                            </div>
                        </div>

                    </div>
                    <hr style="border-bottom: 1px solid #1E9FF2">
                </div>
            @endforeach
        @else
            <div data-repeater-item="">
                <div class="row">
                    <div class=" col-md-10">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    {{ Form::label('type_of_publication', trans('hrm::publication.type_of_publication'), ['class' => 'required']) }}
                                    {{ Form::text('type_of_publication', null,
                                    ['class' => 'form-control', 'placeholder' => 'eg. Newsletters, Journals, Bulletins,  Reports etc',
                                    'data-validation-required-message'=> trans('labels.This field is required')]) }}
                                    <div class="help-block"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    {{ Form::label('author_name', trans('hrm::publication.author_name'), ['class' => 'required']) }}
                                    {{ Form::text('author_name',  null,
                                    ['class' => 'form-control', 'placeholder' => 'eg. John Doe',
                                    'data-validation-required-message'=>trans('labels.This field is required')]) }}
                                    <div class="help-block"></div>

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    {{ Form::label('publication_title', trans('hrm::publication.publication_title'), ['class' => 'required']) }}
                                    {{ Form::text('publication_title', null,
                                    ['class' => 'form-control', 'placeholder' => 'Population Database of Mexico',
                                    'data-validation-required-message'=>trans('labels.This field is required')]) }}
                                    <div class="help-block"></div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    {{ Form::label('publication_company', trans('hrm::publication.publication_company'), ['class' => 'required']) }}
                                    {{ Form::text('publication_company',  null,
                                    ['class' => 'form-control', 'placeholder' => 'eg. IEEE',
                                    'data-validation-required-message'=> trans('labels.This field is required')]) }}
                                    <div class="help-block"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    {{ Form::label('publication_company_location', trans('hrm::publication.publication_company_location')) }}
                                    {{ Form::text('publication_company_location',  null, ['class' => 'form-control', 'placeholder' => 'eg. NYC']) }}
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    {{ Form::label('published_date', trans('hrm::publication.published_date'), ['class' => 'required']) }}
                                    {{ Form::date('published_date',  null,
                                     [ 'class' => 'form-control DatePicker', 'placeholder' => 'Pick the date', 'data-validation-required-message'=>
                                     trans('labels.This field is required')]) }}
                                    <div class="help-block"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    {{ Form::label('source_link', trans('hrm::publication.published_source_link'), ['class' => 'required']) }}
                                    <input type="url" name="source_link" class="form-control" required
                                           placeholder = 'http://www.example.com/your-publication-link'
                                           data-validation-regex-regex = "{{config('constants.regex.url')}}"
                                           data-validation-regex-message="{{trans('labels.invalid_url')}}"
                                           data-validation-required-message = "{{trans('labels.This field is required')}}">
                                    <div class="help-block"></div>
                                </div>
                            </div>
                            {{ Form::hidden('employee_id', $employee_id, ['class' =>'EmployeeId']) }}

                            <hr>

                        </div>
                    </div>
                    <div class=" col-md-2">
                        <div class="form-group col-sm-12 col-md-2 mt-2">
                            <button type="button" class="btn btn-danger" data-repeater-delete=""><i
                                        class="ft-x"></i>
                                @lang('labels.remove')
                            </button>
                        </div>
                    </div>

                </div>
                <hr style="border-bottom: 1px solid #1E9FF2">
            </div>
        @endif
    </div>
    <div class="col-md-12">
        <button type="button" data-repeater-create="" class="btn btn-primary addMore"><i class="ft-plus"></i>
            @lang('labels.add_more')
        </button>
    </div>
    <div class="form-actions col-md-12 ">
        <div class="pull-right">
            {{ Form::button('<i class="la la-check-square-o"></i>'.trans('labels.save'), ['type' => 'submit', 'class' => 'btn btn-primary'] )  }}
            <a href="{{ url('/hrm/employee') }}">
                <button type="button" class="btn btn-warning mr-1">
                    <i class="la la-times"></i> @lang('labels.cancel')
                </button>
            </a>

        </div>

    </div>
</div>