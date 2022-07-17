@extends('pms::layouts.master')
@section('title', trans('pms::member.edit_member'))

@section('content')

    <div class="row match-height">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title" id="basic-layout-form">@lang('pms::member.edit_member')</h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                            {{--<li><a data-action="close"><i class="ft-x"></i></a></li>--}}
                        </ul>
                    </div>
                </div>
                <div class="card-content collapse show">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                {{--<h5>Last Submission Date: {{date('d-M-Y', strtotime($projectRequest->end_date))}}</h5>--}}
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-12"></div>
                            <div class="col-12">
                                {{--<strong> Remarks: </strong>{{  $proposal->remarks }}--}}
                            </div>
                        </div>

                        {!! Form::model($member, ['route' =>  ['member.update-organization-member', $member->id], 'class' => 'form',' novalidate']) !!}
                        @include('pms::project-members.form.add_edit_organization_member_form', ['mode' => trans('pms::member.edit_member'), 'form-mode' => trans('pms::member.member_adding_form')])
                        {!! Form::close() !!}


                    </div>

                </div>
            </div>
        </div>
    </div>


@endsection
@push('page-js')
    <script>
        $(document).ready(function () {
            $(".addSelect2Class").select2({
                width: '100%',

            });
        });
    </script>
@endpush