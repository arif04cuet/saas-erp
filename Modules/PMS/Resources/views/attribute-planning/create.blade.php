@extends('pms::layouts.master')
@section('title', trans('pms::attribute_planning.enter_planning'))
@push('page-css')
    <link rel="stylesheet" href="{{asset('/css/calculator/creative.min.css')}}">
@endpush
@section('content')
    <section>
        <div class="row">
            <div class="col-sm-12 col-md-5">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">@lang('pms::attribute_planning.enter_planning')</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                                <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            {!! Form::open(['route' =>  ['attribute-plannings.store', $project->id], 'class' => 'form']) !!}
                            <div class="form-body">
                                <h4 class="form-section"><i class="ft-user"></i> Attribute Planning Form</h4>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="date"
                                                   class="form-label required">@lang('labels.date')</label>
                                            {!! Form::text('date', null, [
                                                'class' => 'form-control' . ($errors->has('date') ? ' is-invalid' : ''),
                                                'autocomplete' => 'off',
                                                'required'
                                            ]) !!}

                                            @if ($errors->has('date'))
                                                <span class="invalid-feedback">
                                                    <strong>{{ $errors->first('date') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @foreach($project->attributes as $attribute)
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label required">{{ $attribute->name }}</label>
                                            {{ Form::hidden('planning[' . $loop->iteration . '][attribute_id]', $attribute->id) }}
                                            {{ Form::number('planning[' . $loop->iteration . '][planned_value]', null, [
                                                'class' => 'form-control',
                                                'min' => 0,
                                                'required'
                                            ]) }}

                                            <div class="help-block"></div>
                                            @if ($errors->has($attribute->id))
                                                <span class="invalid-feedback">
                                                        <strong>{{ $errors->first($attribute->id) }}</strong>
                                                    </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <div class="form-actions">
                                <button type="submit" class="btn btn-primary">
                                    <i class="la la-check-square-o"></i> {{trans('labels.save')}}
                                </button>
                                <a class="btn btn-warning mr-1" role="button"
                                   href="{{ route('project.show', $project->id) }}">
                                    <i class="ft-x"></i> {{trans('labels.cancel')}}
                                </a>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
            <!-- Calculator Div -->
            {{--https://www.jqueryscript.net/other/Material-Design-Calculator-jQuery.html--}}

            <div class="col-sm-12 col-md-7 ">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">@lang('pms::attribute_planning.calculator')</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                                <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-content">
                        <div class="card-body">

                            <div class="col-md-12 ">
                                <div class="row displayBox">
                                    <p class="displayText" id="display">0</p>
                                </div>
                                <div class="row numberPad">
                                    <div class="col-md-10 ">


                                            <div class=" text-center">
                                                    <button class="btn clear hvr-back-pulse" id="clear">C</button>
                                                    <button class="btn btn-calc hvr-radial-out" id="sqrt">√</button>
                                                    <button class="btn btn-calc hvr-radial-out hvr-radial-out" id="square">
                                                        x<sup>2</sup></button>
                                            </div>

                                            <div class=" text-center">
                                                <button class="btn btn-calc hvr-radial-out" id="seven">7</button>
                                                <button class="btn btn-calc hvr-radial-out" id="eight">8</button>
                                                <button class="btn btn-calc hvr-radial-out" id="nine">9</button>
                                            </div>

                                            <div class=" text-center">
                                                <button class="btn btn-calc hvr-radial-out" id="four">4</button>
                                                <button class="btn btn-calc hvr-radial-out" id="five">5</button>
                                                <button class="btn btn-calc hvr-radial-out" id="six">6</button>
                                            </div>


                                            <div class=" text-center">
                                                <button class="btn btn-calc hvr-radial-out" id="one">1</button>
                                                <button class="btn btn-calc hvr-radial-out" id="two">2</button>
                                                <button class="btn btn-calc hvr-radial-out" id="three">3</button>
                                            </div>

                                            <div class=" text-center">
                                                <button class="btn btn-calc hvr-radial-out" id="plus_minus">&#177;
                                                </button>
                                                <button class="btn btn-calc hvr-radial-out" id="zero">0</button>
                                                <button class="btn btn-calc hvr-radial-out" id="decimal">.</button>
                                            </div>



                                    </div>
                                    <div class="col-md-2 col-sm-12 operationSide">
                                        <button id="divide" class="btn btn-operation hvr-fade">÷</button>
                                        <button id="multiply" class="btn btn-operation hvr-fade">×</button>
                                        <button id="subtract" class="btn btn-operation hvr-fade">−</button>
                                        <button id="add" class="btn btn-operation hvr-fade">+</button>
                                        <button id="equals" class="btn btn-operation equals hvr-back-pulse">=</button>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection



@push('page-css')
    <link rel="stylesheet" href="{{ asset('theme/vendors/css/ui/jquery-ui.min.css') }}">
    <style>
        .ui-datepicker-calendar {
            display: none;
        }
    </style>
@endpush

@push('page-js')
    <script type="text/javascript" src="{{asset('/js/calculator/calculate.js')}}"></script>
    <script src="{{ asset('theme/js/core/libraries/jquery_ui/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('theme/js/scripts/ui/jquery-ui/date-pickers.js') }}"></script>
    <script src="{{ asset('js/month-year/custom-jquery-datepicker.js') }}"></script>
    <script>
        $(document).ready(function () {
            monthYearDatePicker('input[name=date]');
        });
    </script>
@endpush