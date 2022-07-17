<div class="row">
    <div class="col-12 mt-3 mt-lg-5">
        <div id="medicineTable" class="table-responsive form-group">
            <table class="table table-bordered repeater-medicine">
                <thead>
                <tr>
                    <th width="28%">@lang('mms::prescription.medicine')</th>
                    <th width="17.4%">@lang('mms::prescription.table.dose')</th>
                    <th width="17.4%">@lang('mms::prescription.table.in_stock')</th>
                    <th width="17.4%">@lang('mms::prescription.table.total_medicine')</th>
                    {{-- <th width="17.4%">@lang('mms::prescription.day')</th> --}}
                    <th class="text-center" style="width: 2%">
                        <i data-repeater-create class="la la-plus-circle text-info cursor-pointer"></i>
                    </th>
                </tr>
                </thead>
                <tbody data-repeater-list="medicine">
                @foreach($medicine as $medicineInfo)
                    <tr data-repeater-item id="{{$medicineInfo->id}}">
                        <td>
                            <input type="hidden" name="id" value="{{$medicineInfo->id}}" class="medicine_id">
                        @if($medicineInfo->type==0)
                            {!! Form::select('medicine_id', $medicines, $page == "edit" ? $medicines ? $medicineInfo->medicine_id : null : null,
                              ['class' => ' select2 form-control item-category-select dropdown-name select2 required',
                              'data-msg-required'=> __('labels.This field is required'),
                              'id'=>'medicine-dropdown',
                              'onchange' => 'loadItems(this)'
                              ]) !!}
                            <!-- error message -->
                                @if ($errors->has('medicine_id'))
                                    <div class="help-block text-danger">
                                        {{ $errors->first('medicine_id') }}
                                    </div>
                                @endif
                            @else
                                <div class="medicine_name" name="medicine_name">
                                {!! Form::text('medicine_name', $page == "edit" ? $medicineInfo->medicine_name : null, ['class' =>
                            'form-control required',
                            'placeholder' => trans('mms::prescription.medicine'),
                            'data-msg-required'=> __('labels.This field is required'),
                            'data-rule-maxlength' => 255,
                            'data-msg-maxlength'=> trans('labels.At most 255 characters') ])!!}
                                <!-- error message -->
                                    @if ($errors->has('name'))
                                        <div class="help-block text-danger">
                                            {{ $errors->first('name') }}
                                        </div>
                                    @endif
                                </div>
                            @endif
                        </td>
                        <td><input class="form-control " name="dose" type="text"
                                   value="{{$medicineInfo->dose}}"></td>
                        <td><input class="form-control " name="in_stock" type="number"
                                   value="{{$medicineInfo->in_stock}}" readonly></td>
                        <td><input class="form-control " name="total_medicine" type="number"
                                   value="{{$medicineInfo->total_medicine}}">
                        </td>
                        <td class="text-center align-middle">
                            {{-- <i data-repeater-delete class="la la-trash-o text-danger cursor-pointer"></i> --}}
                        </td>
                    </tr>
                @endforeach


                </tbody>
            </table>
        </div>
    </div>
</div>
