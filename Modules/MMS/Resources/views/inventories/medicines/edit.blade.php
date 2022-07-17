@extends('mms::layouts.master')
@section('title', trans('mms::medicine_inventory.site_titel'))
@section('content')

    <div class="medicine">
        <div class="card p-2">
            <div class="card-header border-bottom pl-0">
                <h3 class="form-section">
                    <i class="ft-grid"></i> Medicine
                </h3>
            </div>
            <div class="card-content ">
                <div class="card-body">
                    {!! Form::open(['route' =>  ['circular.store'], 'class' => 'form', 'novalidate', 'method' => 'post', 'enctype' => 'multipart/form-data']) !!}

                    @include('mms::inventories.medicines.form.edit.form')
                    @include('mms::inventories.medicines.form.edit.history-table')

                    <div class="form-actions text-center">
                        <button type="button" class="btn btn-primary">
                            <i class="ft-check-square "></i> {{ trans('labels.save') }}
                        </button>
                        <button class="btn btn-warning" type="button"
                                onclick="window.location = '{{ route('inventories.medicines.index') }}'">
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
@endpush
