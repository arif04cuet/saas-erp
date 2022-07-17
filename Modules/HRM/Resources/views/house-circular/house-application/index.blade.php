@extends('hrm::layouts.master')
@section('title', trans('hrm::house-circular.application.list'))

@section('content')
    <section id="role-list">
        <div class="col-xl-11 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">@lang('hrm::house-circular.application.list')</h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <h4 class="card-title">@lang('hrm::house-circular.reference_no')
                            : {{ $circular->reference_no }}</h4>
                        <div class="table-responsive">
                            <table class="table table-bordered alt-pagination" id="applicantInfo">
                                <thead>
                                <th>@lang('labels.serial')</th>
                                <th>@lang('labels.name')</th>
                                <th>@lang('hrm::house-circular.application.birth_date')</th>
                                <th>@lang('hrm::house-circular.application.house_no')</th>
                                <th>@lang('labels.status')</th>
                                <th>@lang('hrm::house-circular.application.house_allocated')</th>
                                <th>@lang('hrm::house-circular.application.selected')</th>
                                <th>@lang('labels.action')</th>
                                </thead>
                                <tbody>
                                @foreach ($houseApplications as $key => $applicant)
                                    @php
                                        $houseDetailDropdown = [];
                                    @endphp
                                    <tr>
                                        {{ Form::hidden('house_application_id'.$key.'', $applicant->id) }}
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $applicant->name }}</td>
                                        <td>{{ $applicant->birth_date }}</td>
                                        <td>
                                            @foreach($applicant->houseDetails as $houseDetail)
                                                @php
                                                    $name = optional($houseDetail->houseDetail)->house_id ?? trans('labels.not_found');
                                                    $houseDetailDropdown[$houseDetail->houseDetail->id] = $name;
                                                @endphp
                                            @endforeach
                                            {{ implode(', ', $houseDetailDropdown) }}
                                        </td>
                                        <td class="status{{$key}}">{{ trans('hrm::house-circular.application.status.' . $applicant->status) }}</td>
                                        <td>
                                            @if($applicant->is_allocated)
                                                {{trans('labels.yes')}}
                                            @else
                                                {{trans('labels.no')}}
                                            @endif
                                        </td>
                                        <td>
                                            @if(!$applicant->is_allocated)
                                                {!! Form::checkbox('select'.$key.'', null,
                                                  $applicant->status == "selected" ? true : false,
                                                    [
                                                        'class' => 'selection'
                                                    ]
                                                  ) !!}
                                            @endif
                                        </td>
                                        <td>
                                            <a class="btn btn-sm btn-primary"
                                               title="{{trans('labels.details')}}"
                                               href="{{ route('house-applications.show', $applicant->id) }}">
                                                <i class="ft-eye"></i>
                                            </a>

                                            @php
                                                $visibleClass = "";
                                                 if($applicant->status == 'submitted')
                                                 {
                                                    $visibleClass.="d-none";
                                                 }
                                            @endphp

                                            @if(!$applicant->is_allocated )
                                                <a href="#"
                                                   class="btn btn-sm btn-success allocate-button-{{$key}} {{$visibleClass}}"
                                                   data-toggle="modal"
                                                   title="{{trans('hrm::house-details.allocated_to')}}"
                                                   data-target="#inlineForm{{$key}}">
                                                    <i class="ft-check"></i>
                                                </a>

                                            @endif
                                        </td>
                                    </tr>
                                    <!-- modal -->
                                    <div class="modal fade text-left" id="inlineForm{{$key}}" tabindex="-1"
                                         role="dialog" aria-labelledby="myModalLabel33"
                                         aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <label class="modal-title text-text-bold-600" id="myModalLabel33">{{trans('hrm::house-details.allocated_to')}}</label>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <!-- modal body -->
                                                {!! Form::open(['route' => ['house-applications.allocate-house-details',$circular,$applicant], 'class' => 'form novalidate', 'files' => true]) !!}
                                                <div class="modal-body">
                                                    <label>@lang('hrm::house-circular.application.house_no') </label>
                                                    <div class="form-group position-relative has-icon-left">
                                                        {!!
                                                               Form::select('house_detail_id', $houseDetailDropdown, null,
                                                              [
                                                                     'class'=>'form-control select2 ',
                                                                     'required'=>'required'
                                                                 ])

                                                       !!}
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <input type="reset" class="btn btn-outline-secondary btn-lg"
                                                           data-dismiss="modal" value="{{trans('labels.cancel')}}">
                                                    <input type="submit" class="btn btn-outline-primary btn-lg"
                                                           value="{{trans('hrm::house-details.allocated_to')}}">
                                                </div>
                                                {!! Form::close() !!}
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection
@push('page-js')
    <script src="{{ asset('theme/js/scripts/modal/components-modal.min.js') }}" type="text/javascript"></script>
    <script>
        $('#applicantInfo').on('click', '.selection', function () {
            let name = $(this).attr('name');
            let index = name.match(/\d+/).toString();
            let applicantId = $("input[name='house_application_id" + index + "']").val();
            let status = $(`.status${index}`);
            let url = "{{ route('house-applications.selection') }}";
            let checked = $(this).is(':checked');
            if (checked) {
                $(`.allocate-button-${index}`).first().removeClass('d-none').show();
            } else {
                $(`.allocate-button-${index}`).first().hide();
            }
            let data = {
                "house_application_id": applicantId,
                "_token": "{{ csrf_token() }}",
            }
            $.post(url, data, function (response) {
                status.html(response);
            })
        })
    </script>
@endpush
