@extends('hrm::layouts.master')
@section('title', trans('hrm::designation.add_card_title'))

@section("content")

    <div class="col-xl-12 col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title" id="repeat-form">@lang('hrm::designation.add_card_title')</h4>
                <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                <div class="heading-elements">
                    <ul class="list-inline mb-0">
                        <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                        <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                        <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                    </ul>
                </div>

            </div>
            <div class="card-content collapse show" style="">
                <div class="card-body">
                    {!! Form::open(['url' => route('designation.store'), 'class' => 'form',' novalidate']) !!}
                    @include('hrm::designation.form.designation_store_update_form')
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
