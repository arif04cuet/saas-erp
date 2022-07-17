@extends('tms::layouts.master')
@section('title', trans('tms::venue.title.index'))

@section('content')
    <section id="user-list">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="form-section"><i class="ft-user black"></i>
                                @lang('tms::venue.title.index')
                            </h4>
                        </div>
                        <div class="card-content collapse show">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-body">
                                            @include('tms::venue.partials.create_form')
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="table-responsive">
                                            <table class="master table table-striped table-bordered venue-table" style="width: 100%">
                                                <thead>
                                                <tr>
                                                    <th width="10px">{{ trans('labels.serial') }}</th>
                                                    <th>{{ trans('tms::venue.th.name') }}</th>
                                                    <th class="text-center">{{ trans('labels.action') }} </th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($venues as $key => $venue)
                                                    <tr>
                                                        <td scope="row">{{ $loop->iteration }}</td>
                                                        <td>{{ App::isLocale('bn') ? $venue->title_bn:$venue->title }}</td>
                                                        {{-- <td class="text-center">
                                                            <span class="dropdown">
                                                                <button id="imsRequestList" type="button" data-toggle="dropdown"
                                                                        aria-haspopup="true" aria-expanded="false"
                                                                        class="btn btn-info dropdown-toggle">
                                                                    <i class="la la-cog"></i>
                                                                </button>
                                                                    <span aria-labelledby="imsRequestList" class="dropdown-menu mt-1 dropdown-menu-right">
                                                                        <a href="{{ route('venue.edit',  $venue) }}"
                                                                            class="dropdown-item">
                                                                            <i class="ft-edit-2"></i> {{ trans('labels.edit') }}
                                                                        </a>
            
                                                                        <div class="dropdown-divider"></div>
                                                                        <a href="{{ route('venue.show', $venue) }}"
                                                                        class="dropdown-item">
                                                                            <i class="ft-eye"></i> {{trans('labels.details')}}
                                                                        </a>
                                                                        <div class="dropdown-divider"></div>
                                                                        {!! Form::open([
                                                                            'method'=>'DELETE',
                                                                            'url' => route('venue.destroy',$venue->id),
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
                                                                <a href="{{ route('venue.show', $venue) }}" class="master btn btn-info" title="{{trans('labels.details')}}">
                                                                    <i class="ft-eye white"></i>
                                                                </a>
                                                                <a href="{{ route('venue.edit', $venue) }}" class="master btn btn-success" title="{{trans('labels.edit')}}">
                                                                    <i class="ft-edit white"></i>
                                                                </a>
                                                                <a href="#" class="master btn btn-danger"
                                                                    onclick="delete_form{{ $key }}.submit()" title="{{ trans('labels.delete') }}">
                                                                    <i class="la la-trash-o white"></i>
                                                                </a>
                                                                <!-- delete -->
                                                                {!! Form::open([
                                                                    'method' => 'DELETE',
                                                                    'url' => route('venue.destroy',$venue->id),
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
        let table = $('.venue-table').DataTable({});
    </script>
@endpush
