@extends('pms::layouts.master')
@section('title', trans('pms::attribute.attribute_value_list'))

@section('content')
    <section>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">@lang('pms::attribute.attribute_value_list') - {{ $attribute->organization->name }}</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                                <li><a href="{{ route('attribute-values.create', $attribute->id) }}" class="btn btn-sm btn-primary"><i class="ft ft-plus"></i> @lang('pms::attribute.enter_value')</a></li>
                                <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body card-dashboard">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered alt-pagination">
                                    <thead>
                                    <tr>
                                        <th scope="col">{{trans('labels.serial')}}</th>
                                        <th>@lang('labels.date')</th>
                                        <th>@lang('pms::attribute.planned_value')</th>
                                        <th>@lang('pms::attribute.achieved_value')</th>
                                        <th>@lang('labels.action')</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($attribute->values as $attributeValue)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ \Carbon\Carbon::parse($attributeValue->date)->format('d/m/Y') }}</td>
                                            <td>{{ $attributeValue->planned_value }}</td>
                                            <td>{{ $attributeValue->achieved_value }}</td>
                                            <td class="text-center">
                                                <a href="{{ route('attribute-values.edit', [$attribute->id, $attributeValue->id]) }}" class="btn btn-sm btn-info"><span
                                                            class="ft ft-edit"></span></a>
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

