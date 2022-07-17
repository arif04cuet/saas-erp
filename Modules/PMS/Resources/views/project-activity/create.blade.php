@extends('tms::layouts.master')
@section('title', trans('tms::budget.sector.title'))

@section('content')
    <div class="row">
        <div class="col-12">

            <div class="card">
                <!-- Card Header -->
{{--                <div class="card-header">--}}
{{--                    <h4 class="card-title">--}}
{{--                        @lang('tms::budget.sector.title')--}}
{{--                        @if($page == 'create')--}}
{{--                            @lang('labels.create')--}}
{{--                        @else--}}
{{--                            @lang('labels.edit')--}}
{{--                        @endif--}}
{{--                    </h4>--}}
{{--                    <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>--}}
{{--                </div>--}}
{{--                <div class="card-content collapse show">--}}
                    <div class="card-body">
                        @if($page == 'create')
                            {!! Form::open(array('route' => ['pms-activity.store', $project], 'class' => 'form', 'method' => 'post', 'files' => 'true')) !!}
                        @else
                            {!! Form::open(array('route' => ['pms-activity.update', $project, $activity->id], 'class' => 'form', 'method' => 'post', 'files' => 'true')) !!}
                            @method('put')
                        @endif
                            @include('pms::project-activity.form')
                        {!!Form::close()!!}
                    </div>
{{--                </div>--}}
            </div>
        </div>

    </div>
@endsection

@push('page-css')
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/vendors/css/forms/icheck/icheck.css') }}">

    <link rel="stylesheet" type="text/css" href="{{  asset('theme/vendors/css/pickers/pickadate/pickadate.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/vendors/css/pickers/daterange/daterangepicker.css')  }}">
    <link rel="stylesheet" href="{{ asset('theme/css/plugins/pickers/daterange/daterange.css')  }}">
@endpush

@push('page-js')

    <!-- repeater -->
    <script type="text/javascript" src="{{ asset('theme/vendors/js/forms/repeater/jquery.repeater.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('theme/js/scripts/forms/form-repeater.js') }}"></script>

    <script src="{{ asset('theme/vendors/js/pickers/pickadate/picker.js')  }}"></script>
    <script src="{{ asset('theme/vendors/js/pickers/pickadate/picker.date.js') }}"></script>
    <script src="{{ asset('theme/js/scripts/pickers/dateTime/pick-a-datetime.js')  }}"></script>
    <script src="{{ asset('theme/vendors/js/pickers/daterange/daterangepicker.js') }}"></script>

    <script type="text/javascript">
        $('#expected_start_time, #expected_end_time,#actual_end_time').pickadate({
            format: 'yyyy-mm-dd',
        });

        $('#expected_start_time').change(function () {
            $('#actual_end_date').pickadate('picker').set('min', new Date($(this).val()));
        });

        $('#add').click(function () {
            $('#repeat-attachments').append('<br><input type="file" class="form-control" name="attachments[]">');
        });
    </script>


    <script>


        let sectorItemsRepeater = $(`.repeater-sector-items`).repeater({
            show: function () {
                $("input,select,textarea").not("[type=submit]").jqBootstrapValidation("destroy");
                $(this).slideDown(function () {

                    $("input,select,textarea").not("[type=submit]").jqBootstrapValidation();
                });
            },
            hide: function (deleteElement) {
                if (confirm('@lang('labels.confirm_delete')')) {
                    $(this).slideUp(deleteElement);
                }
            },
            // making the first item not deletable
            @if($page == 'create')
            isFirstItemUndeletable: true
            @endif
        });
    </script>

@endpush
