@extends('hrm::layouts.master')
@section('title', trans('hrm::employee.training_list'))

@section('content')
    <section id="user-list">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{trans('tms::training.trainee_card_title')}}</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>


                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body card-dashboard">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <select class="form-control" onchange="location = this.options[this.selectedIndex].value;">
                                                <option></option>
                                                @foreach($trainings as $key=>$training)
                                                    <option {{$selectedTrainingId == $training->id ? 'selected' : ''}} value="{{route('employee-training.list', $training->id)}}">{{$training->training_title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <table class="table table-striped table-bordered alt-pagination">
                                <thead>
                                <tr>
                                    <th>{{trans('labels.serial')}}</th>
                                    <th>{{trans('tms::training.training_id')}}</th>
                                    <th>{{trans('tms::training.trainee_name')}}</th>
                                    <th>{{trans('tms::training.trainee_gender')}}</th>
                                    <th>{{trans('labels.mobile')}}</th>
                                    <th>{{trans('labels.status')}}</th>
                                    <th>{{trans('labels.action')}}</th>
                                </tr>
                                </thead>
                                <tbody>

                                @if(isset($trainees))
                                    @foreach($trainees as $trainee)
                                        <tr>
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            <td><a href="{{route( 'training.show' ,$trainee->training_id)}}">{{$trainee->training->training_id}}</a></td>
                                            <td>{{$trainee['trainee_first_name']." ".$trainee['trainee_last_name']}}</td>
                                            <td>{{trans('labels.'.strtolower($trainee['trainee_gender']))}}</td>
                                            <td>{{$trainee['mobile']}}</td>
                                            <td>{{($trainee['status'] == 1)? "Active":"Inactive"}}</td>
                                            <td>
                                            <span class="dropdown">
                                            <button id="btnSearchDrop2" type="button" data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false" class="btn btn-info dropdown-toggle"><i class="la la-cog"></i></button>
                                              <span aria-labelledby="btnSearchDrop2" class="dropdown-menu mt-1 dropdown-menu-right">
                                                <a href="{{URL::to( '/tms/trainee/edit/'.$trainee['id'])}}" class="dropdown-item"><i class="ft-edit-2"></i> {{trans('labels.edit')}}</a>
                                                <div class="dropdown-divider"></div>
                                                  {!! Form::open([
                                                  'method'=>'DELETE',
                                                  'url' => [ '/tms/trainee/delete', $trainee['id']],
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
                                @endif
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
