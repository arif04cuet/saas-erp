<div class="card-body">
    @if ($page == "create")
    {!! Form::open(['route' => 'special-groups.store', 'class' => 'form special-group-form']) !!}
    @else
    {!! Form::open(['route' => ['special-groups.update', $group->id ], 'class' => 'form special-group-form']) !!}
    @method('PUT')
    @endif
    <div id="invoice-items-details" class="">
        <h4 class="form-section"><i class="la la-tag"></i>@lang('cafeteria::special-service.special_group.title') @lang('cafeteria::cafeteria.information')</h4>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('Name (Bangla)',  trans('cafeteria::cafeteria.bangla_name'), ['class' => 'form-label required']) !!}
                    {!! Form::text('bn_name', $page == "edit" ? $group->bn_name : null, ['class' =>
                        "form-control required",
                        'placeholder' => trans('cafeteria::cafeteria.bangla_name'),
                        'data-msg-required'=> __('labels.This field is required'),
                        'data-rule-maxlength' => 50,
                        'data-msg-maxlength'=> trans('labels.At most 50 characters'),
                     ])!!}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('Name (English)', trans('cafeteria::cafeteria.english_name'), ['class' => 'form-label required']) !!}
                    {!! Form::text('en_name', $page == "edit" ? $group->en_name : null, ['class' =>
                        'form-control required',
                        'placeholder' => trans('cafeteria::cafeteria.english_name'),
                        'data-msg-required'=> __('labels.This field is required'),
                        'data-rule-maxlength' => 50,
                        'data-msg-maxlength'=> trans('labels.At most 50 characters'),
                     ])!!}
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('number', trans('cafeteria::cafeteria.member'), ['class' => 'form-label required']) !!}
                    {!! Form::number('total_no', $page == "edit" ? $group->total_no : null, ['class' =>
                        'form-control required',
                        'placeholder' => trans('cafeteria::cafeteria.member'),
                        'data-msg-required'=> __('labels.This field is required'),
                        'min' => 1,
                        'data-msg-min'=> trans('labels.Please enter a value greater than or equal to 1'),
                        'data-rule-maxlength' => 7,
                        'data-msg-maxlength'=> trans('labels.At most 7 characters'),
                     ])!!}
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('charge', trans('cafeteria::special-service.bill.charge'), ['class' => 'form-label required']) !!}
                    {!! Form::number('charge', $page == "edit" ? $group->charge : null, ['class' =>
                        'form-control required',
                        'placeholder' => trans('cafeteria::special-service.bill.charge'),
                        'data-msg-required'=> __('labels.This field is required'),
                        'min' => 1,
                        'data-msg-min'=> trans('labels.Please enter a value greater than or equal to 1'),
                        'data-rule-maxlength' => 7,
                        'data-msg-maxlength'=> trans('labels.At most 7 characters'),
                     ])!!}
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('rent', trans('cafeteria::special-service.special_group.rent'), ['class' => 'form-label']) !!}
                    {!! Form::number('rent', $page == "edit" ? $group->rent : null, ['class' =>
                        'form-control',
                        'placeholder' => trans('cafeteria::special-service.special_group.rent'),
                        'min' => 1,
                        'data-msg-min'=> trans('labels.Please enter a value greater than or equal to 1'),
                        'data-rule-maxlength' => 7,
                        'data-msg-maxlength'=> trans('labels.At most 7 characters'),
                     ])!!}
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('Remark', trans('labels.remarks'), ['class' => 'form-label'])!!}
                    {!! Form::textarea('remark', $page == "edit" ? $group->remark : null, ['class' => 'form-control', 'rows' => 2,
                        'data-rule-maxlength' => 255,
                        'data-msg-maxlength'=> trans('labels.At most 255 characters'),
                     ])!!}
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('advance_amount', trans('cafeteria::special-service.special_group.advance_amount'), ['class' => 'form-label']) !!}
                    {!! Form::number('advance_amount', $page == "edit" ? $group->advance_amount : null, ['class' =>
                        'form-control',
                        'placeholder' => trans('cafeteria::special-service.special_group.advance_amount'),
                        'min' => 1,
                        'data-msg-min'=> trans('labels.Please enter a value greater than or equal to 1'),
                        'data-rule-maxlength' => 7,
                        'data-msg-maxlength'=> trans('labels.At most 7 characters'),
                     ])!!}
                </div>
            </div>
        </div>
    </div>

    <!-- Save & Cancel Button -->
    <div class="form-actions text-center">
        <button type="submit" class="btn {{ $page == "edit" ? 'btn-primary' : 'btn-success'}}">
            <i class="ft-check-square"></i>
            @lang('labels.save')
        </button>
        <a class="btn btn-warning mr-1" role="button" href="{{route('special-groups.index')}}">
            <i class="ft-x"></i> @lang('labels.cancel')
        </a>
    </div>
    {!! Form::close() !!}
</div>