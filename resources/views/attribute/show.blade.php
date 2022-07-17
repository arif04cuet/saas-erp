@extends($module . '::layouts.master')
@section('title', trans('attribute.attribute'))

@section('content')
    <section>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                                <li><a href="{{ route($module . '-attribute-values.create', $attribute->id) }}"
                                       class="btn btn-sm btn-primary"><i
                                                class="ft ft-plus"></i> @lang('attribute.enter_value')</a></li>
                                <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body card-dashboard">
                            <br>
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-4">
                                        <h4>@lang('attribute.organization'): {{ $organization->name }}</h4>
                                    </div>
                                    <div class="col-md-4">
                                        <h4>@lang('attribute.attribute'): {{ $attribute->name }}</h4>
                                    </div>
                                    <div class="col-md-4">
                                        <h4>@lang('attribute.unit'): {{ $attribute->unit }}</h4>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <h4 class="card-title">@lang('attribute.attribute_value_list')</h4>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered alt-pagination">
                                    <thead>
                                    <tr>
                                        <th scope="col">{{trans('labels.serial')}}</th>
                                        <th scope="col">@lang('labels.date')</th>
                                        <th scope="col">@lang('attribute.planned_value')</th>
                                        <th scope="col">@lang('attribute.achieved_value')</th>
                                        <th scope="col">@lang('labels.action')</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($attribute->values as $value)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ \Carbon\Carbon::parse($value->date)->format('d/m/Y') }}</td>
                                            <td>{{ $value->planned_value }}</td>
                                            <td>{{ $value->achieved_value }}</td>
                                            <td class="text-center"><a
                                                        href="{{ route($module . '-attribute-values.edit', [$attribute->id, $value->id]) }}"
                                                        class="btn btn-sm btn-info"><i class="ft ft-edit"></i></a></td>
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

