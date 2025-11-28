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
                                @guest
                                    <a href="{{ route('auth.login-page') }}" class="btn btn-outline-primary">Giriş Yap</a>
                                @endguest
                                <a href="{{ route('tasks.index') }}" class="btn btn-outline-primary">Günün Görevleri</a>
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
                            @foreach ($tasks as $task)
                                <div class="col-lg-6 col-md-6">
                                    <div class="twm-jobs-st5 m-b30">
                                        <div class="twm-jobs-amount">
                                            <i class="fa-solid fa-coins text-warning"></i>
                                            {{ $task->amount }} <span> {{ $task->currency }}</span>
                                        </div>
                                        <div class="twm-job-st5-top">
                                            <div class="twm-media">
                                                <img src="{{ asset('assets/images/task-image.png') }}" alt="#">
                                            </div>
                                            <div class="twm-com-info">
                                                <p class="mb-0"><b>Ödül: </b> <span class="">{{ $task->reward }} {{ $task->currency }}</span></p>
                                                <a href="{{ route('tasks.detail', $task->id) }}" class="twm-job-com-name site-text-primary">
                                                    {{ $task->title }}
                                                </a>
                                            </div>
                                        </div>

                                        <div class="twm-mid-content">
                                            <div class="twm-job-duration">
                                                <ul>
                                                    <li>
                                                        <span class="twm-job-post-duration"><i class="fa-solid fa-star text-warning"></i> {{ $task->score }} Puan</span>
                                                    </li>
                                                    <li>
                                                        <span class="twm-job-post-duration"><i class="far fa-hourglass"></i> {{ $task->duration }} dakika</span>
                                                    </li>
                                                </ul>
                                            </div>
                                            <p>{{ \Illuminate\Support\Str::limit($task->description) }}</p>
                                        </div>
                                        <div class="text-right">
                                            <a href="{{ route('tasks.detail', $task->id) }}" class="twm-jobs-browse site-text-primary">Görevi Yap</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="text-center m-b30">
                            <a href="{{ route('tasks.index') }}" class=" site-button">Hepsini Göster</a>
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
                                        <div>Akıllı Yatırım Çözümleri</div>
                                    </div>
                                    <h2 class="wt-title">Birikimlerinize Değer Katın</h2>
                                    <p>Sermayenizi uzman sistemlerimizle yönetiyoruz.
                                        Bütçenizi sisteme ekleyin,
                                        gerekli işlem süreçleri tamamlandıktan sonra ana paranızı,
                                        elde edilen kâr payı ile birlikte güvenle hesabınıza geri çekin.</p>
                                </div>
                                <div class="twm-how-t-get-bottom">
                                    @auth
                                        <a href="{{ route('tasks.index') }}" class="site-button">Şimdi Kazanmaya Başla</a>
                                    @else
                                        <a href="{{ route('auth.login-page') }}" class="site-button">Şimdi Kazanmaya Başla</a>
                                    @endauth
                                    <div class="twm-left-icon-bx">
                                        <div class="twm-left-icon-media site-bg-primary">
                                            <i class="flaticon-bell site-text-white"></i>
                                        </div>
                                        <div class="twm-left-icon-content">
                                            <h4 class="icon-title">Yeni İşlem Başarılı</h4>
                                            <p>Kazancınız hesabınıza gönderildi</p>
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
                                        <h4 class="icon-title">Hedef Kazanç</h4>
                                        <p>%100 Tamamlandı</p>
                                    </div>
                                </div>
                                <div class="twm-profile-card bounce2">
                                    <div class="twm-profile-pic"><img src="https://thewebmax.org/jobzilla/images/home-7/img-bx/pic3.jpg" alt="#"></div>
                                    <div class="twm-profile-info">
                                        <h4 class="twm-profile-name">
                                            Ahmet Yılmaz
                                        </h4>
                                        <div class="twm-profile-position">Platin Yatırımcı</div>
                                        <a class="site-button-link underline badge badge-success text-success">Kazanç Çekildi</a>
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
