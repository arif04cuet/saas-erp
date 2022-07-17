@extends('accounts::layouts.master')
@section('title',trans('accounts::pension.contract.title'))
@section('content')
    <section id="room-type-list">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">@lang('accounts::pension.contract.title') @lang('labels.list')</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                        <div class="heading-elements">
                            <a href="{{route('monthly-pension-contracts.create')}}" class="btn btn-primary btn-sm">
                                <i class="ft-plus white"></i>@lang('labels.new') @lang('accounts::pension.contract.title')
                            </a>
                        </div>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body card-dashboard">
                            <table id="room-type" class="table table-striped table-bordered alt-pagination">
                                <thead>
                                <tr>
                                    <td width="5%"><strong>@lang('labels.serial')</strong></td>
                                    <td>
                                        <strong>@lang('accounts::employee-contract.employee_name')</strong>
                                    </td>
                                    <th>@lang('accounts::pension.contract.ppo_no')</th>
                                    <td><strong>@lang('accounts::pension.contract.receiver')</strong></td>
                                    <td><strong>@lang('accounts::pension.contract.initial_basic')</strong></td>
                                    <td><strong>@lang('accounts::pension.contract.current_basic')</strong></td>
                                    <td><strong>@lang('accounts::employee-contract.increment')</strong></td>
                                    <td width="15%"><strong>@lang('accounts::pension.contract.increment_percentage')</strong></td>
                                    <td><strong>@lang('labels.status')</strong></td>
                                    <td><strong>@lang('labels.action')</strong></td>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($pensionContracts as $contract)
                                    @php
                                        $employee = $contract->employee?? null;
                                    @endphp
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>
                                            <a href="{{route('monthly-pension-contracts.show', $contract->id)}}">
                                                {{($employee)? $employee->first_name.' '.$employee->last_name : '-'}}
                                            </a>
                                        </td>
                                        <td>{{$contract->ppo_number}}</td>
                                        <td>
                                            <?php echo $contract->getReceiverInfo() ?>
                                        </td>
                                        <td>{{$contract->initial_basic}}</td>
                                        <td>{{$contract->current_basic}}</td>
                                        <td>{{$contract->increment}}</td>
                                        <td>{{$contract->increment_percentage}}</td>
                                        <td>{{ucwords($contract->status)}}</td>
                                        <td>
                                            <button id="btnSearchDrop2" type="button" data-toggle="dropdown"
                                                    aria-haspopup="true"
                                                    aria-expanded="false" class="btn btn-info dropdown-toggle">
                                                <i class="la la-cog"></i>
                                            </button>
                                            <span aria-labelledby="btnSearchDrop2"
                                                  class="dropdown-menu mt-1 dropdown-menu-right">
                                                <a class="dropdown-item"
                                                   href="{{route('monthly-pension-contracts.toggle-activation', $contract->id)}}">
                                                    @if($contract->status == 'active')
                                                        <i class="ft-x-circle"></i>
                                                        @lang('labels.inactive')
                                                    @else
                                                        <i class="ft-check-circle"></i>

                                                        @lang('labels.active')
                                                    @endif
                                                </a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item"
                                                   href="{{route('monthly-pension-contracts.show', $contract->id)}}">
                                                    <i class="ft-eye"></i>
                                                    @lang('labels.details')
                                                </a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item"
                                                   href="{{route('monthly-pension-contracts.edit', $contract->id)}}">
                                                    <i class="ft-edit"></i>
                                                    @lang('labels.edit')
                                                </a>
                                                <div class="dropdown-divider"></div>
                                                 {!! Form::open([
                                                     'method'=>'DELETE',
                                                     'url' => route('monthly-pension-contracts.destroy', $contract->id),
                                                     'style' => 'display:inline'
                                                     ]) !!}
                                                {!! Form::button('<i class="la la-trash-o"></i> '.__('labels.delete'), array(
                                                'type' => 'submit',
                                                'mou' => 'submit',
                                                'class' => 'dropdown-item',
                                                'onclick'=> 'return confirm("'.__('labels.confirm_delete').'")',
                                                )) !!}
                                                {!! Form::close() !!}

                                            </span>


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

