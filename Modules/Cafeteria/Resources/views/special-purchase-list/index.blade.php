@extends('cafeteria::layouts.master')
@section('title', trans('cafeteria::purchase-list.index'))


@section('content')
<section id="role-list">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{ trans('cafeteria::purchase-list.index') }}</h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                    <div class="heading-elements">
                        <a href="{{route('special-purchase-lists.create')}}" class="btn btn-primary btn-sm"><i
                                class="ft-plus white"></i> {{ trans('cafeteria::purchase-list.create') }}
                        </a>
                    </div>
                </div>

                <div class="card-content collapse show">
                    <div class="card-body card-dashboard">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered special-purchase-list-table">
                                <thead>
                                    <tr>
                                        <th>{{trans('labels.serial')}}</th>
                                        <th>{{trans('labels.date')}}</th>
                                        <th>{{trans('labels.title')}}</th>
                                        <th>{{trans('cafeteria::cafeteria.group')}}</th>
                                        <th>{{trans('labels.action')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($purchaseLists as $list)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>
                                            {{ $list->purchase_date }}
                                        </td>
                                        <td>
                                            {{ $list->title }}
                                        </td>
                                        <td>
                                            @if (app()->isLocale('en'))
                                                {{ $list->specialGroup->en_name }}
                                            @else
                                                 {{ $list->specialGroup->bn_name }}
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('special-purchase-lists.show', $list->id) }}"
                                                class="btn btn-info btn-sm">
                                                <i class="la la-eye"></i>
                                            </a>
                                            <a href="{{ route('special-purchase-lists.edit', $list->id) }}"
                                                class="btn btn-primary btn-sm">
                                                <i class="la la la-pencil-square"></i>
                                            </a>
                                            {!! Form::open([
                                                'method'=>'DELETE',
                                                'url' => route('special-purchase-lists.destroy', $list->id),
                                                'style' => 'display:inline'
                                                ]) !!}
                                            {!! Form::button('<i class="la la-trash-o"></i>', array(
                                            'type' => 'submit',
                                            'class' => 'btn btn-danger btn-sm',
                                            'title' => 'Delete Special List',
                                            'onclick'=> 'return confirm("Confirm delete?")',
                                            )) !!}
                                            {!! Form::close() !!}
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

@push('page-js')
    <script>
         $('.special-purchase-list-table').dataTable({
            "stateSave": true
        });
    </script>
@endpush
