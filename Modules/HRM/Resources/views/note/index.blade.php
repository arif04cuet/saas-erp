@extends('hrm::layouts.master')


@section('title', trans('hrm::note.title'))

@push('page-css')
    <!-- BEGIN VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('theme/vendors/css/extensions/sweetalert.css')}}">
    <!-- END VENDOR CSS -->
@endpush

@section('content')

    @forelse($notes as $note)

        <section id="card-footer-options">
            <div class="row">

                <div class="col">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">
                                <table>
                                    <tr>
                                        <td><h5 class="font-weight-800 mb-1">@lang('labels.title') : &nbsp;</h5></td>
                                        <td><p>{{$note->title}}</p></td>
                                    </tr>
                                    <tr>
                                        <td><h5 class="font-weight-800 mb-1">@lang('hrm::note.type') : &nbsp;</h5></td>
                                        <td><p>{{$note->noteType->name}}</p></td>
                                    </tr>
                                </table>
                            </h4>
                            <div class="card-content collapse show">
                                <h5 class="font-weight-800 mb-1">@lang('labels.description') : </h5>
                                <div class="card-text">
                                    <p>{!! str_limit($note->details, $limit = 500, $end = '...')  !!}</p>
                                    <div class="card-footer text-muted mt-2">
                                        <span>{{$note->created_at->diffForHumans()}}</span>

                                        <a href="{{route('note.show',$note->id)}}">
                                            <span class="float-right primary">
                                                @lang('hrm::note.view_full_note')<i class="ft-arrow-right"></i>
                                            </span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </section>
    @empty
        <section id="card-footer-options">
            <div class="row">

                <div class="col">
                    <div class="card">
                        <div class="card-header">

                            <div class="card-content collapse show">
                                <div class="card-body text-center">
                                    <p class="text-danger"> No Notes Are Found !
                                    </p>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </section>

    @endforelse

@endsection

@push('page-js')


    <script src="{{asset('theme/vendors/js/scripts/cards/draggable.js')}}"></script>

    <script src="{{asset('theme/vendors/js/extensions/dragula.min.js')}}"></script>

    <!-- BEGIN PAGE VENDOR JS-->
    <script src="{{asset('theme/vendors/js/extensions/sweetalert.min.js')}}" type="text/javascript"></script>
    <!-- END PAGE VENDOR JS-->

    <!-- BEGIN PAGE LEVEL JS-->
    <script src="{{asset('theme/js/scripts/extensions/sweet-alerts.js')}}" type="text/javascript"></script>
    <!-- END PAGE LEVEL JS-->

    <script type="text/javascript">

        // $('.custom_delete').on('click', function () {
        //     var id = $(this).data('id');
        //     alert(id);
        //
        // });
        //

        $(document).on('click', '.custom_delete', function (e) {
            e.preventDefault();
            var id = $(this).data('id');

            swal({
                title: "Are you sure!",
                type: "error",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            type: "POST",
                            url: "{{url('/hrm/notes/1')}}",
                            data: {
                                _token: '{{ csrf_token() }}',
                                _method: "DELETE"
                            },
                            success: function (data) {
                                console.log(data);
                                swal("Poof! Your imaginary file has been deleted!", {
                                    icon: "success",
                                }).then(() => {
                                    location.reload();
                                });
                            }

                        });
                    } else {
                        swal("Your imaginary file is safe!");
                    }
                });
        });
    </script>


@endpush