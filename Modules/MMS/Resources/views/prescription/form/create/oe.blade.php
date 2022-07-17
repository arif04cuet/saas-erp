<div class="row">
    <div class="col-12 mt-2">
        <div id="oeTable" class="table-responsive form-group">
            <table class="table table-bordered repeater-oe">
                <thead>
                <tr>
                    <th width="30%"> @lang('mms::prescription.oe.oe_titel')</th>
                    <th width="60%"> @lang('mms::prescription.oe.oe_result')</th>
                    <th class="text-center" style="width: 2%">
                        {{-- <i data-repeater-create class="la la-plus-circle text-info cursor-pointer"></i> --}}
                    </th>
                </tr>
                </thead>
                <tbody data-repeater-list="oe">
                <tr data-repeater-item>
                    <td><input class="form-control required" name="oe_name" type="text" value="Anaemia" readonly></td>
                    <td><input class="form-control required" name="oe_value" type="text"></td>
                    <td class="text-center align-middle"><i data-repeater-delete
                                                            class="la la-trash-o text-danger cursor-pointer"></i></td>
                </tr>
                <tr data-repeater-item>
                    <td><input class="form-control required" name="oe_name" type="text" value="Oedema" readonly></td>
                    <td><input class="form-control required" name="oe_value" type="text"></td>
                    <td class="text-center align-middle"><i data-repeater-delete
                                                            class="la la-trash-o text-danger cursor-pointer"></i></td>
                </tr>
                <tr data-repeater-item>
                    <td><input class="form-control required" name="oe_name" type="text" value="Pulse" readonly></td>
                    <td><input class="form-control required" name="oe_value" type="text"></td>
                    <td class="text-center align-middle"><i data-repeater-delete
                                                            class="la la-trash-o text-danger cursor-pointer"></i></td>
                </tr>
                <tr data-repeater-item>
                    <td><input class="form-control required" name="oe_name" type="text" value="BP" readonly></td>
                    <td><input class="form-control required" name="oe_value" type="text"></td>
                    <td class="text-center align-middle"><i data-repeater-delete
                                                            class="la la-trash-o text-danger cursor-pointer"></i></td>
                </tr>
                <tr data-repeater-item>
                    <td><input class="form-control required" name="oe_name" type="text" value="R/R" readonly></td>
                    <td><input class="form-control required" name="oe_value" type="text"></td>
                    <td class="text-center align-middle"><i data-repeater-delete
                                                            class="la la-trash-o text-danger cursor-pointer"></i></td>
                </tr>
                <tr data-repeater-item>
                    <td><input class="form-control required" name="oe_name" type="text" value="Lung" readonly></td>
                    <td><input class="form-control required" name="oe_value" type="text"></td>
                    <td class="text-center align-middle"><i data-repeater-delete
                                                            class="la la-trash-o text-danger cursor-pointer"></i></td>
                </tr>
                <tr data-repeater-item>
                    <td><input class="form-control required" name="oe_name" type="text" value="Heart" readonly></td>
                    <td><input class="form-control required" name="oe_value" type="text"></td>
                    <td class="text-center align-middle"><i data-repeater-delete
                                                            class="la la-trash-o text-danger cursor-pointer"></i></td>
                </tr>
                <tr data-repeater-item>
                    <td><input class="form-control required" name="oe_name" type="text" value="Abdomen" readonly></td>
                    <td><input class="form-control required" name="oe_value" type="text"></td>
                    <td class="text-center align-middle"><i data-repeater-delete
                                                            class="la la-trash-o text-danger cursor-pointer"></i></td>
                </tr>
                <tr data-repeater-item>
                    <td><input class="form-control required" name="oe_name" type="text" value="Temp" readonly></td>
                    <td><input class="form-control required" name="oe_value" type="text"></td>
                    <td class="text-center align-middle"><i data-repeater-delete
                                                            class="la la-trash-o text-danger cursor-pointer"></i></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
