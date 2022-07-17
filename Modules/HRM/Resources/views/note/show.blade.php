@extends('hrm::layouts.master')


@section('title', trans('hrm::note.details'))

@push('page-css')

@endpush

@section('content')



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
                                <p>{!! $note->details  !!}</p>
                            </div>

                            <div class="card-footer text-muted mt-2">
                                <span>{{$note->created_at->diffForHumans()}}</span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </section>


@endsection

@push('page-js')


    <script src="{{asset('theme/vendors/js/scripts/cards/draggable.js')}}"></script>

    <script src="{{asset('theme/vendors/js/extensions/dragula.min.js')}}"></script>

@endpush