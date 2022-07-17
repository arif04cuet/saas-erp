@extends('hm::layouts.master')
@section('title', trans('hm::bill.title'))

@section('content')
    <h1>
        {{trans('hm::bill.title')}}
        <span class="font-size-base">
            Module: {!! config('hm.name') !!}
        </span>
    </h1>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title" id="basic-layout-form">Search for Check in</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                                <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 offset-3">
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12">
                                                <div class="form-group">
                                                    <select class="select2 form-control" onchange="location = this.options[this.selectedIndex].value;">
                                                        <option>Search Here</option>
                                                        <option value="{{ route('bill.create') }}">CH5401 - 018xxxxxxxx</option>
                                                        <option value="{{ route('bill.create') }}">CH5402 - 013xxxxxxxx</option>
                                                        <option value="{{ route('bill.create') }}">CH5404 - 017xxxxxxxx</option>
                                                        <option value="{{ route('bill.create') }}">CH5406 - 015xxxxxxxx</option>
                                                        <option value="{{ route('bill.create') }}">CH5407 - 016xxxxxxxx</option>
                                                        <option value="{{ route('bill.create') }}">CH5409 - 019xxxxxxxx</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
