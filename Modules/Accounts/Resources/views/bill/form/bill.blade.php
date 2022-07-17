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

            <div class="row">
                <!-- Default Debit Account -->
                <div class="col-md-6 col-sm-12">
                    {!! Form::label('invoice_due_date', 'Default Debit Account', ['class' => 'form-label']) !!}
                    <p><a href="#"> Debit Account </a></p>
                </div>

                <!-- Default Credit Account -->
                <div class="col-md-6 col-sm-12">
                    {!! Form::label('invoice_reference', 'Default Credit Account', ['class' => 'form-label']) !!}
                    <p><a href="#"> Credit Account </a></p>
                </div>

            </div>
        </div>

        <!--/ Payment Details -->


        <!-- Invoice Vendor Details -->
        <h4 class="form-section">
            <i class="fa fa-plus"></i>Vendor Details
        </h4>

        <div id="invoice-customer-details">

            <div class="row">

                <!-- Vendor DropDown -->
                <div class="col-md-6 col-sm-12  ">

                    {!! Form::label('category_id', 'Select Vendor', ['class' => 'form-label required']) !!}
                    {!! Form::select('category_id', ['Vendor - A', 'Vendor - B','Vendor - C'], null, [
                                                     'class' => 'form-control category-type-select required',
                                                     'data-msg-required' => Lang::get('labels.This field is required'),
                                                     ]) !!}
                </div>

                <div class="col-md-6 col-sm-12">

                    <!-- invoice date -->
                    <div class="row form-group">
                        {!! Form::label('invoice_date', 'Invoice Date', ['class' => 'form-label required']) !!}
                        {{ Form::text('invoice_date', date('d/m/Y'), ['class' => 'form-control']) }}
                    </div>

                </div>
            </div>

            <div class="row">
                <!-- invoice due date -->
                <div class="col-md-6 col-sm-12">
                    {!! Form::label('invoice_due_date', 'Invoice Due Date', ['class' => 'form-label required']) !!}
                    {{ Form::text('invoice_due_date', date('d/m/Y'), ['class' => 'form-control']) }}
                </div>

                <!-- invoice due date -->
                <div class="col-md-6 col-sm-12">
                    {!! Form::label('invoice_reference', 'Invoice Reference', ['class' => 'form-label required']) !!}
                    {{ Form::text('invoice_reference', null, ['class' => 'form-control']) }}
                </div>

            </div>

            <!-- Attachments -->
            <div class="row">
                <div class="col-md-6 col-sm-12">
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
        <!--/ Invoice Vendor Details -->

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
                            <th>Description</th>
                            <th class="">Quantity</th>
                            <th class="">Unit Price</th>
                            <th class="">Account</th>
                            <th class="text-right">Amount</th>
                            <th width="1%"><i data-repeater-create class="la la-plus-circle text-info"
                                              style="cursor: pointer"></i></th>
                        </tr>
                        </thead>
                        <tbody data-repeater-list="category">

                        <tr data-repeater-item>

                            <th scope="row">1</th>

                            <!-- description -->
                            <td>
                                {!! Form::text('description',null,['class' => 'form-control']) !!}
                            </td>

                            <!-- quantity -->
                            <td>
                                {!! Form::number('quantity',null,['class' => 'form-control']) !!}
                            </td>

                            <!-- unit price -->
                            <td>
                                {!! Form::number('unit_price',null,['class' => 'form-control']) !!}
                            </td>

                            <!-- account dropdown -->
                            <td width="25%">
                                {!! Form::select('account_id', ['Accounts - 011', 'Accounts - 012','Accounts - 013'], 1, [
                                                     'class' => 'form-control category-type-select required',
                                                     'data-msg-required' => Lang::get('labels.This field is required'),
                                                     ]) !!}
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
