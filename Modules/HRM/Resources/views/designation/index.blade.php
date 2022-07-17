@extends('hrm::layouts.master')
@section('title', trans('hrm::designation.list_page_title'))

@section('content')
    <section id="role-list">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">@lang('hrm::designation.list_page_title')</h4>
                            <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                            <div class="heading-elements">
                                <a href="{{route('designation.create')}}" class="btn btn-primary btn-sm"><i class="ft-plus white"></i> @lang('labels.add')</a>
    
                            </div>
                        </div>
    
                        <div class="card-content collapse show">
                            <div class="card-body card-dashboard">
                                <div class="table-responsive">
                                    <table class="master table table-striped table-bordered alt-pagination" id="DepartmentTable">
                                        <thead>
                                        <tr>
                                            <th>@lang('labels.serial')</th>
                                            <th>@lang('labels.name')</th>
                                            <th>@lang('labels.name') (বাংলা)</th>
                                            <th>@lang('labels.short_name')</th>
                                            <th>@lang('hrm::designation.hierarchy_level')</th>
                                            <th>@lang('labels.action')</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if(isset($designationList) && count($designationList)>0)
                                            @foreach($designationList as $key => $designation)
    
                                                <tr>
                                                    <th scope="row">{{$loop->iteration}}</th>
                                                    <th>{{ $designation->name }}</th>
                                                    <th>{{ $designation->bangla_name?? '-' }}</th>
                                                    <td>{{ $designation->short_name }}</td>
                                                    <td>{{ $designation->hierarchy_level }}</td>
                                                    <td class="text-center">
                                                        <div class="btn-group">
                                                            <a href="{{ route('designation.show', $designation->id) }}" class="master btn btn-info" title="{{trans('labels.details')}}">
                                                                <i class="ft-eye white"></i>
                                                            </a>
                                                            <a href="{{ route('designation.edit',  $designation->id) }}" class="master btn btn-success" title="{{trans('labels.edit')}}">
                                                                <i class="ft-edit white"></i>
                                                            </a>
                                                            <a href="#" class="master btn btn-danger"
                                                                onclick="delete_form{{ $key }}.submit()" title="{{ trans('labels.delete') }}">
                                                                <i class="la la-trash-o white"></i>
                                                            </a>
                                                            <!-- delete -->
                                                            {!! Form::open([
                                                                'method' => 'DELETE',
                                                                'url' => route('designation.destroy',$designation->id),
                                                                'style' => 'display:inline',
                                                                'id' => 'delete_form' . $key,
                                                                'onclick'=>'return confirm("Confirm delete?")',
                                                            ]) !!}

                                                            {!! Form::close() !!}
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
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

    <script>

        //        table export configuration
        $(document).ready(function () {
            $('#DepartmentTable').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'copy', className: 'copyButton',
                        exportOptions: {
                            columns: [0, 1, 2,3],
                        }
                    },
                    {
                        extend: 'excel', className: 'excel',
                        exportOptions: {
                            columns: [0, 1, 2,3],
                        }
                    },
                    {
                        extend: 'pdf', className: 'pdf',
                        exportOptions: {
                            columns: [0, 1, 2,3],
                        }
                    },
                    {
                        extend: 'print', className: 'print',
                        exportOptions: {
                            columns: [0, 1, 2,3],
                        }
                    },
                ],
                paging: true,
                searching: true,
                "bDestroy": true,
            });

        });

        function confirmMessage() {
            if(!confirm("{{ trans('labels.confirm_delete') }}"))
                event.preventDefault();
        }
    </script>

@endpush
