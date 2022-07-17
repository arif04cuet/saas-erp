<!-- Item View Modal -->
<div class="modal fade text-left" id="item-category-modal-{{$categoryId}}" tabindex="-1" role="dialog"
     aria-labelledby="myModalLabel16"
     aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title white" id="myModalLabel16">
                    <i class="ft ft-list"></i>
                    @lang('ims::inventory.item.view_item')
                </h4>
                <button type="button" class="close white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="card">
                    <div class="card-header">
                        <div class="head-title bold">
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <h4 class="form-label">
                                    {{__('ims::inventory.item.view_item_label', ['category' => $category->name])}}
                                </h4>
                                <table class="table">
                                    @php
                                        $filteredInventoryItems = $inventoryItems->filter(
    function ($item) use ($categoryId) {
        return $item->item->category->id == $categoryId;
    });
                                    @endphp
                                    <tr>
                                        <th>@lang('labels.serial')</th>
                                        <th>@lang('labels.title') <span class="red">*</span></th>
                                        <th>@lang('ims::inventory.item.unique_id')</th>
                                        <th>@lang('ims::inventory.item.model')</th>
                                    </tr>
                                    @foreach($filteredInventoryItems as $filteredItem)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{ optional($filteredItem->item)->title ?? ""}}</td>
                                            <td>{{ optional($filteredItem->item)->unique_id ?? ""}}</td>
                                            <td>{{ optional($filteredItem->item)->model ?? ""}}</td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-warning" data-dismiss="modal">
                    <i class="ft ft-x-square"></i> @lang('labels.cancel')
                </button>
            </div>
        </div>
    </div>
</div>
<!-- Modal End -->
