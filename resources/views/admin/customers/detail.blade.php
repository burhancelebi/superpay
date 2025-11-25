@php use Permissions\Permissions; @endphp
@extends('admin.layouts.master')
@section('toolbar-title', $customer->fullName)
@section('content')
    <!--begin::Content-->
    <div id="kt_app_content" class="app-content  flex-column-fluid " >
        <!--begin::Content container-->
        <div id="kt_app_content_container" class="app-container  container-xxl ">
            <!--begin::Layout-->
            <div class="d-flex flex-column">
                <!--begin::Sidebar-->
                <div class="flex-column flex-lg-row-auto mb-10">

                    <!--begin::Card-->
                    <div class="card mb-5 mb-xl-12">
                        <!--begin::Card body-->
                        <div class="card-body">
                            <div class="card-title">
                                <h3>Customer Informations</h3>
                            </div>
                            <!--begin::Summary-->
                            <!--begin::User Info-->
                            <div class="d-flex flex-center flex-column py-5">
                                <!--begin::Avatar-->
                                <div class="symbol symbol-100px symbol-circle mb-7">
                                    <img src="{{ asset('assets/media/blank-profile.webp') }}" alt="image"/>
                                </div>
                                <!--end::Avatar-->
                                <!--begin::Name-->
                                <a href="javascript:void(0)" class="fs-3 text-gray-800 text-hover-primary fw-bold mb-3">
                                    {{ $customer->fullName }}
                                </a>
                                <!--end::Name-->
                                <!--begin::Info-->
                            </div>
                            <!--end::User Info-->
                            <!--end::Summary-->

                            <!--begin::Details toggle-->
                            <div class="d-flex flex-stack fs-4 py-3">
                                <div class="fw-bold rotate collapsible" data-bs-toggle="collapse"
                                     href="#kt_customer_view_details" role="button" aria-expanded="false"
                                     aria-controls="kt_customer_view_details">
                                    Details
                                    <span class="ms-2 rotate-180">
                                        <i class="fa-solid fa-caret-down fs-3"></i>
                                    </span>
                                </div>
                            </div>
                            <!--end::Details toggle-->

                            <div class="separator"></div>

                            <!--begin::Details content-->
                            <div id="kt_customer_view_details" class="collapse show">
                                <div class="pb-5 fs-6">
                                    <!--begin::Details item-->
                                    <div class="fw-bold mt-5">Name</div>
                                    <div class="text-gray-600">
                                        <a href="#" class="text-gray-600 text-hover-primary">
                                            {{ $customer->name }}
                                        </a>
                                    </div>
                                    <!--begin::Details item-->
                                    <!--begin::Details item-->
                                    <div class="fw-bold mt-5">Surname</div>
                                    <div class="text-gray-600">
                                        <a href="#" class="text-gray-600 text-hover-primary">
                                            {{ $customer->surname }}
                                        </a>
                                    </div>
                                    <!--begin::Details item-->

                                    <!--begin::Details item-->
                                    <div class="fw-bold mt-5">Email</div>
                                    <div class="text-gray-600">
                                        <a href="#" class="text-gray-600 text-hover-primary">
                                            {{ $customer->email }}
                                        </a>
                                    </div>
                                    <!--begin::Details item-->

                                    <!--begin::Details item-->
                                    <div class="fw-bold mt-5">Phone</div>
                                    <div class="text-gray-600">
                                        <a href="#" class="text-gray-600 text-hover-primary">
                                            {{ $customer->phone }}
                                        </a>
                                    </div>
                                    <!--begin::Details item-->

                                    <!--begin::Details item-->
                                    <div class="fw-bold mt-5">External ID</div>
                                    <div class="text-gray-600">
                                        <a href="#" class="text-gray-600 text-hover-primary">
                                            {{ $customer->external_user_id }}
                                        </a>
                                    </div>
                                    <!--begin::Details item-->
                                </div>
                            </div>
                            <!--end::Details content-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Card-->

                    <!--begin::Products-->
                    <div class="card card-flush">
                        <div class="card-header border-0 pt-5">
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bold fs-3 mb-1">Transactions</span>

                                <span class="text-muted mt-1 fw-semibold fs-7">{{ $transactions->total() }} Transactions</span>
                            </h3>
                        </div>
                        <!--begin::Card body-->
                        <div class="card-body pt-0 table-responsive">
                            @include('admin.layouts.partials.errors')
                            @include('admin.layouts.partials.alert')
                            <!--begin::Table-->
                            <table class="table align-middle table-row-dashed fs-6 gy-5">
                                <thead>
                                <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                                    <th class="min-w-100px">ID</th>
                                    <th class="min-w-175px">Key</th>
                                    <th class="min-w-175px">Currency</th>
                                    <th class="min-w-175px">Amount Paid</th>
                                    <th class="text-end min-w-70px">Status</th>
                                    <th class="text-end min-w-100px">Action</th>
                                </tr>
                                </thead>
                                <tbody class="fw-semibold text-gray-600">
                                <tr>
                                    <td colspan="4" class="text-center">
                                        @include('admin.layouts.partials.empty_data', [
                                            'data' => $transactions,
                                            'message' => 'No transactions'
                                        ])
                                    </td>
                                </tr>
                                @foreach($transactions as $transaction)
                                    <tr>
                                        <td class="text-start" data-dt-column="0">
                                            <a href="javascript:void(0)" class="text-gray-800 text-hover-primary fw-bold">
                                                {{ $transaction->id }}
                                            </a>
                                        </td>
                                        <td class="text-start" data-dt-column="0">
                                            <a href="javascript:void(0)" class="text-gray-800 text-hover-primary fw-bold">
                                                {{ $transaction->key }}
                                            </a>
                                        </td>
                                        <td class="text-start" data-dt-column="0">
                                            <a href="javascript:void(0)" class="text-gray-800 text-hover-primary fw-bold">
                                                {{ $transaction->currency }}
                                            </a>
                                        </td>
                                        <td class="text-start" data-dt-column="0">
                                            <a href="javascript:void(0)" class="text-gray-800 text-hover-primary fw-bold">
                                                {{ $transaction->amount_to_be_paid . ' - ' . $transaction->coinAddress->coin->symbol }}
                                            </a>
                                        </td>
                                        <td class="text-end pe-0" data-dt-column="2">
                                            <!--begin::Badges-->
                                            <div class="badge">
                                                {{ \Transactions\TransactionStatusEnum::getLabel($transaction->status) }}
                                            </div>
                                            <!--end::Badges-->
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
                                                <!--begin::Menu item-->
                                                <div class="menu-item px-3">
                                                    <a href="{{ route('admin.transactions.show', $transaction->id) }}" class="menu-link px-3" data-kt-ecommerce-order-filter="delete_row">
                                                        Detail
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
                            {{ $transactions->appends(request()->query())->links('pagination::bootstrap-5') }}
                            <!--end::Table-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Products-->
                </div>
                <!--end::Sidebar-->
            </div>
            <!--end::Layout-->

@endsection
