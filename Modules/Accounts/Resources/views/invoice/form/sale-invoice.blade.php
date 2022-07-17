<div id="invoice-template" class="card-body">

    <form>


        <!-- Invoice Company Details -->
        <div id="invoice-company-details" class="row">
            <div class="col-md-6 col-sm-12 text-center text-md-left">
                <div class="media">
                    <img src="{{asset('images/logo.png')}}" alt="company logo" class=""/>
                    <div class="media-body">
                        <ul class="ml-2 px-0 list-unstyled">
                            <!-- todo:: Use Localization -->
                            <li class="text-bold-800">@lang('labels.BARD ERP')</li>
                            <li>Kotbari</li>
                            <li>Cumilla, Bangladesh</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-12 text-center text-md-right">
                <h2>INVOICE</h2>
                <p class="pb-3"> #INV-001001 </p>
            </div>
        </div>
        <!--/ Invoice Company Details -->


        <!-- Payment Details -->

        <h4 class="form-section">
            <i class="fa fa-plus"></i>Payment Information
        </h4>

        <div id="invoice-customer-details">
            <div class="row">
                <!-- Journal DropDown -->
                <div class="col-md-6 col-sm-12  ">

                    {!! Form::label('category_id', 'Journal', ['class' => 'form-label required']) !!}
                    {!! Form::select('category_id', ['HM: Sale Journal','HM: Purchase Journal'], null, [
                                                     'class' => 'form-control category-type-select required',
                                                     'data-msg-required' => Lang::get('labels.This field is required'),
                                                     ]) !!}
                </div>

                <!-- entry date -->
                <div class="col-md-6 col-sm-12">
                    <div class="row form-group">
                        {!! Form::label('invoice_date', 'Entry Date', ['class' => 'form-label required']) !!}
                        {{ Form::text('invoice_date', date('d/m/Y'), ['class' => 'form-control']) }}
                    </div>
                </div>
            </div>
        </div>

        <!--/ Payment Details -->


        <!-- Invoice Transaction Details -->
        <h4 class="form-section">
            <!-- todo: Localization Needed -->
            <i class="fa fa-plus"></i>Transaction Details
        </h4>

        <div id="invoice-customer-details">

            <div class="row ">
            @php
                $sources = ['Vendor','Customer','Sector','Temporary Sector'];
            @endphp

            <!-- Transaction Source -->
                <div class="col-md-6 form-group">
                    {!! Form::label('source', 'Source', ['class' => 'form-label required']) !!}
                    {!! Form::select('source', $sources, null, [
                                                     'class' => 'form-control category-type-select required',
                                                     'data-msg-required' => Lang::get('labels.This field is required'),
                                                     ]) !!}
                </div>

                <!-- Vendor DropDown -->
                <div id='vendor_div' class="col-md-6">
                    {!! Form::label('vendor', 'Select Vendor', ['class' => 'form-label required']) !!}
                    {!! Form::select('vendor', ['Vendor - A', 'Vendor - B','Vendor - C'], null, [
                                                     'class' => 'form-control category-type-select required',
                                                     'data-msg-required' => Lang::get('labels.This field is required'),
                                                     ]) !!}
                </div>

                <!-- Customer DropDown -->
                <div id='customer_div' class="col-md-6">
                    {!! Form::label('customer', 'Select Customer', ['class' => 'form-label required']) !!}
                    {!! Form::select('customer', ['Customer - A', 'Customer - B','Customer - C'], null, [
                                                     'class' => 'form-control category-type-select required',
                                                     'data-msg-required' => Lang::get('labels.This field is required'),
                                                     ]) !!}
                </div>

                <!-- Sector DropDown -->
                <div id='sector_div' class="col-md-6">
                    {!! Form::label('sector', 'Select Sector', ['class' => 'form-label required']) !!}
                    {!! Form::select('sector', ['Sector - A', 'Sector - B','Sector - C'], null, [
                                                     'class' => 'form-control category-type-select required',
                                                     'data-msg-required' => Lang::get('labels.This field is required'),
                                                     ]) !!}
                </div>

                <!-- Temporary Sector DropDown -->
                <div id='temporary_sector_div' class="col-md-6">
                    {!! Form::label('temporary_sector', 'Select Vendor', ['class' => 'form-label required']) !!}
                    {!! Form::select('temporary_sector', ['Temp. Sector - A', 'Temp Sector - B','Temp. Sector - C'], null, [
                                                     'class' => 'form-control category-type-select required',
                                                     'data-msg-required' => Lang::get('labels.This field is required'),
                                                     ]) !!}
                </div>


            </div>

            <div class="row form-group">
                <!-- invoice date -->
                <div class="col-md-6">
                    {!! Form::label('invoice_date', 'Invoice Date', ['class' => 'form-label required']) !!}
                    {{ Form::text('invoice_date', date('d/m/Y'), ['class' => 'form-control']) }}
                </div>

                <!-- invoice due date -->
                <div class="col-md-6">
                    {!! Form::label('invoice_due_date', 'Invoice Due Date', ['class' => 'form-label required']) !!}
                    {{ Form::text('invoice_due_date', date('d/m/Y'), ['class' => 'form-control']) }}
                </div>
            </div>

            <div class="row form-group">
                <!-- invoice title  -->
                <div class="col-md-6">
                    {!! Form::label('invoice_title', 'Invoice Title', ['class' => 'form-label required']) !!}
                    {{ Form::text('invoice_title', null, ['class' => 'form-control']) }}
                </div>

                <!-- attachments -->
                <div class="col-md-6">
                    {!! Form::label('attachment', 'Attachment', ['class' => 'form-label required']) !!}
                    {!! Form::file('attachment[]', ['class' => 'form-control required' . ($errors->has('attachment') ? ' is-invalid' : ''), 'data-msg-required' => trans('labels.This field is required'), 'accept' => '.doc, .docx, .xlx, .xlsx, .csv, .pdf', 'multiple' => 'multiple']) !!}
                    @if ($errors->has('attachment.*'))
                        @foreach(range(0, count($errors->get('attachment.*')) - 1) as $index)
                            <strong
                                style="color: red">{{ $errors->first('attachment.' . $index) }}</strong>
                            <br>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
        <!--/Invoice Transaction Details -->

        <h4 class="form-section"><i class="fa fa-plus"></i>
            Invoice Items
        </h4>
        <!-- Invoice Items Details -->
        <div id="invoice-items-details" class="">
            <div class="row">
                <div class="table-responsive col-sm-12">
                    <table class="table repeater-category-request table-bordered">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th class="">Account</th>
                            <th>Description</th>
                            <th class="text-right">Amount</th>
                            <th width="1%"><i data-repeater-create class="la la-plus-circle text-info"
                                              style="cursor: pointer"></i></th>
                        </tr>
                        </thead>
                        <tbody data-repeater-list="category">

                        <tr data-repeater-item>

                            <th scope="row">1</th>

                            <!-- account dropdown -->
                            <td width="25%">
                                {!! Form::select('account_id', ['Accounts - 011', 'Accounts - 012','Accounts - 013'], 1, [
                                                     'class' => 'form-control category-type-select required',
                                                     'data-msg-required' => Lang::get('labels.This field is required'),
                                                     ]) !!}
                            </td>

                            <!-- description -->
                            <td>
                                {!! Form::text('description',null,['class' => 'form-control']) !!}
                            </td>

                            <!-- amount -->
                            <td class="text-right">{!! Form::number('amount',null,['class' => 'form-control readonly']) !!}</td>
                            <td><i data-repeater-delete class="la la-trash-o text-danger"
                                   style="cursor: pointer"></i></td>
                        </tr>

                        </tbody>
                    </table>
                </div>
            </div>

            <div class="row">
                <div class="col-md-7 col-sm-12 text-center text-md-left">
                    <h6>Terms & Condition</h6>
                    <p>You know, being a test pilot isn't always the healthiest business
                        in the world. We predict too much for the next year and yet far
                        too little for the next 10.</p>
                </div>
                <div class="col-md-5 col-sm-12">
                    <p class="lead">Total due</p>
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                            <tr>
                                <td>Sub Total</td>
                                <td class="text-center">$ 0.00</td>
                            </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!--/ Invoice Items Details -->

    </form>

    <!-- Save & Cancel Button -->
    <div class="form-actions text-center">
        <button type="submit" class="btn btn-success">
            <i class="la la-check-square-o"></i>@lang('labels.validate')
        </button>
        <a class="btn btn-warning mr-1" role="button" href="#">
            <i class="ft-x"></i> @lang('labels.cancel')
        </a>
    </div>

</div>

@push('page-js')

    <script type="text/javascript">

        // These codes are only for demonstration purpose //
        $(document).ready(function () {
            hideAllSourceDropdown();
            $('[id=vendor_div]').show();
            $('[name=source]').change(function () {
                hideAllSourceDropdown();
                let value = $(this).val();
                let allSourceDivId = [{'id': 'vendor_div'}, {'id': 'customer_div'}, {'id': 'sector_div'}, {'id': 'temporary_sector_div'}]
                $('[id=' + allSourceDivId[value].id + ']').show();
            });
        });

        function hideAllSourceDropdown() {
            $('[id=vendor_div],[id=customer_div], [id=sector_div],[id=temporary_sector_div]').hide();
        }


    </script>
@endpush
