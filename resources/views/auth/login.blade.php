@extends('layouts.public.public-login')
@section('title', trans('labels.login'))
@section('content')
    <section class="flexbox-container">
        <div class="login-wrapper">
            <div class="login-panel">
                <div class="grid-1 bg-info"></div>
                <div class="grid-2 bg-white">
                    <!-- // -->
                    <div>
                        <div class="">
                            <div class="card-title text-center m-0">
                                <img class="brand-logo" width="230" alt="bard erp logo" src="{{ asset('images/training-btm-002.webp') }}">
                            </div>
                        </div>
                        <div class="separator"></div>
                        <div class="card-content">
                            <p class="card-subtitle m-0 p-0 text-center font-small-3 mx-2 my-2">
                                <span>@lang('labels.provide_your_account_details')</span>
                            </p>
                            <div class="card-body pt-0">
                                <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                                    @csrf
                                    <fieldset class="form-group position-relative has-icon-left">
                                        <input id="username" type="text"
                                            class="input-lg form-control{{ $errors->has('username') ? ' is-invalid' : '' }}"
                                            name="username" value="{{ old('username') }}" placeholder="ইউজারনেম লিখুন"
                                            required autofocus>
                                        <div class="form-control-position">
                                            <i class="la la-user"></i>
                                        </div>
                                        @if ($errors->has('username'))
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('username') }}</strong>
                                        </span>
                                        @endif
                                    </fieldset>
                                    <!-- // -->
                                    <fieldset class="form-group position-relative has-icon-left">
                                        <input id="password" type="password"
                                            class="input-lg form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                            name="password" placeholder="পাসওয়ার্ড লিখুন" required>
                                        <div class="form-control-position">
                                            <i class="la la-key"></i>
                                        </div>
                                        @if ($errors->has('password'))
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                        @endif

                                    </fieldset>
                                    <button type="submit" class="btn btn-info btn-lg btn-block"><i
                                            class="ft-unlock"></i> @lang('labels.login')
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @include('layouts.partials.master_footer')
        </div>


        {{-- 
        <div class="col-12 d-flex align-items-center justify-content-center">
            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 box-shadow-2 p-0">
                <div class="card border-grey border-lighten-3 m-0">

                    <div class="card-header border-0">
                        <div class="card-title text-center">
                            <img class="brand-logo" alt="bard erp logo" src="{{ asset('images/logo.png') }}">
                            -- 
                                <h3>
                                    @php 
                                    $lang = App::getLocale();
                                    if($lang == 'bn'){
                                        echo 'পল্লী উন্নয়ন ও সমবায় বিভাগ';
                                    }else{
                                        echo 'Rural Development and Cooperative Division';
                                    }
                                    @endphp
                                </h3> 
                            --
                        </div>
                    </div>

                    <div class="card-content">
                        <p class="card-subtitle line-on-side text-muted text-center font-small-3 mx-2 my-2">
                            <span>@lang('labels.provide_your_account_details')</span>
                        </p>
                        <div class="card-body pt-0">
                            <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                                @csrf
                                <fieldset class="form-group position-relative has-icon-left">
                                    <input id="username" type="text"
                                           class="input-lg form-control{{ $errors->has('username') ? ' is-invalid' : '' }}"
                                           name="username" value="{{ old('username') }}" placeholder="Enter Username"
                                           required autofocus>
                                    <div class="form-control-position">
                                        <i class="la la-user"></i>
                                    </div>
                                    @if ($errors->has('username'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                    @endif
                                </fieldset>
                                <fieldset class="form-group position-relative has-icon-left">
                                    <input id="password" type="password"
                                           class="input-lg form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                           name="password" placeholder="Enter password" required>
                                    <div class="form-control-position">
                                        <i class="la la-key"></i>
                                    </div>
                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif

                                </fieldset>
                                <button type="submit" class="btn btn-info btn-lg"><i
                                        class="ft-unlock"></i> @lang('labels.login')
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        --}}
    </section>

    <style>
        .login-wrapper {
            position: fixed;
            width: 100%;
            height: calc(100vh - 45px);
            left:0;
            top:0;
            background: #ddd;
            display: flex;
            justify-content: center;
            align-items: center;
            background: url({{asset('/images/background-v1.0.webp')}});
            background-repeat: no-repeat;
            background-size: cover;
            background-position: bottom;
        }
        .login-panel {
            width: 830px;
            height: 377px;
            border-radius: 16px;
            display: flex;
            overflow: hidden;
            box-shadow: 4px 6px 16px #737373;
        }
        .grid-1, .grid-2 {
            height: 100%;
            width: 57%;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .grid-1 {
            background: url({{asset('images/btm-login-side.webp')}});
            background-size: cover;
        }
        .grid-2 {
            width: 43%;
        }
        .grid-2 > div {
            width: 82%;
        }
        .form-group.validate input, .form-group.validate select, .form-group.validate textarea {
            border-color : #63a3cd!important;
        }
        .btn-lg {
            background : #004f7d!important;
        }
        .card-subtitle {
            margin-top: 12px!important;
            margin-bottom: 12px!important;
        }
        .separator {
            width: 100%;
            border-top: 1px solid #ddd;
            position: relative;
            margin-top: 6px;
        }
        .separator:before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            height: 15px;
            width: 15px;
            border-radius: 50%;
            border : 1px solid #ddd;
            background : #fff;
        }
        .btn-block {
            font-size: 15px;
        }

        select.form-control:not([size]):not([multiple]).input-lg + .form-control-position,
        select.form-control:not([size]):not([multiple]).form-group-lg > .form-control-position,
        input.form-control.input-lg + .form-control-position,
        input.form-control.form-group-lg > .form-control-position {
            width: 3rem;
            height: 2rem;
            line-height: 2rem;
            top: 8px;
        }
        .has-icon-left .form-control.input-lg {
            padding-right: 1.25rem;
            padding-left: calc(2.3625rem + 2px);
            font-size: 13px;
            max-height: 40px;
        }
        button.btn-lg {
            max-height: 40px;
            padding: 10px 0px;
        }
    </style>
@endsection
