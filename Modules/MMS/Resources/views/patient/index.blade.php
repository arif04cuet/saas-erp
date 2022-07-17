@extends('mms::layouts.master')
@section('title', trans('mms::patient.title'))

@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">@lang('mms::patient.list')</h4>
                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                <div class="heading-elements">
                    <a href="{{route('patients.create')}}" class="btn btn-primary btn-sm"><i
                            class="ft-plus white"></i> {{ trans('mms::patient.registration') }}
                    </a>
                </div>
            </div>
            <div class="card-content ">
                <div class="card-body card-dashboard">
                    <div class="table-responsive">
                        <table class="patient-list-table table table-bordered">
                            <thead>
                            <tr>
                                <th width="1%">{{ trans('labels.serial') }}</th>
                                <th>@lang('mms::patient.id')</th>
                                <th>@lang('labels.name')</th>
                                <th>@lang('mms::patient.age')</th>
                                <th>@lang('mms::patient.mobile')</th>
                                <th>@lang('mms::patient.gender')</th>
                                <th>@lang('mms::patient.type.title')</th>
                                <th width="2%">@lang('labels.action')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($patients as $patient)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $patient->patient_id }}</td>
                                    <td>{{ $patient->name }}</td>
                                    <td>{{ $patient->age }}</td>
                                    <td>{{ $patient->mobile_no }}</td>
                                    <td>{{ $patient->gender }}</td>
                                    <td>

                                        @lang("mms::patient.type.$patient->type")
                                    </td>
                                    <td>
                                    <span class="dropdown">
                                        <button id="imsRequestList" type="button" data-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="false"
                                                class="btn btn-info dropdown-toggle">
                                            <i class="la la-cog"></i>
                                        </button>
                                        <span aria-labelledby="imsRequestList"
                                              class="dropdown-menu mt-1 dropdown-menu-right">
                                            <a href="{{ route('patients.show', $patient->id) }}"
                                               class="dropdown-item"><i class="ft-eye"></i> @lang('labels.details')</a>
                                            <div class="dropdown-divider"></div>
                                                <a href="{{ route('patients.edit', $patient->id) }}"
                                                   class="dropdown-item"><i class="ft-edit-2"></i> @lang('labels.edit')</a>
                                           <div class="dropdown-divider"></div>
                                                    {!! Form::open([
                                                        'method'=>'DELETE',
                                                        'url' => route('patients.delete', $patient->id),
                                                        'style' => 'display:inline'
                                                    ]) !!}
                                            {!! Form::button('<i class="ft-trash"></i>'.trans('labels.delete'), array(
                                                'type' => 'submit',
                                                'class' => 'dropdown-item',
                                                'title' => 'Delete the patients',
                                                'onclick'=>'return confirm("Confirm delete?")',
                                            )) !!}
                                            {!! Form::close() !!}

                                        </span>
                                    </span>
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
@endsection

@push('page-js')
    <script type="text/javascript">
        $(document).ready(function () {
            $('.patient-list-table').DataTable({
                //    'stateSave' : true
            });
        });
    </script>
@endpush
