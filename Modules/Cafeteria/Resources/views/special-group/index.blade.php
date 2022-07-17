@extends('cafeteria::layouts.master')
@section('title', trans('cafeteria::special-service.special_group.index'))


@section('content')
<section id="role-list">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{ trans('cafeteria::special-service.special_group.index') }}</h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                    <div class="heading-elements">
                        <a href="{{route('special-groups.create')}}" class="btn btn-primary btn-sm"><i
                                class="ft-plus white"></i> {{ trans('cafeteria::special-service.create_group') }}
                        </a>
                    </div>
                </div>

                <div class="card-content collapse show">
                    <div class="card-body card-dashboard">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered alt-pagination" id="Example1">
                                <thead>
                                    <tr>
                                        <th>{{trans('labels.serial')}}</th>
                                        <th>{{trans('cafeteria::cafeteria.bangla_name')}}</th>
                                        <th>{{trans('cafeteria::cafeteria.english_name')}}</th>
                                        <th>{{trans('labels.total')}}</th>
                                        <th>{{trans('cafeteria::special-service.special_group.advance_amount')}}</th>
                                        <th>{{trans('labels.remarks')}}</th>
                                        <th>{{trans('labels.action')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($groups as $group)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>
                                            {{ $group->bn_name }}
                                        </td>
                                        <td>
                                            {{ $group->en_name }}
                                        </td>
                                        <td>
                                            {{ $group->total_no }}
                                        </td>
                                        <td>
                                            {{ $group->advance_amount }}
                                        </td>
                                        <td>
                                            {{ $group->remark }}
                                        </td>
                                        <td>
                                            <a href="{{ route('special-groups.edit', $group->id) }}"
                                                class="btn btn-primary btn-sm">
                                                <i class="la la-pencil-square"></i>
                                            </a>
                                            @if($group->purchaseLists->count() == 0 && $group->specialBills->count() == 0)
                                            {!! Form::open([
                                                'method'=>'DELETE',
                                                'url' => route('special-groups.destroy', $group->id),
                                                'style' => 'display:inline'
                                                ]) !!}
                                            {!! Form::button('<i class="la la-trash-o"></i>', array(
                                            'type' => 'submit',
                                            'class' => 'btn btn-danger btn-sm',
                                            'title' => 'Delete Special Group',
                                            'onclick'=> 'return confirm("Confirm delete?")',
                                            )) !!}
                                            {!! Form::close() !!}
                                            @endif
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