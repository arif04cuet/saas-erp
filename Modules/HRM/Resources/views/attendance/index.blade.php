@extends('hrm::layouts.master')
@section('title', trans('hrm::employee.attendance_list'))

@section('content')
    <section id="user-list">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{trans('hrm::employee.attendance_list')}}</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>


                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body card-dashboard">

                            <table class="table table-striped table-bordered alt-pagination">
                                <thead>
                                <tr>
                                    <th>{{trans('labels.serial')}}</th>
                                    <th>{{trans('hrm::department.department')}}</th>
                                    <th>{{trans('labels.status')}}</th>
                                    <th>{{trans('labels.date')}}</th>
                                    <th>{{trans('hrm::employee.in_time')}}</th>
                                    <th>{{trans('hrm::employee.out_time')}}</th>
                                    <th>{{trans('hrm::employee.working_hour')}}</th>
                                    <th>{{trans('labels.action')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                $dept = ['Human Resource', 'Project Management', 'Research Management', 'Business Development'];
                                @endphp
                                @foreach($period as $date)
                                    @php
                                        $status = in_array(date('w', strtotime($date->format('Y-m-d'))), [5,6]) ? 'Day Off' : 'Present';
                                    @endphp
                                    <tr>

                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <th>{{$dept[rand(0,3)]}}</th>
                                        <td><span class="{{$status == 'Day Off' ? 'badge bg-danger' : 'badge bg-success'}}">{{$status}}</span></td>
                                        <td>{{$date->format('d-m-Y')}}</td>
                                        <td>{{'9:'.rand(10,59) }} AM</td>
                                        <td>{{'6:'.rand(10,59)}} PM</td>
                                        <td>9:{{rand(10, 59)}}</td>
                                        <td>
                                            <span class="dropdown">
                                            <button id="btnSearchDrop2" type="button" data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false" class="btn btn-info dropdown-toggle"><i class="la la-cog"></i></button>
                                              <span aria-labelledby="btnSearchDrop2" class="dropdown-menu mt-1 dropdown-menu-right">
                                                <a href="" class="dropdown-item"><i class="ft-edit-2"></i> {{trans('labels.edit')}}</a>
                                                <div class="dropdown-divider"></div>
                                                  {!! Form::open([
                                                  'method'=>'DELETE',
                                                  'url' => [ '/', ],
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
    </section>
@endsection
@push('page-js')
    <script type="text/javascript">
        $(document).ready(function () {
            $('select').select2({
                placeholder: {
                    id: '', // the value of the option
                    text: '{{__("tms::training.select_training")}}'
                }
            });
        });
    </script>
@endpush
