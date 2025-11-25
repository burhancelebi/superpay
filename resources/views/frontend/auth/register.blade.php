@extends('frontend.layouts.master')
@section('content')
    <!-- CONTENT START -->
    <div class="page-content">
        <!-- Login Section Start -->
        <div class="section-full site-bg-white">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-md-5 twm-log-reg-media-wrap">
                        <div class="twm-log-reg-media">
                            <div class="twm-l-media">
                                <img src="https://thewebmax.org/jobzilla/images/login-bg.png" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-7">
                        <div class="twm-log-reg-form-wrap">
                            <div class="twm-log-reg-logo-head">
                                <a href="index.html">
                                    <img src="{{ asset('assets/images/logo-dark.png') }}" alt="" class="logo">
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
                                    <form id="registerForm" action="{{ route('auth.register') }}" method="post">
                                        @csrf
                                        <div class="col-lg-12">
                                            <div class="form-group mb-3">
                                                <input name="name" type="text" required="" value="{{ old('name') }}"
                                                       class="form-control" placeholder="İsim*">
                                                <small class="text-danger error-message" data-field="name"></small>
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <div class="form-group mb-3">
                                                <input name="surname" type="text" required=""
                                                       value="{{ old('surname') }}" class="form-control"
                                                       placeholder="Soyisim*">
                                                <small class="text-danger error-message" data-field="surname"></small>
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <div class="form-group mb-3">
                                                <input name="email" type="email" class="form-control"
                                                       value="{{ old('email') }}" required="" placeholder="Email*">
                                                <small class="text-danger error-message" data-field="email"></small>
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <div class="form-group mb-3">
                                                <input name="password" type="password" class="form-control"
                                                       value="{{ old('password') }}" required="" placeholder="Şifre*">
                                                <small class="text-danger error-message" data-field="password"></small>
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <div class="form-group mb-3">
                                                <input name="password_confirmation" type="password" class="form-control"
                                                       value="{{ old('password_confirmation') }}" required=""
                                                       placeholder="Şifre Tekrar*">
                                                <small class="text-danger error-message"
                                                       data-field="password-confirmation"></small>
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <div class="form-group mb-3">
                                                <input name="phone" type="tel" required="" class="form-control"
                                                       value="{{ old('phone') }}" placeholder="Telefon*">
                                                <small class="text-danger error-message" data-field="phone"></small>
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <div class="form-group mb-3">
                                                <input name="profession" type="text" required="" class="form-control"
                                                       value="{{ old('profession') }}" placeholder="Meslek*">
                                                <small class="text-danger error-message"
                                                       data-field="profession"></small>
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <div class="form-group mb-3">
                                                <input name="age" type="number" required="" class="form-control"
                                                       value="{{ old('age') }}" placeholder="Yaş*">
                                                <small class="text-danger error-message" data-field="age"></small>
                                            </div>
                                        </div>

                                        <div id="bank-accounts-container">
                                            <div class="col-lg-12">
                                                <div class="form-group mb-3 d-flex align-items-center">
                                                    <div class="flex-grow-1 me-2">
                                                        <input name="bank_name[]" type="text" required="" class="form-control" placeholder="Banka Adı*">
                                                        <small class="text-danger error-message" data-field="bank_name"></small>
                                                    </div>
                                                    <div class="flex-grow-1 me-2">
                                                        <input name="iban[]" type="text" required="" class="form-control" placeholder="IBAN*">
                                                        <small class="text-danger error-message" data-field="iban"></small>
                                                    </div>
                                                    <button type="button"
                                                            class="btn btn-primary add-bank-account">
                                                        <i class="fas fa-plus"></i>
                                                    </button>
                                                    <button type="button"
                                                            class="btn btn-danger ms-2 remove-bank-account">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="twm-forgot-wrap">
                                                <div class="form-group mb-3">
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input" id="Password4">
                                                        <label class="form-check-label rem-forgot" for="Password4">Beni
                                                            hatırla
                                                            <a href="javascript:;" class="site-text-primary">Şifremi
                                                                unuttum</a>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <button type="submit" class="site-button">Kaydol</button>
                                            </div>
                                        </div>

                                        <script>
                                            document.getElementById('registerForm').addEventListener('submit', function (e) {
                                                e.preventDefault();

                                                document.querySelectorAll('.error-message').forEach(el => el.textContent = '');
                                                const formData = new FormData(this);

                                                fetch(this.action, {
                                                    method: 'POST',
                                                    body: formData,
                                                    headers: {
                                                        'Accept': 'application/json',
                                                    }
                                                })
                                                    .then(response => response.json())
                                                    .then(data => {
                                                        if (data.success) {
                                                            window.location.href = '/'; // Anasayfaya yönlendir
                                                        } else if (data.errors) {
                                                            Object.keys(data.errors).forEach(field => {
                                                                const errorElement = document.querySelector(`[data-field="${field}"]`);
                                                                if (errorElement) {
                                                                    errorElement.textContent = data.errors[field][0];
                                                                }
                                                            });
                                                        }
                                                    })
                                                    .catch(error => {
                                                        console.error('Error:', error);
                                                    });
                                            });
                                        </script>
                                    </form>

                                    <div class="col-md-12 text-center">
                                        <div class="form-group">
                                            <span class="center-text-or">Ya da</span>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <a class="site-button" href="{{ route('auth.login-page') }}">Giriş Yap</a>
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
    <!-- CONTENT END -->
@endsection
@section('js')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const container = document.getElementById('bank-accounts-container');

            container.addEventListener('click', function (e) {
                if (e.target.closest('.add-bank-account')) {
                    const newFields = `
                                                    <div class="col-lg-12">
                                                        <div class="form-group mb-3 d-flex align-items-center">
                                                            <div class="flex-grow-1 me-2">
                                                                <input name="bank_name[]" type="text" required="" class="form-control" placeholder="Banka Adı*">
                                                            </div>
                                                            <div class="flex-grow-1 me-2">
                                                                <input name="iban[]" type="text" required="" class="form-control" placeholder="IBAN*">
                                                            </div>
                                                            <button type="button" class="btn btn-primary add-bank-account">
                                                                <i class="fas fa-plus"></i>
                                                            </button>
                                                            <button type="button" class="btn btn-danger ms-2 remove-bank-account">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                `;
                    container.insertAdjacentHTML('beforeend', newFields);
                }

                if (e.target.closest('.remove-bank-account')) {
                    const row = e.target.closest('.col-lg-12');
                    if (container.querySelectorAll('.col-lg-12').length > 1) {
                        row.remove();
                    }
                }
            });
        });
    </script>
@endsection
