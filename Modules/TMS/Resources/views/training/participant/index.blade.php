@extends('tms::layouts.master')
@section('title', trans('tms::trainee_type.title'))

@section('content')
    <section id="user-list">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title" id="basic-layout-form"><i class="ft-user black"></i> @lang('tms::trainee_type.title')</h4>
                            <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                            <div class="heading-elements">
                                <ul class="list-inline mb-0">
                                    <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                    <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                    <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-content collapse show">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                        @include('tms::training.participant.partials.form', ['page' => 'create'])
                                    </div>
                                    <div class="col-6">
                                        <div class="table-responsive">
                                            <table class="master table table-striped table-bordered alt-pagination">
                                                <thead>
                                                <tr>
                                                    <th width="10px">{{ trans('labels.serial') }}</th>
                                                    <th>{{ trans('labels.name') }}</th>
                                                    <th class="text-center">{{ trans('labels.action') }} </th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($trainingParticipants as $key => $trainingParticipant)
                                                    <tr>
                                                        <td scope="row">{{ $loop->iteration }}</td>
                                                        <td>
                                                            <a href="{{ route('trainee-type.show', $trainingParticipant->id) }}">
                                                                {{ $trainingParticipant->title ?? trans('labels.not_found') }}
                                                            </a>
                                                        </td>
                                                        {{-- <td class="text-center">
                                                            <span class="dropdown">
                                                                <button id="imsRequestList" type="button" data-toggle="dropdown"
                                                                        aria-haspopup="true" aria-expanded="false"
                                                                        class="btn btn-info dropdown-toggle">
                                                                    <i class="la la-cog"></i>
                                                                </button>
                                                                    <span aria-labelledby="imsRequestList" class="dropdown-menu mt-1 dropdown-menu-right">
                                                                        <a href="{{ route('trainee-type.edit',  $trainingParticipant) }}"
                                                                            class="dropdown-item">
                                                                            <i class="ft-edit-2"></i> {{ trans('labels.edit') }}
                                                                        </a>
            
                                                                        <div class="dropdown-divider"></div>
                                                                        <a href="{{ route('trainee-type.show', $trainingParticipant) }}"
                                                                        class="dropdown-item">
                                                                            <i class="ft-eye"></i> {{trans('labels.details')}}
                                                                        </a>
                                                                        <div class="dropdown-divider"></div>
                                                                        {!! Form::open([
                                                                            'method'=>'DELETE',
                                                                            'url' => route('trainee-type.delete',$trainingParticipant->id),
                                                                            'style' => 'display:inline'
                                                                            ]) !!}
                                                                            {!! Form::button('<i class="ft-trash"></i> '.trans('labels.delete'), array(
                                                                            'type' => 'submit',
                                                                            'class' => 'dropdown-item',
                                                                            'title' => 'Delete the user',
                                                                            'onclick'=>'return confirm("Confirm delete?")',
                                                                            )) !!}
                                                                            {!! Form::close() !!}
                                                                    </span>
                                                            </span>
                                                        </td> --}}
                                                        <td class="text-center">
                                                            <div class="btn-group">
                                                                <a href="{{ route('trainee-type.show', $trainingParticipant) }}" class="master btn btn-info" title="{{trans('labels.details')}}">
                                                                    <i class="ft-eye white"></i>
                                                                </a>
                                                                <a href="{{ route('trainee-type.edit', $trainingParticipant) }}" class="master btn btn-success" title="{{trans('labels.edit')}}">
                                                                    <i class="ft-edit white"></i>
                                                                </a>
                                                                <a href="#" class="master btn btn-danger"
                                                                    onclick="delete_form{{ $key }}.submit()" title="{{ trans('labels.delete') }}">
                                                                    <i class="la la-trash-o white"></i>
                                                                </a>
                                                                <!-- delete -->
                                                                {!! Form::open([
                                                                    'method' => 'DELETE',
                                                                    'url' => route('trainee-type.delete',$trainingParticipant->id),
                                                                    'style' => 'display:inline',
                                                                    'id' => 'delete_form' . $key,
                                                                    'onclick'=>'return confirm("Confirm delete?")',
                                                                ]) !!}

                                                                {!! Form::close() !!}
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('page-css')
    <link rel="stylesheet" href="{{ asset('theme/vendors/css/forms/icheck/icheck.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/css/plugins/forms/checkboxes-radios.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/vendors/css/pickers/pickadate/pickadate.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/vendors/css/pickers/daterange/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/css/plugins/pickers/daterange/daterange.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
@endpush

@push('page-js')
    <script src="{{ asset('theme/vendors/js/pickers/pickadate/picker.js')  }}"></script>
    <script src="{{ asset('theme/vendors/js/pickers/pickadate/picker.date.js') }}"></script>
    <script src="{{ asset('theme/vendors/js/forms/icheck/icheck.min.js') }}"></script>
    <script src="{{ asset('theme/js/scripts/forms/checkbox-radio.js') }}"></script>
    <script type="text/javascript" src="{{ asset('theme/vendors/js/forms/validation/jquery.validate.min.js') }}"></script>

    <script>

        $(document).ready(function () {
            let table = $('.training-organization-table').DataTable({
                scrollX:        true,
                scrollCollapse: true,
                responsive: true,
            });

            $('#filter-select').on('change', function () {
                table.draw();
            });
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function () {

            $("input,select,textarea").not("[type=submit]").jqBootstrapValidation("destroy");
            $('select').select2({
                placeholder: '{{ trans('labels.select') }}'
            });

            // datepicker
            $('#deadline_date').pickadate({
                min: new Date(),
                max: 365*17,
                default: new Date(),
            });


            let validator = $('.training-organization-form').validate({
                ignore: [],
                errorClass: 'danger',
                successClass: 'success',
                highlight: function (element, errorClass) {
                    $(element).removeClass(errorClass);
                },
                unhighlight: function (element, errorClass) {
                    $(element).removeClass(errorClass);
                },
                errorPlacement: function (error, element) {
                    if (element.attr('type') == 'radio') {
                        error.insertBefore(element.parents().siblings('.radio-error'));
                    } else if (element[0].tagName == "SELECT") {
                        error.insertAfter(element.siblings('.select2-container'));
                    } else if (element.attr('id') == 'ckeditor') {
                        error.insertAfter(element.siblings('#cke_ckeditor'));
                    } else {
                        error.insertAfter(element);
                    }
                },
                rules: {},
                submitHandler: function (form, event) {
                    form.submit();
                }
            });
        });
    </script>
@endpush
