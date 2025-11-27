@extends('frontend.layouts.master')
@section('content')
    <div class="page-content">

        <!-- INNER PAGE BANNER -->
        <div class="wt-bnr-inr overlay-wraper bg-center" style="background-image:url({{ asset('assets/images/task-list-3.jpg') }});">
            <div class="overlay-main site-bg-white opacity-01"></div>
            <div class="container">
                <div class="wt-bnr-inr-entry">
                    <div class="banner-title-outer">
                        <div class="banner-title-name">
                            <h2 class="wt-title">Mevcut Görevler</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- INNER PAGE BANNER END -->


        <!-- OUR BLOG START -->
        <div class="section-full p-t120  p-b90 site-bg-white">


            <div class="container">
                <div class="row">

                    <div class="col-lg-12 col-md-12">
                        <div class="row">
                            @foreach ($tasks as $task)
                                <div class="col-lg-6 col-md-12 m-b30">
                                    <div class="twm-jobs-grid-style1">
                                        <div class="twm-media">
                                            <img src="{{ asset('assets/images/task-image.png') }}" alt="task image">
                                        </div>

                                        <div class="twm-jobs-category green"><span class="twm-bg-green">{{ $task->type->label() }}</span></div>
                                        <div class="twm-mid-content">
                                            <div class="row">
                                                <div class="col-6 text-start">
                                                    <span class="text-success fw-bold" style="font-size: 14px;"><i class="fa-solid fa-star text-warning"></i> {{ $task->score }} Puan</span>
                                                </div>
                                                <div class="col-6 text-end">
                                                    <span class="text-success fw-bold"><i class="far fa-hourglass"></i> {{ $task->duration }} dakika</span>
                                                </div>
                                            </div>
                                            <a href="job-detail.html" class="twm-job-title">
                                                <h4>{{ $task->title }}</h4>
                                            </a>
                                            <p class="twm-job-address">{{ \Illuminate\Support\Str::limit($task->description) }}</p>
                                            <p class="mb-0"><b>Ödül: </b> <span class="text-success fw-bold">{{ $task->reward }} {{ $task->currency }}</span> <i class="fa-solid fa-coins text-warning"></i></p>
                                        </div>
                                        <div class="twm-right-content">
                                            <div class="twm-jobs-amount"><i class="fa-solid fa-coins text-warning"></i> {{ $task->amount }} <span> {{ $task->currency }}</span></div>
                                            <a href="{{ route('tasks.detail', $task->id) }}" class="twm-jobs-browse site-text-primary">Görevi Yap</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        {{ $tasks->links('vendor.pagination') }}
                    </div>

                </div>
            </div>
        </div>
        <!-- OUR BLOG END -->



    </div>
@endsection
