@extends('publication::layouts.master')
@section('title', trans('publication::press.index'))


@section('content')
    <section id="role-list">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{ trans('publication::press.index') }}</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                        <div class="heading-elements">
                            <a href="{{ route('publication-presses.create') }}" class="btn btn-primary btn-sm"><i
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
                                            <th>{{ trans('publication::press.name_en') }}</th>
                                            <th>{{ trans('publication::press.name_bn') }}</th>
                                            <th>{{ trans('publication::press.address') }}</th>
                                            <th>{{ trans('publication::press.contact_number') }}</th>
                                            <th>{{ trans('publication::press.press_user') }}</th>
                                            <th>{{ trans('publication::press.activation') }}</th>
                                            <th>{{ trans('labels.action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($presses as $press)
                                            <tr>
                                                <th scope="row">{{ $loop->iteration }}</th>
                                                <td>
                                                    {{ $press->press_name_en }}
                                                </td>
                                                <td>
                                                    {{ $press->press_name_bn }}
                                                </td>
                                                <td>
                                                    {{ $press->address }}
                                                </td>
                                                <td>
                                                    {{ $press->contact_number }}
                                                </td>
                                                <td>
                                                    {{ $press->employee->getName() }}
                                                </td>
                                                <td>
                                                    @if ($press->status == 'active')
                                                        <span class="badge badge-success">
                                                            {{ trans('publication::press.active') }}
                                                        </span>
                                                    @else
                                                        <span class="badge badge-secondary">
                                                            {{ trans('publication::press.inactive') }}
                                                        </span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ route('publication-presses.edit', $press->id) }}"
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
