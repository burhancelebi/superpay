<!--begin::Scrolltop-->
<div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
    <i class="ki-duotone ki-arrow-up"><span class="path1"></span><span class="path2"></span></i></div>
<!--end::Scrolltop-->

<!--begin::Javascript-->

<!--begin::Global Javascript Bundle(mandatory for all pages)-->
<script src="{{ asset('assets/admin/plugins/global/plugins.bundle.js') }}"></script>
<script src="{{ asset('assets/admin/js/scripts.bundle.js') }}"></script>
<!--end::Global Javascript Bundle-->

<!--begin::Vendors Javascript(used for this page only)-->
<script src="{{ asset('assets/admin/plugins/custom/datatables/datatables.bundle.js') }}"></script>
<!--end::Vendors Javascript-->
<script src="{{ asset('assets/admin/js/custom/apps/ecommerce/sales/listing.js') }}"></script>
<!--begin::Custom Javascript(used for this page only)-->
<script src="{{ asset('assets/admin/js/widgets.bundle.js') }}"></script>
<script src="{{ asset('assets/admin/js/custom/widgets.js') }}"></script>
<script src="{{ asset('assets/admin/js/custom/utilities/modals/create-app.js') }}"></script>
<script src="{{ asset('assets/admin/js/custom/utilities/modals/new-target.js') }}"></script>
<script src="{{ asset('assets/admin/js/custom/utilities/modals/users-search.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/tr.js"></script>
<script src="{{ asset('assets/admin/js/custom.js') }}"></script>
<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    });

</script>
@yield('js')
<!--end::Custom Javascript-->
<!--end::Javascript-->
</body>
<!--end::Body-->
</html>
