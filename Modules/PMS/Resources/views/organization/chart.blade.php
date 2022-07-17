<section>
    <div class="row">
        <div class="col-md-12">
            <label for="">@lang('attribute.attribute')</label>
            {{ Form::select('attribute_id', $project->attributes->pluck('name', 'id'), null, ['class' => 'form-control']) }}
            @include('../../../attribute.partials.graph')
        </div>
    </div>
</section>

{!! Form::open(['route' =>  ['filter.value.bydaterange.organization',$project->id],'id' =>'value-filter-form-organization','class' => 'form']) !!}
{{-- DateRanger Section --}}
<section>
    <div class="row">

        {{-- DatePicker --}}
        <div class="col-md-6">
            <div class="form-group">
                {!! Form::label('period_from_org', trans('labels.start'), ['class' => 'form-label']) !!}
                {!! Form::text('period_from_org', \Carbon\Carbon::now()->format('d/m/Y'),
                        ['class' => 'form-control period_from_org']
                    )
                 !!}
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                {!! Form::label('period_to_org', trans('labels.end'), ['class' => 'form-label']) !!}
                {!! Form::text('period_to_org', \Carbon\Carbon::now()->format('d/m/Y'),
                        ['class' => 'form-control period_to_org']
                    )
                 !!}
            </div>
        </div>

        <!--Select Attribute-->
        <div class="col-md-6">
            <div class="form-group">
                {!! Form::label('attribute_id',
                        trans('attribute.attribute'),
                        ['class' => 'form-label'])
                !!}
                {!!
                    Form::select('attribute_id',  $attributes, null,
                    ['class'=>'form-control select2','placeholder'=>trans('labels.all')])
            !!}

            </div>
        </div>

         <!--Select Organization-->
        <div class="col-md-6">
            <div class="form-group">
                {!! Form::label('Name (Bangla)', trans('organization.organization'), ['class' => 'form-label ']) !!}
                <select id="org-dropdown" name="organization_id"
                    class="form-control select2 organization_dropdown ">
                    <option value="" selected> {{ trans('labels.all') }}
                    </option>
                    @foreach ($organizations as $organization)
                            <option value="{{ $organization['id']}}">
                                {{ $organization['name']}}</option>
                    @endforeach
                </select>
            </div>
        </div>

         <!--Select Members-->
        <div class="col-md-6">
            <div class="form-group">
                {!! Form::label('Name (Bangla)', trans('pms::member.member'), ['class' => 'form-label ']) !!}
                <select name="member_id"
                    class="form-control select2 organization_dropdown ">
                    <option value="" selected> {{ trans('labels.all') }}
                    </option>
                </select>
            </div>
        </div>


        <div class="col-md-6">
            <div class="form-group">
            </div>
        </div>

    </div>
    
    <!-- button -->
    <div class="text-center">
        <!-- Search Button -->
        <a class="ft ft-search btn btn-success" id="search_in_organization">
            @lang('accounts::payroll.payslip_report.form_elements.search')
        </a>
    </div>    
</section>
{!! Form::close() !!}

<section>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">@lang('attribute.attribute_tabular_view')
                    </h4>
                </div>
                {{-- Print Button --}}
                <div style="text-align: center">
                    <a class="btn btn-success" style="color: #fff;" onclick="printDiv('printable-org')">
                        @lang('labels.print')
                    </a>
                </div>     
                <div class="card-content" id="printable-org">
                    
                    <div class="card-body">                 
                        <div class="table-resposive">
                            <div class="card-text">
                                <dl class="row">
                                    <dd style="font-weight: bold">{{ $project->title }}</dd>
                                </dl>
                            </div>  
                            <table class="table table-bordered table-striped organization-attribute">
                                <thead>
                                    <tr>
                                        <th id="">@lang('labels.serial')</th>
                                        <th id="organization-column1">@lang('attribute.attribute')</th>
                                        <th id="organization-column2">@lang('labels.unit')</th>
                                        <th id="organization-column3">@lang('attribute.planned_value')</th>
                                        <th id="organization-column4">@lang('attribute.achieved_value')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($project->attributes as $attribute)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td id="organization-column1">{{ $attribute->name }}</td>
                                            <td id="organization-column2">{{ $attribute->unit }}</td>                                                              
                                            <td >{{ $attribute->plannings->sum('planned_value') }}
                                            </td>
                                            <td >{{ $attribute->values->sum('achieved_value') }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
