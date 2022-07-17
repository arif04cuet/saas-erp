<div class="row">
    <div class="col-12 mt-2">
        <div id="oeTable" class="table-responsive form-group">
            <table class="table table-bordered repeater-oe">
                <thead>
                <tr>
                    <th width="30%"> @lang('mms::prescription.oe.oe_titel')</th>
                    <th width="60%"> @lang('mms::prescription.oe.oe_result')</th>
                </tr>
                </thead>
                <tbody data-repeater-list="oe">
                @foreach ($medicineOe as $item)
                    <tr data-repeater-item>
                        <td><input class="form-control required" name="oe_name" type="text" value="{{$item->oe_name}}" readonly>
                            <input class="form-control required" name="id" type="hidden" value="{{$item->id}}" readonly>
                        </td>
                        <td><input class="form-control required" name="oe_value" type="text" value="{{$item->oe_value}}"></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
