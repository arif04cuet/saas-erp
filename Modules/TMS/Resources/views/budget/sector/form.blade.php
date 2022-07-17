<div class="card-body">
    @if($page == 'create')
        {!! Form::open(['route' =>  'tms-sectors.store', 'class' => 'form', 'novalidate']) !!}
    @else
        {!! Form::open(['route' =>  ['tms-sectors.update', $sector->id], 'class' => 'form', 'novalidate']) !!}
        @method('PUT')
    @endif
    <div id="invoice-items-details" class="">
        <h4><i class="la la-tag"></i>@lang('tms::budget.sector.form.title')</h4>

        <!-- Sector input fields -->
        <div class="row">
            <!-- Title in Bengali -->
            <div class="col-6">
                <div class="form-group">
                    {!! Form::label('title_bangla', trans('tms::budget.sector.form.title_bangla'),
['class' => 'form-label required']) !!}
                    {{ Form::text('title_bangla', $page == 'create'? old('title_bangla') : $sector->title_bangla,
['class' => 'form-control form-control-sm', 'placeholder' => __('labels.title'), 'required', 'data-validation-required-message' =>
__('labels.This field is required'), 'maxlength' => 250]) }}
                    <div class="help-block"></div>
                </div>
                <!-- error message -->
                @if ($errors->has('title_bangla'))
                    <div class="help-block text-danger">
                        {{ $errors->first('title_bangla') }}
                    </div>
                @endif
            </div>

            <!-- Title -->
            <div class="col-6">
                <div class="form-group">
                    {!! Form::label('title_english', trans('labels.title'), ['class' => 'form-label required']) !!}
                    {{ Form::text('title_english', $page == 'create'? old('title_english') : $sector->title_english,
['class' => 'form-control form-control-sm', 'placeholder' => 'Title', 'maxlength' => 250, 'required', 'data-validation-required-message'
=> __('labels.This field is required')]) }}
                    <div class="help-block"></div>
                    <!-- error message -->
                    @if ($errors->has('title_english'))
                        <div class="help-block text-danger">
                            {{ $errors->first('title_english') }}
                        </div>
                    @endif
                </div>
            </div>

            <!-- Sequence -->
            <div class="col-6">
                <div class="form-group">
                    {!! Form::label('sequence', trans('labels.sequence'), ['class' => 'form-label']) !!}
                    {{ Form::number('sequence', $page == 'create'? old('sequence') : $sector->sequence,
['class' => 'form-control form-control-sm', 'placeholder' => __('labels.sequence'), 'data-validation-max-max' => 999,
'data-validation-max-message' => __('validation.max.numeric', ['attribute' => __('labels.sequence'),
 'max' => \App\Utilities\EnToBnNumberConverter::en2bn(999)])]) }}
                    <div class="help-block"></div>
                </div>
                <!-- error message -->
                @if ($errors->has('sequence'))
                    <div class="help-block text-danger">
                        {{ $errors->first('sequence') }}
                    </div>
                @endif
            </div>

            <!-- Details -->
            <div class="col-6">
                <div class="form-group">
                    {!! Form::label('details', trans('labels.details'), ['class' => 'form-label']) !!}
                    {{ Form::textarea('details', $page == 'create'? old('details') : $sector->details,
['class' => 'form-control form-control-sm', 'placeholder' => __('labels.details'), 'maxlength' => 250, 'rows' => 3]) }}
                </div>
                <!-- error message -->
                @if ($errors->has('details'))
                    <div class="help-block text-danger">
                        {{ $errors->first('details') }}
                    </div>
                @endif
            </div>

        </div>

        <!-- Sub Sectors -->
        <h4><i class="la la-tag"></i>@lang('tms::budget.sector.form.sub_sector')</h4>
        <div class="row">
            <div class="table-responsive col-sm-12">
                <table class="master table table-bordered repeater-sector-items">
                    <thead>
                    <tr class="text-center">
                        <th width="35%">@lang('tms::budget.sector.form.title_bangla')</th>
                        <th width="35%">@lang('labels.title')</th>
                        <th width="10%">@lang('labels.sequence')</th>
                        <th width="20%">@lang('labels.details')</th>
                        <th width="1%">
                            <i data-repeater-create class="la la-plus-circle text-info" style="cursor: pointer"
                               id="repeater_create"></i>
                        </th>
                    </tr>

                    </thead>
                    <tbody data-repeater-list="sub_sectors">

                    @if($page == 'edit')
                        @foreach($sector->subSectors as $subSector)
                            <tr data-repeater-item>
                                <td>
                                    <div class="form-group">
                                        {!! Form::hidden('id', $subSector->id) !!}
                                        {!! Form::text('title_bangla', $subSector->title_bangla, ['class' => 'form-control form-control-sm',
    'data-validation-required-message' => __('labels.This field is required'), 'maxlength' => 250])!!}
                                        <div class="help-block"></div>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                        {!! Form::text('title_english', $subSector->title_english, ['class' => 'form-control form-control-sm',
    'data-validation-required-message' => __('labels.This field is required'), 'maxlength' => 250])!!}
                                        <div class="help-block"></div>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                        {!! Form::number('sequence', $subSector->sequence, ['class' => 'form-control form-control-sm',
'data-validation-max-max' => 999, 'data-validation-max-message' => __('validation.max.numeric', ['attribute' =>
__('labels.sequence'), 'max' => \App\Utilities\EnToBnNumberConverter::en2bn(999)])])!!}
                                        <div class="help-block"></div>
                                    </div>
                                </td>
                                <td>
                                    {!! Form::textarea('details', $subSector->details, ['class' => 'form-control form-control-sm',
'rows' => 2, 'maxlength' => 250])!!}
                                </td>
                                <td>
                                    <i data-repeater-delete class="la la-trash-o text-danger" title="@lang('labels.delete')"
                                       style="cursor: pointer"></i>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                    <tr data-repeater-item>
                        <td>
                            {!! Form::hidden('id', null) !!}
                            <div class="form-group">
                                {!! Form::text('title_bangla', null, ['class' => 'form-control form-control-sm', 'required',
 'data-validation-required-message' => __('labels.This field is required'), 'maxlength' => 250])!!}
                                <div class="help-block"></div>
                            </div>
                        </td>
                        <td>
                            <div class="form-group">
                                {!! Form::text('title_english', null, ['class' => 'form-control form-control-sm', 'required',
 'data-validation-required-message' => __('labels.This field is required'), 'maxlength' => 250])!!}
                                <div class="help-block"></div>
                            </div>
                        </td>
                        <td>
                            <div class="form-group">
                                {!! Form::number('sequence', null,['class' => 'form-control form-control-sm',
'data-validation-max-max' => 999, 'data-validation-max-message' => __('validation.max.numeric',
['attribute' => __('labels.sequence'), 'max' => \App\Utilities\EnToBnNumberConverter::en2bn(999)])])!!}
                                <div class="help-block"></div>
                            </div>
                        </td>
                        <td>
                            {!! Form::textarea('details', null,['class' => 'form-control form-control-sm', 'rows' => 2, 'maxlength' => 250])!!}
                        </td>
                        <td><i data-repeater-delete class="la la-trash-o text-danger" title="@lang('labels.delete')"
                               style="cursor: pointer"></i>
                        </td>
                    </tr>
                    </tbody>
                </table>

                <button class="master btn btn-sm btn-primary" style="cursor: pointer" type="button"
                        onclick="$('#repeater_create').trigger('click');">
                    <i class="ft ft-plus"></i>@lang('labels.add')
                </button>
            </div>
        </div>
        <!--/ Journal Item Details -->

    </div>

    <!-- Save & Cancel Button -->
    <div class="form-actions text-center">
        <button type="submit" class="master btn btn-success">
            <i class="la la-check-square-o"></i>
            @if($page == 'create')
                @lang('labels.save')
            @else
                @lang('labels.edit')
            @endif
        </button>
        <a class="master btn btn-warning mr-1" role="button" href="{{route('tms-sectors.index')}}">
            <i class="ft-x"></i> @lang('labels.cancel')
        </a>
    </div>
    {!! Form::close() !!}
</div>
