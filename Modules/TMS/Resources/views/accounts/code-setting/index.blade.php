@extends('tms::layouts.master')
@section('title',trans('tms::tms_code_setting.title'))

@section('content')
    <section id="">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title"><i class="ft-list black"></i> @lang('tms::tms_code_setting.title')</h4>
                            <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                            <div class="heading-elements">
                                <a href="{{route('tms.code-setting.create')}}" class="master btn btn-primary btn-sm"><i
                                        class="ft-plus white"></i>
                                    {{ trans('tms::tms_code_setting.create') }}
                                </a>
                                <a href="{{route('tms.code-setting.edit')}}" class="master btn btn-warning btn-sm"><i
                                        class="ft-edit white"></i>
                                    {{ trans('labels.update') }}
                                </a>
    
                            </div>
                        </div>
    
                        <div class="card-content collapse show">
                            <div class="card-body card-dashboard">
    
                                <div class="table-responsive">
                                    <table class="master table table-striped table-bordered alt-pagination text-center">
                                        <thead>
                                        <tr>
                                            <th>{{trans('labels.serial')}}</th>
                                            <th>@lang('tms::tms_code_setting.form_elements.economy_code')</th>
                                            <th>@lang('tms::tms_code_setting.form_elements.journal_id')</th>
                                            <th>@lang('tms::tms_code_setting.form_elements.tms_sub_sector_id')</th>
                                        </tr>
                                        </thead>
                                        <tbody>
    
                                        @foreach($codeSettings as $codeSetting)
                                            <tr>
                                                <th scope="row">@enToBnNumber($loop->iteration)</th>
                                                <td>{{optional($codeSetting->economyCode)->getName() ?? ''}}
                                                    - @enToBnNumber($codeSetting->economy_code ?? 0,false)
                                                </td>
                                                <td>{{$codeSetting->journal->name ?? trans('labels.not_found')}}</td>
                                                <td>
                                                    <ul>
                                                        @foreach($codeSetting->details as $subSector)
                                                            <li>
                                                                {{$subSector->tmsSubSector->getTitle() ?? trans('labels.not_found')}}
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </td>
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
        </div>
    </section>
@endsection



@push('page-js')
    <script src="{{ asset('theme/vendors/js/forms/icheck/icheck.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('theme/js/scripts/tables/datatables/datatable-advanced.js') }}"
            type="text/javascript"></script>
@endpush
