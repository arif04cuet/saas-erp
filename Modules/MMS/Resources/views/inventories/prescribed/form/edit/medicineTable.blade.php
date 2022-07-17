<div class="row">
    <div class="col-12 mt-3 mt-lg-5">
        <div id="medicineTable" class="table-responsive form-group">
            <table class="table table-bordered repeater-medicine">
                <thead>
                <tr>
                    <th width="48%">Medicine Name</th>
                    <th width="25%">Pata</th>
                    <th width="25%">Piece</th>
                    <th class="text-center" style="width: 2%">
                        <i data-repeater-create class="la la-plus-circle text-info cursor-pointer"></i>
                    </th>
                </tr>
                </thead>
                <tbody data-repeater-list="medicine">
                <tr data-repeater-item>
                    <td>
                        <select class="select2 form-control required" name="Name">
                            <option value=""></option>
                            <option value="1" selected>Medicine 1</option>
                            <option value="2">Medicine 2</option>
                            <option value="3">Medicine 3</option>
                        </select>
                    </td>
                    <td><input class="form-control required" name="" type="number" value="5"></td>
                    <td><input class="form-control required" name="" type="number" value="50"></td>
                    <td class="text-center align-middle">
                        <i data-repeater-delete class="la la-trash-o text-danger cursor-pointer"></i>
                    </td>
                </tr>
                <tr data-repeater-item>
                    <td>
                        <select class="select2 form-control required" name="Name">
                            <option value=""></option>
                            <option value="1" >Medicine 1</option>
                            <option value="2" selected>Medicine 2</option>
                            <option value="3">Medicine 3</option>
                        </select>
                    </td>
                    <td><input class="form-control required" name="" type="number" value="15"></td>
                    <td><input class="form-control required" name="" type="number" value="150"></td>
                    <td class="text-center align-middle">
                        <i data-repeater-delete class="la la-trash-o text-danger cursor-pointer"></i>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
