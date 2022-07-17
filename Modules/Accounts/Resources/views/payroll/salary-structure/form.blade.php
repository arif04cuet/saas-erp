@if($page == 'create')
    {!! Form::open(['route' =>  'salary-structures.store', 'class' => 'form salary-structure-form', 'novalidate']) !!}
@else
    {!! Form::open(['route' => ['salary-structures.update', $salaryStructure->id], 'class' => 'salary-structure-form']) !!}
    @method('PUT')
@endif
<h4 class="form-section"><i class="la la-tag"></i>@lang('accounts::salary-structure.title')</h4>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('name', trans('labels.name'), ['class' => 'form-label required']) !!}
            {!! Form::text('name', $page == 'create' ? old('name') : $salaryStructure->name, ['class' => 'form-control'.($errors->has('name') ? ' is-invalid' : ''), 'required',
            "placeholder" => "e.g Project Director",
            'data-validation-maxlength-maxlength' => 255, 'data-validation-maxlength-message' =>
            __('validation.lte.numeric', ['attribute' => __('labels.name'), 'value' => \App\Utilities\EnToBnNumberConverter::en2bn(255)]),
            'data-validation-required-message'=>trans('validation.required', ['attribute' => __('labels.name')])]) !!}
            <div class="help-block"></div>
            @if ($errors->has('name'))
                <span class="invalid-feedback">{{ $errors->first('name') }}</span>
            @endif
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('parent_structure', trans('accounts::salary-structure.parent_structure'), ['class' => 'form-label']) !!}
            {!! Form::select('parent_structure', $structures, $page === 'create' ? null : $salaryStructure->parent_structure,
['class'=>'form-control select2 required']) !!}
            <div class="help-block"></div>
            @if ($errors->has('salary_category'))
                <span class="invalid-feedback">{{ $errors->first('salary_category') }}</span>
            @endif
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('reference', trans('accounts::salary-structure.reference'), ['class' => 'form-label']) !!}
            <span class="danger">*</span>
            {!! Form::text('reference', $page == 'create' ? old('reference') : $salaryStructure->reference, ['class' => 'form-control'.($errors->has('reference') ? ' is-invalid' : ''), 'required',
            "placeholder" => "",
            'data-validation-maxlength-maxlength' => 255, 'data-validation-maxlength-message' =>
            __('validation.lte.numeric', ['attribute' => __('labels.name'), 'value' => \App\Utilities\EnToBnNumberConverter::en2bn(255)]),
            'data-validation-required-message' => trans('validation.required', ['attribute' => __('accounts::salary-structure.reference')])]) !!}
            <div class="help-block"></div>
            @if ($errors->has('reference'))
                <span class="invalid-feedback">{{ $errors->first('reference') }}</span>
            @endif
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('is_parent', trans('accounts::salary-structure.is_parent'), ['class' => 'form-label']) !!}
            {!! Form::checkbox('is_parent', 1, $page == 'create' ? old('is_parent') : $salaryStructure->is_parent) !!}
            <div class="help-block"></div>
            @if ($errors->has('reference'))
                <span class="invalid-feedback">{{ $errors->first('reference') }}</span>
            @endif
        </div>
    </div>
    <div class="col-md-12">
        <h4 class="form-section"><i class="fa fa-plus"></i>
            Salary Rules
        </h4>
        <div class="form-group">
            {!! Form::label('salary_rules', trans('accounts::salary-structure.rules'), ['class' => 'form-label']) !!}
            <span class="danger">*</span>
            {!! Form::select('salary_rules[]', $rules, $page === 'create' ? null : $salaryStructure->rules,
['id' => 'salary_rules','required','class'=>'form-control select2 required', 'multiple',
'data-validation-required-message' => __('labels.This field is required')]) !!}
            <div class="help-block"></div>
            @if ($errors->has('salary_rules'))
                <span class="invalid-feedback">{{$errors->first('salary_rules')}}</span>
            @endif
        </div>

        <!-- Invoice Items Details -->
        <div class="col-md-12">
            <div id="invoice-items-details" class="">
                <div class="row">
                    <div class="table-responsive">
                        <table class="table repeater-category-request table-bordered" id="salary-rules-table">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th class="">Code</th>
                                <th class="">Category</th>
                                <th class="">Contribution Register</th>
                                {{--<th width="1%"><i data-repeater-create class="la la-plus-circle text-info"--}}
                                {{--style="cursor: pointer"></i></th>--}}
                            </tr>
                            </thead>
                            <tbody data-repeater-list="category">


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="form-actions text-center">
    <button type="submit" class="btn btn-primary">
        <i class="la la-check-square-o"></i>{{$page == 'create' ? trans('labels.save') : trans('labels.update')}}
    </button>
    <a class="btn btn-warning mr-1" role="button" href="{{url(route('salary-structures.index'))}}">
        <i class="ft-x"></i> @lang('labels.cancel')
    </a>
</div>
{!! Form::close() !!}
