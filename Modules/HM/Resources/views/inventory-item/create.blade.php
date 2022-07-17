@extends('hm::layouts.master')
@section('title', 'Inventory create')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title" id="basic-layout-form">Inventory Item Creation</h4>
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
                            <form action="{{ route('inventory-items.store') }}" method="post">
                                <h4 class="form-section"><i class="la  la-list"></i>Inventory Item Form</h4>
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Department <span class="danger">*</span></label>
                                            <select name="department_id" id="department-select" class="form-control"
                                                    required>
                                                <option></option>
                                                <option value="1">Dept 1</option>
                                                <option value="2">Dept 2</option>
                                            </select>

                                            @if ($errors->has('department_id'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('department_id') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Inventory Item Type <span class="danger">*</span></label>
                                            <select name="inventory_item_type_id" id="inventory-type-select"
                                                    class="form-control" required>
                                                <option></option>
                                                <option value="1">Inventory 1</option>
                                                <option value="2">Inventory 2</option>
                                                <option value="3">Inventory 3</option>
                                            </select>

                                            @if ($errors->has('inventory_item_type_id'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('inventory_item_type_id') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Name <span class="danger">*</span></label>
                                            <input name="name" type="text" class="form-control"
                                                   placeholder="e.g Swivel chair" required>

                                            @if ($errors->has('name'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('name') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Code <span class="danger">*</span></label>
                                            <input name="code" type="text" class="form-control" placeholder="e.g bard-bed-1"
                                                   required>

                                            @if ($errors->has('code'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('code') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">In stock</label>
                                            <input name="in_stock" type="number" min="0" class="form-control" placeholder="e.g 100">

                                            @if ($errors->has('in_stock'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('in_stock') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label for="">In use</label>
                                            <input name="in_use" type="number" min="0" class="form-control" placeholder="e.g 80">

                                            @if ($errors->has('in_use'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('in_use') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Description</label>
                                            <textarea name="description" id="" cols="30" rows="6"
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
            $("#department-select").select2({
                placeholder: 'Select department'
            });

            $("#inventory-type-select").select2({
                placeholder: 'Select inventory-type'
            });
        });
    </script>
@endpush