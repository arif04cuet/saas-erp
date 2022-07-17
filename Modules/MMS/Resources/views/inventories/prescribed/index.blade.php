@extends('mms::layouts.master')
@section('title', trans('mms::medicine_distribution.site_title'))
@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">@lang('mms::medicine_distribution.distribution_list')</h4>
                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                <div class="heading-elements" style="top: 10px;">
                    <ul class="list-inline mb-1">
                        <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                        <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="card-content ">
                <div class="card-body card-dashboard">
                    <div class="table-responsive">
                        <table class="prescriptions-list-table table table-bordered">
                            <thead>
                            <tr>
                                <th width="1%">{{ trans('labels.serial') }}</th>
                                <th>{{trans('mms::medicine_distribution.patient_id')}}</th>
                                <th>{{trans('mms::medicine_distribution.name')}}</th>
                                <th>{{trans('mms::medicine_distribution.date_of_prescription')}}</th>
                                <th>{{trans('mms::medicine_distribution.date')}}</th>
                                <th>{{trans('mms::medicine_distribution.medicine')}}</th>
                                <th>{{trans('mms::medicine_distribution.attachment')}}</th>
                                <th>{{trans('mms::medicine_distribution.status')}}</th>
                                <th width="2%">@lang('labels.action')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($result as $info)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{$info['patient_id']}}</td>
                                    <td>{{$info['patient_name']}}</td>
                                    <td>
                                        @if(!empty($info['prescription_id']))
                                            <a href="{{ route('prescription.show',$info['prescription_id']) }}"
                                               style="color: #0A246A"
                                               target="_blank">{{$info['prescribed_date']}}
                                            </a>
                                        @endif

                                    </td>
                                    <td>{{$info['date']}}</td>
                                    <td>{{$info['patient_medicine']}}</td>
                                    @if(empty($info['acknowledgement_slip']))
                                        <td>
                                            <button class="btn btn-sm btn-success" data-toggle="modal"
                                                    onclick="aplicationAttachmentAdd({{$info['id']}})"
                                                    data-target="#myModal">Attach
                                            </button>
                                        </td>
                                    @else
                                        <td>
                                            <a href="{{ route('file.getfile',['filePath'=>$info['acknowledgement_slip']]) }}"
                                               target="_blank" class="btn btn-info btn-sm">
                                                View
                                            </a>
                                        </td>
                                    @endif
                                    <td>@if($info['status']==0) Pending @else  Approved @endif</td>
                                    <td>
                                    <span class="dropdown">
                                        <button id="imsRequestList" type="button" data-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="false"
                                                class="btn btn-info dropdown-toggle">
                                            <i class="la la-cog"></i>
                                        </button>
                                        <span aria-labelledby="imsRequestList"
                                              class="dropdown-menu mt-1 dropdown-menu-right">
                                            <a href="{{ route('inventories.prescribed.show',$info['id']) }}"
                                               class="dropdown-item"><i class="ft-eye"></i> @lang('labels.details')</a>
{{--                                            <div class="dropdown-divider"></div>--}}
                                            {{--                                                <a href="{{ route('inventories.prescribed.edit') }}"--}}
                                            {{--                                                   class="dropdown-item"><i class="ft-edit-2"></i> @lang('labels.edit')</a>--}}

                                        </span>
                                    </span>
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
    @include('mms::inventories.prescribed.modal')
@endsection

@push('page-js')
    <script type="text/javascript">
        function aplicationAttachmentAdd(id) {
            $('#acknowledgement_slip_id').val('');
            $('#acknowledgement_slip_id').val(id);
        }

        $(document).ready(function () {
            {{--$('#upload_form').on('submit', function(event){--}}
            {{--    event.preventDefault();--}}
            {{--    var datastring = $("#upload_form").serialize();--}}

            {{--    $.ajax({--}}
            {{--        type: "POST",--}}
            {{--        url:"{{ route('inventories.prescribed.acknowledgement') }}",--}}
            {{--        data: datastring,--}}
            {{--        enctype: 'multipart/form-data',--}}
            {{--        cache: false,--}}
            {{--        contentType: false,--}}
            {{--        processData: false,--}}
            {{--        timeout: 600000,--}}
            {{--        dataType:'JSON',--}}
            {{--        success: function(data) {--}}
            {{--            $('#message').css('display', 'block');--}}
            {{--            $('#message').html(data.message);--}}
            {{--            $('#message').addClass(data.class_name);--}}
            {{--            $('#uploaded_image').html(data.uploaded_image);--}}

            {{--            //var obj = jQuery.parseJSON(data); if the dataType is not specified as json uncomment this--}}
            {{--            // do what ever you want with the server response--}}
            {{--        },--}}
            {{--        error: function() {--}}
            {{--            alert('error handling here');--}}
            {{--        }--}}
            {{--    });--}}


            {{--    return false;--}}
            {{--});--}}

            let table = $('.prescriptions-list-table ').DataTable({
                "columnDefs": [
                    {"orderable": false, "targets": 1}
                ],
                "language": {
                    "search": "{{ trans('labels.search') }}",
                    "zeroRecords": "{{ trans('labels.No_matching_records_found') }}",
                    "lengthMenu": "{{ trans('labels.show') }} _MENU_ {{ trans('labels.records') }}",
                    "info": "{{trans('labels.showing')}} _START_ {{trans('labels.to')}} _END_ {{trans('labels.of')}} _TOTAL_ {{ trans('labels.records') }}",
                    "infoFiltered": "( {{ trans('labels.total')}} _MAX_ {{ trans('labels.infoFiltered') }} )",
                    "paginate": {
                        "first": "First",
                        "last": "Last",
                        "next": "{{ trans('labels.next') }}",
                        "previous": "{{ trans('labels.previous') }}"
                    },
                },
                // scrollY:        500,
                scrollX: true,
                scrollCollapse: true,
                // paging:         false,
                // fixedColumns:   true,
                fixedColumns: {
                    leftColumns: 0
                },
                // select: true
            });


        });
    </script>
@endpush
