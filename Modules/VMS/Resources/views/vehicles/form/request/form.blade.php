<div class="row">
    <div class="col-12">
        <div class="row">

            <div class="col-sm-4 col-lg-3 ">
                <div class="form-group">
                    <label>Form</label>
                    <input type="text" class="form-control" placeholder="form">
                </div>

            </div>
            <div class="col-sm-4 col-lg-3 ">
                <div class="form-group">
                    <label>To</label>
                    <input type="text" class="form-control" placeholder="to">
                </div>
            </div>
            <div class="col-sm-4 col-lg-3 ">
                <div class="form-group">
                    <label>Previous use</label>
                    <input type="number" class="form-control" placeholder="">
                </div>
            </div>
            <div class="col-sm-4 col-lg-3 ">
                <div class="form-group">
                    <label class="mb-2">Purpose of use</label>
                    <div class="row">
                        <div class="col-6">
                            <div class="skin skin-flat">
                                <input class="required" data-msg-required="This field is required" name="gender"
                                       type="radio" value="official" id="officialId">
                                <label for="officialId">Official</label>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="skin skin-flat">
                                <input class="required" data-msg-required="This field is required" name="gender"
                                       type="radio" value="personal" id="personalId">
                                <label for="personalId">Personal</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 col-lg-3 ">
                <div class="form-group">
                    <label>Receive Time</label>
                    <input type="time" class="form-control" placeholder="">
                </div>
            </div>
            <div class="col-sm-4 col-lg-3 ">
                <div class="form-group">
                    <label>Receive Location</label>
                    <input type="text" class="form-control" placeholder="">
                </div>
            </div>
            <div class="col-sm-4 col-lg-3 ">
                <div class="form-group">
                    <label>Return Date</label>
                    <input type="date" class="form-control" placeholder="">
                </div>
            </div>
            <div class="col-sm-4 col-lg-3 ">
                <div class="form-group">
                    <label>Return Time</label>
                    <input type="time" class="form-control" placeholder="">
                </div>
            </div>
        </div>
    </div>

    <div class="col-12">
        <hr>
        <br>
        <div class="d-flex">
            <div class="w-100">
                <div class="row">
                    <div class="col-sm-3 ">
                        <div class="form-group">
                            <label>Date</label>
                            <input type="date" class="form-control" placeholder="">
                        </div>
                    </div>
                    <div class="col-sm-3 ">
                        <div class="form-group">
                            <label>Seat</label>
                            <input type="number" class="form-control" placeholder="">
                        </div>
                    </div>
                    <div class="col-sm-3 ">
                        <div class="form-group">
                            <label>Type</label>
                            <select class="select2 form-control required" name="Name">
                                <option value="" disabled selected>Selected a Type</option>
                                <option value="1">Type 1</option>
                                <option value="2">Type 2</option>
                                <option value="3">Type 3</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-3 ">
                        <div class="form-group">
                            <label>Model</label>
                            <select class="select2 form-control required" name="Name">
                                <option value="" disabled selected>Selected a Model</option>
                                <option value="1">Model 1</option>
                                <option value="2">Model 2</option>
                                <option value="3">Model 3</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="p-1">
                <button class="btn btn-primary pl-2 pr-2 mt-1"><i class="la la-filter"></i> Filter</button>
            </div>
        </div>
        <h3>Vehicle List</h3>

        <div class="table-responsive">
            <table class="prescriptions-list-table table table-bordered">
                <thead>
                <tr>
                    <th width="1%">{{ trans('labels.serial') }}</th>
                    <th>Id</th>
                    <th>Type</th>
                    <th>Name</th>
                    <th>Model</th>
                    <th>Year</th>
                    <th>CC</th>
                    <th>Seat</th>
                    <th>Cost</th>
                    <th width="2%">Request</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>1</td>
                    <td>v023</td>
                    <td>Bus</td>
                    <td>Baby Carriage</td>
                    <td>V-087</td>
                    <td>2019</td>
                    <td>G-855</td>
                    <td>01</td>
                    <td>12,00,000</td>
                    <td><span>Select</span></td>
                </tr>
                <tr>
                    <td>1</td>
                    <td>v025</td>
                    <td>Bus</td>
                    <td>Conestoga wagon</td>
                    <td>V-087</td>
                    <td>2019</td>
                    <td>G-855</td>
                    <td>01</td>
                    <td>15,50,000</td>
                    <td><span>Selected</span></td>
                </tr>
                </tbody>
            </table>
        </div>

    </div>

</div>
