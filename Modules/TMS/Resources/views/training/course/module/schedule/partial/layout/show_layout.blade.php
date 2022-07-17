@extends('tms::layouts.master')
@section('title', __('tms::session.preview_title'))

@section('content')
    <section id="assessment">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header ml-1">
                            <h4 class="card-title"> @lang('tms::session.preview_title') @lang('labels.show')</h4>
                            <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                        </div>
                        <div class="card-content collapse show">
                            <div class="card-body">
                                {{ $slot }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
