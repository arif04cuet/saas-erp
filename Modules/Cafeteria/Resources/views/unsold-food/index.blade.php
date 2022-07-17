@extends('cafeteria::layouts.master')
@section('title', trans('cafeteria::inventory.title'))


@section('content')
<section id="role-list">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{ trans('cafeteria::unsold-food.title') }}</h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                </div>

                <div class="card-content collapse show">
                    <div class="card-body card-dashboard">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered inventory-table">
                                <thead>
                                    <tr>
                                        <th>{{trans('labels.serial')}}</th>
                                        <th>{{trans('labels.date')}}</th>
                                        <th>{{trans('cafeteria::raw-material.title')}}</th>
                                        <th>{{trans('cafeteria::raw-material-category.title')}}</th>
                                        <th>{{trans('cafeteria::unsold-food.quantity')}}</th>
                                        <th>{{trans('cafeteria::unit.title')}}</th>
                                        <th>{{trans('cafeteria::unsold-food.loss')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $totalLoss = 0 ; 
                                    @endphp
                                    @foreach($unsoldFoods as $food)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>
                                            {{ date('d-m-Y H:i A', strtotime($food->created_at)) }}
                                        </td>
                                        <td>
                                            {{ $food->rawMaterial->getName() ?? trans('labels.not_found') }}
                                        </td>
                                        <td>
                                            {{ $food->rawMaterial->rawMaterialCategory
                                                        ? $food->rawMaterial->rawMaterialCategory->getName()
                                                        : trans('labels.not_found') }}
                                        </td>
                                        <td>
                                            {{ $food->quantity }}
                                        </td>
                                        <td>
                                            {{ $food->rawMaterial->unit->getName() ?? trans('labels.not_found') }}
                                        </td>
                                        <td>
                                            {{ ($food->rawMaterial->unitPrices['0']->price)*($food->quantity ) .' Tk.' ?? trans('labels.not_found') }}
                                            @php
                                                $totalLoss += ($food->rawMaterial->unitPrices['0']->price)*($food->quantity ); 
                                            @endphp
                                        </td>
                                     
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>{{trans('cafeteria::unsold-food.total_loss')}}</td>
                                        <td>{{$totalLoss.' Tk.'}}</td>
                                    </tr>
                                </tfoot>
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
    <script type="text/javascript">

        $(document).ready(function () {

            let table = $('.inventory-table').DataTable({
                'stateSave': true,
                "columnDefs": [
                    {"orderable": false, "targets": 1}
                ],
                "language": {
                    "search": "{{ trans('labels.search') }}",
                    "zeroRecords": "{{ trans('labels.No_matching_records_found') }}",
                    "lengthMenu": "{{ trans('labels.show') }} _MENU_ {{ trans('labels.records') }}",
                    "info": "{{trans('labels.showing')}} _START_ {{trans('labels.to')}} _END_ {{trans('labels.of')}} _TOTAL_ {{ trans('labels.records') }}",
                    "infoFiltered": "( {{ trans('labels.total')}} _MAX_ {{ trans('labels.infoFiltered') }} )",
                    "paginate": {
                        "first": "First",
                        "last": "Last",
                        "next": "{{ trans('labels.next') }}",
                        "previous": "{{ trans('labels.previous') }}"
                    },
                },
            });

            table.draw();
        });
    </script>
@endpush
