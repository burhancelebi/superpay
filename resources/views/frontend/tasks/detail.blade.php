@extends('frontend.layouts.master')
@section('content')
    <div class="page-content">
        <div class="wt-bnr-inr overlay-wraper bg-center" style="background-image:url({{ asset('assets/images/header-banner.jpg') }});">
            <div class="overlay-main site-bg-white opacity-01"></div>
            <div class="container">
                <div class="wt-bnr-inr-entry">
                    <div class="banner-title-outer">
                        <div class="banner-title-name">
                            <h2 class="wt-title">{{ $task->title }}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="section-full  p-t120 p-b90 bg-white">
            <div class="container">
                <div class="section-content">
                    <div class="row d-flex justify-content-center">
                        <div class="col-lg-8 col-md-12">
                            <div class="cabdidate-de-info">
                                <div class="twm-job-self-wrap">
                                    <div class="twm-job-self-info">
                                        <div class="twm-job-self-top">
                                            <div class="twm-media-bg">
                                                <img src="{{ asset('assets/images/bitcoin-3.jpg') }}" alt="#">
                                                <div class="twm-jobs-category green"><span class="twm-bg-green">{{ $task->type->label() }}</span></div>
                                            </div>

                                            <div class="twm-mid-content">
                                                <div class="twm-media">
                                                    <img src="{{ asset('assets/images/anka-kusu.png') }}" alt="#">
                                                </div>

                                                <h4 class="twm-job-title">{{ $task->title }} <span class="twm-job-post-duration"></span></h4>
                                                <p class="twm-job-address">
                                                    @isset($task->score)
                                                        <span class="twm-job-post-duration"><i class="fa-solid fa-star text-warning"></i>{{ $task->score }} Puan</span>
                                                    @endisset
                                                    <span class="twm-job-post-duration"><i class="far fa-hourglass text-warning"></i>{{ $task->duration }} dakika</span>
                                                </p>
                                                <div class="twm-job-self-mid">
                                                    <div class="twm-job-self-mid-left">
                                                        @if($task->isInvestment())
                                                            <a href="javascript:void(0);" class="twm-job-websites site-text-primary">Yatırılacak Tutar: </a>
                                                        @else
                                                            <a href="javascript:void(0);" class="twm-job-websites site-text-primary">Kazanılacak Tutar: </a>
                                                        @endif
                                                        <div class="twm-jobs-amount">{{ $task->amount }} <span>/ {{ $task->currency }}</span></div>
                                                    </div>
                                                    <div class="twm-job-apllication-area">ÖDÜL:
                                                        <span class="text-success">{{ $task->reward }} {{ $task->currency }} <i class="fa-solid fa-coins text-warning"></i></span>
                                                    </div>
                                                </div>

                                                @if($task->isInvestment())
                                                    <hr>
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <div class="twm-job-self-mid">
                                                                <div class="twm-job-apllication-area">Cüzdan Adresi:
                                                                    <span class="text-success" id="wallet-address">{{ $task->wallet->address }}</span>
                                                                    <button onclick="copyWalletAddress()" class="btn btn-sm" style="padding:0 5px;margin-left:5px;">
                                                                        <i class="far fa-copy"></i>
                                                                    </button>
                                                                </div>
                                                                <div class="twm-job-self-mid-left">
                                                                    <div
                                                                        class="twm-jobs-amount">{{ $task->wallet->network }}
                                                                        <span>/ {{ $task->wallet->currency }}</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif

                                                <div class="twm-job-self-bottom">
                                                    <a class="site-button" data-bs-toggle="modal" href="javascript:void(0);" role="button">
                                                        Görevi Yap
                                                    </a>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <h4 class="twm-s-title">Görev Açıklaması:</h4>

                                <p>{{ $task->description }}</p>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </div>
    </div>
@endsection
@section('js')
    <script>
        function copyWalletAddress() {
            var address = document.getElementById("wallet-address").innerText;
            navigator.clipboard.writeText(address);
            alert("Cüzdan adresi kopyalandı!");
        }
    </script>
@endsection
