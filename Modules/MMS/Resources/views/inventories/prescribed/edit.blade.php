@extends('mms::layouts.master')

@section('content')
    <div class="prescription">
        <div class="card p-2">
            <div class="card-header border-bottom pl-0">
                <h3 class="form-section">
                    <i class="ft-grid"></i> Prescribed Medicine
                </h3>
            </div>
            <div class="card-content ">
                <div class="card-body">
                    {!! Form::open(['route' =>  ['circular.store'], 'class' => 'form', 'novalidate', 'method' => 'post', 'enctype' => 'multipart/form-data']) !!}

                    @include('mms::inventories.prescribed.form.edit.form')
                    @include('mms::inventories.prescribed.form.edit.medicineTable')
                    <div class="form-actions text-center">
                        <button type="button" class="btn btn-primary">
                            <i class="ft-check-square "></i> {{ trans('labels.save') }}
                        </button>
                        <button class="btn btn-warning" type="button"
                                onclick="window.location = '{{ route('inventories.prescribed.index') }}'">
                            <i class="ft-x"></i> {{ trans('labels.cancel') }}
                        </button>
                    </div>

                    {!! Form::close() !!}

                </div>
            </div>
        </div>

    </div>

@endsection



@push('page-js')
    <script type="text/javascript" src="{{ asset('theme/vendors/js/forms/repeater/jquery.repeater.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('theme/js/scripts/forms/form-repeater.js') }}"></script>
    <script>
        $(`.repeater-medicine`).repeater({
            initEmpty: false,
            show: function () {
                $(this).find('.select2-container').remove();
                $(this).find('select').select2({
                    placeholder: 'Select a Option'
                });

                $(this).slideDown();
            },

        });

        $(`.repeater-test`).repeater({
            initEmpty: true,
        });
    </script>
@endpush
