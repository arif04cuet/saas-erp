@extends('hrm::layouts.master')


@section('title', 'Note')

@push('page-css')

    <link rel="stylesheet" type="text/css" href="{{asset('theme/vendors/css/editors/tinymce/tinymce.min.css')}}">
@endpush

@section('content')

    <!-- Basic Editor start -->
    <section id="basic">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Create Note</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                                <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                <li><a data-action="close"><i class="ft-x"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body">
                            <form class="form-horizontal" action="#">
                                <div class="form-group">
                                    <label for="note_type">Select a type </label>
                                    <select id="note_type" class="select2 form-control">

                                        <option value="AK">Type1</option>
                                        <option value="HI">Type2</option>

                                        <option value="CA">California</option>
                                        <option value="NV">Nevada</option>
                                        <option value="OR">Oregon</option>
                                        <option value="WA">Washington</option>

                                    </select>
                                    <textarea class="tinymce">

								</textarea>
                                </div>
                                <button type="submit" class="btn btn-outline-success">Save</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Basic Editor end -->

@endsection

@push('page-js')

    <!-- BEGIN PAGE VENDOR JS-->
    <script src="{{asset('theme/vendors/js/editors/tinymce/tinymce.js')}}" type="text/javascript"></script>
    <!-- END PAGE VENDOR JS-->

    <!-- BEGIN PAGE LEVEL JS-->
    <script src="{{asset('theme/js/scripts/editors/editor-tinymce.js')}}" type="text/javascript"></script>
    <!-- END PAGE LEVEL JS-->
@endpush