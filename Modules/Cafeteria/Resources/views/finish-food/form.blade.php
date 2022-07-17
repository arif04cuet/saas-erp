<div class="card-body">
    {!! Form::open(['route' => 'finish-foods.store', 'class' => 'form finish-food-form']) !!}
    <div id="invoice-items-details" class="">
        <h4 class="form-section"><i class="la la-tag"></i>@lang('cafeteria::finish-food.title') @lang('cafeteria::cafeteria.information')</h4>
        
            <div class="table-responsive col-sm-12">
                <table class="table table-bordered text-center finish-food-entries">
                    <thead>
                    <tr>
                        <th>@lang('cafeteria::purchase-list.name')<span class="mandatory">*</span></th>
                        <th>@lang('cafeteria::purchase-list.quantity')<span class="mandatory">*</span></th>
                        <th>@lang('cafeteria::purchase-list.unit')</th>
                        <th width="1%">
                            <i data-repeater-create class="la la-plus-circle text-info" style="cursor: pointer"
                               id="repeater_create"></i>
                        </th>
                    </tr>
                    </thead>
                    <tbody data-repeater-list="finish-food-entries">
                    <tr data-repeater-item>
                        <td width="33%">
                            {!! Form::select('raw_material_id', $rawMaterials, null, ['class' =>
                                "form-control material-dropdown-select required",
                                'data-msg-required'=> __('labels.This field is required'),
                                'onChange' => 'getUnitByMaterial(this.name)',
                            ])!!}
                        </td>

                        <td width="33%"> 
                            {!! Form::number('quantity', null,['class' =>
                                'form-control required',
                                'data-rule-maxlength' => 11,
                                'data-msg-maxlength'=> trans('labels.At most 11 characters'),
                                'min' => 1,
                                'data-msg-min'=> trans('labels.Please enter a value greater than or equal to 1'),
                                'placeholder' => trans('cafeteria::purchase-list.quantity'),
                                'data-msg-required'=> __('labels.This field is required'),
                                ])!!}
                        </td>
                        <td class="unit" width="33%"> {!! Form::select('unit_id', [], null, ['class' => '
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

    <!-- Save & Cancel Button -->
    <div class="form-actions text-center">
        <button type="submit" class="btn btn-success">
            <i class="ft-check-square"></i>
            @lang('labels.add')
        </button>
        <a class="btn btn-warning mr-1" role="button" href="{{route('finish-foods.index')}}">
            <i class="ft-x"></i> @lang('labels.cancel')
        </a>
    </div>
    {!! Form::close() !!}
</div>
@push('page-css')
    <style>
        .mandatory {
            color: red;
            font-weight: normal;
            padding-left: 5px;
        }
    </style>
@endpush
@push('page-js')
    <script>
        function getUnitByMaterial(name) {
            $index = name.match(/\d+/).toString();
            $rawMateial = $("select[name='finish-food-entries[" + $index + "][raw_material_id]']");
            $unit = $("select[name='finish-food-entries[" + $index + "][unit_id]']");

            let url = "{{ url('cafeteria/get-unit-by-material/') }}" ;
            $.get( url +'/'+ $rawMateial.val(), function (data) {
                $($unit).find('option').remove();
                $($unit).append(`<option value="${data.unit_id}">${data.unit_name}</option>`)
            });
        }
    </script>
@endpush