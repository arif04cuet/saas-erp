@extends('ims::layouts.master')
@section('title', trans('ims::inventory.item_category_list'))

@section('content')
    <section id="role-list">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{trans('ims::group.group_list')}}</h4>

                        <div class="heading-elements">
                            <a href="{{ route('inventory-category-group.create') }}" class="btn btn-primary btn-sm">
                                <i class="ft-plus white"></i>@lang('ims::group.add_new_group')
                            </a>
                        </div>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body card-dashboard">

                            <div class="table-responsive">
                                <table class="table table-striped table-bordered alt-pagination">
                                    <thead>
                                    <tr>
                                        <th scope="col">@lang('labels.serial')</th>
                                        <th scope="col">@lang('ims::group.name_bn')</th>
                                        <th scope="col">@lang('ims::group.name_en')</th>
                                        <th scope="col">@lang('ims::group.total_category')</th>
                                        <th scope="col">@lang('ims::group.total_items')</th>
                                        <th scope="col">@lang('labels.action')</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($groups as $group)
                                        <tr>
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            <td>
                                                <a href="{{route('inventory-category-group.show', $group->id)}}">
                                                    {{ $group->name_bn }}
                                                </a>
                                            </td>
                                            <td>
                                                {{--                                                <a href="{{ route('inventory-item-category.show', $category->id) }}">{{ $category->name }}</a>--}}

                                                {{ $group->name_en }}

                                            </td>
                                            <td>
                                                {{ $group->categories->count() }}
                                            </td>
                                            <td>
                                                {{ $group->getItemCounts() }}
                                            </td>
                                            <td>
                                                <span class="dropdown">
                                                    <button id="imsProductList" type="button" data-toggle="dropdown"
                                                            aria-haspopup="true" aria-expanded="false"
                                                            class="btn btn-info dropdown-toggle">
                                                        <i class="la la-cog"></i>
                                                    </button>
                                                    <span aria-labelledby="imsProductList"
                                                          class="dropdown-menu mt-1 dropdown-menu-right">
                                                        <a href="{{ route('inventory-category-group.show', $group->id) }}"
                                                           class="dropdown-item">
                                                            <i class="ft-eye"></i> @lang('labels.show')
                                                        </a>

                                                        <a href="{{ route('inventory-category-group.edit', $group->id) }}"
                                                               class="dropdown-item">
                                                            <i class="ft-edit-2"></i> @lang('labels.edit')
                                                        </a>
{{--                                                            <div--}}
                                                        {{--                                                                class="dropdown-divider">--}}
                                                        {{--                                                            </div>--}}

                                                        {{--                                                    {!!--}}

                                                        {{--                                                        Form::open([--}}
                                                        {{--                                                          'method'=>'DELETE',--}}
                                                        {{--                                                          'url' => [''],--}}
                                                        {{--                                                          'style' => 'display:inline'--}}
                                                        {{--                                                            ])--}}
                                                        {{--                                                     !!}--}}

                                                        {{--                                                        {!!--}}
                                                        {{--                                                           Form::button('<i class="ft-trash"></i> '.trans('labels.delete'), array(--}}
                                                        {{--                                                           'type' => 'submit',--}}
                                                        {{--                                                           'class' => 'dropdown-item',--}}
                                                        {{--                                                           'title' => 'Delete the user',--}}
                                                        {{--                                                           'onclick'=>'return confirm("Confirm delete?")',--}}
                                                        {{--                                                                   ))--}}
                                                        {{--                                                                   !!}--}}
                                                        {{--                                                        {!! Form::close() !!}--}}
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
