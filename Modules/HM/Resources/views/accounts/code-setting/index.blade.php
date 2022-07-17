@extends('hm::layouts.master')
@section('title',trans('hm::hm_journal_entry.journal_entry.title'))

@section('content')

    <section id="">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title"><i class="ft-tag black"></i> @lang('hm::hm_code_setting.title')</h4>
                            <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                            <div class="heading-elements">
                                <a href="{{route('hm.accounts.code-setting.create')}}" class="master btn btn-primary btn-sm"><i
                                        class="ft-plus white"></i>
                                    {{ trans('hm::hm_code_setting.create') }}
                                </a>
                                <a href="{{route('hm.accounts.code-setting.edit')}}" class="master btn btn-warning btn-sm"><i
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
                                            <th>@lang('hm::hm_code_setting.form_elements.economy_code')</th>
                                            <th>@lang('hm::hm_code_setting.form_elements.journal_id')</th>
                                            <th>@lang('hm::hm_code_setting.form_elements.hostel_budget_section_id')</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($codeSettings as $codeSetting)
                                            <tr>
                                                <td scope="row">@enToBnNumber($loop->iteration)</td>
                                                <td>
                                                    @enToBnNumber($codeSetting->economy_code ?? 0,false)
                                                    - {{$codeSetting->economyCode->getName() ?? trans('labels.not_found')}}
                                                </td>
                                                <td>{{$codeSetting->journal->name ?? trans('labels.not_found')}}</td>
                                                <td>
                                                    <ul>
                                                        @foreach($codeSetting->details as $detail)
                                                            <li>
                                                                {{$detail->hostelBudgetSection->getTitle() ?? trans('labels.not_found')}}
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
