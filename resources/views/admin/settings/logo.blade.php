@extends('admin.layouts.master')
@section('toolbar-title', 'Update Logo')
@section('content')
    <!--begin::Content-->
    <div id="kt_app_content" class="app-content  flex-column-fluid">
        <!--begin::Content container-->
        <div id="kt_app_content_container" class="app-container container-xxl">

            <div class="card shadow-sm">
                <div class="card-header">
                    <h3 class="card-title">Title</h3>
                    <div class="card-toolbar">
                        <button type="button" class="btn btn-sm btn-light">
                            Action
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    @include('admin.layouts.partials.errors')
                    @include('admin.layouts.partials.alert')
                    <div class="mb-10">
                        <form action="{{ route('admin.settings.logo') }}" method="post" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="rounded border p-10">
                                <div class="mb-10">
                                    <label class="form-label required">Title</label>
                                    <input type="text" class="form-control" name="logo-title" value="{{ old('logo-title', $settings['logo-title']->value) }}">
                                </div>

                                <div class="mb-10">
                                    <div class="card">
                                        @if(is_null($settings['logo-image']->value))
                                            <b class="alert alert-warning">LOGO EKLENMEDİ</b>
                                        @else
                                            <img src="{{ asset($settings['logo-image']->value) }}" class="img-fluid" width="200" height="200">
                                        @endif
                                    </div>
                                    <label class="form-label required">Logo</label>
                                    <input type="file" class="form-control" name="logo-image">
                                </div>

                                <div class="mb-10">
                                    <button type="submit" class="btn btn-success fw-bolder">Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
@endsection
