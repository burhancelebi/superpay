@extends('admin.layouts.master')
@php use Statuses\StatusEnum; @endphp
@section('toolbar')
    @include('admin.layouts.partials.toolbar', [
        'toolbar_title' => $user->fullName . ' - ' . $user->email .' - Permissions',
    ])
@endsection
@section('content')
    <!--begin::Products-->
    <div class="card card-flush">
        <div class="card-toolbar">
            <!--begin::Toolbar-->
            <div class="d-flex justify-content-start mt-3 pr-3" data-kt-customer-table-toolbar="base">

                <a href="#" class="btn btn-primary btn-sm px-5" data-bs-toggle="modal"
                   data-bs-target="#kt_modal_new_permission">
                    Add Permission
                </a>
            </div>
            <!--end::Toolbar-->
        </div>
        <!--begin::Card body-->
        <div class="card-body pt-0 table-responsive">
            @include('admin.layouts.partials.errors')
            @include('admin.layouts.partials.alert')
            <!--begin::Table-->
            <table class="table align-middle table-row-dashed fs-6 gy-5 dataTable">
                <thead>
                <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                    <th class="min-w-100px">ID</th>
                    <th class="min-w-175px">Permission</th>
                    <th class="text-end min-w-100px">Action</th>
                </tr>
                </thead>
                <tbody class="fw-semibold text-gray-600">
                <tr>
                    <td colspan="4" class="text-center">
                        @include('admin.layouts.partials.empty_data', [
                            'data' => $permissions,
                            'message' => 'No Permissions'
                        ])
                    </td>
                </tr>
                @foreach($permissions as $permission)
                    <tr>
                        <td class="text-start" data-dt-column="0">
                            <a href="javascript:void(0)" class="text-gray-800 text-hover-primary fw-bold">
                                {{ $permission->id }}
                            </a>
                        </td>
                        <td class="text-start" data-dt-column="0">
                            <a href="javascript:void(0)" class="text-gray-800 text-hover-primary fw-bold">
                                {{ $permission->name }}
                            </a>
                        </td>
                        <td class="text-end" data-dt-column="3">
                            <a href="#" class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary"
                               data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                Actions
                                <i class="fa-solid fa-caret-down fs-5 ms-1"></i>
                            </a>
                            <!--begin::Menu-->
                            <div
                                class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                data-kt-menu="true">

                                <div class="menu-item px-3">
                                    <a href="{{ route('admin.users.permissions.revoke', [
    'permission' => $permission->name,
    'user' => $user->id,
]) }}" class="menu-link px-3" data-kt-ecommerce-order-filter="delete_row" onclick="confirmAction(event, this, 'Permission will be removed');">
                                        Delete Permission
                                    </a>
                                </div>
                                <!--end::Menu item-->
                            </div>
                            <!--end::Menu-->
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <!--end::Table-->
        </div>
        <!--end::Card body-->
    </div>
    <!--end::Products-->

    <!--end::Modal - Create App--><!--begin::Modal - New Target-->
    <div class="modal fade" id="kt_modal_new_permission" tabindex="-1" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <!--begin::Modal content-->
            <div class="modal-content rounded">
                <!--begin::Modal header-->
                <div class="modal-header pb-0 border-0 justify-content-end">
                    <!--begin::Close-->
                    <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                        <i class="fa-solid fa-xmark fs-1">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                    </div>
                    <!--end::Close-->
                </div>
                <!--begin::Modal header-->

                <!--begin::Modal body-->
                <div class="modal-body scroll-y px-10 px-lg-15 pt-0 pb-15">
                    <!--begin:Form-->
                    <form id="coin-address-form" class="form" action="{{ route('admin.users.permissions.store', $user->id) }}" method="post">
                        @csrf
                        <!--begin::Heading-->
                        <div class="mb-13 text-center">
                            <!--begin::Title-->
                            <h1 class="mb-3">Add Permission</h1>
                            <!--end::Title-->
                        </div>
                        <!--end::Heading-->

                        <!--begin::Input group-->
                        <div class="row g-9 mb-8">
                            <!--begin::Col-->
                            <div class="col-md-12 fv-row">
                                <label class="required fs-6 fw-semibold mb-2">Assign</label>

                                <select class="form-select form-select-solid" data-control="select2"
                                        data-hide-search="true" data-placeholder="Select a Permission" name="permission">
                                    <option value="">Choose</option>
                                    @foreach (\Permissions\Roles::getPermissions() as $key => $permissions)
                                        @foreach ($permissions as $permission)
                                            <option value="{{ $permission }}">{{ $permission }}</option>
                                        @endforeach
                                    @endforeach
                                </select>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->

                        <div class="text-center d-flex flex-column mb-8 fv-row d-none" id="coin-address-error">
                            <span class="alert-danger alert"></span>
                        </div>

                        <div class="text-center d-flex flex-column mb-8 fv-row d-none"
                             id="coin-address-success">
                            <span class="alert-success alert"></span>
                        </div>

                        <!--begin::Actions-->
                        <div class="text-center">
                            <button type="submit" id="add-permission-button" class="btn btn-primary">
                                <span class="indicator-label">Submit</span>
                            </button>
                        </div>
                        <!--end::Actions-->
                    </form>
                    <!--end:Form-->
                </div>
                <!--end::Modal body-->
            </div>
            <!--end::Modal content-->
        </div>
        <!--end::Modal dialog-->
    </div>
    <!--end::Modal - New Target--><!--begin::Modal - Users Search-->
@endsection





















