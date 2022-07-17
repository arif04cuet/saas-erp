@extends('publication::layouts.master')
@section('title', trans('publication::type.index'))


@section('content')
    <section id="role-list">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{ trans('publication::type.index') }}</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                        <div class="heading-elements">
                            <a href="{{ route('publication-types.create') }}" class="btn btn-primary btn-sm"><i
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
                                            <th>{{ trans('labels.serial') }}</th>
                                            <th>{{ trans('publication::type.name_en') }}</th>
                                            <th>{{ trans('publication::type.name_bn') }}</th>
                                            <th>{{ trans('publication::type.activation') }}</th>
                                            <th>{{ trans('labels.action') }}</th>


                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($types as $type)
                                            <tr>
                                                <th scope="row">{{ $loop->iteration }}</th>
                                                <td>
                                                    {{ $type->name_en }}
                                                </td>
                                                <td>
                                                    {{ $type->name_bn }}
                                                </td>
                                                <td>
                                                    @if ($type->status == 'active')
                                                        <span class="badge badge-success">
                                                            {{ trans('publication::type.active') }}
                                                        </span>
                                                    @else
                                                        <span class="badge badge-secondary">
                                                            {{ trans('publication::type.inactive') }}
                                                        </span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ route('publication-types.edit', $type->id) }}"
                                                        class="btn btn-primary btn-sm">
                                                        <i class="la la-pencil-square"></i>
                                                    </a>
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
