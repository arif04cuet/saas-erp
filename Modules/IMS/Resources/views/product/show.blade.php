@extends('ims::layouts.master')

@section('title', trans('ims::product.details'))

@section('content')
    <div class="row match-height">
        <div class="col-sm-12 col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{ trans('ims::product.details') }}</h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <div class="card-text">
                            <dl class="row">
                                <dt class="col-sm-3">@lang('ims::product-list-table.columns.name')</dt>
                                <dd class="col-sm-9">{{ $product->name }}</dd>
                            </dl>
                            <dl class="row">
                                <dt class="col-sm-3">@lang('ims::product-list-table.columns.code')</dt>
                                <dd class="col-sm-9">{{ $product->code }}</dd>
                            </dl>
                            <dl class="row">
                                <dt class="col-sm-3">@lang('ims::product-list-table.columns.hs_code')</dt>
                                <dd class="col-sm-9">{{ $product->sh_code }}</dd>
                            </dl>
                            <dl class="row">
                                <dt class="col-sm-3">@lang('ims::product-list-table.columns.bar_code')</dt>
                                <dd class="col-sm-9">{{ $product->bar_code }}</dd>
                            </dl>
                            <dl class="row">
                                <dt class="col-sm-3">@lang('labels.date')</dt>
                                <dd class="col-sm-9">{{ date('j F,Y', strtotime($product->date)) }}</dd>
                            </dl>
                        </div>
                        <div class="form-actions text-center">
                            <a href="{{ route('inventory.product.edit', $product->id) }}" class="btn btn-primary mr-1">
                                <i class="ft-plus white"></i> @lang('labels.edit')
                            </a>

                            <a class="btn btn-warning mr-1" role="button" href="{{ route('inventory.product.index') }}">
                                <i class="ft-x"></i> @lang('labels.cancel')
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection