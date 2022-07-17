@extends('ims::layouts.master')
@section('title', trans('ims::auction.add_menu_title'))

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">@lang('ims::auction.add_menu_title')</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                        <div class="heading-elements" style="top: 5px;">
                            <ul class="list-inline mb-1">
                                <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                            </ul>
                        </div>
                        <div class="heading-elements mt-2" style="margin-right: 10px;">
                            <a href="{{ route('auctions.index') }}" class="btn btn-primary btn-sm">
                                <i class="ft-list white">@lang('ims::auction.list_menu_title')</i>
                            </a>
                        </div>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body">
                            {{ Form::open(['route'=>['auctions.update',$auction->id]]) }}
                            @method('PUT')
                            <h4 class="form-section"><i class="la la-puzzle-piece"></i> @lang('ims::auction.title')</h4>
                            <div class="row">
                                <!-- Auction Title -->
                                <div class="col">
                                    <label for="auction_title"> @lang('ims::auction.name')</label>
                                    <input id="auction_title" name="auction_title" type="text" class="form-control"
                                           placeholder="@lang('ims::auction.name')" value="{{$auction->title}}"
                                           required>
                                </div>

                                <!-- Auction Date -->
                                <div class="col">
                                    <label class="required">@lang('ims::auction.date')</label>
                                    {{ Form::text('auction_date', date('d/m/Y',strtotime($auction->date)), ['class' => 'form-control']) }}
                                </div>

                            </div>


                            <h4 class="form-section"><i class="la la-puzzle-piece"></i> @lang('ims::auction.scrap_add')
                            </h4>

                            <!-- Scrap Products -->
                            @if(isset($auctionDetails))
                                <div class="repeater-default">
                                    <div data-repeater-list="scrap_product">
                                        @foreach ($auctionDetails as $auctionDetail)
                                            <div data-repeater-item>
                                                <div class="form row">
                                                {!! Form::hidden('id', $auctionDetail->id) !!}
                                                <!--Scrap Category -->
                                                    <div class="form-group mb-1 col-sm-12 col-md-5">
                                                        <label class="required">{{ trans('ims::auction.category') }}</label>
                                                        <br>
                                                        {!! Form::select('category_id', $scrapCategories, $auctionDetail->category_id,
                                                        ['class' => 'form-control category-type-select required','onChange' => '', 'data-msg-required' =>
                                                        Lang::get('labels.This field is required')]) !!}
                                                        <span class="select-error"></span>
                                                    </div>
                                                    <!-- Scrap Quantity -->
                                                    <div class="form-group mb-1 col-sm-12 col-md-2">
                                                        <label class="required"
                                                               for="quantity">{{ trans('ims::auction.quantity') }}</label>
                                                        <br>
                                                        {!! Form::number('quantity', $auctionDetail->quantity, [
                                                        'class' => 'form-control required', 'placeholder' => 'e.g. 2',
                                                        'data-msg-required' => trans('labels.This field is required'),
                                                        'min' => 1,
                                                        'data-msg-min'=> trans('labels.At least 1 characters'),
                                                        'max' => 100,
                                                        'data-msg-max'=> trans('labels.At most 100 characters'),
                                                        ]) !!}
                                                    </div>

                                                    <div class="form-group col-sm-12 col-md-1 text-center mt-2">
                                                        <button type="button" class="btn btn-outline-danger"
                                                                data-repeater-delete="">
                                                            <i class="ft-x"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <hr>
                                            </div>
                                        @endforeach
                                    </div>

                                    <div class="form-group overflow-auto">
                                        <div class="col-12">
                                            <button type="button" data-repeater-create id="add_scrap_product"
                                                    class="pull-right btn btn-sm btn-outline-primary">
                                                <i class="ft-plus"></i> @lang('labels.add')
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="repeater-default">
                                    <div data-repeater-list="scrap_product">
                                        <div data-repeater-item>
                                            <div class="form row">
                                            {!! Form::hidden('id', $auctionDetail->id) !!}
                                            <!--Scrap Category -->
                                                <div class="form-group mb-1 col-sm-12 col-md-5">
                                                    <label class="required">{{ trans('ims::auction.category') }}</label>
                                                    <br>
                                                    {!! Form::select('category_id', $scrapCategories, $auctionDetail->category_id,
                                                    ['class' => 'form-control category-type-select required', 'placeholder' =>
                                                    'Select Category', 'onChange' => '', 'data-msg-required' =>
                                                    Lang::get('labels.This field is required')]) !!}
                                                    <span class="select-error"></span>
                                                </div>
                                                <!-- Scrap Quantity -->
                                                <div class="form-group mb-1 col-sm-12 col-md-2">
                                                    <label class="required"
                                                           for="quantity">{{ trans('ims::auction.quantity') }}</label>
                                                    <br>

                                                    {!! Form::number('quantity', $auctionDetail->quantity, [
                                                    'class' => 'form-control required', 'placeholder' => 'e.g. 2',
                                                    'data-msg-required' => trans('labels.This field is required'),
                                                    'min' => 1,
                                                    'data-msg-min'=> trans('labels.At least 1 characters'),
                                                    'max' => 100,
                                                    'data-msg-max'=> trans('labels.At most 100 characters'),
                                                    ]) !!}
                                                </div>

                                                <div class="form-group col-sm-12 col-md-1 text-center mt-2">
                                                    <button type="button" class="btn btn-outline-danger"
                                                            data-repeater-delete="">
                                                        <i class="ft-x"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <hr>
                                        </div>
                                    </div>

                                    <div class="form-group overflow-auto">
                                        <div class="col-12">
                                            <button type="button" data-repeater-create id="add_scrap_product"
                                                    class="pull-right btn btn-sm btn-outline-primary">
                                                <i class="ft-plus"></i> @lang('labels.add')
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @endif

                        <!-- Labels -->
                            <div class="form-actions mb-lg-3">
                                <a class="btn btn-warning pull-right" role="button" href="{{ route('auctions.index') }}"
                                   style="margin-left: 2px;">
                                    <i class="ft-x"></i> {{trans('labels.cancel')}}
                                </a>
                                <button type="submit" class="btn btn-primary pull-right">
                                    <i class="la la-check-square-o"></i> {{trans('labels.save')}}
                                </button>
                            </div>
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('page-css')
    <link rel="stylesheet" href="{{ asset('theme/vendors/css/forms/icheck/icheck.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/css/plugins/forms/checkboxes-radios.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/css/plugins/forms/wizard.css') }}">

    <link rel="stylesheet" href="{{  asset('theme/vendors/css/pickers/pickadate/pickadate.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/vendors/css/pickers/daterange/daterangepicker.css')  }}">
    <link rel="stylesheet" href="{{ asset('theme/css/plugins/pickers/daterange/daterange.css')  }}">
