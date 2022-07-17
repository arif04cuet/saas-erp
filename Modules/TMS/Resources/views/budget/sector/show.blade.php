@extends('tms::layouts.master')
@section('title', __('tms::budget.sector.title').' '.__('labels.show'))

@section('content')
    <!-- General Information Card -->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"><i class="ft-list black"></i> @lang('tms::budget.sector.title') @lang('labels.show')</h4>
                        <a class="heading-elements-toggle" href=""><i class="la la-ellipsis-v font-medium-3"></i></a>
                        <div class="heading-elements" style="top: 5px;">
                            <ul class="list-inline mb-1">
                                <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                            </ul>
                        </div>
                    </div>
    
                    <div class="card-content collapse show">
                        <div class="card-body">
                            <div class="col-md-8">
                                <table class="master table">
                                    <tr>
                                        <th>@lang('labels.title')</th>
                                        <td>{{$sector->title_english}}</td>
                                    </tr>
                                    <tr>
                                        <th>@lang('tms::budget.sector.form.title_bangla')</th>
                                        <td>{{$sector->title_bangla}}</td>
                                    </tr>
                                    <tr>
                                        <th>@lang('labels.code')</th>
                                        <td>{{$sector->code}}</td>
                                    </tr>
                                    <tr>
                                        <th>@lang('labels.details')</th>
                                        <td>{{$sector->details}}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="tab-content px-1 pt-1">
    
                                <h4 class="card-title">@lang('accounts::budget.sectors')</h4>
    
                                <table class="master table repeater-category-request table-bordered">
                                    <thead>
                                    <tr>
                                        <th>@lang('labels.sequence')</th>
                                        <th width="35%">@lang('tms::budget.sector.form.title_bangla')</th>
                                        <th width="35%">@lang('labels.title')</th>
                                        <th width="20%">@lang('labels.details')</th>
                                    </tr>
                                    </thead>
                                    <tbody data-repeater-list="category">
                                    @foreach($sector->subSectors as $subSector)
                                        <tr>
                                            <td>{{$subSector->sequence}}</td>
                                            <td>{{$subSector->title_bangla}}</td>
                                            <td>{{$subSector->title_english}}</td>
                                            <td>{{$subSector->details}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="col-md-12">
                                <a href="{{route('tms-sectors.edit', $sector->id)}}" class="master btn btn-success">
                                    <i class="la la-pencil"></i> @lang('labels.edit')
                                </a>
                                <a href="{{route('tms-sectors.index')}}" class="master btn btn-danger">
                                    <i class="la la-backward"></i> @lang('labels.back_page')
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
    
            </div>
        </div>
    </div>

@endsection

@push('page-js')
    <script src="{{ asset('theme/vendors/js/forms/icheck/icheck.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('theme/js/scripts/tables/datatables/datatable-advanced.js') }}"
            type="text/javascript"></script>

    <!-- repeater -->
    <script type="text/javascript" src="{{ asset('theme/vendors/js/forms/repeater/jquery.repeater.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('theme/js/scripts/forms/form-repeater.js') }}"></script>
@endpush
