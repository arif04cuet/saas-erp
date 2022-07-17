<div class="card-body">
    @if ($page == "create")
    {!! Form::open(['route' => 'house-circulars.store', 'class' => 'form house-circular-form']) !!}
    @else
    {!! Form::open(['route' => ['house-circulars.update', $circular->id ], 'class' => 'form house-circular-form']) !!}
    @method('PUT')
    @endif
    <div id="invoice-items-details">
        <h4 class="form-section"><i class="ft-grid"></i>@lang('hrm::house-circular.title') @lang('labels.form')</h4>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('reference_no',  trans('hrm::house-circular.reference_no'), ['class' => 'form-label required']) !!}
                    {!! Form::text('reference_no', $page == "edit" ? $circular->reference_no : null, 
                    [
                        'class' => "form-control required",
                        'placeholder' => trans('hrm::house-circular.reference_no'),
                        'data-msg-required'=> __('labels.This field is required'),
                        'data-rule-maxlength' => 255,
                        'data-msg-maxlength'=> trans('labels.At most 255 characters'),
                     ])!!}
                    <!-- error message -->
                    @if ($errors->has('reference_no'))
                        <div class="help-block text-danger">
                            {{ $errors->first('reference_no') }}
                        </div>
                    @endif
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('apply_from', trans('hrm::house-circular.apply_from'), ['class' => 'form-label required']) !!}
                    {!! Form::text('apply_from',  $page == "edit" ? $circular->apply_from : date('Y-m-d'), 
                    [
                        'class' => 'form-control required apply-from',
                        'placeholder' => trans('hrm::house-circular.apply_from'),
                        'data-msg-required'=> __('labels.This field is required'),
                     ])!!}
                    <!-- error message -->
                    @if ($errors->has('apply_from'))
                        <div class="help-block text-danger">
                            {{ $errors->first('apply_from') }}
                        </div>
                    @endif
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('apply_to', trans('hrm::house-circular.apply_to'), ['class' => 'form-label required']) !!}
                    {!! Form::text('apply_to',  $page == "edit" ? $circular->apply_to : date('Y-m-d'), 
                    [
                        'class' => 'form-control required apply-to',
                        'placeholder' => trans('hrm::house-circular.apply_to'),
                        'data-msg-required'=> __('labels.This field is required'),
                     ])!!}
                     <!-- error message -->
                     @if ($errors->has('apply_to'))
                        <div class="help-block text-danger">
                            {{ $errors->first('apply_to') }}
                        </div>
                    @endif
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('status', trans('labels.status'), ['class' => 'form-label']) !!}
                    {{ Form::select('status', Config::get('constants.house_circular.status'), $page == "edit" ? $circular->status : null,
                        [
                            'class' => 'form-control select2',
                            'data-msg-required' => trans('labels.This field is required')
                        ]
                    ) }}
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('Remark', trans('labels.remarks'), ['class' => 'form-label'])!!}
                    {!! Form::textarea('remark',  $page == "edit" ? $circular->remark : null, ['class' => 'form-control', 'rows' => 2,
                    'data-rule-maxlength' => 255,
                    'data-msg-maxlength'=> trans('labels.At most 255 characters'),
                     ])!!}
                     <!-- error message -->
                     @if ($errors->has('remark'))
                        <div class="help-block text-danger">
                            {{ $errors->first('remark') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <h4 class="form-section">
            <i class="la la-child"></i> @lang('hrm::house-circular.details')
        </h4>
        <div class="house-repeater">
            <div data-repeater-list="house-entries">
            @if ($page == "edit")
                @foreach ($circular->circularCategories as $circularCategory)
                    <div data-repeater-item>
                        <div class="row">
                            <div class="col-md-10">
                                <div class="row">
                                    {{ Form::hidden('circular_category_id', $circularCategory->id) }}
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label required">@lang('hrm::house-details.house_type')</label>
                                            {{ Form::select('house_category_id', $categories, 
                                                $circularCategory->category->id,
                                                [
                                                    'class' => 'form-control required house-type',
                                                    'onchange' => 'getHouseByType(this.name)',
                                                    'data-msg-required' => trans('labels.This field is required'),
                                                ]
                                            ) }}
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label required">@lang('hrm::house-details.house_id')</label>
                                            {{ Form::select('house_details_id', 
                                                $circularCategory->category->houseDetails->pluck('house_id', 'id'), 
                                                $circularCategory->circularHouses->pluck('house_details_id'),
                                                [
                                                    'class' => 'form-control required house-details',
                                                    'multiple',
                                                    'data-msg-required' => trans('labels.This field is required'),
                                                ]
                                            ) }}
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="form-label required">@lang('labels.designation')</label>
                                            {{ Form::select('designation_id', $designations, 
                                                $circularCategory->circularDesignations,
                                                [
                                                    'class' => 'required form-control designation',
                                                    'multiple',
                                                    'data-msg-required' => trans('labels.This field is required'),
                                                ]
                                            ) }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class=" col-md-2 mt-2">
                                <div class="form-group col-sm-12 col-md-2" style="margin-top: 5px;">
                                    <button type="button" class="btn btn-danger" data-repeater-delete=""><i class="ft-x"></i>
                                        @lang('labels.remove')
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div data-repeater-item>
                    <div class="row">
                        <div class="col-md-10">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label required">@lang('hrm::house-details.house_type')</label>
                                        {{ Form::select('house_category_id', $categories, null,
                                            [
                                                'class' => 'form-control required house-type',
                                                'onchange' => 'getHouseByType(this.name)',
                                                'data-msg-required' => trans('labels.This field is required'),
                                            ]
                                        ) }}
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-lable required">@lang('hrm::house-details.house_id')</label>
                                        {{ Form::select('house_details_id', [], null,
                                            [
                                                'class' => 'form-control required house-details',
                                                'multiple',
                                                'data-msg-required' => trans('labels.This field is required'),
                                            ]
                                        ) }}
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label required">@lang('hrm::house-circular.applicable_designation')</label>
                                        {{ Form::select('designation_id', $designations, null,
                                            [
                                                'class' => 'required form-control designation',
                                                'multiple',
                                                'data-msg-required' => trans('labels.This field is required'),
                                            ]
                                        ) }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class=" col-md-2 mt-2">
                            <div class="form-group col-sm-12 col-md-2" style="margin-top: 5px;">
                                <button type="button" class="btn btn-danger" data-repeater-delete=""><i class="ft-x"></i>
                                    @lang('labels.remove')
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
               
            </div>
            <div class="row">
                <div class="col-md-12">
                    <button type="button" data-repeater-create="" class="btn btn-primary addMore"><i
                            class="ft-plus"></i> @lang('labels.add')
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Save & Cancel Button -->
    <div class="form-actions text-center">
        @if ($page == "create")
            <button type="submit" class="btn btn-primary" name="status" value="draft">
                <i class="ft-check-square"></i>
                @lang('labels.draft')
            </button>
        @else
            @if ($circular->status == "draft")
                <button type="submit" class="btn btn-primary" name="status" value="draft">
                    <i class="ft-check-square"></i>
                    @lang('labels.draft')
                </button>
            @endif
        @endif
        <button type="submit" class="btn btn-success">
            <i class="ft-check-square"></i>
            @lang('hrm::house-circular.publish')
        </button>
        <a class="btn btn-warning mr-1" role="button" href="{{route('house-categories.index')}}">
            <i class="ft-x"></i> @lang('labels.cancel')
        </a>
    </div>
    {!! Form::close() !!}
</div>
@push('page-js')
    <script>
        function getHouseByType(name) {
            let index = name.match(/\d+/).toString();
            let houseCategory = $("select[name='house-entries[" + index + "][house_category_id]']");
            let houseDetails = $("select[name='house-entries[" + index + "][house_details_id][]']");

            let val = $(houseCategory).val();
            let url = "{{ route('get-house-by-type') }}"
            let data = { typeId : val }
            
            $.get(url, data, function (response) {
                $(houseDetails).find('option').remove();
                for (let row = 0; row < response.length; row++) {
                    let obj = response[row];
                    $(houseDetails).append(`<option value="${obj.id}">${obj.house_id}</option>`)
                }
            });
        }
    </script>
@endpush