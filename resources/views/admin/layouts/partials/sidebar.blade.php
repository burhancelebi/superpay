<!--begin::Sidebar-->
<div id="kt_app_sidebar" class="app-sidebar flex-column"
     data-kt-drawer="true" data-kt-drawer-name="app-sidebar" data-kt-drawer-activate="{default: true, lg: false}"
     data-kt-drawer-overlay="true" data-kt-drawer-width="225px" data-kt-drawer-direction="start"
     data-kt-drawer-toggle="#kt_app_sidebar_mobile_toggle"
>


    <!--begin::Logo-->
    <div class="app-sidebar-logo px-6" id="kt_app_sidebar_logo">
        <!--begin::Logo image-->
        <a href="{{ route('admin.backoffice') }}">
            @php $logo = getSettingByKey('logo-image')?->value; @endphp
            <img alt="Logo" src="{{ asset($logo) }}" class="h-25px app-sidebar-logo-default"/>
            <img alt="Logo" src="{{ asset($logo) }}" class="h-20px app-sidebar-logo-minimize"/>
        </a>
        <!--end::Logo image-->
        <div
            id="kt_app_sidebar_toggle"
            class="app-sidebar-toggle btn btn-icon btn-shadow btn-sm btn-color-muted btn-active-color-primary h-30px w-30px position-absolute top-50 start-100 translate-middle rotate "
            data-kt-toggle="true"
            data-kt-toggle-state="active"
            data-kt-toggle-target="body"
            data-kt-toggle-name="app-sidebar-minimize">
            <i class="fa-solid fa-arrow-left"></i>
        </div>
        <!--end::Sidebar toggle-->
    </div>
    <!--end::Logo-->
    @php
        $user = auth()->user();
    @endphp
        <!--begin::sidebar menu-->
    <div class="app-sidebar-menu overflow-hidden flex-column-fluid">
        <!--begin::Menu wrapper-->
        <div id="kt_app_sidebar_menu_wrapper" class="app-sidebar-wrapper">
            <!--begin::Scroll wrapper-->
            <div
                id="kt_app_sidebar_menu_scroll"
                class="scroll-y my-5 mx-3"
                data-kt-scroll="true"
                data-kt-scroll-activate="true"
                data-kt-scroll-height="auto"
                data-kt-scroll-dependencies="#kt_app_sidebar_logo, #kt_app_sidebar_footer"
                data-kt-scroll-wrappers="#kt_app_sidebar_menu"
                data-kt-scroll-offset="5px"
                data-kt-scroll-save-state="true"
            >
                <!--begin::Menu-->
                <div class="menu menu-column menu-rounded menu-sub-indention fw-semibold fs-6"
                     id="#kt_app_sidebar_menu"
                     data-kt-menu="true"
                     data-kt-menu-expand="false">
                    <!--begin:Menu item-->

                    <div class="menu-item pt-5"><!--begin:Menu content-->
                        <div class="menu-content">
                            <span class="menu-heading fw-bold text-uppercase fs-7">Admin</span>
                        </div>
                    </div><!--end:Menu item-->
                    <!--begin:Menu item-->
                    <div data-kt-menu-trigger="click" class="menu-item menu-accordion">

                        <div>
                            <span class="menu-link {{ request()->routeIs('admin.transactions.*') ? 'active' : '' }}">
                                <span class="menu-icon"><i class="fa-solid fa-compass"></i></span>
                                <a class="menu-title" href="{{ route('admin.transactions.index') }}">İşlemler</a>
                            </span>
                        </div>

                        <div>
                            <span class="menu-link {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
                                <span class="menu-icon"><i class="fa-solid fa-compass"></i></span>
                                <a class="menu-title" href="{{ route('admin.settings.index') }}">Ayarlar</a>
                            </span>
                        </div>

                        <div>
                            <span class="menu-link {{ request()->routeIs('admin.wallets.*') ? 'active' : '' }}">
                                <span class="menu-icon"><i class="fa-solid fa-wallet"></i></span>
                                <a class="menu-title" href="{{ route('admin.wallets.index') }}">Cüzdanlar</a>
                            </span>
                        </div>

                        <div>
                            <span class="menu-link {{ request()->routeIs('admin.tasks.*') ? 'active' : '' }}">
                                <span class="menu-icon">
                                    <svg aria-hidden="true" class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"></path>
                                        <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"></path>
                                    </svg>
                                </span>
                                <a class="menu-title" href="{{ route('admin.tasks.index') }}">Görevler</a>
                            </span>
                        </div>

                        <div>
                            <span class="menu-link {{ request()->routeIs('admin.users.index') ? 'active' : '' }}">
                                <span class="menu-icon"><i class="fa-solid fa-compass"></i></span>
                                <a class="menu-title" href="{{ route('admin.users.index') }}">
                                    Kullanıcı Listesi
                                </a>
                            </span>
                        </div>

                        {{--<div>
                            <span class="menu-link {{ request()->routeIs('admin.users.show') ? 'active' : '' }}">
                                <span class="menu-icon"><i class="fa-solid fa-compass"></i></span>
                                <a class="menu-title" href="{{ route('admin.users.show', $user->id) }}">
                                    Profil
                                </a>
                            </span>
                        </div>--}}
                    </div>
                    <!--end::Scroll wrapper-->
                </div>
                <!--end::Menu wrapper-->
            </div>
            <!--end::sidebar menu-->
        </div>
        <!--end::Sidebar-->
    </div>
</div>
