@extends('frontend.layouts.master')
@section('content')
    <div class="page-content">
        <div class="twm-home8-banner-section site-bg-white bg-cover" style="background-image:url(https://thewebmax.org/jobzilla/images/home-8/h8-banner.jpg)">
            <div class="container">
                <div class="twm-home8-inner-section">
                    <div class="row">
                        <div class="col-lg-7 col-md-12">
                            <div class="twm-bnr-left-section">
                                <div class="twm-bnr-title-large">Kazanç Dünyasına Adım Atmak İster Misin ?</div>
                                <a href="{{ route('auth.login-page') }}" class="btn btn-outline-primary w-100">Giriş Yap</a>
                            </div>
                        </div>
                        <div class="col-lg-5 col-md-12">
                            <div class="bnr-media bounce2">
                                <img src="{{ asset('assets/images/slide-image2.png') }}" alt="#">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="twm-bnr-bottom-section">
                    <div class="twm-browse-jobs">Kazan</div>
                </div>
            </div>

        </div>
        <!--Banner End-->

        <!-- Jobs START -->
        <div class="section-full p-t120 p-b90 site-bg-white pos-relative twm-bdr-bottom-1">
            <div class="container">

                <!-- TITLE START-->
                <div class="section-head center wt-small-separator-outer">
                    <h2 class="wt-title">Günün görevleri</h2>
                </div>
                <!-- TITLE END-->

                <div class="section-content">
                    <div class="twm-jobs-grid-h5-wrap">
                        <div class="row">
                            <div class="col-lg-6 col-md-6">
                                <div class="twm-jobs-st5  m-b30">
                                    <div class="twm-jobs-amount">$500 <span>/ hour</span></div>
                                    <div class="twm-job-st5-top">
                                        <div class="twm-media">
                                            <img src="https://thewebmax.org/jobzilla/images/home-5/jobs-company/pic1.jpg" alt="#">
                                        </div>
                                        <div class="twm-com-info">
                                            <p class="twm-job-address">New York, US</p>
                                            <a href="https://themeforest.net/user/thewebmax/portfolio" class="twm-job-com-name site-text-primary">
                                                Crystel Inc Pvt. Ltd.
                                            </a>
                                        </div>
                                    </div>

                                    <div class="twm-mid-content">
                                        <a href="job-detail.html" class="twm-job-title">
                                            <h4>UI / UX Designer fulltime</h4>
                                        </a>
                                        <div class="twm-job-duration">
                                            <ul>
                                                <li>
                                                    <span class="twm-job-post-duration"><i class="fa fa-calendar-alt"></i>Fulltime</span>
                                                </li>
                                                <li>
                                                    <span class="twm-job-post-duration"><i class="far fa-clock"></i>4 Minutes ago</span>
                                                </li>
                                            </ul>
                                        </div>
                                        <p>Lorem Ipsum is simply dummy text of printing
                                            and typesetting industry
                                        </p>


                                    </div>
                                    <div class="twm-right-content">
                                        <div class="twm-candi-thum-content">
                                            <div class="twm-pics">
                                                <span><img src="https://thewebmax.org/jobzilla/images/main-slider/slider2/user/u-1.jpg" alt=""></span>
                                                <span><img src="https://thewebmax.org/jobzilla/images/main-slider/slider2/user/u-2.jpg" alt=""></span>
                                                <span><img src="https://thewebmax.org/jobzilla/images/main-slider/slider2/user/u-3.jpg" alt=""></span>
                                                <span><img src="https://thewebmax.org/jobzilla/images/main-slider/slider2/user/u-4.jpg" alt=""></span>
                                                <span><img src="https://thewebmax.org/jobzilla/images/main-slider/slider2/user/u-5.jpg" alt=""></span>
                                                <span><img src="https://thewebmax.org/jobzilla/images/main-slider/slider2/user/u-6.jpg" alt=""></span>
                                                <div class="tot-view"><b>86<i>+</i></b></div>
                                            </div>
                                        </div>
                                        <a href="job-detail.html" class="twm-jobs-browse site-text-primary">Apply Job</a>
                                    </div>
                                    <div class="twm-jobs-category outline">
                                        <a href="javascript:;">AdobeXd</a>
                                        <a href="javascript:;">Figma</a>
                                        <a href="javascript:;">Photoshop</a>
                                        <a href="javascript:;">Corel</a>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6">
                                <div class="twm-jobs-st5  m-b30">
                                    <div class="twm-jobs-amount">$250 <span>/ hour</span></div>
                                    <div class="twm-job-st5-top">
                                        <div class="twm-media">
                                            <img src="https://thewebmax.org/jobzilla/images/home-5/jobs-company/pic2.jpg" alt="#">
                                        </div>
                                        <div class="twm-com-info">
                                            <p class="twm-job-address">New York, US</p>
                                            <a href="https://themeforest.net/user/thewebmax/portfolio" class="twm-job-com-name site-text-primary">
                                                Infosys BPM Ltd.
                                            </a>
                                        </div>
                                    </div>

                                    <div class="twm-mid-content">
                                        <a href="job-detail.html" class="twm-job-title">
                                            <h4>Full Stack Engineer</h4>
                                        </a>
                                        <div class="twm-job-duration">
                                            <ul>
                                                <li>
                                                    <span class="twm-job-post-duration"><i class="fa fa-calendar-alt"></i>Fulltime</span>
                                                </li>
                                                <li>
                                                    <span class="twm-job-post-duration"><i class="far fa-clock"></i>4 Minutes ago</span>
                                                </li>
                                            </ul>
                                        </div>
                                        <p>Lorem Ipsum is simply dummy text of printing
                                            and typesetting industry
                                        </p>


                                    </div>
                                    <div class="twm-right-content">
                                        <div class="twm-candi-thum-content">
                                            <div class="twm-pics">
                                                <span><img src="https://thewebmax.org/jobzilla/images/main-slider/slider2/user/u-1.jpg" alt=""></span>
                                                <span><img src="https://thewebmax.org/jobzilla/images/main-slider/slider2/user/u-2.jpg" alt=""></span>
                                                <span><img src="https://thewebmax.org/jobzilla/images/main-slider/slider2/user/u-3.jpg" alt=""></span>
                                                <span><img src="https://thewebmax.org/jobzilla/images/main-slider/slider2/user/u-4.jpg" alt=""></span>
                                                <span><img src="https://thewebmax.org/jobzilla/images/main-slider/slider2/user/u-5.jpg" alt=""></span>
                                                <span><img src="https://thewebmax.org/jobzilla/images/main-slider/slider2/user/u-6.jpg" alt=""></span>
                                                <div class="tot-view"><b>50<i>+</i></b></div>
                                            </div>
                                        </div>
                                        <a href="job-detail.html" class="twm-jobs-browse site-text-primary">Apply Job</a>
                                    </div>
                                    <div class="twm-jobs-category outline">
                                        <a href="javascript:;">AdobeXd</a>
                                        <a href="javascript:;">Figma</a>
                                        <a href="javascript:;">Photoshop</a>
                                        <a href="javascript:;">Corel</a>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6">
                                <div class="twm-jobs-st5  m-b30">
                                    <div class="twm-jobs-amount">$250 <span>/ hour</span></div>
                                    <div class="twm-job-st5-top">
                                        <div class="twm-media">
                                            <img src="https://thewebmax.org/jobzilla/images/home-5/jobs-company/pic3.jpg" alt="#">
                                        </div>
                                        <div class="twm-com-info">
                                            <p class="twm-job-address">New York, US</p>
                                            <a href="https://themeforest.net/user/thewebmax/portfolio" class="twm-job-com-name site-text-primary">
                                                Accenture Plc
                                            </a>
                                        </div>
                                    </div>

                                    <div class="twm-mid-content">
                                        <a href="job-detail.html" class="twm-job-title">
                                            <h4>Frontend Developer</h4>
                                        </a>
                                        <div class="twm-job-duration">
                                            <ul>
                                                <li>
                                                    <span class="twm-job-post-duration"><i class="fa fa-calendar-alt"></i>Fulltime</span>
                                                </li>
                                                <li>
                                                    <span class="twm-job-post-duration"><i class="far fa-clock"></i>4 Minutes ago</span>
                                                </li>
                                            </ul>
                                        </div>
                                        <p>Lorem Ipsum is simply dummy text of printing
                                            and typesetting industry
                                        </p>


                                    </div>
                                    <div class="twm-right-content">
                                        <div class="twm-candi-thum-content">
                                            <div class="twm-pics">
                                                <span><img src="https://thewebmax.org/jobzilla/images/main-slider/slider2/user/u-1.jpg" alt=""></span>
                                                <span><img src="https://thewebmax.org/jobzilla/images/main-slider/slider2/user/u-2.jpg" alt=""></span>
                                                <span><img src="https://thewebmax.org/jobzilla/images/main-slider/slider2/user/u-3.jpg" alt=""></span>
                                                <span><img src="https://thewebmax.org/jobzilla/images/main-slider/slider2/user/u-4.jpg" alt=""></span>
                                                <span><img src="https://thewebmax.org/jobzilla/images/main-slider/slider2/user/u-5.jpg" alt=""></span>
                                                <span><img src="https://thewebmax.org/jobzilla/images/main-slider/slider2/user/u-6.jpg" alt=""></span>
                                                <div class="tot-view"><b>200<i>+</i></b></div>
                                            </div>
                                        </div>
                                        <a href="job-detail.html" class="twm-jobs-browse site-text-primary">Apply Job</a>
                                    </div>
                                    <div class="twm-jobs-category outline">
                                        <a href="javascript:;">AdobeXd</a>
                                        <a href="javascript:;">Figma</a>
                                        <a href="javascript:;">Photoshop</a>
                                        <a href="javascript:;">Corel</a>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6">
                                <div class="twm-jobs-st5  m-b30">
                                    <div class="twm-jobs-amount">$150 <span>/ hour</span></div>
                                    <div class="twm-job-st5-top">
                                        <div class="twm-media">
                                            <img src="https://thewebmax.org/jobzilla/images/home-5/jobs-company/pic4.jpg" alt="#">
                                        </div>
                                        <div class="twm-com-info">
                                            <p class="twm-job-address">New York, US</p>
                                            <a href="https://themeforest.net/user/thewebmax/portfolio" class="twm-job-com-name site-text-primary">
                                                Infosys BPM Ltd.
                                            </a>
                                        </div>
                                    </div>

                                    <div class="twm-mid-content">
                                        <a href="job-detail.html" class="twm-job-title">
                                            <h4>Products Manager</h4>
                                        </a>
                                        <div class="twm-job-duration">
                                            <ul>
                                                <li>
                                                    <span class="twm-job-post-duration"><i class="fa fa-calendar-alt"></i>Fulltime</span>
                                                </li>
                                                <li>
                                                    <span class="twm-job-post-duration"><i class="far fa-clock"></i>4 Minutes ago</span>
                                                </li>
                                            </ul>
                                        </div>
                                        <p>Lorem Ipsum is simply dummy text of printing
                                            and typesetting industry
                                        </p>


                                    </div>
                                    <div class="twm-right-content">
                                        <div class="twm-candi-thum-content">
                                            <div class="twm-pics">
                                                <span><img src="https://thewebmax.org/jobzilla/images/main-slider/slider2/user/u-1.jpg" alt=""></span>
                                                <span><img src="https://thewebmax.org/jobzilla/images/main-slider/slider2/user/u-2.jpg" alt=""></span>
                                                <span><img src="https://thewebmax.org/jobzilla/images/main-slider/slider2/user/u-3.jpg" alt=""></span>
                                                <span><img src="https://thewebmax.org/jobzilla/images/main-slider/slider2/user/u-4.jpg" alt=""></span>
                                                <span><img src="https://thewebmax.org/jobzilla/images/main-slider/slider2/user/u-5.jpg" alt=""></span>
                                                <span><img src="https://thewebmax.org/jobzilla/images/main-slider/slider2/user/u-6.jpg" alt=""></span>
                                                <div class="tot-view"><b>35<i>+</i></b></div>
                                            </div>
                                        </div>
                                        <a href="job-detail.html" class="twm-jobs-browse site-text-primary">Apply Job</a>
                                    </div>
                                    <div class="twm-jobs-category outline">
                                        <a href="javascript:;">AdobeXd</a>
                                        <a href="javascript:;">Figma</a>
                                        <a href="javascript:;">Photoshop</a>
                                        <a href="javascript:;">Corel</a>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="text-center m-b30">
                            <a href="job-grid.html" class=" site-button">View All</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!-- Recruiters END -->

        <!-- HOW TO GET YOUR JOB SECTION START -->
        <div class="section-full p-t120 p-b90 site-bg-light twm-how-t-get-wrap7">
            <div class="container">

                <div class="twm-how-t-get-section">
                    <div class="row">

                        <div class="col-xl-5 col-lg-5 col-md-12">
                            <div class="twm-how-t-get-section-left">
                                <div class="section-head left wt-small-separator-outer">
                                    <div class="wt-small-separator site-text-primary">
                                        <div>How to get your job</div>
                                    </div>
                                    <h2 class="wt-title">Build Your Personal Account Profile</h2>
                                    <p>Create an account for job information that you wanted, get notification
                                        everyday and you can easily apply directly to the company you want
                                        create and account now for free.</p>
                                </div>
                                <div class="twm-how-t-get-bottom">
                                    <a href="about-1.html" class="site-button">Edit Profile</a>
                                    <div class="twm-left-icon-bx">
                                        <div class="twm-left-icon-media site-bg-primary">
                                            <i class="flaticon-bell site-text-white"></i>
                                        </div>
                                        <div class="twm-left-icon-content">
                                            <h4 class="icon-title">New Interview</h4>
                                            <p>You has new interview today</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-7 col-lg-7 col-md-12">
                            <div class="twm-how-t-get-section-right">
                                <div class="twm-media">
                                    <img src="https://thewebmax.org/jobzilla/images/home-8/hig-pic2.png" alt="#">
                                </div>
                                <div class="twm-left-img-bx bounce">
                                    <div class="twm-left-img-media">
                                        <img src="https://thewebmax.org/jobzilla/images/home-7/img-bx/pic1.jpg" alt="#">
                                    </div>
                                    <div class="twm-left-img-content">
                                        <h4 class="icon-title">Complete your profile</h4>
                                        <p>95% Completed</p>
                                    </div>
                                </div>
                                <div class="twm-profile-card bounce2">
                                    <div class="twm-profile-pic"><img src="https://thewebmax.org/jobzilla/images/home-7/img-bx/pic3.jpg" alt="#"></div>
                                    <div class="twm-profile-info">
                                        <h4 class="twm-profile-name">
                                            Devid Smith
                                        </h4>
                                        <div class="twm-profile-position">UI/UX Designer</div>
                                        <a class="site-button-link underline">Hire Me!</a>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>

        </div>
        <!-- HOW TO GET YOUR JOB SECTION END -->
    </div>
@endsection
