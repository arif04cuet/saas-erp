@extends('mms::layouts.master')
@section('title', trans('mms::medicine_inventory.site_titel'))
@section('content')

    <div class="medicine">
        <div class="card p-2">
            <div class="card-header border-bottom pl-0">
                <h3 class="form-section">
                    <i class="ft-grid"></i> @lang('mms::medicine_inventory.medicine_create_form')
                </h3>
            </div>
            <div class="card-content ">
                <div class="card-body">
                    @if ($page == "create")
                        {!! Form::open(['route' => 'inventories.medicines.store', 'class' => 'form company-form']) !!}
                    @else
                        {!! Form::open(['route' => ['inventories.medicines.update', $medicine_info->id], 'class' => 'form company-form']) !!}
                        @method('PUT')
                    @endif
                    @include('mms::inventories.medicines.form.create.form')

                    <div class="form-actions text-center">
                        <br>
                        <button type="submit" class="btn btn-primary">
                            <i class="ft-check-square "></i> {{ trans('labels.save') }}
                        </button>
                        <button class="btn btn-warning" type="button"
                                onclick="window.location = '{{ route('inventories.medicines.index') }}'">
                            <i class="ft-x"></i> {{ trans('labels.cancel') }}
                        </button>
                    </div>

                    {!! Form::close() !!}
                    {{--                    @include('mms::inventories.medicines.form.create.history-table')--}}
                </div>
            </div>
        </div>

    </div>
@endsection


@push('page-js')

    <!-- validation -->
    <script type="text/javascript" src="{{ asset('theme/vendors/js/forms/validation/jquery.validate.min.js') }}">
    </script>

    <script>
        $(document).ready(function () {
            validateForm('.company-form');

        });

    </script>
@endpush
