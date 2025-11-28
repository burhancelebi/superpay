<!-- FOOTER START -->
<footer class="footer-light">
    <div class="container">
        <!-- FOOTER BLOCKES START -->
        <div class="footer-top">
            <div class="row">

                <div class="col-lg-3 col-md-12">

                    <div class="widget widget_about">
                        <div class="logo-footer clearfix">
                            <a href="{{ route('home') }}"><img src="{{ asset(getSettingByKey('logo-image')?->value) }}" alt=""></a>
                        </div>
                        <p>Many desktop publishing packages and web page editors now.</p>
                        <ul class="ftr-list">
                            <li><p><span>Adres :</span>Istanbul </p></li>
                            <li><p><span>Email :</span>example@max.com</p></li>
                            <li><p><span>Call :</span>555-555-1234</p></li>
                        </ul>
                    </div>

                </div>

                <div class="col-lg-9 col-md-12">
                    <div class="row">
                        {{--<div class="col-lg-3 col-md-6 col-sm-6">
                            <div class="widget widget_services ftr-list-center">
                                <h3 class="widget-title">For Candidate</h3>
                                <ul>
                                    <li><a href="https://thewebmax.org/jobzilla/dashboard.html">User Dashboard</a></li>
                                    <li><a href="https://thewebmax.org/jobzilla/dash-resume-alert.html">Alert resume</a></li>
                                    <li><a href="candidate-grid.html">Candidates</a></li>
                                    <li><a href="blog-list.html">Blog List</a></li>
                                    <li><a href="https://thewebmax.org/jobzilla/blog-single.html">Blog single</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <div class="widget widget_services ftr-list-center">
                                <h3 class="widget-title">For Employers</h3>
                                <ul>
                                    <li><a href="https://thewebmax.org/jobzilla/dash-post-job.html">Post Jobs</a></li>
                                    <li><a href="blog-grid.html">Blog Grid</a></li>
                                    <li><a href="contact.html">Contact</a></li>
                                    <li><a href="job-list.html">Jobs Listing</a></li>
                                    <li><a href="job-detail.html">Jobs details</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <div class="widget widget_services ftr-list-center">
                                <h3 class="widget-title">Helpful Resources</h3>
                                <ul>
                                    <li><a href="faq.html">FAQs</a></li>
                                    <li><a href="employer-detail.html">Employer detail</a></li>
                                    <li><a href="https://thewebmax.org/jobzilla/dash-my-profile.html">Profile</a></li>
                                    <li><a href="error-404.html">404 Page</a></li>
                                    <li><a href="pricing.html">Pricing</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <div class="widget widget_services ftr-list-center">
                                <h3 class="widget-title">Quick Links</h3>
                                <ul>
                                    <li><a href="index.html">Home</a></li>
                                    <li><a href="about-1.html">About us</a></li>
                                    <li><a href="https://thewebmax.org/jobzilla/dash-bookmark.html">Bookmark</a></li>
                                    <li><a href="job-grid.html">Jobs</a></li>
                                    <li><a href="employer-list.html">Employer</a></li>
                                </ul>
                            </div>
                        </div>--}}
                    </div>
                </div>

            </div>
        </div>
        <!-- FOOTER COPYRIGHT -->
        <div class="footer-bottom">
            <div class="footer-bottom-info">
                <div class="footer-copy-right">
                    <span class="copyrights-text">Copyright © 2023 by SuperPay All Rights Reserved.</span>
                </div>
                <ul class="social-icons">
                    <li><a href="javascript:void(0);" class="fab fa-facebook-f"></a></li>
                    <li><a href="javascript:void(0);" class="fab fa-twitter"></a></li>
                    <li><a href="javascript:void(0);" class="fab fa-instagram"></a></li>
                    <li><a href="javascript:void(0);" class="fab fa-youtube"></a></li>
                </ul>

            </div>

        </div>

    </div>

</footer>
<!-- FOOTER END -->

<!-- BUTTON TOP START -->
<button class="scroltop"><span class="fa fa-angle-up  relative" id="btn-vibrate"></span></button>

<!-- JAVASCRIPT  FILES ========================================= -->
<script  src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
<script  src="{{ asset('assets/js/popper.min.js') }}"></script>
<script  src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/magnific-popup.min.js') }}"></script>
<script src="{{ asset('assets/js/waypoints.min.js') }}"></script>
<script src="{{ asset('assets/js/counterup.min.js') }}"></script>
<script src="{{ asset('assets/js/waypoints-sticky.min.js') }}"></script>
<script src="{{ asset('assets/js/isotope.pkgd.min.js') }}"></script>
<script src="{{ asset('assets/js/imagesloaded.pkgd.min.js') }}"></script>
<script src="{{ asset('assets/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.owl-filter.js') }}"></script>
<script src="{{ asset('assets/js/theia-sticky-sidebar.js') }}"></script>
<script src="{{ asset('assets/js/lc_lightbox.lite.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap-select.min.js') }}"></script>
<script src="{{ asset('assets/js/dropzone.js') }}"></script>
<script src="{{ asset('assets/js/jquery.scrollbar.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap-datepicker.js') }}"></script>
<script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/js/dataTables.bootstrap5.min.js') }}"></script>
<script src="{{ asset('assets/js/chart.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap-slider.min.js') }}"></script>
<script src="{{ asset('assets/js/swiper-bundle.min.js') }}"></script>
<script src="{{ asset('assets/js/custom.js') }}"></script>
<script src="{{ asset('assets/js/switcher.js') }}"></script>
@yield('js')
<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    });

</script>

</body>
</html>
