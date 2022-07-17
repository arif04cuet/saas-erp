@extends('hrm::layouts.master')
@section('title', trans('hrm::employee.attendance_list'))

@section('content')
    <section id="user-list">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Employee List</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>


                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body card-dashboard">

                            <table class="table table-striped table-bordered alt-pagination">
                                <thead>
                                <tr>
                                    <th>Serial</th>
                                    <th>Name</th>
                                    <th>Designation</th>
                                    <th>Role</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>

                                    <td>1</td>
                                    <td>Mohammad Imran Hossain</td>
                                    <td><span class="badge bg-info">Associate Software Engineer</span></td>
                                    <td><span class="badge bg-warning">Demo Role</span></td>
                                    <td>
                                        <button id="btnSearchDrop2" type="button" data-toggle="dropdown"
                                                aria-haspopup="true"
                                                aria-expanded="false" class="btn btn-info dropdown-toggle">
                                            <i class="la la-cog"></i></button>
                                        <span aria-labelledby="btnSearchDrop2"
                                              class="dropdown-menu mt-1 dropdown-menu-right">
                                                        <a href="{{url('hrm/promotion/promote')}}"
                                                           class="dropdown-item"><i class="ft-eye"></i> Promote</a>
                                                         <div class="dropdown-divider"></div>
                                                         <a href="#" class="dropdown-item"><i class="ft ft-trash"></i> @lang('labels.delete')</a>
                                                </span>
                                        </span>
                                    </td>
                                </tr>

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
