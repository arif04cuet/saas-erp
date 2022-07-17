@extends('hrm::layouts.master')
@section('title', trans('hrm::employee.religion.title'))

@section('content')
    <section id="religion-list">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">
                                <i class="ft-eye"></i> @lang('hrm::employee.religion.title')
                            </h4>
                            <a class="heading-elements-toggle">
                                <i class="la la-ellipsis-h font-medium-3 btn-sm"></i>
                            </a>
                            <div class="heading-elements">
                                <a href="{{ route('employees.religions.create') }}" class="master btn btn-primary btn-sm">
                                    <i class="ft-plus white"></i>
                                    @lang('labels.add')
                                </a>
                            </div>
                        </div>
                        <div class="card-content collapse show">
                            <div class="card-body card-dashboard">
                                <div class="table-responsive">
                                    <table class="master table table-striped table-bordered alt-pagination" id="religion-table">
                                        <thead>
                                        <tr>
                                            <th>@lang('labels.serial')</th>
                                            <th>@lang('hrm::employee.religion.table.columns.bengali_name.title')</th>
                                            <th>@lang('hrm::employee.religion.table.columns.english_name.title')</th>
                                            <th>@lang('labels.action')</th>
                                        </tr>
                                        </thead>
                                        @if($religions->count())
                                            @foreach($religions as $religion)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $religion->bengali_title }}</td>
                                                    <td>{{ $religion->english_title }}</td>
                                                    {{-- <td>
                                                        <button id="btnSearchDrop2" type="button" data-toggle="dropdown"
                                                                aria-haspopup="true"
                                                                aria-expanded="false" class="btn btn-info dropdown-toggle">
                                                            <i class="la la-cog"></i>
                                                        </button>
                                                        <span aria-labelledby="btnSearchDrop2"
                                                              class="dropdown-menu mt-1 dropdown-menu-right">
                                                        <a href="{{ route('employees.religions.show', ['religion' => $religion->id]) }}"
                                                           class="dropdown-item"><i class="ft-eye"></i> @lang('labels.details')</a>
                                                                <div class="dropdown-divider"></div>
                                                        <a href="{{ route('employees.religions.edit', ['religion' => $religion->id]) }}"
                                                           class="dropdown-item"><i class="ft-edit-2"></i> @lang('labels.edit')
                                                        </a>
                                                    </span>
                                                    </td> --}}
                                                    <td class="text-center">
                                                        <div class="btn-group">
                                                            <a href="{{ route('employees.religions.show', ['religion' => $religion->id]) }}" class="master btn btn-info" title="{{trans('labels.details')}}">
                                                                <i class="ft-eye white"></i>
                                                            </a>
                                                            <a href="{{ route('employees.religions.edit',  ['religion' => $religion->id]) }}" class="master btn btn-success" title="{{trans('labels.edit')}}">
                                                                <i class="ft-edit white"></i>
                                                            </a>
                                                            {{-- <a href="#" class="master btn btn-danger"
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

                                                            {!! Form::close() !!} --}}
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
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
