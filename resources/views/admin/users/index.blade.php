@php
    use App\enums\ActiveEnum;
@endphp
@extends('admin.layouts.master')
@section('toolbar-title', 'Kullanıcı Listesi')
@section('content')
    <!--begin::Products-->
    <div class="card card-flush">
        <!--begin::Card header-->
        <div class="card-header align-items-center py-5 gap-2 gap-md-5">
            <!--begin::Card toolbar-->
            <div class="card-toolbar flex-row-fluid justify-content-start gap-5">
                <div class="w-100 mw-150px">
                    <form action="{{ route('admin.users.index') }}" method="get">
                        <input type="text" name="email" id="email" class="form-control"
                               placeholder="Email search..."
                               value="{{ request()->get('email') }}">
                    </form>
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
                    <th class="min-w-175px">İsim & Soyisim</th>
                    <th class="min-w-175px">Email</th>
                    <th class="min-w-175px">Meslek</th>
                    <th class="min-w-175px">Yaş</th>
                    <th class="text-end min-w-70px">Aktif / Pasif</th>
                    <th class="text-end min-w-100px">İşlemler</th>
                </tr>
                </thead>
                <tbody class="fw-semibold text-gray-600">
                @foreach($users as $user)
                    <tr>
                        <td class="text-start" data-dt-column="0">
                            <a href="{{ route('admin.users.show', $user->id) }}"
                               class="text-gray-800 text-hover-primary fw-bold">
                                {{ $user->id }}
                            </a>
                        </td>
                        <td class="text-start" data-dt-column="1">
                            <a href="javascript:void(0)" class="text-gray-800 text-hover-primary fw-bold">
                                {{ $user->fullName }}
                            </a>
                        </td>
                        <td class="text-start" data-dt-column="1">
                            <a href="javascript:void(0)" class="text-gray-800 text-hover-primary fw-bold">
                                {{ $user->email }}
                            </a>
                        </td>
                        <td class="text-start" data-dt-column="1">
                            <a href="javascript:void(0)" class="text-gray-800 text-hover-primary fw-bold">
                                {{ $user->profession }}
                            </a>
                        </td>
                        <td class="text-start" data-dt-column="1">
                            <a href="javascript:void(0)" class="text-gray-800 text-hover-primary fw-bold">
                                {{ $user->age }}
                            </a>
                        </td>
                        <td class="text-end pe-0" data-dt-column="2">
                            <!--begin::Badges-->
                            <div class="badge badge-light-{{ $user->active?->value ? 'success' : 'danger' }}">
                                {{ $user->active?->label() }}
                            </div>
                            <!--end::Badges-->
                        </td>
                        <td class="text-end" data-dt-column="3">
                            <a href="#" class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary"
                               data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                İşlemler
                                <i class="fa-solid fa-caret-down fs-5 ms-1"></i>
                            </a>
                            <!--begin::Menu-->
                            <div
                                class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                data-kt-menu="true">

                                <div class="menu-item px-3">
                                    <a href="{{ route('admin.users.show', $user->id) }}" class="menu-link px-3">
                                        Detay
                                    </a>
                                </div>
                                    <div class="menu-item px-3">
                                        <a href="{{ route('admin.users.updateStatus', [
    'userId' => $user->id,
    'active' => $user->active?->value ? ActiveEnum::PASSIVE->value : ActiveEnum::ACTIVE->value
]) }}" class="menu-link px-3" data-kt-ecommerce-order-filter="delete_row">
                                            {{ $user->active?->toggle()->label() }}
                                        </a>
                                    </div>
                            </div>
                            <!--end::Menu-->
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{ $users->appends(request()->query())->links('pagination::bootstrap-5') }}
            <!--end::Table-->
        </div>
        <!--end::Card body-->
    </div>
    <!--end::Products-->

@endsection
