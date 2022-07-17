@extends('accounts::layouts.master')
@section('title', trans('accounts::cost-center.index'))

@section('content')

    <section id="role-list">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{ trans('accounts::budget.index') }}</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                        <div class="heading-elements">
                            <a href="{{route('cost-centers.create')}}" class="btn btn-primary btn-sm"><i
                                        class="ft-plus white"></i> {{ trans('labels.add') }}
                            </a>

                        </div>
                    </div>

                    <div class="card-content collapse show">
                        <div class="card-body card-dashboard">

                            <div class="table-responsive">
                                <table class="table table-striped table-bordered alt-pagination" id="Example1">
                                    <thead>
                                    <tr>
                                        <th>{{trans('labels.serial')}}</th>
                                        <th>{{trans('accounts::budget.title')}}</th>
                                        <th>{{trans('labels.code')}}</th>
                                        <th>{{trans('labels.action')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($costCenters as $costCenter)
                                        @php $economyCode = $costCenter->economyCode @endphp
                                        <tr>
                                            <th scope="row">{{$loop->iteration}}</th>
                                            <td>
                                                <a href="{{route('budgets.show',1)}}">
                                                    @if(App::getLocale() == 'bn')
                                                        {{$costCenter->title_bangla}}
                                                    @else
                                                        {{$costCenter->title}}
                                                    @endif
                                                </a>
                                            </td>
                                            <td>
                                                {{$costCenter->code.' - '}}
                                                {{(App::getLocale() == 'bn')? $economyCode->bangla_name :
                                                $economyCode->english_name}}
                                            </td>
                                            <td>
                                                <button id="btnSearchDrop2" type="button" data-toggle="dropdown"
                                                        aria-haspopup="true"
                                                        aria-expanded="false" class="btn btn-info dropdown-toggle">
                                                    <i class="la la-cog"></i>
                                                </button>
                                                <span aria-labelledby="btnSearchDrop2"
                                                      class="dropdown-menu mt-1 dropdown-menu-right">
                                                    <!-- Details -->
                                                        <a href="{{route('cost-centers.show',$costCenter->id)}}"
                                                           class="dropdown-item"><i class="ft-eye"></i>
                                                            {{trans('labels.details')}}
                                                        </a>
                                                    <!-- Variance -->

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
        </div>
    </section>
@endsection



@push('page-js')
    <script src="{{ asset('theme/vendors/js/forms/icheck/icheck.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('theme/js/scripts/tables/datatables/datatable-advanced.js') }}"
            type="text/javascript"></script>
    <script>
        $(document).ready(function () {
            $('#').DataTable({
                dom: 'Bfrtip',
                paging: true,
                searching: true,
                "bDestroy": true,
            });
        });
    </script>

@endpush
