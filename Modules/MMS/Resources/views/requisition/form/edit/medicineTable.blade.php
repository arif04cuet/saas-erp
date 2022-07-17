<div class="row">


    <div class="col-12 mt-3 mt-lg-5">
        <style>
            .max{
                border: none;
            }
        </style>
        <div id="medicineTable" class="table-responsive form-group">
            <table class="table table-bordered repeater-medicine">
                <thead>
                <tr>
                    <th width="48%">{{trans('mms::medicine_distribution.medicine_name')}}</th>
                    <th width="25%">{{trans('mms::medicine_distribution.piece')}}</th>
                    <th class="text-center" style="width: 2%">
                        <i data-repeater-create class="la la-plus-circle text-info cursor-pointer"></i>
                    </th>
                </tr>
                </thead>
                <tbody data-repeater-list="medicine">
                @if(count($medicine_info->details)>0)
                @foreach($medicine_info->details as $key=>$val)
                <tr data-repeater-item id="{{$val->id}}">

                    <td>
                        <input type="hidden" name="id" value="{{$val->id}}">
                        <div class="form-group">
                        {!! Form::select('medicine_id', $medicine, $page == "edit" ? $medicine ? $val->medicine_id : null : null,
                        ['class' => 'form-control item-category-select dropdown-name select2 required',
                        'data-msg-required'=> __('labels.This field is required'),
                        'id'=>'medicine-dropdown',
                        'onchange' => 'loadItems(this)',
                        ]) !!}
                        <!-- error message -->
                            @if ($errors->has('medicine_id'))
                                <div class="help-block text-danger">
                                    {{ $errors->first('medicine_id') }}
                                </div>
                            @endif
                        </div>

                    </td>
                    <td>
                    {!! Form::number('piece', $page == "edit" ? $val->quantity: null, ['class' =>
                            'form-control required',
                            'placeholder' => __('labels.quantity'),
                            'data-msg-required'=> __('labels.This field is required'),
                            'data-rule-max' => 10000,
                            'data-msg-max'=> __('labels.Please enter a value less than or equal to 100'),
                            'min' => 1,
                            'data-msg-min' => trans('labels.Please enter a value greater than or equal to 1') ])!!}
                    <!-- error message -->
                        <br>
                        <label class="success" name="max"></label>
                        @if ($errors->has('piece'))
                            <div class="help-block text-danger">
                                {{ $errors->first('piece') }}
                            </div>
                        @endif

                    </td>

                    <td class="text-center align-middle">
                        <i data-repeater-delete class="la la-trash-o text-danger cursor-pointer"></i>
                    </td>
                </tr>
                @endforeach
                @else
                    @include('mms::requisition.form.edit.add')
                @endif
                </tbody>
                <tfoot>
                <tr>
                    <td></td>
                    <td></td>
                    <td class="text-center" style="width: 2%">
                        <i data-repeater-create class="la la-plus-circle text-info cursor-pointer"></i>
                    </td>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>

