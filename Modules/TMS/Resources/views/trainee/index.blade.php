@extends('tms::layouts.master')
@section('title', trans('tms::training.trainee_card_title'))

@section('content')
    <section id="user-list">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title bg-info pt-1 pb-1">
                                <span class="card-title-sub-text pl-1 pr-1 text-white">
                                    <i class="las la-list-alt black"></i> {{ trans('tms::training.trainee_card_title')}}:
                                </span>
                                <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                                @if (!empty($selectedTrainingId))
                                    <a
                                        href="{{ Auth::user()->can('tms-access-medical') ? '' : route('training.show', ['training' => $training]) }}">
                                        <b class="card-title-text text-white pl-1 pr-1"> {{ $training->title }}
                                            ({{ $training->uid }})
                                        </b> </a>
                                @endif
                            </h4>
                        </div>
    
                        <div class="card-content collapse show">
                            <div class="card-body card-dashboard">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <select class="form-control training-filter"
                                                    onchange="location = this.options[this.selectedIndex].value;">
                                                    <option></option>
                                                    @foreach ($trainings as $key => $training)
                                                        <option {{ $selectedTrainingId == $training->id ? 'selected' : '' }}
                                                            value="{{ Auth::user()->can('tms-access-medical') ? route('medical.trainee.search.index', $training->id) : route('trainee.index', $training->id) }}">
                                                            <span> {{ $training->title }} </span>
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-7">
                                            <div class="heading-elements float-right">
                                                {{-- @if (!Auth::user()->can('tms-access-medical')) --}}
                                                {{-- <a href="{{ route('training.create') }}" class="btn btn-primary btn-sm"><i
                                                        class="ft-plus white"></i> {{ trans('tms::training.training_create') }}</a> --}}
                                                @if (!empty($selectedTrainingId))
                                                    <a href="{{ route('trainee.add', $selectedTrainingId) }}"
                                                        class="btn btn-info btn-sm">
                                                        <i class="ft-plus white"></i>
                                                        {{ trans('tms::training.add_trainee') }}
                                                    </a>
                                                    <a href="{{ route('trainee.import.index', $selectedTrainingId) }}"
                                                        class="btn btn-info btn-sm">
                                                        <i class="ft-plus white"></i>
                                                        {{ trans('tms::training.trainee_import') }}
                                                    </a>
                                                    <a href="{{ route('trainings.schedules.sessions.index', ['training' => $selectedTrainingId]) }}"
                                                        class="btn btn-info btn-sm">@lang('tms::schedule.session.title')</a>
                                                @endif
                                                {{-- @endif --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div style="overflow-x:auto">
                                    <table class="master table table-striped table-bordered alt-pagination" id="Example1">
                                        <thead>
                                            <tr>
                                                <th>{{ trans('labels.serial') }}</th>
                                                <th>{{ trans('tms::training.trainee_name') }}</th>
                                                <th>{{ trans('tms::trainee.designation') }}</th>
                                                <th>{{ trans('tms::training.service_code') }}</th>
                                                <th>{{ trans('tms::training.trainee_gender') }}</th>
                                                <th>{{ trans('labels.mobile') }}</th>
                                                <th>{{ trans('tms::training.email') }}</th>
                                                <th>@lang('labels.action')</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (isset($trainees))
                                                @foreach ($trainees as $key => $trainee)
                                                    <tr>
                                                        <th scope="row">{{ $loop->iteration }}</th>
                                                        <td>
                                                            <a
                                                                href="{{ Auth::user()->can('tms-access-medical') ? route('medical.trainee.show', $trainee->id) : route('trainee.show', $trainee->id) }}">
                                                                {{ $trainee[trans('tms::trainee.name_locale')] }}
                                                            </a>
                                                        </td>
                                                        <td>
                                                            @if (session()->get('locale') === 'bn')
                                                                {{ optional($trainee->services)->designation_bn }}
                                                            @else
                                                                {{ optional($trainee->services)->designation }}
                                                            @endif
                                                        </td>
                                                        <td>{{ optional($trainee->services)->service_code }}</td>
                                                        <td>{{ trans('labels.' . strtolower($trainee['trainee_gender'])) }}
                                                        </td>
                                                        <td>{{ $trainee['mobile'] }}</td>
                                                        <td>{{ $trainee['email'] }}</td>
                                                        <td class="text-center">
                                                            <div class="btn-group">
                                                                <!-- Details -->
                                                                <a href="{{ Auth::user()->can('tms-access-medical') ? route('trainee.show', $trainee->id) : route('trainee.show', $trainee->id) }}"
                                                                    class="master btn btn-success" title="{{ trans('labels.details') }}">
                                                                    <i class="ft-eye white"></i>
                                                                    {{-- {{ trans('labels.details') }} --}}
                                                                </a>
                                                                <!-- Edit -->
                                                                {{-- @if (!Auth::user()->can('tms-access-medical')) --}}
                                                                    <a href="{{ route('trainee.edit', $trainee->id) }}"
                                                                        class="btn btn-success master" title="{{ trans('labels.edit') }}"><i
                                                                            class="ft-edit-2 white"></i>
                                                                        {{-- {{ trans('labels.edit') }} --}}
                                                                    </a>
                                                                {{-- @endif --}}
                                                                <!--- print -->
                                                                <a href="{{ route('trainees.print', $trainee) }}"
                                                                    class="master btn btn-info" title="{{ trans('labels.print') }}"><i class="ft-printer"></i>
                                                                    {{-- {{ trans('labels.print') }} --}}
                                                                </a>
                                                                <a href="#" class="master btn btn-danger"
                                                                    onclick="delete_form{{ $key }}.submit()" title="{{ trans('labels.delete') }}">
                                                                    <i class="la la-trash-o white"></i>
                                                                </a>
                                                                <!-- delete -->
                                                                {{-- <div class="dropdown-divider"></div> --}}
                                                                {!! Form::open([
                                                                    'method' => 'DELETE',
                                                                    'url' => route('trainee.delete', $trainee->id),
                                                                    'style' => 'display:inline',
                                                                    'id' => 'delete_form' . $key,
                                                                ]) !!}
    
                                                                {!! Form::close() !!}
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                        </tbody>
                                    </table>
    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </section>
@endsection
@push('page-js')
    <script type="text/javascript">
        $(document).ready(function() {
            $('select').select2({
                placeholder: {
                    id: '', // the value of the option
                    text: '{{ __('tms::training.select_training') }}'
                }
            });

            let training = $('.card-title-text').html();
            let title = $('.card-title-sub-text').html();
            let text = training + title;


            // table export configuration
            $('#Example1').DataTable({
                dom: 'Bfrtip',
                buttons: [{
                        extend: 'csv',
                        className: 'csv',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6],
                        },
                        bom: true,
                        charset: 'utf-8',
                        extension: '.csv',
                    },
                    {
                        extend: 'excel',
                        className: 'excel',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6],
                        },
                        customize: function(xlsx) {

                            var sheet = xlsx.xl.worksheets['sheet1.xml'];
                            let colmn = $('c[r=A1] t', sheet).html(text);

                        }
                    },
                ],
                paging: true,
                searching: true,
                "bDestroy": true,

            });
        });
    </script>
@endpush
