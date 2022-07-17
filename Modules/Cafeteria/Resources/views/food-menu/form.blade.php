<div class="card-body">
    @if ($page == "create")
    {!! Form::open(['route' => 'food-menus.store', 'class' => 'form food-menu-form']) !!}
    @else
    {!! Form::open(['route' => ['food-menus.update', $foodMenu->id ], 'class' => 'form food-menu-form']) !!}
    @method('PUT')
    @endif
    <div id="invoice-items-details" class="">
        <h4 class="form-section"><i class="la la-tag"></i>@lang('cafeteria::food-menu.title') @lang('cafeteria::cafeteria.information')</h4>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('Name (Bangla)',  trans('cafeteria::cafeteria.bangla_name'), ['class' => 'form-label required']) !!}
                    {!! Form::text('bn_name', $page == "edit" ? $foodMenu->bn_name : null, ['class' =>
                    "form-control required",
                    'placeholder' => trans('cafeteria::cafeteria.bangla_name'),
                    'data-msg-required'=> __('labels.This field is required'),
                    'data-rule-maxlength' => 50,
                    'data-msg-maxlength'=> trans('labels.At most 50 characters'),
                     ])!!}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('Name (English)', trans('cafeteria::cafeteria.english_name'), ['class' => 'form-label required']) !!}
                    {!! Form::text('en_name',  $page == "edit" ? $foodMenu->en_name : null, ['class' =>
                    'form-control required',
                    'placeholder' => trans('cafeteria::cafeteria.english_name'),
                    'data-msg-required'=> __('labels.This field is required'),
                    'data-rule-maxlength' => 50,
                    'data-msg-maxlength'=> trans('labels.At most 50 characters'),
                     ])!!}
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('raw_material_id', trans('cafeteria::food-menu.food'), ['class' => 'form-label required']) !!}
                    {!! Form::select('raw_material_id[]', $finishFoods, $page == "edit" ? $foodMenu->foodMenuItems->pluck('raw_material_id') : null, ['class' =>
                    "form-control material-dropdown-select required",
                    "multiple",
                    'data-msg-required'=> __('labels.This field is required'),
                    ])!!}
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('Remark', trans('labels.remarks'), ['class' => 'form-label'])!!}
                    {!! Form::textarea('remark', $page == "edit" ? $foodMenu->remark : null, ['class' => 'form-control', 'rows' => 2,
                    'data-rule-maxlength' => 255,
                    'data-msg-maxlength'=> trans('labels.At most 255 characters'),
                     ])!!}
                </div>
            </div>
        </div>
    </div>

    <!-- Save & Cancel Button -->
    <div class="form-actions text-center">
        <button type="submit" class="btn {{ $page == "edit" ? 'btn-primary' : 'btn-success'}}">
            <i class="ft-check-square"></i>
            @lang('labels.save')
        </button>
        <a class="btn btn-warning mr-1" role="button" href="{{route('food-menus.index')}}">
            <i class="ft-x"></i> @lang('labels.cancel')
        </a>
    </div>
    {!! Form::close() !!}
</div>