<div class="card-body">
    @if ($page == "create")
    {!! Form::open(['route' => 'raw-materials.store', 'class' => 'form raw-material-form']) !!}
    @else
    {!! Form::open(['route' => ['raw-materials.update', $rawMaterial->id ], 'class' => 'form raw-material-form']) !!}
    @method('PUT')
    @endif
    <div id="invoice-items-details" class="">
        <h4 class="form-section"><i class="la la-tag"></i>@lang('cafeteria::raw-material.title') @lang('labels.form')
        </h4>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('bn_name',
                    trans('cafeteria::raw-material.bangla_name'),
                    ['class' => 'form-label, required']) !!}
                    {!! Form::text('bn_name',
                    $page == "edit" ? $rawMaterial->bn_name : null,
                    ['class' => "form-control required",
                    'placeholder' => trans('cafeteria::raw-material.bangla_name'),
                    'data-msg-required'=> __('labels.This field is required'),
                    'data-rule-maxlength' => 50,
                    'data-msg-maxlength'=> trans('labels.At most 50 characters'),
                    ])!!}
                    <div class="help-block"></div>
                    @if ($errors->has('bn_name'))
                    <span class="invalid-feedback">{{ $errors->first('bn_name') }}</span>
                    @endif
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('en_name',
                    trans('cafeteria::raw-material.english_name'),
                    ['class' => 'form-label required']) !!}
                    {!! Form::text('en_name',
                    $page == "edit" ? $rawMaterial->en_name : null,
                    ['class' => 'form-control required',
                    'placeholder' => trans('cafeteria::raw-material.english_name'),
                    'data-msg-required'=> __('labels.This field is required'),
                    'data-rule-maxlength' => 50,
                    'data-msg-maxlength'=> trans('labels.At most 50 characters'),
                    ])!!}
                    <div class="help-block"></div>
                    @if ($errors->has('en_name'))
                    <span class="invalid-feedback">{{ $errors->first('en_name') }}</span>
                    @endif
                </div>
            </div>

            <!-- unique code -->
            <div class="col-md-3">
                <div class="form-group">
                    {!! Form::label('short_code',
                    trans('cafeteria::raw-material.short_code'),
                    ['class' => 'form-label required']) !!}
                    {!! Form::text('short_code', $page == "edit" ? $rawMaterial->short_code : null,
                    ['class' => 'form-control required',
                    'placeholder' => trans('cafeteria::raw-material.short_code'),
                    'data-msg-required'=> __('labels.This field is required'),
                    'data-rule-maxlength' => 11,
                    'data-msg-maxlength'=> trans('labels.At most 11 characters'),
                    ])!!}
                    <!-- error message -->
                    @if ($errors->has('short_code'))
                    <div class="help-block text-danger">
                        {{ $errors->first('short_code') }}
                    </div>
                    @endif
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    {!! Form::label('raw_material_category_id',
                    trans('cafeteria::raw-material-category.title'),
                    ['class' => 'form-label required']) !!}
                    {!! Form::select('raw_material_category_id', 
                    $category, $page == "edit" 
                    ? $rawMaterial->raw_material_category_id : null, 
                    ['class' => 'form-control select2 required',
                    'data-msg-required'=> __('labels.This field is required')
                    ])!!}
                </div>
            </div>

            <!-- inventory amount and unit -->
            @if ($page == "create")
            <div class="col-md-3">
                <div class="form-group">
                    {!! Form::label('available_amount',
                    trans('cafeteria::inventory.available_amount'),
                    ['class' => 'form-label required']) !!}
                    {!! Form::text('available_amount', null,
                    ['class' => 'form-control required',
                    'placeholder' => trans('cafeteria::inventory.available_amount'),
                    'data-msg-required'=> __('labels.This field is required'),
                    'data-rule-maxlength' => 7,
                    'data-msg-maxlength'=> trans('labels.At most 7 characters'),
                    'min' => 0,
                    'data-msg-min'=> trans('labels.Please enter a value greater than or equal to 0')
                    ])!!}
                </div>
            </div>
            @endif

            <div class="col-md-{{ $page== "edit" ? '6' : '3' }}">
                <div class="form-group">
                    {!! Form::label('unit_id',
                    trans('cafeteria::unit.title'),
                    ['class' => 'form-label required']) !!}
                    {!! Form::select('unit_id', $units, $page == "edit" ? $rawMaterial->unit_id : null, ['class' => '
                    form-control select2 required',
                    'data-msg-required'=> __('labels.This field is required')
                    ])!!}
                </div>
            </div>

            <!-- Type -->
            <div class="col-md-6">
                {!! Form::label('type',
                trans('cafeteria::raw-material.type.title'),
                ['class' => 'form-label required']) !!}
                <p></p>
                @if ($page == "edit")
                <div class="form-check-inline skin skin-flat">
                    {!! Form::radio('type', 'finish-food',
                    $rawMaterial->type == 'finish-food' ? true : false,
                    ['class' => 'required' ]) !!}
                    <label>@lang('cafeteria::raw-material.type.prepare_food')</label>
                </div>
                <div class="form-check-inline skin skin-flat">
                    {!! Form::radio('type', 'raw-item',
                    $rawMaterial->type == 'raw-item' ? true : false,
                    ['class' => 'required']) !!}
                    <label>@lang('cafeteria::raw-material.type.raw_item')</label>
                </div>
                @else
                <div class="form-check-inline skin skin-flat">
                    {!! Form::radio('type', 'finish-food', false,
                    ['class' => 'required']) !!}
                    <label>@lang('cafeteria::raw-material.type.prepare_food')</label>
                </div>
                <div class="form-check-inline skin skin-flat">
                    {!! Form::radio('type', 'raw-item', true,
                    ['class' => 'required',]) !!}
                    <label>@lang('cafeteria::raw-material.type.raw_item')</label>
                </div>
                @endif
            </div>

            @include('cafeteria::raw-material.unit-price-form')

            <!-- remarks -->
            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('remark',
                        trans('labels.remarks'),
                        ['class' => 'form-label']) !!}
                    {!! Form::textarea('remark',
                        $page == "edit" ? $rawMaterial->remark : null,
                        ['class' => 'form-control', 'rows' => 2,
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

        <!-- Save & Cancel Button -->
        <div class="form-actions text-center">
            <button type="submit" class="btn {{ $page == "edit" ? 'btn-primary' : 'btn-success'}}">
                <i class="ft-check-square"></i>
                @lang('labels.save')
            </button>
            <a class="btn btn-warning mr-1" role="button" href="{{route('raw-materials.index')}}">
                <i class="ft-x"></i> @lang('labels.cancel')
            </a>
        </div>
        {!! Form::close() !!}
    </div>
</div>