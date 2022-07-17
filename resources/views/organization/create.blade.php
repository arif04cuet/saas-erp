@php
    if ($organizableType == \Illuminate\Support\Facades\Config::get('constants.research')) {
        $module = 'rms';
        $title = trans('rms::research_proposal.menu_title');
    } else {
        $module = 'pms';
        $title = trans('pms::project_proposal.menu_title');
    }
@endphp

@extends($module . '::layouts.master')
@section('title', $title)

@section('content')
    <section>
        <div class="row match-height">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
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
                            {{ Form::open(['route' => 'pms-organizations.store', 'class' => 'form']) }}
                            <div class="form-body">
                                <h4 class="form-section"><i
                                            class="ft-grid"></i>
                                    @lang('pms::project_proposal.organization_add_form')
                                </h4>
                                <h4>
                                    @if ($organizableType == \Illuminate\Support\Facades\Config::get('constants.research'))
                                        @lang('rms::research_proposal.research_title') : {{ $organizable->title  }}
                                    @else
                                        @lang('pms::project_proposal.project_title') : {{ $organizable->title  }}
                                    @endif
                                </h4>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="form-group {{ $errors->has('organization_id') ? ' error' : '' }}">
                                                {{ Form::label('organization_id',  trans('pms::project_proposal.organization_name'),
                                                    ['class' => 'required']) }}
                                                @php
                                                    $organizations->push([
                                                        'id' => 'add_new',
                                                        'name' => '+ ' . trans('pms::project_proposal.add_new_organization')
                                                    ]);
                                                    $organizationSelectOptions = $organizations->pluck('name', 'id');
                                                @endphp
                                                {{ Form::select('organization_id', $organizationSelectOptions, null, [
                                                    'class' => 'form-control select2',
                                                    'placeholder' => trans('labels.select'),
                                                    'data-validation-required-message' => trans('labels.This field is required')
                                                ]) }}

                                                <div class="help-block"></div>
                                                @if ($errors->has('organization_id'))
                                                    <div class="help-block">  {{ $errors->first('organization_id') }}</div>
                                                @endif
                                            </div>
                                            {{ Form::hidden('organizable_type', $organizableType) }}
                                            {{ Form::hidden('organizable_id', $organizable->id) }}
                                        </div>
                                    </div>
                                </div>

                                <div class="row addNewOrganization "
                                     style="{{ $errors->has('name') ? '' : 'display: none'}}">
                                    <div class="col-md-6 ">
                                        <div class="form-group ">
                                            <div class="form-group {{ $errors->has('name') ? ' error' : '' }}">
                                                {{ Form::label('name', trans('pms::project_proposal.organization_name'), ['class' => 'required']) }}
                                                <br/>
                                                {{ Form::text('name',  old('name'),  ['id'=>'', 'class' => 'addOrganizationInput form-control', 'placeholder' => 'Enter organization name', 'data-validation-required-message' => trans('labels.This field is required')]) }}
                                                <div class="help-block"></div>
                                                @if ($errors->has('name'))
                                                    <div class="help-block">  {{ $errors->first('name') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 ">
                                        <div class="form-group ">
                                            <div class="form-group {{ $errors->has('email') ? ' error' : '' }}">
                                                {{ Form::label('email', trans('labels.email_address')) }}
                                                <br/>
                                                {{ Form::text('email',  null,    ['id'=>'', 'class' => ' form-control', 'placeholder' => 'Enter organization email']) }}
                                                <div class="help-block"></div>
                                                @if ($errors->has('email'))
                                                    <div class="help-block">  {{ $errors->first('email') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 ">
                                        <div class="form-group ">
                                            <div class="form-group ">
                                                {{ Form::label('mobile', trans('labels.mobile')) }}
                                                <br/>
                                                {{ Form::text('mobile',  null,    ['id'=>'', 'class' => ' form-control', 'placeholder' => 'Enter organization mobile']) }}
                                                <div class="help-block"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 ">
                                        <div class="form-group ">
                                            <div class="form-group ">
                                                {{ Form::label('address', trans('labels.address')) }}
                                                <br/>
                                                {{ Form::text('address',  null,    ['id'=>'', 'class' => ' form-control', 'placeholder' => 'Enter organization address']) }}
                                                <div class="help-block"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 ">
                                        <div class="form-group ">
                                            <div class="form-group ">
                                                <label for="division_id">Division</label>
                                                <select  class="form-control select2" readonly id="division_id"
                                                        name="division_id">

                                                </select>
                                                <div class="help-block"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 ">
                                        <div class="form-group ">
                                            <div class="form-group ">
                                                <div class="form-group ">
                                                    <label for="district_id">District</label>
                                                    <select  class="form-control select2" id="district_id" readonly
                                                            name="district_id">

                                                    </select>
                                                    <div class="help-block"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 ">
                                        <div class="form-group ">
                                            <div class="form-group ">
                                                <label for="thana_id">Thana</label>
                                                <select  class="form-control select2" readonly id="thana_id"
                                                        name="thana_id">

                                                </select>
                                                <div class="help-block"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 ">
                                        <div class="form-group ">
                                            <div class="form-group ">
                                                <label for="union_id">Union</label>
                                                <select class="form-control " id="union_id"
                                                        name="union_id">
                                                    <option value="">Select</option>
                                                    @foreach($unions as $union)
                                                        <option value="{{$union->id}}">{{$union->name}}</option>
                                                    @endforeach
                                                </select>
                                                <div class="help-block"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-actions col-md-12 ">
                                        <div class="pull-right">
                                            {{ Form::button('<i class="la la-check-square-o"></i>'.trans('labels.save'), ['id' => 'submitOrganization', 'type' => 'submit', 'class' => 'btn btn-primary'] )  }}
                                            <a href="{{ URL::previous() }}">
                                                <button type="button" class="btn btn-warning mr-1">
                                                    <i class="la la-times"></i> @lang('labels.cancel')
                                                </button>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('page-js')
    <script src="{{ asset('js/address/cascade-dropdown.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('select[name=organization_id]').on('change', function (e) {
                let organizationSelectValue = $(this).val();

                if (organizationSelectValue == 'add_new') {
                    $('input,select,textarea').jqBootstrapValidation('destroy');
                    $('input,select,textarea').jqBootstrapValidation();
                    $(".addNewOrganization").show();
                    $(".addOrganizationInput").focus();
                } else if (organizationSelectValue == "") {
                    $('input,select,textarea').jqBootstrapValidation();
                    $(".addNewOrganization").hide();
                } else {
                    $('input,select,textarea').jqBootstrapValidation('destroy');
                    $(".addNewOrganization").hide();
                }
            });

            $('#union_id').on('change', function (e) {
                var union_id = $('#union_id').val();
                console.log(union_id);
                $.ajax({
                    url: '{{url('union/1')}}',
                    type: "GET",
                    data: {
                        "union_id": union_id,
                        "_token": "{{ csrf_token() }}",
                    },
                    success: function (response) {
                        console.log(response[1].id, response[2].id, response[3].id);
                        $('#division_id').append('<option selected  readonly="readonly" value="' + response[1].id + '">' + response[1].name + '</option>');
                        $('#district_id').append('<option selected  readonly="readonly" value="' + response[2].id + '">' + response[2].name + '</option>');
                        $('#thana_id').append('<option selected readonly="readonly"  value="' + response[3].id + '">' + response[3].name + '</option>');
                        //location.reload();
                    }
                });


            });
        });
    </script>
@endpush