@extends('publication::layouts.master')
@section('title', trans('publication::inventory.title'))


@section('content')
    <section id="role-list">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{ trans('publication::inventory.index') }}</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                    </div>

                    <div class="card-content collapse show">
                        <div class="card-body card-dashboard">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered alt-pagination" id="Example1">
                                    <thead>
                                        <tr>
                                            <th>{{ trans('labels.serial') }}</th>
                                            <th>{{ trans('publication::publication.title') }}</th>
                                            <th>{{ trans('publication::inventory.previous_amount') }}</th>
                                            <th>{{ trans('publication::inventory.available_amount') }}</th>
                                            <th>{{ trans('labels.action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($inventories as $inventory)
                                            <tr>
                                                <th scope="row">{{ $loop->iteration }}</th>
                                                <td>
                                                    {{ $inventory->publication->publicationRequest->research->title }}
                                                </td>
                                                <td>
                                                    {{ $inventory->previous_amount }}
                                                </td>
                                                <td>
                                                    {{ $inventory->available_amount }}
                                                </td>
                                                <td>
                                                    <a href="{{ route('publication-inventories.show', $inventory->id) }}"
                                                        class="btn btn-primary btn-sm">
                                                        <i class="la la-eye"></i>
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
