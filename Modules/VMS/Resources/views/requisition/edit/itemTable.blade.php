<div class="row">
    <div class="col-12 mt-3 mt-lg-5">
        {!! Form::open(['route' => ['vms.requisition.update', $requisition->id], 'class' => 'form maintenanceIteForm']) !!}
        @method('PUT')
        <div id="medicineTable" class="table-responsive form-group">
            <table class="table table-bordered repeater-medicine">
                <thead>
                <tr>
                    <th width="18%">@lang('vms::requisition.form.maintenance_item')</th>
                    <th width="7.4%">@lang('vms::requisition.form.quantity')</th>
                    <th  width="7.4%">
                        @lang('vms::requisition.table.amount')
                         </th>
                </tr>
                </thead>
                <tbody data-repeater-list="requisition">
                @foreach($requisitionItem as $info)
                <tr data-repeater-item>
                    <th>
                        {{$info->requisiteItem->item_name_en}}
                        <input class="form-control required hidden" name="id" type="text" value="{{$info->id}}">
                    </th>
                    <td><input class="form-control required" name="quantity" type="text" value="{{$info->quantity}}"></td>
                    <td>
                        <input class="form-control required" name="price" type="text" value="{{$info->price}}">

                    </td>
                </tr>

                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="3"></td>

                </tr>
                </tfoot>
            </table>
        </div>

        <!-- Save & Cancel Button -->
        <div class="form-actions text-center">
            <button type="submit" class="btn btn-success">
                <i class="ft-check-square"></i>
                @lang('labels.update')
            </button>
            <a class="btn btn-warning mr-1" role="button" href="{{ route('vms.requisition.index') }}">
                <i class="ft-x"></i> @lang('labels.cancel')
            </a>
        </div>
        {!! Form::close() !!}
        <br>
    </div>
</div>

