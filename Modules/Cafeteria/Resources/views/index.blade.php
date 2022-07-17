@extends('cafeteria::layouts.master')
@section('title', trans('cafeteria::cafeteria.title'))

@section('content')
<div class="container">
  <div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>@lang('labels.dashboard')</h4>
            </div>

            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <h4>@lang('cafeteria::cafeteria.quick_links')</h4>
                    <hr>
                    <div class="row">
                        @can('cafeteria-menu-access')
                          <div class="col-md-2">
                            <a href="{{ route('sales.create') }}">
                              <div class="card text-white bg-success">
                                <p class="text-center font-large-1 mt-1"><i class="fa ft-shopping-cart fa-10x"></i></p>
                                <p class="text-center f-o font-weight-bold">@lang('cafeteria::sales.title')</p>
                              </div>
                            </a>
                          </div>
                        @endcan
                      
                      <div class="col-md-2">
                        <a href="{{ route('food-orders.index') }}">
                          <div class="card text-white bg-info">
                            <p class="text-center font-large-1 mt-1"><i class="fa ft-list fa-10x"></i></p>
                            <p class="text-center f-o font-weight-bold">@lang('cafeteria::food-order.title')</p>
                          </div>
                        </a>
                      </div>

                      @can('cafeteria-menu-access')
                        <div class="col-md-2">
                          <a href="{{ route('cafeteria-inventories.index') }}">
                            <div class="card text-white bg-danger">
                              <p class="text-center font-large-1 mt-1"><i class="ft ft-shuffle fa-10x"></i></p>
                              <p class="text-center f-o font-weight-bold">@lang('cafeteria::inventory.title')</p>
                            </div>
                          </a>
                        </div>
                      @endcan
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>
</div>
@endsection
@push('page-css')
    <style>
        .f-o {
          margin-top: -10px;
        }
    </style>
@endpush
