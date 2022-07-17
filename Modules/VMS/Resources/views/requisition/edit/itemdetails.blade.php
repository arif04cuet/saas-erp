<div class="row">
    <div class="col-12 mt-1 mt-lg-1">
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
                    <tr>
                        <th>
                            {{$info->requisiteItem->item_name_en}}
                        </th>
                        <td>{{$info->quantity}}</td>
                        <td>
                            {{$info->price}}
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

        <div class="card-footer">
            <div class="col-md-12">
                @if($shouldShowApproveRejectButton)
                    <div class="form-actions text-center">
                        <a class="btn btn-outline-success mr-1" role="button"
                           href="{{route('vms.requisition.change-status',[$requisition->id,Modules\VMS\Entities\VehicleMaintenanceRequisition::getStatuses()['approved']])}}">
                            <i class="la la-check-square"></i> @lang('labels.approve')
                        </a>
                        <a class="btn btn-outline-danger mr-1" role="button"
                           href="{{route('vms.requisition.change-status',[$requisition->id,Modules\VMS\Entities\VehicleMaintenanceRequisition::getStatuses()['rejected']])}}">
                            <i class="ft-x la la-check-square"></i> @lang('labels.reject')
                        </a>
                    </div>
                @endif
            </div>
        </div>
</div>

</div>
