@if($page == 'create')
    {!! Form::open(['route' =>  'payscales.store', 'class' => 'form', 'novalidate']) !!}
@else
    {!! Form::open(['route' => ['payscales.update', $payscale->id], 'class' => 'form', 'novalidate']) !!}
    @method('PUT')
@endif
<h4 class="form-section"><i class="la la-tag"></i>@lang('accounts::payscale.title')</h4>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('title', trans('labels.title'), ['class' => 'form-label required']) !!}
            {!! Form::text('title', $page == 'create' ? old('title') : $payscale->title, ['class' => 'form-control'.($errors->has('title') ? ' is-invalid' : ''), 'required',
            "placeholder" => "e.g National Payscale 2015",
            'data-validation-maxlength-maxlength' => 100, 'data-validation-maxlength-message' => __('validation.lte.numeric',
            ['attribute' => __('labels.title'), 'value' => \App\Utilities\EnToBnNumberConverter::en2bn(100)]),
            'data-validation-required-message'=> trans('validation.required', ['attribute' => __('labels.title')])]) !!}
            <div class="help-block"></div>
            @if ($errors->has('title'))
                <span class="invalid-feedback">{{ $errors->first('title') }}</span>
            @endif
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('active_from', trans('accounts::payscale.active_from'), ['class' => 'form-label required']) !!}
            {!! Form::text('active_from', $page === 'create' ? old('active_from') : date('d F Y', strtotime($payscale->active_from)), ['class'=>'form-control required', 'required',
            'data-validation-required-message'=>trans('validation.required', ['attribute' => __('accounts::payscale.active_from')])]) !!}
            <div class="help-block"></div>
            @if ($errors->has('active_from'))
                <div class="help-block red">{{$errors->first('active_from') }}</div>
            @endif
        </div>
    </div>

    <div class="col-md-12">

        <!-- Invoice Items Details -->
        <div class="col-md-12">
            <div id="invoice-items-details" class="">
                <div class="row">
                    <div class="table-responsive">
                        <table class="table repeater-category-request table-bordered" id="salary-rules-table">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>@lang('accounts::payscale.grade')<span class="red"> *</span></th>
                                <th>@lang('accounts::payscale.gradewise_basic') <span class="red"> *</span></th>
                                <th>@lang('accounts::payscale.percentage_of_increment') <span class="red"> *</span></th>
                                <th>@lang('accounts::payscale.no_of_increment') <span class="red"> *</span></th>
                                {{--<th width="1%"><i data-repeater-create class="la la-plus-circle text-info"--}}
                                {{--style="cursor: pointer"></i></th>--}}
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($grades as $key => $grade)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{($page == 'create')? $grade : "Grade ".$grade->grade}}</td>
                                    <td>
                                        <div class="form-group">


                                            {!! Form::text('basic[]', ($page == 'create')? null : $grade->basic_salary,
    ['class'=>'form-control input-sm required', 'required', 'placeholder' => 'Basic Salary',
    'data-validation-required-message' => __('labels.This field is required'),
    'maxlength' => 6, 'id' => 'basic_'.$key, 'onkeyup' => 'getDecimal(this.id)']) !!}
                                            <div class="help-block"></div>
                                        </div>
                                    </td>
                                    <td>{!! Form::text('increment[]', ($page == 'create')? 5 : $grade->percentage_of_increment,
['class'=>'form-control input-sm required','required', 'placeholder' => 'Increment']) !!}</td>
                                    <td>{!! Form::number('no_of_increment[]', ($page == 'create')? null : $grade->no_of_increment,
['class'=>'form-control input-sm required','required', 'placeholder' => 'No of Increment']) !!}</td>
                                </tr>
                            @endforeach

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
    <a class="btn btn-warning mr-1" role="button" href="{{route('payscales.index')}}">
        <i class="ft-x"></i> @lang('labels.cancel')
    </a>
</div>
{!! Form::close() !!}
