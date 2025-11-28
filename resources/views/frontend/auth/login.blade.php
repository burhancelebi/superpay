@extends('frontend.layouts.master')
@section('content')
    <div class="page-content">
        <!-- Login Section Start -->
        <div class="section-full site-bg-white">

            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-8 col-lg-6 col-md-5 twm-log-reg-media-wrap order-2 order-md-1">
                        <div class="twm-log-reg-media">
                            <div class="twm-l-media">
                                <img src="{{ asset('assets/images/login-bg.png') }}" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-6 col-md-7 order-1 order-md-2">
                        <div class="twm-log-reg-form-wrap">
                            <div class="twm-log-reg-logo-head">
                                <a href="{{ route('home') }}">
                                    <img src="{{ asset(getSettingByKey('logo-image')?->value) }}" alt="" class="logo">
                                </a>
                            </div>

                            <div class="twm-log-reg-inner">
                                <div class="twm-log-reg-head">
                                    <div class="twm-log-reg-logo">
                                        <span class="log-reg-form-title">Giriş Yap</span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        @include('admin.layouts.partials.errors')
                                        @include('admin.layouts.partials.alert')
                                    </div>
                                    <form action="{{ route('auth.login') }}" method="POST">
                                        @csrf
                                        <div class="col-lg-12">
                                            <div class="form-group mb-3">
                                                <input name="email" type="email" required="" class="form-control" placeholder="Email*">
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <div class="form-group mb-3">
                                                <input name="password" type="password" class="form-control" required="" placeholder="Şifre*">
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <div class="twm-forgot-wrap">
                                                <div class="form-group mb-3">
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input" id="Password4">
                                                        <label class="form-check-label rem-forgot" for="Password4">Beni hatırla
                                                            <a href="javascript:;" class="site-text-primary">Şifremi unuttum</a>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <button type="submit" class="site-button">Giriş Yap</button>
                                            </div>
                                        </div>
                                    </form>

                                    <div class="col-md-12 text-center">
                                        <div class="form-group">
                                            <span class="center-text-or">Ya da</span>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <a class="site-button text-center" href="{{ route('auth.register-page') }}">Kayıt Oluştur</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Login Section End -->



    </div>
@endsection
