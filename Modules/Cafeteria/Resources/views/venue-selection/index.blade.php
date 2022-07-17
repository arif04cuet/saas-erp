@extends('cafeteria::layouts.master')
@section('title', trans('cafeteria::venue-selection.title'))


@section('content')
<section id="role-list">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                {!! Form::open(['route' =>  'venue-selections.index','class' => 'form', 'method' => 'get']) !!}
                <h4 class="form-section"><i class="la la-tag"></i>@lang('cafeteria::venue-selection.title')</h4>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                {!! Form::label('Start Date',
                                        trans('cafeteria::venue-selection.start_date'),
                                        ['class' => 'form-label ']) !!}
                    
                                {!! Form::date('start_date', app('request')->input('start_date') ?? date('Y-m-d'),
                                        [ 'class'=>'form-control start-date',
                                        'placeholder'=>trans('labels.all')])  !!}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                {!! Form::label('End Date',
                                        trans('cafeteria::venue-selection.end_date'),
                                        ['class' => 'form-label ']) !!}
                    
                                {!! Form::text('end_date', app('request')->input('end_date') ?? date('Y-m-d'),
                                        [ 'class'=>'form-control end-date',
                                        'placeholder'=>trans('labels.all')])  !!}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <div style="margin-top: 2rem !important">
                                    <!-- Search Button -->
                                    <button type="submit" class="ft ft-search btn btn-success">
                                        @lang('cafeteria::cafeteria.search')
                                    </button>
                                    <a class="ft ft-refresh-ccw btn btn-warning" href="{{ route('venue-selections.index')}}">
                                        @lang('cafeteria::venue-selection.refresh')
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    {!! Form::close() !!}
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                    <div class="heading-elements">
                        <a href="{{route('venue-selections.create')}}" class="btn btn-primary btn-sm"><i
                                class="ft-plus white"></i> {{ trans('cafeteria::venue-selection.create') }}
                        </a>
                    </div>
                </div>

                <div class="card-content collapse show">
                    <div class="card-body card-dashboard">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered alt-pagination" id="Example1">
                                <thead>
                                    <tr>
                                        <th>{{trans('labels.serial')}}</th>
                                        <th>{{trans('cafeteria::venue-selection.selection_date')}}</th>
                                        <th>{{trans('cafeteria::venue-selection.venue')}}</th>
                                        <th>{{trans('cafeteria::venue-selection.training')}}</th>
                                        <th>{{trans('cafeteria::venue-selection.food_type')}}</th>
                                        <th>{{trans('cafeteria::venue-selection.total_trainee')}}</th>
                                        <th>{{trans('labels.remarks')}}</th>
                                        <th>{{trans('labels.action')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($venues as $venue)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>
                                            {{ $venue->selection_date }}
                                        </td>
                                        <td>
                                            @if (app()->getLocale('en'))
                                                {{ $venue->venue->name_en }}
                                            @else 
                                                {{ $venue->venue->name_bn }}    
                                            @endif
                                        </td>
                                        <td>
                                            {{ $venue->training->title }}
                                        </td>
                                        <td>
                                            {{ $venue->food_type }}
                                        </td>
                                        <td>
                                            {{ $venue->total_trainee }}
                                        </td>
                                        <td>
                                            {{ $venue->remark }}
                                        </td>
                                        <td>
                                            <a href="{{ route('venue-selections.edit', $venue->id) }}"
                                                class="btn btn-primary btn-sm">
                                                <i class="la la-pencil-square"></i>
                                            </a>
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
</section>
@endsection
@push('page-css')
<!-- date-picker css -->
<link rel="stylesheet" href="{{  asset('theme/vendors/css/pickers/pickadate/pickadate.css') }}">
<link rel="stylesheet" href="{{ asset('theme/vendors/css/pickers/daterange/daterangepicker.css')  }}">
<link rel="stylesheet" href="{{ asset('theme/css/plugins/pickers/daterange/daterange.css')  }}">
@endpush

@push('page-js')
<!-- pickadate -->
<script src="{{ asset('theme/vendors/js/pickers/pickadate/picker.js') }}"></script>
<script src="{{ asset('theme/vendors/js/pickers/pickadate/picker.date.js') }}"></script>
<script>
    /**date picker init*/
    $('input[name=start_date], input[name=end_date]').pickadate({
            format: 'yyyy-mm-dd',
            drops: 'up',
        });
</script>
@endpush