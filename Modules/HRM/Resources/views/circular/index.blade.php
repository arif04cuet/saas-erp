@extends('hrm::layouts.master')
@section('title', trans('hrm::circular.title'))

@section('content')
    <div class="content-header row">
        <div class="content-header-right col-md-6 col-12">
            <div class="btn-group float-md-left" role="group" aria-label="Button group with nested dropdown">
                <div class="btn-group" role="group">
                    <a class="btn btn-outline-info round" href="{{ route('circular.create') }}">
                        <i class="ft-plus-circle"></i> @lang('hrm::circular.create_circular')
                    </a>
                </div>
            </div>
        </div>
    </div>
    <br>

    <section id="card-footer-options">
        <div class="row">
            @if(count($circulars))
                @foreach($circulars as $circular)
                <div class="col-sm-12 col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">
                                <h5 class="font-weight-800 mb-1">@lang('labels.title'):</h5>
                                {{ $circular->title }}
                            </h4>
                            <div class="card-content collapse show mt-1">
                                <div class="card-text">
                                    <h5 class="font-weight-800 mb-1">@lang('labels.description'):</h5>
                                    <p>{!! str_limit($circular->details, $limit = 300, $end = '...') !!}</p>
                                </div>
                                <div class="card-footer text-muted mt-2">
                                    <span class="float-left">@lang('hrm::circular.posted_at') :</span> 	&nbsp;{{ $circular->created_at }}
                                    <a href="{{ route('circular.show', $circular->id) }}">
                                        <span class="float-right primary">View Full Circular<i class="ft-arrow-right"></i></span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            @endif
        </div>
    </section>

@endsection


@push('page-css')
    <!-- BEGIN VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('theme/vendors/css/extensions/sweetalert.css')}}">
    <!-- END VENDOR CSS -->
@endpush

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