@endpush

@push('page-js')
    <script src="{{ asset('theme/vendors/js/pickers/pickadate/picker.js') }}"></script>
    <script src="{{ asset('theme/vendors/js/pickers/pickadate/picker.date.js') }}"></script>
    <script src="{{ asset('theme/js/scripts/pickers/dateTime/pick-a-datetime.js') }}"></script>

    <script src="{{ asset('theme/vendors/js/pickers/daterange/daterangepicker.js') }}"></script>
    <script src="{{ asset('theme/vendors/js/extensions/jquery.steps.min.js') }}"></script>
    <script src="{{ asset('theme/vendors/js/forms/validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('theme/js/scripts/forms/wizard-steps.js') }}"></script>
    <script src="{{ asset('js/booking-request/step.js') }}"></script>
    <script src="{{ asset('theme/vendors/js/forms/icheck/icheck.min.js') }}"></script>
    <script src="{{ asset('theme/js/scripts/forms/checkbox-radio.js') }}"></script>

    <script type="text/javascript">
        let allValues = @json(array_keys($scrapCategories));
        let scrapProducts = JSON.parse('@json($scrapCategories)');
    </script>


    <script src="{{ asset('theme/vendors/js/forms/repeater/jquery.repeater.min.js') }}"></script>
    <script src="{{ asset('theme/js/scripts/forms/form-repeater.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/auction/auction.js') }}"></script>


@endpush