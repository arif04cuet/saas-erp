<div class="card-body">
    @if ($page == "create")
        {!! Form::open(['route' => 'deliver-materials.store', 'class' => 'form deliver-material-form']) !!}
    @else
        {!! Form::open(['route' => ['deliver-materials.update', $deliverItem->id ], 'class' => 'form
        deliver-material-form']) !!}
    @method('PUT')
    @endif
    <div id="invoice-items-details" class="">
        <h4 class="form-section"><i class="la la-tag"></i>@lang('cafeteria::deliver-material.title')
            @lang('cafeteria::cafeteria.information')</h4>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('title', trans('labels.title'), ['class' => 'form-label required']) !!}
                    {!! Form::text('title', $page == "edit" ? $deliverItem->title : null, ['class' =>
                    "form-control required",
                    'placeholder' => trans('labels.title'),
                    ])!!}
                </div>

            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('deliver date', trans('labels.date'), ['class' => 'form-label required']) !!}
                    {!! Form::text('deliver_date', $page == "edit" ? $deliverItem->deliver_date : date('Y-m-d'),
                    ['class' =>
                    'form-control',
                    ])!!}
                </div>
            </div>
            <!-- department -->
            <div class="col-md-6">
                {!! Form::label('type',
                trans('cafeteria::deliver-material.department.title'),
                ['class' => 'form-label required']) !!}
                <p></p>
                <div class="form-check-inline skin skin-flat">
                    {!! Form::radio('department', 'cooking',
                    $page == "edit" ? $deliverItem->department == "cooking" ? true : false : true,
                    ['class' => 'required']) !!}
                    <label>@lang('cafeteria::deliver-material.department.cooking')</label>
                </div>
                <div class="form-check-inline skin skin-flat">
                    {!! Form::radio('department', 'tea',
                    $page == "edit" ? $deliverItem->department == "tea" ? true : false : false,
                    ['class' => 'required',]) !!}
                    <label>@lang('cafeteria::deliver-material.department.tea')</label>
                </div>
                <div class="form-check-inline skin skin-flat">
                    {!! Form::radio('department', 'bakery',
                    $page == "edit" ? $deliverItem->department == "bakery" ? true : false : false,
                    ['class' => 'required',]) !!}
                    <label>@lang('cafeteria::deliver-material.department.bakery')</label>
                </div>
                <div class="form-check-inline skin skin-flat">
                    {!! Form::radio('department', 'snacks',
                    $page == "edit" ? $deliverItem->department == "snacks" ? true : false : false,
                    ['class' => 'required',]) !!}
                    <label>@lang('cafeteria::deliver-material.department.snacks')</label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('remark', trans('labels.remarks'), ['class' => 'form-label']) !!}
                    {!! Form::textarea('remark', $page == "edit" ? $deliverItem->remark : null, ['class' =>
                    'form-control',
                    'rows' => 2,
                    'data-rule-maxlength' => 255,
                    'data-msg-maxlength'=> trans('labels.At most 255 characters'),
                    ])!!}
                    <div class="help-block"></div>
                    @if ($errors->has('remark'))
                    <span class="invalid-feedback">{{ $errors->first('remark') }}</span>
                    @endif
                </div>
            </div>
        </div>

        <h4 class="form-section"><i class="la la-tag"></i>@lang('cafeteria::purchase-list.details')</h4>
        <div class="row">
            <div class="table-responsive col-sm-12">
                <table class="table table-bordered text-center deliver-material-items">
                    <thead>
                        <tr>
                            <th width="30%">@lang('cafeteria::purchase-list.name')</th>
                            <th width="30%">@lang('cafeteria::purchase-list.quantity')</th>
                            <th width="30%">@lang('cafeteria::purchase-list.unit')</th>
                            <th width="1%">
                                <i data-repeater-create class="la la-plus-circle text-info" style="cursor: pointer"
                                    id="repeater_create"></i>
                            </th>
                        </tr>
                    </thead>
                    <tbody data-repeater-list="deliver-material-entries">
                        <!-- edit form start -->
                        @if ($page == "edit")
                        @foreach ($deliverItem->deliverItemLists as $item)
                        <tr data-repeater-item>
                            {{ Form::hidden('item_id', $item->id) }}
                            <td>
                                {!! Form::select('raw_material_id', $rawMaterials, $item->raw_material_id, ['class' =>
                                "form-control material-dropdown-select required",
                                'data-msg-required'=> __('labels.This field is required'),
                                'onChange' => 'getUnitByMaterial(this.name)'
                                ])!!}
                            </td>

                            <td> {!! Form::number('quantity', $item->quantity, ['class' =>
                                'form-control required spin',
                                'data-msg-required'=> __('labels.This field is required'),
                                'data-rule-maxlength' => 7,
                                'data-msg-maxlength'=> trans('labels.At most 7 characters'),
                                'min' => 1,
                                'data-msg-min'=> trans('labels.Please enter a value greater than or equal to 1'),
                                'onkeyup' => 'calculateTotal(this.name)',
                                'placeholder' => trans('cafeteria::purchase-list.quantity')
                                ])!!}
                            </td>
                            @php
                            $unitName = app()->isLocale('en') ?
                                            $item->rawMaterial->unit->en_name :
                                            $item->rawMaterial->unit->bn_name;
                            @endphp
                            <td class="unit"> {!! Form::select('unit_id', [$item->rawMaterial->unit->id => $unitName], null, ['class'
                                => '
                                form-control unit-dropdown-select required',
                                'data-msg-required'=> __('labels.This field is required')
                                ])!!}
                            </td>
                            <td><i data-repeater-delete class="la la-trash-o text-danger" style="cursor: pointer"></i>
                            </td>
                        </tr>
                        @endforeach
                        @endif
                        <!-- edit form end -->
                        <tr data-repeater-item>
                            <td>
                                {!! Form::select('raw_material_id', $rawMaterials, null, ['class' =>
                                "form-control material-dropdown-select required",
                                'data-msg-required'=> __('labels.This field is required'),
                                'onChange' => 'getUnitByMaterial(this.name)'
                                ])!!}
                            </td>

                            <td> {!! Form::number('quantity', null,['class' =>
                                'form-control required spin',
                                'data-msg-required'=> __('labels.This field is required'),
                                'data-msg-max'=> trans('cafeteria::sales.quantity_validate'),
                                'min' => 1,
                                'data-msg-min'=> trans('labels.Please enter a value greater than or equal to 1'),
                                'onkeyup' => 'calculateTotal(this.name)',
                                'placeholder' => trans('cafeteria::purchase-list.quantity')
                                ])!!}
                            </td>

                            <td class="unit"> {!! Form::select('unit_id', $units, null, ['class' => '
                                form-control unit-dropdown-select required',
                                'data-msg-required'=> __('labels.This field is required')
                                ])!!}
                            </td>
                            <td><i data-repeater-delete class="la la-trash-o text-danger" style="cursor: pointer"></i>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <button class="btn btn-sm btn-primary" style="cursor: pointer" type="button"
                    onclick="$('#repeater_create').trigger('click');">
                    <i class="ft ft-plus"></i>@lang('labels.add')
                </button>
            </div>
        </div>
    </div>

    <!-- Save & Cancel Button -->
    <div class="form-actions text-center">
        <button type="submit" class="btn btn-info" name="status" value="draft">
            <i class="ft-check-square"></i>
            @lang('cafeteria::purchase-list.draft')
        </button>
        <button type="submit" class="btn btn-success" name="status" value="pending">
            <i class="ft-check-square"></i>
            @lang('labels.submit')
        </button>
        <a class="btn btn-warning mr-1" role="button" href="{{route('deliver-materials.index')}}">
            <i class="ft-x"></i> @lang('labels.cancel')
        </a>
    </div>
    {!! Form::close() !!}
</div>
@push('page-js')
<script>
    function getUnitByMaterial(name) {
            $index = name.match(/\d+/).toString();
            $rawMateial = $("select[name='deliver-material-entries[" + $index + "][raw_material_id]']");
            $unit = $("select[name='deliver-material-entries[" + $index + "][unit_id]']");
            $quantity = $("input[name='deliver-material-entries[" + $index + "][quantity]']");

            let url = "{{ url('cafeteria/get-unit-by-material/') }}" ;
            $.get( url +'/'+ $rawMateial.val(), function (data) {
                $($unit).find('option').remove();
                $($unit).append(`<option value="${data.unit_id}">${data.unit_name}</option>`)

                $($quantity).attr('max', data.available_amount);
            });
        }
</script>
@endpush
