@extends('hm::layouts.master')
@section('title', 'Store items entry')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title" id="basic-layout-form">Store Entry Creation</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                                <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body">
                            <form action="{{ route('stores.store') }}" method="post">
                                <h4 class="form-section"><i class="la  la-building-o"></i>Store Entry Form</h4>
                                @csrf
                                <div class="table-responsive">
                                    <table id="store-entry-table" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th width="20%">Item</th>
                                            <th width="20%">Quantity</th>
                                            <th width="40%">Comment</th>
                                            <th width="20%">
                                                Accept
                                                <div class="skin skin-flat">
                                                    <fieldset>
                                                        <input type="checkbox" id="input-16" checked>
                                                        <label for="input-16">Accept All</label>
                                                    </fieldset>
                                                </div>
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($items as $item)
                                            <tr>
                                                <td>{{ $item->name }}</td>
                                                <td>{{ $item->quantity }}</td>
                                                <td>
                                                    <textarea name="comment" id="" cols="30" rows="5"
                                                              class="form-control"></textarea>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <div class="skin skin-flat">
                                                        <input type="checkbox" name="" id="">
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="form-actions text-center">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="la la-check-square-o"></i> Save
                                    </button>
                                    <a class="btn btn-warning mr-1" role="button" href="#">
                                        <i class="ft-x"></i> Cancel
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('page-css')
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/vendors/css/forms/icheck/icheck.css') }}">
@endpush

@push('page-js')
    <script src="{{ asset('theme/vendors/js/forms/icheck/icheck.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('theme/js/scripts/tables/datatables/datatable-advanced.js') }}" type="text/javascript"></script>
    <script>
        $(document).ready(function () {
            $('#store-entry-table').DataTable({
                paging: false,
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            });
        });
    </script>

@endpush