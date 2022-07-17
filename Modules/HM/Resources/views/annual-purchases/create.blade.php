@extends('hm::layouts.master')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title" id="basic-layout-form">Annual Purchase Creation</h4>
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
                            <form action="{{ route('annual-purchases.store') }}" method="post">
                                <h4 class="form-section"><i class="la  la-building-o"></i>Annual Purchase Form</h4>
                                @csrf
                                <div class="repeater-annual-purchase-list">
                                    <div data-repeater-list="purchase_list">
                                        <div data-repeater-item="" style="">
                                            <div class="form row">
                                                <div class="form-group mb-1 col-sm-12 col-md-3">
                                                    <label>Item Name <span class="danger">*</span></label>
                                                    <br>
                                                    <select name="item_id" class="item-select form-control">
                                                        <option value=""></option>
                                                        <option value="1">Value 1</option>
                                                        <option value="2">Value 2</option>
                                                    </select>
                                                </div>
                                                <div class="form-group mb-1 col-sm-12 col-md-2">
                                                    <label>Quantity <span class="danger">*</span></label>
                                                    <br>
                                                    <input type="number" name="quantity" min="1" id=""
                                                           class="form-control" placeholder="e.g 10" required>
                                                </div>
                                                <div class="form-group mb-1 col-sm-12 col-md-3">
                                                    <label>Unit Price <span class="danger">*</span></label>
                                                    <br>
                                                    <input type="number" min="1" name="unit_price" class="form-control"
                                                           placeholder="e.g 20" required>
                                                </div>
                                                <div class="form-group mb-1 col-sm-12 col-md-3">
                                                    <label>Total Ammount <span class="danger">*</span></label>
                                                    <br>
                                                    <input type="number" name="total_amount" min="1" id=""
                                                           class="form-control" placeholder="e.g 200" disabled="">
                                                </div>
                                                <div class="form-group col-sm-12 col-md-1 text-center mt-2">
                                                    <button type="button" class="btn btn-outline-danger"
                                                            data-repeater-delete=""><i
                                                                class="ft-x"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <hr>
                                        </div>
                                    </div>
                                    <div class="form-group overflow-auto">
                                        <div class="col-12">
                                            <button type="button" data-repeater-create=""
                                                    class="pull-right btn btn-sm btn-outline-primary">
                                                <i class="ft-plus"></i> Add
                                            </button>
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
    <script src="{{ asset('theme/vendors/js/forms/repeater/jquery.repeater.min.js') }}"
            type="text/javascript"></script>
    <script src="{{ asset('theme/js/scripts/forms/form-repeater.js') }}" type="text/javascript"></script>
    <script>
        $(document).ready(function () {
           $('.item-select').select2({
               placeholder: 'Select item'
           });

           $('.repeater-annual-purchase-list').repeater({
               show: function () {
                   $(this).find('.select2-container').remove();
                   $(this).find('select').select2({
                       placeholder: 'Select item'
                   });
                   $(this).slideDown();
               }
           });
        });
    </script>
@endpush