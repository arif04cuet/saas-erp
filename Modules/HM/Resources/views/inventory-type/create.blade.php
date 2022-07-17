@extends('hm::layouts.master')
@section('title', 'Inventory create')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title" id="basic-layout-form">Inventory Type Creation</h4>
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
                            <form action="{{ route('inventory-types.store') }}" method="post">
                                <h4 class="form-section"><i class="la  la-list"></i>Inventory Type Form</h4>
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 offset-md-3">
                                        <div class="form-group">
                                            <label class="form-label">Parent Inventory Type </label>
                                            <select name="parent_id" id="dropdown" class="form-control">
                                                <option></option>
                                            </select>

                                            @if ($errors->has('parent_id'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('parent_id') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6 offset-md-3">
                                        <div class="form-group">
                                            <label class="form-label">Inventory Type Name <span class="danger">*</span></label>
                                            <input type="text"
                                                   placeholder="e.g Office furniture"
                                                   value="{{ old('name') }}"
                                                   class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                                   name="name" required/>

                                            @if ($errors->has('name'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('name') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6 offset-md-3">
                                        <div class="form-group">
                                            <label class="form-label">Description </label>
                                            <textarea name="description" id="" cols="30" rows="5"
                                                      class="form-control"></textarea>

                                            @if ($errors->has('description'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('description') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="form-actions text-center">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="la la-check-square-o"></i> Save
                                    </button>
                                    <a class="btn btn-warning mr-1" role="button" href="#">
                                        <i class="ft-x"></i> Cancel
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('page-js')
    <script>
        $(document).ready(function () {
            $("#dropdown").select2({
                placeholder: 'Select parent inventory-type'
            });
        });
    </script>
@endpush