<h4 class="form-section"><i class="la la-tag"></i>@lang('ims::inventory.inventory_request')</h4>
<div class="row">
    <div class="col-md-12">
        @if ($errors->has('category'))
            <span class="invalid-feedback" style="display: block">{{ $errors->first('category') }}</span>
        @endif
        <div class="table-responsive">
            <table class="table table-bordered repeater-category-request">
                <thead>
                <tr>
                    <th width="25%">@lang('ims::group.select_group')</th>
                    <th width="45%">@lang('ims::product.title')</th>
                    <th width="25%">@lang('labels.quantity')</th>
                    <th width="1%"><i data-repeater-create class="la la-plus-circle text-info" style="cursor: pointer"></i></th>
                </tr>
                </thead>
                <tbody data-repeater-list="category">
                <tr data-repeater-item>
                    <td width="20%">
                        {!! Form::select('group_id',
                                $groups,
                                null,
                                [
                                    'class' => 'form-control repeater-select item-group-select required',
                                    'data-msg-required' => trans('labels.This field is required'),
                                    'onchange' => 'getCategoriesByGroup(this.name)',
                                    'placeholder' => trans('labels.select')
                                ]
                            )
                        !!}
                    </td>
                    <td>
                        {!! Form::select('category_id',
                                [],
                                null,
                                [
                                    'class' => 'form-control repeater-select item-category-select required',
                                    'data-msg-required' => trans('labels.This field is required'),
                                ]
                            )
                        !!}
                    </td>
                    <td>
                        {!! Form::number('quantity', null, [
                                'class' => 'form-control required',
                                'data-msg-required' => trans('labels.This field is required'),
                                'data-rule-min' => 1,
                                'data-msg-min'=> trans('validation.min.numeric', ['attribute' => trans('labels.quantity'), 'min' => 1]),
                                'data-rule-number' => 'true',
                                'data-msg-number' => trans('labels.Please enter a valid number'),
                            ])
                        !!}
                    </td>
                    <td><i data-repeater-delete class="la la-trash-o text-danger" style="cursor: pointer"></i></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@push('page-js')
    <script>
        function getCategoriesByGroup(name) {
            $index = name.match(/\d+/).toString();
            $group = $("select[name='category[" + $index + "][group_id]']");
            $category = $("select[name='category[" + $index + "][category_id]']");

            let url = "{{ url('ims/inventory-item-category/group-by-categories') }}" ;
            $.get( url +'/'+ $group.val(), function (data) {
                $($category).find('option').remove();
                for(let i = 0; data.length > 0; i++) {
                    $($category).append(`<option value="${data[i].id}">${data[i].name}</option>`)
                }
            });
        }
    </script>
@endpush