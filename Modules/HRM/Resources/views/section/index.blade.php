@extends('hrm::layouts.master')
@section('title', trans('hrm::department.section_page_card_title'))

@section('content')
    <section id="role-list">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title"><i class="ft-list"></i> @lang('hrm::department.section_page_card_title')</h4>
                            <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                            <div class="heading-elements">
                                <a href="{{route('sections.create')}}" class="btn btn-primary btn-sm"><i
                                        class="ft-plus white"></i>@lang('labels.add')</a>
    
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
                                            <th>@lang('labels.code')</th>
                                            <th>@lang('hrm::department.department')</th>
                                            <th>@lang('hrm::department.section_head')</th>
                                            <th>@lang('labels.action')</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if(!is_null($sections))
                                            @foreach($sections as $key => $section)
                                                <tr>
                                                    <th scope="row">{{$loop->iteration}}</th>
                                                    <th>{{$section->name }}</th>
                                                    <td>{{$section->section_code}}</td>
                                                    <td>{{$section->department->name ?? trans('labels.not_found')}}</td>
                                                    <td>{{optional($section->head)->getName() ?? trans('labels.not_found')}}</td>
                                                    <td class="text-center">
                                                        <div class="btn-group">
                                                            <a href="{{ route('sections.show', $section->id) }}" class="master btn btn-info" title="{{trans('labels.details')}}">
                                                                <i class="ft-eye white"></i>
                                                            </a>
                                                            <a href="{{ route('sections.edit',  $section->id) }}" class="master btn btn-success" title="{{trans('labels.edit')}}">
                                                                <i class="ft-edit white"></i>
                                                            </a>
                                                            <a href="#" class="master btn btn-danger"
                                                                onclick="delete_form{{ $key }}.submit()" title="{{ trans('labels.delete') }}">
                                                                <i class="la la-trash-o white"></i>
                                                            </a>
                                                            <!-- delete -->
                                                            {!! Form::open([
                                                                'method' => 'DELETE',
                                                                'url' => route('sections.destroy',$section->id),
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
                            columns: [0, 1, 2],
                        }
                    },
                    {
                        extend: 'excel', className: 'excel',
                        exportOptions: {
                            columns: [0, 1, 2],
                        }
                    },
                    {
                        extend: 'pdf', className: 'pdf',
                        exportOptions: {
                            columns: [0, 1, 2],
                        }
                    },
                    {
                        extend: 'print', className: 'print',
                        exportOptions: {
                            columns: [0, 1, 2],
                        }
                    },
                ],
                paging: true,
                searching: true,
                "bDestroy": true,
            });
        });

        function confirmMessage() {
            if (!confirm("{{ trans('labels.confirm_delete') }}"))
                event.preventDefault();
        }
    </script>

@endpush
