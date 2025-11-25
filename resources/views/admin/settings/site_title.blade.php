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
                        <form action="{{ route('admin.settings.site_title') }}" method="post">
                            @method('PUT')
                            @csrf
                            <div class="rounded border p-10">
                                <div class="mb-10">
                                    <label class="form-label required">Title</label>
                                    <input type="text" class="form-control" name="site-title" value="{{ old('site-title', $settings['site-title']->value) }}">
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
