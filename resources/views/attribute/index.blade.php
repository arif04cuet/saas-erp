@extends('pms::layouts.master')
@section('title', trans('pms::attribute.attribute_list'))

@section('content')
    <section id="role-list">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">@lang('pms::attribute.attribute_list')</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                        <div class="heading-elements">
                            <a href="{{ route('attributes.create') }}" class="btn btn-primary btn-sm"><i
                                        class="ft-plus white"></i>@lang('pms::attribute.create_attribute')</a>
                        </div>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body card-dashboard">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered alt-pagination">
                                    <thead>
                                    <tr>
                                        <th scope="col">{{trans('labels.serial')}}</th>
                                        <th scope="col">@lang('pms::attribute.organization')</th>
                                        <th scope="col">@lang('labels.name')</th>
                                        <th scope="col">@lang('pms::attribute.unit')</th>
                                        <th scope="col">@lang('labels.action')</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($attributes as $attribute)
                                        <tr>
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            <td>{{ $attribute->organization->name }}</td>
                                            <td>{{ $attribute->name }}</td>
                                            <td>{{ $attribute->unit }}</td>
                                            <td class="text-center">
                                            <span class="dropdown">
                                            <button id="btnSearchDrop2" type="button" data-toggle="dropdown"
                                                    aria-haspopup="true"
                                                    aria-expanded="false" class="btn btn-info btn-sm dropdown-toggle"><i
                                                        class="la la-cog"></i></button>
                                              <span aria-labelledby="btnSearchDrop2"
                                                    class="dropdown-menu mt-1 dropdown-menu-right">
                                                <a href="{{ route('attribute-values.index', $attribute->id) }}"
                                                   class="dropdown-item"><i
                                                            class="la la-list"></i>@lang('labels.details')</a>
                                                  <a href="{{ route('attribute-values.create', $attribute->id) }}"
                                                     class="dropdown-item"><i
                                                              class="la la-keyboard-o"></i>@lang('pms::attribute.enter_value')</a>
                                                <a href="{{ route('attributes.edit', $attribute->id) }}"
                                                   class="dropdown-item"><i
                                                            class="ft-edit-2"></i> {{trans('labels.edit')}}</a>
                                              </span>
                                            </span>
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

