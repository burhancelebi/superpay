@extends('admin.layouts.master')
@section('content')
    <div class="card">
        <!--begin::Card header-->
        <div class="card-header border-0 pt-6">
            <!--begin::Card title-->
            <div class="card-title">
                <div class="d-flex align-items-center position-relative my-1">
                   <span class="fw-bold fs-3">Cüzdan Yönetimi</span>
                </div>
            </div>
            <!--begin::Card title-->
            <!--begin::Card toolbar-->
            <div class="card-toolbar">
                <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                    <a href="{{ route('admin.wallets.create') }}" class="btn btn-primary">
                        <i class="fa-solid fa-plus fs-2"></i> Yeni Cüzdan Ekle
                    </a>
                </div>
            </div>
            <!--end::Card toolbar-->
        </div>
        <!--end::Card header-->

        <!--begin::Card body-->
        <div class="card-body py-4">
            <div class="table-responsive">
                <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_wallets">
                    <thead>
                        <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                            <th class="min-w-125px">Kullanıcı</th>
                            <th class="min-w-125px">Ağ (Network)</th>
                            <th class="min-w-125px">Kripto Birimi</th>
                            <th class="min-w-125px">Adres</th>
                            <th class="min-w-125px">Aktif / Pasif</th>
                            <th class="min-w-125px">Oluşturulma Tarihi</th>
                            <th class="text-end min-w-100px">İşlemler</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600 fw-semibold">
                        @foreach($wallets as $wallet)
                            <tr>
                                <td>
                                    {{ $wallet->user->fullName }}
                                </td>
                                <td>{{ $wallet->network }}</td>
                                <td>{{ $wallet->currency }}</td>
                                <td>
                                    <span
                                        class="text-gray-800 fs-7">{{ \Illuminate\Support\Str::limit($wallet->address, 20) }}</span>
                                    <button class="btn btn-sm btn-icon"
                                            onclick="navigator.clipboard.writeText('{{ $wallet->address }}'); toastr.success('Cüzdan adresi kopyalandı!');">
                                        <i class="fa-regular fa-copy"></i>
                                    </button>
                                </td>
                                <td>
                                    <div class="badge badge-light-{{ $wallet->active->value ? 'success' : 'danger' }} fw-bold">
                                        {{ $wallet->active->label() }}
                                    </div>
                                </td>
                                <td>{{ $wallet->created_at->format('d.m.Y H:i') }}</td>
                                <td class="text-end">
                                    <a href="#" class="btn btn-light btn-active-light-primary btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                        İşlemler
                                        <i class="fa-solid fa-chevron-down ms-2 fs-5"></i>
                                    </a>
                                    <!--begin::Menu-->
                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="{{ route('admin.wallets.active', [
    'id' => $wallet->id, 'active' => $wallet->active->toggle()->value
    ]) }}" class="menu-link px-3">{{ $wallet->active->toggle()->label() }}</a>
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="{{ route('admin.wallets.destroy', $wallet->id) }}" class="menu-link px-3" onclick="return confirm('Silmek istediğinize emin misiniz?')">Sil</a>
                                        </div>
                                        <!--end::Menu item-->
                                    </div>
                                    <!--end::Menu-->
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!--begin::Pagination-->
            <div class="d-flex justify-content-end">
                {{ $wallets->links() }}
            </div>
            <!--end::Pagination-->
        </div>
        <!--end::Card body-->
    </div>
@endsection
