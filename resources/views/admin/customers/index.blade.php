@extends('admin.layouts.master')
@section('toolbar-title', 'Customers')
@section('content')
    <!--begin::Products-->
    <div class="card card-flush">
        <!--begin::Card header-->
        <div class="card-header align-items-center py-5 gap-2 gap-md-5">
            <!--begin::Card toolbar-->
            <div class="card-toolbar flex-row-fluid justify-content-start gap-5">
                <div class="w-100 mw-150px">
                    @if(auth()->user()->hasRole(['admin', 'developer']))
                        <form action="{{ route('admin.merchants.customers', $company->id) }}" method="get">
                            <input type="text" name="email" id="email" class="form-control"
                                   placeholder="Email search..."
                                   value="{{ request()->get('email') }}">
                        </form>
                    @endif
                </div>
                <!--end::Add product-->
            </div>
            <!--end::Card toolbar-->
        </div>
        <!--end::Card header-->

        <!--begin::Card body-->
        <div class="card-body pt-0 table-responsive">
            <!--begin::Table-->
            <table class="table align-middle table-row-dashed fs-6 gy-5">
                <thead>
                <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                    <th class="min-w-100px">ID</th>
                    <th class="min-w-175px">Name & Surname</th>
                    <th class="min-w-175px">Email</th>
                    <th class="text-end min-w-100px">Action</th>
                </tr>
                </thead>
                <tbody class="fw-semibold text-gray-600">
                @foreach($customers as $customer)
                    <tr>
                        <td class="text-start" data-dt-column="0">
                            <a href="{{ route('admin.users.show', $customer->id) }}"
                               class="text-gray-800 text-hover-primary fw-bold">
                                {{ $customer->id }}
                            </a>
                        </td>
                        <td class="text-start" data-dt-column="1">
                            <a href="javascript:void(0)" class="text-gray-800 text-hover-primary fw-bold">
                                {{ $customer->fullName }}
                            </a>
                        </td>
                        <td class="text-start" data-dt-column="1">
                            <a href="javascript:void(0)" class="text-gray-800 text-hover-primary fw-bold">
                                {{ $customer->email }}
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
                                    <a href="{{ route('admin.customers.show', $customer->id) }}" class="menu-link px-3">
                                        Detail
                                    </a>
                                </div>
                            </div>
                            <!--end::Menu-->
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{ $customers->appends(request()->query())->links('pagination::bootstrap-5') }}
            <!--end::Table-->
        </div>
        <!--end::Card body-->
    </div>
    <!--end::Products-->

@endsection
