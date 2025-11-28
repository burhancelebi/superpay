@extends('frontend.layouts.master')
@section('content')

    <!-- CONTENT START -->
    <div class="page-content">

        <!-- INNER PAGE BANNER -->
        <div class="wt-bnr-inr overlay-wraper bg-center" style="background-image:url({{ asset('assets/images/profile-banner.jpg') }});">
            <div class="overlay-main site-bg-white opacity-01"></div>
            <div class="container">
                <div class="wt-bnr-inr-entry">
                    <div class="banner-title-outer">
                        <div class="banner-title-name">
                            <h2 class="wt-title">{{ $user->fullName }}</h2>
                        </div>
                    </div>
                    <!-- BREADCRUMB ROW -->

                    <div>
                        <ul class="wt-breadcrumb breadcrumb-style-2">
                            <li><a href="{{ route('home') }}">Anasayfa</a></li>
                            <li>Profil</li>
                        </ul>
                    </div>

                    <!-- BREADCRUMB ROW END -->
                </div>
            </div>
        </div>
        <!-- INNER PAGE BANNER END -->

        <!-- OUR BLOG START -->
        <div class="section-full p-t120  p-b90 site-bg-white">
            <div class="container">
                <div class="row">
                    <div class="col-xl-3 col-lg-4 col-md-12 rightSidebar m-b30">
                        <div class="side-bar-st-1">
                            <div class="twm-candidate-profile-pic">
                                <img src="{{ asset('assets/images/default-user-profile.png') }}" alt="">
                                {{--<div class="upload-btn-wrapper">

                                    <div id="upload-image-grid"></div>
                                    <button class="site-button button-sm">Upload Photo</button>
                                    <input type="file" name="myfile" id="file-uploader" accept=".jpg, .jpeg, .png">
                                </div>--}}

                            </div>

                            <div class="twm-mid-content text-center">
                                <a href="candidate-detail.html" class="twm-job-title">
                                    <h4>{{ $user->fullName }}</h4>
                                </a>
                                <p>Hoş geldiniz</p>
                            </div>
                            <div class="twm-nav-list-1">
                                <ul>
                                    <li class="{{ request()->routeIs('users.profile') ? 'active' : '' }}">
                                        <a href="{{ route('users.profile') }}"><i class="fa fa-user"></i> Profilim</a>
                                    </li>
                                    <li class="{{ request()->routeIs('users.transactions') ? 'active' : '' }}">
                                        <a href="{{ route('users.transactions') }}"><i class="fa fa-credit-card"></i>İşlemler</a>
                                    </li>
                                    {{--<li><a href="employer-change-password.html"><i class="fa fa-fingerprint"></i> Change Password</a></li>--}}
                                    <li>
                                        <form action="{{ route('auth.logout') }}" method="POST" style="display: none"
                                              id="logoutForm">@csrf</form>
                                        <a href="javascript:;" onclick="document.getElementById('logoutForm').submit()"><i
                                                class="fa fa-share-square"></i> Çıkış Yap</a>
                                    </li>
                                </ul>
                            </div>

                        </div>
                    </div>
                    @yield('profile-content')
                </div>
            </div>
        </div>
        <!-- OUR BLOG END -->
    </div>
    <!-- CONTENT END -->
@endsection
