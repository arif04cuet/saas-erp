@extends('hrm::layouts.master')
@section('title', trans('hrm::employee.attendance_list'))

@section('content')


    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Employee Info</h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                            <li><a data-action="close"><i class="ft-x"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-content collpase show">
                    <div class="card-body">
                        <div class="card-text">
                            <p class="card-text">

                            </p>
                        </div>
                        <form class="form">
                            <div class="form-body">
                                <h4 class="form-section"><i class="ft-user"></i> Personal Info</h4>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="projectinput1">First Name</label>
                                            <input type="text" id="projectinput1" class="form-control"
                                                   placeholder="First Name"
                                                   name="fname" value="Mohammad Imran" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="projectinput2">Last Name</label>
                                            <input type="text" id="projectinput2" class="form-control"
                                                   placeholder="Last Name"
                                                   name="lname" value="Hossain" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="projectinput3">E-mail</label>
                                            <input type="text" id="projectinput3" class="form-control"
                                                   placeholder="E-mail" name="email"
                                                   value="imranhossain16.ctg@gmail.com" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="projectinput4">Contact Number</label>
                                            <input type="text" id="projectinput4" class="form-control"
                                                   placeholder="Phone" name="phone" value="0143256545" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="projectinput3">Role</label>
                                            <input type="text" id="projectinput3" class="form-control"
                                                   placeholder="E-mail" name="email"
                                                   value="Demo 1" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="projectinput4">Designation</label>
                                            <input type="text" id="projectinput4" class="form-control"
                                                   placeholder="Phone" name="phone" value="Associate Software Engineer"
                                                   disabled>
                                        </div>
                                    </div>
                                </div>

                                <h4 class="form-section"><i class="ft-check-circle"></i> Requirements</h4>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="projectinput5">Role</label>
                                            <select id="projectinput5" name="interested" class="form-control">
                                                <option value="none" selected="" disabled="">Select Role</option>
                                                @foreach($roles as $role)
                                                    <option value="design">{{$role}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="projectinput6">Designation</label>
                                            <select id="projectinput6" name="budget" class="form-control">
                                                <option value="0" selected="" disabled="">Select Designation</option>
                                                @foreach($designations as $designation)
                                                    <option value="design">{{$designation}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="projectinput8">Remarks</label>
                                    <textarea id="projectinput8" rows="5" class="form-control" name="comment"
                                              placeholder="About Project"></textarea>
                                </div>
                            </div>
                            <div class="form-actions">
                                <button type="button" class="btn btn-outline-warning mr-1">
                                    <i class="ft-x"></i> Cancel
                                </button>
                                <button type="submit" class="btn btn-outline-primary">
                                    <i class="ft-check"></i> Save
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('page-js')

@endpush
