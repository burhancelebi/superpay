@include('frontend.layouts.partials.header')
@yield('content')

@if (!isset($hideFooter) || $hideFooter === false)
    @include('frontend.layouts.partials.footer')
@endif
