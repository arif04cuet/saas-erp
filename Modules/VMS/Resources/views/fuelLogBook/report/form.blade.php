<div class="card-body">
    {!! Form::open(['route' => 'vms.fuel.log.store', 'class' => 'form company-form']) !!}
    <div id="invoice-items-details" class="">
        <h4 class="form-section"><i class="la la-tag"></i>@lang('vms::fuelLogBook.title') @lang('labels.form')</h4>
        <!-- filling station -->
        <div class="row">
            <div class="col-6">
                {!! Form::label('filling_station_label', trans('vms::fuelLogBook.form_elements.filling_station'), ['class' => 'form-label required']) !!}
                {{
                       Form::select('filling_station_id', $fillingStation, $page == "edit" ? $fillingStation ? $fuelLog->filling_station_id : null : null, [
                            'class' => 'form-control required select2',
                'data-msg-required'=> __('labels.This field is required'),
                'id'=>'filling_station_id',
                'multiple'=>'multiple',
                ])
                }}
                <!-- error message -->
                @if ($errors->has('filling_station_id'))
                    <div class="help-block text-danger">
                        {{ $errors->first('filling_station_id') }}
                    </div>
                @endif
            </div>

            <div class="col-6">
                <div class="form-group">
                    {!! Form::label('date_label', trans('labels.date'),
                     ['class' => 'form-label required']) !!}
                    {!! Form::text('date', $page == "edit"
                                ? date('d M Y', strtotime($fuelLog->date))
                                : date('d M Y'), ['class' =>'form-control required datepicker','id'=>'date','data-validation-required-message'=> __('labels.This field is required')])!!}
                    @if ($errors->has('date'))
                        <span class="invalid-feedback">{{ $errors->first('date') }}</span>
                    @endif
                </div>
            </div>

            {{--            <div class="col-2 mt-2">--}}
            {{--                <button type="button" class="btn btn-success">--}}
            {{--                    <i class="ft-check-square"></i>--}}
            {{--                    @lang('labels.save')--}}
            {{--                </button>--}}
            {{--            </div>--}}
        </div>
        {!! Form::close() !!}
        <br>
    </div>
</div>
@push('page-css')
    <link rel="stylesheet" href="{{ asset('theme/vendors/css/pickers/daterange/daterangepicker.css')  }}">
    <link rel="stylesheet" href="{{ asset('theme/css/plugins/pickers/daterange/daterange.css')}}">
    <link rel="stylesheet" href="{{  asset('theme/vendors/css/pickers/pickadate/pickadate.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/css/plugins/pickers/daterange/daterange.css')  }}">
@endpush
@push('page-js')
    <script src="{{ asset('theme/vendors/js/pickers/daterange/daterangepicker.js') }}"></script>
    <script src="{{ asset('theme/vendors/js/pickers/pickadate/picker.js')  }}"></script>
    <script src="{{ asset('theme/vendors/js/pickers/pickadate/picker.date.js') }}"></script>
    <script>

        $(document).ready(function () {
            let cb = function (start, end, label) {
                jQuery('.daterange span').html(start.format('D MMMM, YYYY') + ' - ' + end.format('D MMMM, YYYY'));
            };

            let dat_opt = {
                showDropdowns: true,
                showWeekNumbers: false,
                startDate: moment().startOf('month'),
                endDate: moment().endOf('month'),
                locale: {
                    format: 'YYYY-MM-DD'
                }
            };
            $('.datepicker').daterangepicker(dat_opt, cb);
            cb(dat_opt.startDate, dat_opt.endDate);

        });
    </script>
@endpush
