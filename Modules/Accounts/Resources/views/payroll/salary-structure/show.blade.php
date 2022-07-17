@extends('accounts::layouts.master')
@section('title', trans('accounts::salary-structure.title'))

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title" id="basic-layout-form">@lang('accounts::salary-structure.title') @lang('labels.show')</h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                            {{--<li><a data-action="close"><i class="ft-x"></i></a></li>--}}
                        </ul>
                    </div>
                </div>
                <div class="card-content collapse show">
                    <div class="card-body">
                        <table class="table">
                            <tbody>
                            <tr>
                                <th>@lang('labels.name')</th>
                                <td>{{$salaryStructure->name}}</td>
                            </tr>
                            <tr>
                                <th>@lang('accounts::salary-structure.reference')</th>
                                <td>{{$salaryStructure->reference}}</td>
                            </tr>
                            <tr>
                                <th>@lang('accounts::salary-structure.parent_structure')</th>
                                <td>{{($salaryStructure->is_parent)?  "N/A" : $salaryStructure->parent->name }}</td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <h4 class="form-section">@lang('accounts::salary-rule.title')</h4>
                                </td>
                            </tr>

                            @if($salaryStructure->rules)
                                <table class="table table-bordered">
                                    <tr>
                                        <th>@lang('labels.name')</th>
                                        <th>@lang('labels.code')</th>
                                        <th>@lang('accounts::payroll.salary_category')</th>
                                        <th>@lang('accounts::salary-rule.contribution_register')</th>

                                    </tr>
                                    @foreach($salaryStructure->rules as $rule)
                                        <tr>
                                            <td>
                                                <a href="{{route('salary-rule.show', $rule->id)}}" target="_blank">
                                                    {{$rule->name}}
                                                </a>
                                            </td>
                                            <td>{{$rule->code}}</td>
                                            <td>{{$rule->salaryCategory->name}}</td>
                                            <td>{{$rule->contribution_register}}</td>
                                        </tr>
                                    @endforeach
                                </table>
                            @endif
                            </tbody>
                        </table>
                        <div class="form-actions">
                            <a href="{{route('salary-structures.edit', $salaryStructure->id)}}" class="btn btn-primary"><i class="ft-edit-2"></i> {{trans('labels.edit')}}</a>
                            {{--<a href="{{URL::to( '/tms/trainee/show/'.$salaryStructure->id)}}" class="btn btn-primary"><i class="ft-list"></i> {{trans('tms::training.trainee_card_title')}}</a>--}}
                            <a class="btn btn-warning mr-1" role="button" href="{{route('salary-structures.index')}}">
                                <i class="ft-x"></i> {{trans('labels.back_page')}}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
