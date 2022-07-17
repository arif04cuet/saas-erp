<!-- Item Select Modal -->
<div class="modal fade text-left" id="item-modal-{{$categoryId}}" tabindex="-1" role="dialog"
     aria-labelledby="myModalLabel16"
     aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title white" id="myModalLabel16">
                    <i class="ft ft-list"></i>
                    @lang('ims::inventory.item.select_item')
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
                                <div class="form-group">
                                    <label class="form-label">
                                        {{__('ims::inventory.item.select_item_label', ['category' => $category->name])}}
                                    </label>
                                    {!! Form::select(
                                            'inventory_item_ids[]',
                                            !is_array($inventoryItems) ? $inventoryItems->filter(function ($thisItem) use ($categoryId) {
                                                    return $thisItem->inventory_item_category_id === $categoryId;
                                                })->each(function ($item) {
                                                    return $item->title_id = $item->title . ' - ' . $item->unique_id;
                                                })->pluck('title_id', 'id') : [],
                                            old('inventory_item_ids[]'),
                                            [
                                                'class' => 'form-control select2 item-selector',
                                                'limit' => $item->quantity,
                                                'category' => $categoryId,
                                                'multiple',
                                              ]
                                            )
                                      !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-success" data-dismiss="modal">
                    <i class="ft ft-plus-square"></i> @lang('labels.submit')
                </button>
            </div>
        </div>
    </div>
</div>
<!-- Modal End -->
