@include('admin.layouts.partials.login_header', [
    'title' => 'Admin Login'
])

<!--begin::Body-->
<body  id="kt_body"  class="app-blank" >
<!--begin::Root-->
<div class="d-flex flex-column flex-root" id="kt_app_root">

    <!--begin::Authentication - Sign-in -->
    <div class="d-flex flex-column flex-lg-row flex-column-fluid">
        <!--begin::Logo-->
        <a href="{{ asset('admin.home') }}" class="d-block d-lg-none mx-auto py-20">
            <img alt="Logo" src="{{ asset('assets/admin/media/logos/default.svg') }}" class="theme-light-show h-25px"/>
            <img alt="Logo" src="{{ asset('assets/admin/media/logos/default-dark.svg') }}" class="theme-dark-show h-25px"/>
        </a>
        <!--end::Logo-->

        <!--begin::Aside-->
        <div class="d-flex flex-column-fluid flex-center w-lg-50 p-10">
            <!--begin::Wrapper-->
            <div class="d-flex justify-content-between flex-column-fluid flex-column w-100 mw-450px">
                <!--begin::Header-->
                <div class="d-flex flex-stack py-2">
                    <!--begin::Back link-->
                    <div class="me-2">

                    </div>
                    <!--end::Back link-->
                </div>
                <!--end::Header-->

                <!--begin::Body-->
                <div class="py-20">
                    @include('admin.layouts.partials.errors')
                    @include('admin.layouts.partials.alert')
                    <!--begin::Form-->
                    <form class="form w-100" method="post" action="{{ route('admin.login') }}">
                        @csrf
                        <!--begin::Body-->
                        <div class="card-body">
                            <!--begin::Heading-->
                            <div class="text-start mb-10">
                                <!--begin::Title-->
                                <h1 class="text-gray-900 mb-3 fs-3x" data-kt-translate="sign-in-title">
                                    Sign In
                                </h1>
                                <!--end::Title-->
                            </div>
                            <!--begin::Heading-->

                            <!--begin::Input group--->
                            <div class="fv-row mb-8">
                                <!--begin::Email-->
                                <input type="text" value="{{ old('email') }}" placeholder="Email" name="email" data-kt-translate="sign-in-input-email" class="form-control form-control-solid"/>
                                <!--end::Email-->
                            </div>

                            <!--end::Input group--->
                            <div class="fv-row mb-7">
                                <!--begin::Password-->
                                <input type="password" placeholder="Password" name="password" data-kt-translate="sign-in-input-password" class="form-control form-control-solid"/>
                                <!--end::Password-->
                            </div>
                            <!--end::Input group--->

                            <!--begin::Wrapper-->
                            <div class="d-flex flex-stack flex-wrap gap-3 fs-base fw-semibold mb-10">
                                <div></div>

                                <!--begin::Link-->
                                <a href="{{ route('admin.password.request') }}" class="link-primary" data-kt-translate="sign-in-forgot-password">
                                    Forgot Password ?
                                </a>
                                <!--end::Link-->
                            </div>
                            <!--end::Wrapper-->

                            <!--begin::Actions-->
                            <div class="d-flex flex-stack">
                                <!--begin::Submit-->
                                <button type="submit" class="btn btn-primary me-2 flex-shrink-0">
                                    <!--begin::Indicator label-->
                                    <span class="indicator-label" data-kt-translate="sign-in-submit">
                                        Login
                                    </span>
                                    <!--end::Indicator label-->

                                    <!--begin::Indicator progress-->
                                    <span class="indicator-progress">
                    <span data-kt-translate="general-progress">Please wait...</span>
                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                </span>
                                    <!--end::Indicator progress-->
                                </button>
                                <!--end::Submit-->
                            </div>
                            <!--end::Actions-->
                        </div>
                        <!--begin::Body-->
                    </form>
                    <!--end::Form-->
                </div>
                <!--end::Body-->
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Aside-->

        <!--begin::Body-->
        <div class="d-none d-lg-flex flex-lg-row-fluid w-50 bgi-size-cover bgi-position-y-center bgi-position-x-start bgi-no-repeat"
             style="background-image: url(../../../assets/admin/media/auth/bg11.png)">
        </div>
        <!--begin::Body-->
    </div>
    <!--end::Authentication - Sign-in--></div>
<!--end::Root-->
@include('admin.layouts.partials.login_footer')
