<!DOCTYPE html>
<html lang="en" >
<!--begin::Head-->

<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
    <title>{{ $title }}</title>
    <meta charset="utf-8"/>
    <link rel="shortcut icon" href="{{ asset('assets/admin/media/logos/favicon.ico') }}"/>

    <!--begin::Fonts(mandatory for all pages)-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700"/>        <!--end::Fonts-->

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
    <link href="{{ asset('assets/admin/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/admin/css/style.bundle.css') }}" rel="stylesheet" type="text/css"/>
    <script>
        // Frame-busting to prevent site from being loaded within a frame without permission (click-jacking)
        if (window.top != window.self) {
            window.top.location.replace(window.self.location.href);
        }
    </script>
</head>
<!--end::Head-->
