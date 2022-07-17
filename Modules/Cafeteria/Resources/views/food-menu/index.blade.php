@extends('cafeteria::layouts.master')
@section('title', trans('cafeteria::food-menu.index'))


@section('content')
<section id="role-list">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{ trans('cafeteria::food-menu.index') }}</h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                    @can('cafeteria-menu-access')
                    <div class="heading-elements">
                        <a href="{{route('food-menus.create')}}" class="btn btn-primary btn-sm"><i
                                class="ft-plus white"></i> {{ trans('cafeteria::food-menu.create') }}
                        </a>
                    </div>
                    @endcan
                </div>

                <div class="card-content collapse show">
                    <div class="card-body card-dashboard">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered alt-pagination">
                                <thead>
                                    <tr>
                                        <th>{{trans('labels.serial')}}</th>
                                        <th>{{trans('labels.name')}}</th>
                                        <th>{{trans('cafeteria::food-menu.food')}}</th>
                                        <th>{{trans('labels.remarks')}}</th>
                                        @can('cafeteria-menu-access')
                                        <th>{{trans('labels.action')}}</th>
                                        @endcan
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($foodMenus as $key => $menu)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>
                                            {{ app()->isLocale('en') ? 
                                                $menu->en_name : 
                                                $menu->bn_name }}
                                        </td>
                                        <td>
                                            <div id="itemDiv{{ $key }}" class="itemDiv">
                                                @foreach ($menu->foodMenuItems as $item)
                                                <span class="badge badge-info">{{
                                                        app()->isLocale('en') ? 
                                                            $item->rawMaterial->en_name : 
                                                            $item->rawMaterial->bn_name
                                                    }}</span>
                                                @endforeach
                                            </div>
                                            <span class="toggleClick" onClick="foodsToggle({{$key}})"><i class="la la-eye"></i></span>
                                        </td>
                                        <td>
                                            {{ $menu->remark }}
                                        </td>
                                        @can('cafeteria-menu-access')
                                        <td>
                                            <a href="{{ route('food-menus.edit', $menu->id) }}"
                                                class="btn btn-primary btn-sm" title="Edit Food Menu">
                                                <i class="la la-pencil-square"></i>
                                            </a>
                                            {!! Form::open([
                                                'method'=>'DELETE',
                                                'url' => route('food-menus.destroy', $menu->id),
                                                'style' => 'display:inline'
                                                ]) !!}
                                                {!! Form::button('<i class="la la-trash-o"></i>', array(
                                                'type' => 'submit',
                                                'class' => 'btn btn-danger btn-sm',
                                                'title' => 'Delete Food Menu',
                                                'onclick'=> 'return confirm("Confirm delete?")',
                                                )) !!}
                                            {!! Form::close() !!}
                                        </td>
                                        @endcan
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
@push('page-css')
    <style>
        .itemDiv {
            display: block;
        }
        .toggleClick {
            cursor: pointer;
        }
    </style>
@endpush

@push('page-js')
    <script>
        /** foodItems show minimize */
       function foodsToggle(index) {
            let element = $('#itemDiv'+index);
            element.css('display') === "none" ? element.css('display', 'block') : element.css('display', 'none');
       }
    </script>
@endpush