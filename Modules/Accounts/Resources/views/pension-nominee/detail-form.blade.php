<h4 class="form-section"><i
        class="la la-tag"></i>
    @lang('accounts::pension.nominee.nominee_details')
</h4>

@if($page == 'edit')
    <div class="repeater-nominee-items">
        <div data-repeater-list="nominee_entries">
            @foreach($nominee->nominees as $eachNominee)
                <div data-repeater-item>
                    <div class="col">
                        <div class="row">
                            <!-- Nominee Name English  -->
                            <div class="col">
                                <div class="form-group">
                                    {!! Form::label('name',
                                                    trans('accounts::pension.nominee.nominee_name'),
                                                    ['class' => 'form-label'])
                                    !!}
                                    {{ Form::text(
                                        'name',
                                         $eachNominee->name,
                                        [
                                            'class' => 'form-control'
                                        ])
                                     }}
                                    {!! Form::hidden('id', $eachNominee->id) !!}
                                </div>
                            </div>
                            <!-- Nominee Name Bangla  -->
                            <div class="col">
                                <div class="form-group">
                                    {!! Form::label('bangla_name',
                                                    trans('labels.name').' (বাংলা)',
                                                    ['class' => 'form-label'])
                                    !!}
                                    {{ Form::text(
                                        'bangla_name',
                                         $eachNominee->bangla_name,
                                        [
                                            'class' => 'form-control'
                                        ])
                                     }}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <!-- Nominee birthdate  -->
                            <div class="col">
                                <div class="form-group">
                                    {!! Form::label('birth_date',
                                                    trans('accounts::pension.nominee.birth_date'),
                                                    ['class' => 'form-label'])
                                    !!}
                                    {{ Form::date(
                                        'birth_date',
                                         \Carbon\Carbon::parse($eachNominee->birth_date)->format('Y-m-d'),
                                        [
                                            'class' => 'form-control'
                                        ])
                                     }}
                                </div>
                            </div>
                            <!-- Nominee relation -->
                            <div class="col">
                                <div class="form-group">
                                    {!! Form::label('relation',
                                                    trans('accounts::pension.nominee.relation'),
                                                    ['class' => 'form-label'])
                                    !!}
                                    {{ Form::text(
                                        'relation',
                                         $eachNominee->relation,
                                        [
                                            'class' => 'form-control'
                                        ])
                                     }}
                                </div>
                            </div>
                            <!-- Nominee age limit -->
                            <div class="col">
                                <div class="form-group">
                                    {!! Form::label('age_limit',
                                                    trans('accounts::pension.nominee.age_limit'),
                                                    ['class' => 'form-label'])
                                    !!}
                                    {{ Form::text(
                                        'age_limit',
                                         $eachNominee->age_limit,
                                        [
                                            'class' => 'form-control',
                                            'placeholder'=> trans('accounts::pension.nominee.age_limit.age_limit_message')
                                        ])
                                     }}
                                </div>
                            </div>
                            <!--Nomineed Remarks -->
                            <div class="col">
                                <div class="form-group">
                                    {!! Form::label('remark',
                                                    trans('labels.remarks'),
                                                    ['class' => 'form-label'])
                                    !!}
                                    {{ Form::text(
                                        'remark',
                                         $eachNominee->remark,
                                        [
                                            'class' => 'form-control',
                                        ])
                                     }}
                                </div>
                            </div>
                            <!-- remove item -->
                            <div class="col">
                                <div class="form-group col-sm-12 col-md-2" style="margin-top: 20px;">
                                    <button type="button" class="btn btn-danger" data-repeater-delete="">
                                        <i
                                            class="ft-x"></i>
                                        @lang('labels.remove')
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr style="border-bottom: black">
                </div>
            @endforeach
        </div>
        <div class="row">
            <div class="col-md-12">
                <button type="button" data-repeater-create="" class="btn btn-primary addMore"><i
                        class="ft-plus"></i> @lang('labels.add')
                </button>
            </div>
        </div>
    </div>
@else
    <!-- Nominee details -->
    <div class="repeater-nominee-items">
        <div data-repeater-list="nominee_entries">

            <div data-repeater-item>
                <div class="col">
                    <div class="row">
                        <!-- Nominee Name English  -->
                        <div class="col">
                            <div class="form-group">
                                {!! Form::label('name',
                                                trans('accounts::pension.nominee.nominee_name'),
                                                ['class' => 'form-label'])
                                !!}
                                {{ Form::text(
                                    'name',
                                     null,
                                    [
                                        'class' => 'form-control'
                                    ])
                                 }}
                            </div>
                        </div>
                        <!-- Nominee Name Bangla  -->
                        <div class="col">
                            <div class="form-group">
                                {!! Form::label('bangla_name',
                                                trans('labels.name').' (বাংলা)',
                                                ['class' => 'form-label'])
                                !!}
                                {{ Form::text(
                                    'bangla_name',
                                     null,
                                    [
                                        'class' => 'form-control'
                                    ])
                                 }}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- Nominee birthdate  -->
                        <div class="col">
                            <div class="form-group">
                                {!! Form::label('birth_date',
                                                trans('accounts::pension.nominee.birth_date'),
                                                ['class' => 'form-label'])
                                !!}
                                {{ Form::date(
                                    'birth_date',
                                     null,
                                    [
                                        'class' => 'form-control'
                                    ])
                                 }}
                            </div>
                        </div>
                        <!-- Nominee relation -->
                        <div class="col">
                            <div class="form-group">
                                {!! Form::label('relation',
                                                trans('accounts::pension.nominee.relation'),
                                                ['class' => 'form-label'])
                                !!}
                                {{ Form::text(
                                    'relation',
                                     null,
                                    [
                                        'class' => 'form-control'
                                    ])
                                 }}
                            </div>
                        </div>
                        <!-- Nominee age limit -->
                        <div class="col width-50">
                            <div class="form-group">
                                {!! Form::label('age_limit',
                                                trans('accounts::pension.nominee.age_limit'),
                                                ['class' => 'form-label'])
                                !!}
                                {{ Form::text(
                                    'age_limit',
                                     null,
                                    [
                                        'class' => 'form-control',
                                        'data-toggle'=>'tooltip',
                                        'data-placement'=>'top',
                                        'title'=> trans('accounts::pension.nominee.age_limit_message')
                                    ])
                                 }}
                            </div>
                        </div>
                        <!--Nomineed Remarks -->
                        <div class="col">
                            <div class="form-group">
                                {!! Form::label('remark',
                                                trans('labels.remarks'),
                                                ['class' => 'form-label'])
                                !!}
                                {{ Form::text(
                                    'remark',
                                     null,
                                    [
                                        'class' => 'form-control'
                                    ])
                                 }}
                            </div>
                        </div>
                        <!-- remove item -->
                        <div class="col">
                            <div class="form-group col-sm-12 col-md-2" style="margin-top: 20px;">
                                <button type="button" class="btn btn-danger" data-repeater-delete="">
                                    <i
                                        class="ft-x"></i>
                                    @lang('labels.remove')
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <hr style="border-bottom: black">

            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <button type="button" data-repeater-create="" class="btn btn-primary addMore"><i
                        class="ft-plus"></i> @lang('labels.add')
                </button>
            </div>
        </div>
    </div>
    <!--/  Nominee details  -->
@endif
