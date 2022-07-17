@extends('accounts::layouts.master')
@section('title',trans('accounts::salary-rule.title'))
@section('content')
    <section id="room-type-list">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">@lang('accounts::salary-rule.title') @lang('labels.list')</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                        <div class="heading-elements">
                            <a href="{{url(route('salary-rule.create'))}}" class="btn btn-primary btn-sm">
                                <i class="ft-plus white"></i>@lang('labels.new') @lang('accounts::salary-rule.title')
                            </a>
                        </div>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body card-dashboard">
                            <table id="room-type" class="table text-center table-striped table-bordered alt-pagination">
                                <thead>
                                <tr>
                                    <th width="5%">@lang('labels.serial')</th>
                                    <th width="25%">@lang('labels.name')</th>
                                    <th>@lang('labels.code')</th>
                                    <th>@lang('accounts::payroll.salary_category')</th>
                                    <th width="20%">@lang('labels.action')</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($salaryRules as $salaryRule)
                                    @php
                                        $editable = (in_array($salaryRule->code,
                                        Config::get('constants.base_salary_rule_codes')))? false : true;
                                    @endphp
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>
                                            <a href="{{route('salary-rule.show', $salaryRule->id)}}">
                                                {{(App::getLocale() == 'bn') ? $salaryRule->bangla_name :
                                                $salaryRule->name}}
                                            </a>
                                        </td>
                                        <td>{{$salaryRule->code}}</td>
                                        <td>{{$salaryRule->salaryCategory->name}}</td>
                                        <td>
                                            <a class="btn btn-sm btn-info" href="{{route('salary-rule.show',
                                            $salaryRule->id)}}" title="{{__('labels.show')}}">
                                                <i class="la la-eye"></i>
                                            </a>
                                            <a class="btn btn-sm btn-primary {{($editable)? '': 'disabled'}}"
                                               href="{{($editable) ? route('salary-rule.edit', $salaryRule->id) : ''}}"
                                               title="{{__('labels.edit')}}"><i class="la la-pencil"></i>
                                            </a>
                                            {!! Form::open([
                                                     'method'=>'DELETE',
                                                     'url' => route('salary-rule.destroy', $salaryRule->id),
                                                     'style' => 'display:inline'
                                                     ]) !!}
                                            {!! Form::button('<i class="la la-trash-o"></i>', array(
                                            'type' => 'submit',
                                            'class' => 'btn btn-danger btn-sm',
                                            'title' => __('labels.delete'),
                                            'onclick'=> 'return confirm("'.__('labels.confirm_delete').'")',
                                            )) !!}
                                            {!! Form::close() !!}
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
    </section>
@endsection

