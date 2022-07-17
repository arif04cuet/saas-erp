@extends('ims::layouts.master')

@section('title', trans('ims::group.title') . ' ' . trans('labels.show'))

@section('content')

    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">@lang('ims::group.title') @lang('labels.show')</h4>
                    <a class="heading-elements-toggle" href=""><i class="la la-ellipsis-v font-medium-3"></i></a>
                    <div class="heading-elements">
                        <a href="{{ route('inventory-category-group.edit', $group->id) }}"
                           class="btn btn-success btn-sm">
                            <i class="ft-edit white"> @lang('labels.edit')</i>
                        </a>
                        <a href="{{ route('inventory-category-group.index') }}" class="btn btn-warning btn-sm">
                            <i class="ft-x white"> @lang('ims::group.group_list')</i>
                        </a>
                    </div>
                </div>

                <div class="card-content collapse show">
                    <div class="card-body">
                        <h4 class="form-section">
                            <i class="la la-tag"></i>
                            @lang('ims::inventory.item_category_details')
                        </h4>

                        <!-- Inventory Category Information -->
                        <div class="row">
                            <div class="col-md-8">
                                <table class="table table-striped">
                                    <tr>
                                        <th style="width: 30%">@lang('ims::group.name_bn')</th>
                                        <td>{{ $group->name_bn}}</td>
                                    </tr>
                                    <tr>
                                        <th>@lang('ims::group.name_en')</th>
                                        <td>{{ $group->name_en}}</td>
                                    </tr>
                                    <tr>
                                        <th>@lang('ims::group.total_category')</th>
                                        <td>
                                            {{ \App\Utilities\EnToBnNumberConverter::en2bn(count($categories) ?? 0) }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>@lang('ims::group.total_items')</th>
                                        <td>
                                            {{\App\Utilities\EnToBnNumberConverter::en2bn($group->getItemCounts() ?? 0)}}
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Inventory Category Information -->
                    <div class="card-body">
                        <div class="form-body">

                            <h4 class="form-section">
                                <i class="la la-tag"></i>
                                @lang('ims::inventory.item_category')
                                <hr>
                            </h4>
                            <table class="table table-bordered table-striped" id="Example1">
                                <thead class="text-center">
                                <tr>
                                    <th>@lang('labels.serial')</th>
                                    <th>@lang('labels.id')</th>
                                    <th>@lang('labels.title')</th>
                                    <th>@lang('ims::inventory.type')</th>
                                </tr>
                                </thead>

                                <tbody>
                                @foreach($categories as $category)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>
                                            <a href="{{route('inventory-item-category.show', $category->id)}}" target="_blank">
                                                {{$category->unique_id}}
                                            </a>
                                        </td>
                                        <td>{{$category->name}}</td>
                                        <td>
                                            {{__('ims::inventory.' . preg_replace('/\s+/', '_', $category->type)) ?? ""}}
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
@stop

@push('page-js')
    <script>
        $(document).ready(function () {
            $('#Example1').DataTable({
                dom: 'Bfrtip',
                buttons: ['copy', 'excel', 'csv', 'print'],
                paging: true,
                searching: true,
                "bDestroy": true,
            });
        });
    </script>
@endpush

