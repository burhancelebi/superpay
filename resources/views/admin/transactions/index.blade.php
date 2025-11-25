@extends('admin.layouts.master')
@section('toolbar-title', 'İşlemler')
@section('css')
    <style>
        .select2-container .select2-dropdown {
            z-index: 9999 !important;
        }

        .children-row td {
            background-color: #f8f9fa;
            border-top: 1px solid #dee2e6;
        }

        .children-row td:hover {
            background-color: #e2e6ea;
        }
    </style>
@endsection
@section('content')

    <div class="card card-flush mb-2">
        <div class="card-body table-responsive">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-bordered border-2 align-middle fs-6 gy-5 mb-5">
                            <thead>
                                <tr class="fw-bold fs-7 text-uppercase gs-0 text-center">
                                    <th>Toplam Talep Edilen Tutar</th>
                                    <th>Oran Tutar Toplam</th>
                                    <th>Toplam Bakiye</th>
                                    <th>Toplam Gönderilen</th>
                                    <th>Toplam Kalan Tutar</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="fw-bold text-dark text-center">
                                    <td>{{ number_format($transactions->sum('requested_amount'), 2, ',', '.') }} ₺</td>
                                    <td>{{ number_format($transactions->sum('payment_system_fee_amount'), 2, ',', '.') }} ₺</td>
                                    <td>{{ number_format($transactions->sum('balance'), 2, ',', '.') }} ₺</td>
                                    <td>{{ number_format($transactions->sum('amount_sent'), 2, ',', '.') }} ₺</td>
                                    <td>{{ number_format($transactions->sum('remaining_amount'), 2, ',', '.') }} ₺</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--begin::Products-->
    <div class="card card-flush">
        <div class="card-header border-0 pt-5">
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bold fs-3 mb-1">Yapılan İşlemler</span>
                <span class="text-muted mt-1 fw-semibold fs-7">Toplamda {{ $transactions->count() }} İşlem</span>
            </h3>

            <div class="card-toolbar" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover"
                 data-bs-original-title="Click to add a user" data-kt-initialized="1">
                <div class="m-0">
                    <a href="#" class="btn btn-sm btn-flex btn-secondary fw-bold" data-kt-menu-trigger="click"
                       data-kt-menu-placement="bottom-end">
                        <i class="fa-solid fa-filter"></i>
                        Filtrele
                    </a>
                    <div class="menu menu-sub menu-sub-dropdown w-500px" data-kt-menu="true"
                         id="kt_menu_68a873b6cc3ca" style="">
                        <div class="px-7 py-5">
                            <div class="fs-5 text-gray-900 fw-bold">Filtreleme Seçenekleri</div>
                        </div>
                        <div class="separator border-gray-200"></div>
                        <form action="" method="get">
                            <div class="px-7 py-5">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-semibold">ID: </label>
                                        <input type="text" name="filter[id]" value="{{ request()->input('filter.id') }}" class="form-control">
                                    </div>
                                    <div class="col-md-6 mb-3 d-flex align-items-center">
                                        <div class="form-check mt-4">
                                            <input class="form-check-input" type="checkbox"
                                                   name="filter[awaiting_payment]"
                                                   value="1"
                                                   id="awaitingPaymentCheck"
                                                {{ request()->input('filter.awaiting_payment') ? 'checked' : '' }}>
                                            <label class="fw-semibold" for="awaitingPaymentCheck">
                                                Ödemesi Beklenenler
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label fw-semibold">Talep Edilen Tarih: </label>
                                            <input type="text" name="filter[requested_at_between]"
                                                   value="{{ request()->input('filter.requested_at_between', now()) }}"
                                                   class="form-control kt_datetimepicker_between">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label fw-semibold">Ödenme Tarihi: </label>
                                            <input type="text" name="filter[sent_at_between]" value="{{ request()->input('filter.sent_at_between') }}" class="form-control kt_datetimepicker_between">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label fw-semibold">Çekilen Tutar: </label>
                                            <input type="text" name="filter[requested_amount]" value="{{ request()->input('filter.requested_amount') }}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label fw-semibold">Gönderilen Tutar: </label>
                                            <input type="text" name="filter[amount_sent]" value="{{ request()->input('filter.amount_sent') }}" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label fw-semibold">Grup: </label>
                                            <div>
                                                <select class="form-select form-select-solid cursor-pointer" name="filter[transaction_group_id]">
                                                    <option value="">Grup Seç</option>
                                                    @foreach($transactionGroups as $transactionGroup)
                                                        <option value="{{ $transactionGroup->id }}" {{ request()->input('filter.transaction_group_id') == $transactionGroup->id ? 'selected' : '' }}>
                                                            {{ $transactionGroup->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label fw-semibold">İşlemi Yapan: </label>
                                            <div>
                                                <select class="form-select form-select-solid cursor-pointer" name="filter[user_id]">
                                                    <option value="">Kullanıcı seç...</option>
                                                    @foreach($users as $user)
                                                        <option value="{{ $user->id }}" {{ request()->input('filter.user_id') == $user->id ? 'selected' : '' }}>
                                                            {{ $user->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Taksit oranı: </label>
                                    <input type="text" name="filter[payment_system_rate]" value="{{ request()->input('filter.payment_system_rate') }}" class="form-control">
                                </div>
                                <div class="d-flex justify-content-end">
                                    <a href="{{ route('admin.transactions.index') }}" class="btn btn-sm btn-light btn-active-light-primary me-2" data-kt-menu-dismiss="true">
                                        Sıfırla
                                    </a>
                                    <button type="submit" class="btn btn-sm btn-primary" data-kt-menu-dismiss="true">Filtrele</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="m-0">
                    <button type="button" class="btn ml-5 btn-sm btn-icon btn-color-primary btn-active-light-primary"
                            data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                        <i class="fa-solid fa-bars"></i>
                    </button>
                    <div
                        class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px"
                        data-kt-menu="true">
                        <div class="menu-item px-3">
                            <div class="menu-content fs-6 text-gray-900 fw-bold px-3 py-4">Hızlı İşlem</div>
                        </div>
                        <div class="separator mb-3 opacity-75"></div>
                        <div class="menu-item px-3">
                            <a href="#" class="menu-link px-3" data-bs-target="#kt_modal_new_transaction"
                               data-bs-toggle="modal">
                                Yeni Ekle
                            </a>
                        </div>
                        <div class="separator mt-3 opacity-75"></div>
                        <div class="menu-item px-3">
                            <div class="menu-content px-3 py-3">
                                <a class="btn btn-primary btn-sm px-4" id="export-to-excel" href="{{ route('admin.transactions.export', request()->query()) }}">
                                    Excel'e Aktar
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--begin::Card body-->
        <div class="card-body pt-0 table-responsive">
            @include('admin.layouts.partials.errors')
            @include('admin.layouts.partials.alert')
            <!--begin::Table-->
            <table class="table align-middle table-row-dashed fs-6 gy-5">
                <thead>
                <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                    <th class="min-w-100px">#</th>
                    <th class="min-w-100px">Grup</th>
                    <th class="min-w-100px">Talep Tarihi</th>
                    <th class="min-w-100px">Gönderim Tarihi</th>
                    <th class="min-w-175px">Referans</th>
                    <th class="min-w-175px">Tutar</th>
                    <th class="min-w-175px">Taksit</th>
                    <th class="min-w-175px">Ödeme Sistemi Oranı</th>
                    <th class="min-w-175px">Ödeme Sistemi Oran Tutarı</th>
                    <th class="min-w-175px">Bizim Oran</th>
                    <th class="min-w-175px">Bizim Oran Tutarı</th>
                    <th class="min-w-175px">Bakiye</th>
                    <th class="min-w-175px">Gönderilen Tutar</th>
                    <th class="min-w-175px">Kalan Tutar</th>
                    <th class="text-end min-w-100px">İşlem</th>
                </tr>
                </thead>
                <tbody class="fw-semibold text-gray-600">
                @foreach($transactions as $transaction)
                    <tr>
                        <td class="text-start" >
                            <a href="{{ route('admin.transactions.show', $transaction->id) }}"
                               class="text-hover-primary text-primary fw-bold" target="_blank">
                                {{ $transaction->id }}
                            </a>

                            @if($transaction->subTransactions->count())
                                <button class="btn btn-sm btn-light ms-2 toggle-children" data-target="#children-{{ $transaction->id }}">
                                    <i class="fa-solid fa-caret-down"></i>
                                </button>
                            @endif
                        </td>
                        <td class="text-start">{{ $transaction->group->name }}</td>
                        <td class="text-start">{{ $transaction->requested_at }}</td>
                        <td class="text-start">{{ $transaction->sent_at }}</td>
                        <td class="text-start" >{{ $transaction->reference_name }}</td>
                        <td class="text-start" >{{ number_format($transaction->requested_amount, 2, ',', '.') }} ₺</td>
                        <td class="text-start" >{{ $transaction->installment }}</td>
                        <td class="text-start" >{{ $transaction->payment_system_rate }}</td>
                        <td class="text-start" >{{ number_format($transaction->payment_system_fee_amount, 2, ',', '.') }} ₺</td>
                        <td class="text-start" >{{ $transaction->our_rate }}</td>
                        <td class="text-start" >{{ number_format($transaction->our_fee_amount, 2, ',', '.') }} ₺</td>
                        <td class="text-start" >{{ number_format($transaction->balance, 2, ',', '.') }} ₺</td>
                        <td class="text-start" >{{ number_format($transaction->amount_sent, 2, ',', '.') }} ₺</td>
                        <td class="text-start" >{{ number_format($transaction->remaining_amount, 2, ',', '.') }} ₺</td>
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
                                    <a href="{{ route('admin.transactions.show', $transaction->id) }}"
                                       class="menu-link px-3">
                                        Detay
                                    </a>
                                </div>
                                <div class="menu-item px-3">
                                    <a href="{{ route('admin.transactions.edit', $transaction->id) }}" class="menu-link px-3 update-button">
                                        Güncelle
                                    </a>
                                </div>
                                <div class="menu-item px-3">
                                    <a class="menu-link px-3 text-start" data-id="{{ $transaction->id }}"
                                       data-bs-target="#kt_modal_transaction_file_preview_{{ $transaction->id }}"
                                       data-bs-toggle="modal">
                                        Dosya Görüntüle
                                    </a>
                                </div>

                                @if(is_null($transaction->parent_id))
                                    <div class="menu-item px-3">
                                        <a class="menu-link px-3 partial-transaction" data-id="{{ $transaction->id }}"
                                           data-bs-target="#kt_modal_new_transaction"
                                           data-bs-toggle="modal">
                                            Parçalı Çekim
                                        </a>
                                    </div>
                                @endif

                                <div class="menu-item px-3">
                                    <a class="menu-link px-3 partial-payment" data-id="{{ $transaction->id }}"
                                       data-bs-target="#kt_modal_new_partial_payment"
                                       data-bs-toggle="modal">
                                        Parçalı Ödeme
                                    </a>
                                </div>
                                <div class="menu-item px-3">
                                    <form action="{{ route('admin.transactions.destroy', $transaction->id) }}" method="POST" class="delete-transaction-form d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="menu-link px-3 text-danger w-100 text-start"
                                                onclick="return confirm('ID: {{$transaction->id}} numaralı işlemi silmek istediğinize emin misiniz?')">
                                            Sil
                                        </button>
                                    </form>
                                </div>
                            </div>
                            <!--end::Menu-->
                        </td>
                    </tr>

                    <x-transactions.file-preview :model="$transaction"/>
                    @if($transaction->subTransactions->count())
                        <tr id="children-{{ $transaction->id }}" class="children-row bg-light" style="display:none;">
                            <td colspan="14">
                                <table class="table align-middle table-row-dashed fs-6 gy-5">
                                    <thead>
                                    <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                                        <th class="min-w-100px">#</th>
                                        <th class="min-w-100px">Grup</th>
                                        <th class="min-w-100px">Talep Tarihi</th>
                                        <th class="min-w-100px">Gönderim Tarihi</th>
                                        <th class="min-w-175px">Referans</th>
                                        <th class="min-w-175px">Tutar</th>
                                        <th class="min-w-175px">Taksit</th>
                                        <th class="min-w-175px">Ödeme Sistemi Oranı</th>
                                        <th class="min-w-175px">Ödeme Sistemi Oran Tutarı</th>
                                        <th class="min-w-175px">Bizim Oran</th>
                                        <th class="min-w-175px">Bizim Oran Tutarı</th>
                                        <th class="min-w-175px">Bakiye</th>
                                        <th class="min-w-175px">Gönderilen Tutar</th>
                                        <th class="min-w-175px">Kalan Tutar</th>
                                        <th class="text-end min-w-100px">İşlem</th>
                                    </tr>
                                    </thead>
                                    @foreach($transaction->subTransactions as $child)
                                        <tr>
                                            <td class="text-start py-1 px-2">
                                                <a href="{{ route('admin.transactions.show', $child->id) }}"
                                                   class="text-hover-primary text-primary fw-bold">
                                                    {{ $child->id }}
                                                </a>
                                            </td>
                                            <td class="text-start py-1 px-2">{{ $child->group->name }}</td>
                                            <td class="text-start py-1 px-2">{{ $child->requested_at }}</td>
                                            <td class="text-start py-1 px-2">{{ $child->sent_at }}</td>
                                            <td class="text-start py-1 px-2">{{ $child->reference_name }}</td>
                                            <td class="text-start py-1 px-2" >{{ number_format($child->requested_amount, 2, ',', '.') }} ₺</td>
                                            <td class="text-start py-1 px-2" >{{ $child->installment }}</td>
                                            <td class="text-start py-1 px-2" >{{ $child->payment_system_rate }}</td>
                                            <td class="text-start py-1 px-2" >{{ number_format($child->payment_system_fee_amount, 2, ',', '.') }} ₺</td>
                                            <td class="text-start py-1 px-2" >{{ $child->our_rate }}</td>
                                            <td class="text-start py-1 px-2" >{{ number_format($child->our_fee_amount, 2, ',', '.') }} ₺</td>
                                            <td class="text-start py-1 px-2" >{{ number_format($child->balance, 2, ',', '.') }} ₺</td>
                                            <td class="text-start py-1 px-2" >{{ number_format($child->amount_sent, 2, ',', '.') }} ₺</td>
                                            <td class="text-start py-1 px-2" >{{ number_format($child->remaining_amount, 2, ',', '.') }} ₺</td>
                                            <td class="text-end" data-dt-column="3">
                                                <a href="#" class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary"
                                                   data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                                    İşlemler
                                                    <i class="fa-solid fa-caret-down fs-5 ms-1"></i>
                                                </a>
                                                <!--begin::Menu-->
                                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                                    data-kt-menu="true">
                                                    <div class="menu-item px-3">
                                                        <a class="menu-link px-3 text-start update-button" data-id="{{ $child->id }}"
                                                           data-bs-target="#kt_modal_transaction_file_preview_{{ $child->id }}"
                                                           data-bs-toggle="modal">
                                                            Dosya Görüntüle
                                                        </a>
                                                    </div>

                                                    <div class="menu-item px-3">
                                                        <a href="{{ route('admin.transactions.show', $child->id) }}"
                                                           class="menu-link px-3">
                                                            Detay
                                                        </a>
                                                    </div>

                                                    <div class="menu-item px-3">
                                                        <form action="{{ route('admin.transactions.destroy', $child->id) }}" method="POST" class="delete-transaction-form d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="menu-link px-3 text-danger w-100 text-start"
                                                                    onclick="return confirm('ID: {{$child->id}} numaralı işlemi silmek istediğinize emin misiniz?')">
                                                                Sil
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                                <!--end::Menu-->
                                            </td>
                                        </tr>

                                        <x-transactions.file-preview :model="$child"/>
                                    @endforeach
                                </table>
                            </td>
                        </tr>
                    @endif
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="modal fade" id="kt_modal_new_transaction" tabindex="-1" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered modal-xl">
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
                    <form id="store-transaction" method="POST" class="form" action="{{ route('admin.transactions.store') }}">
                        <div class="mb-13 text-center">
                            <h1 class="mb-3">Yeni İşlem Gir</h1>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="d-flex flex-column fv-row">
                                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                        <span>Üst İşlem ID: </span>
                                    </label>
                                    <input type="number" class="form-control form-control" name="parent_id" placeholder="Örn: 123"/>
                                </div>

                                <div class="d-flex flex-column mb-4 fv-row">
                                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                        <span class="required">İşlem Grubu: </span>
                                    </label>
                                    <select class="form-control cursor-pointer" name="transaction_group_id" required>
                                        <option value="">İşlem grubu seçin...</option>
                                        @foreach($transactionGroups as $transactionGroup)
                                            <option value="{{ $transactionGroup->id }}">{{ $transactionGroup->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="d-flex flex-column mb-4 fv-row">
                                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                        <span class="required">İş Yeri</span>
                                    </label>
                                    <select class="form-control cursor-pointer" name="merchants" required>
                                        <option value="">İş yeri seçin...</option>
                                        @foreach($merchants as $merchant)
                                            <option value="{{ $merchant->id }}">{{ $merchant->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="d-flex flex-column mb-4 fv-row">
                                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                        <span class="required">Ödeme Sistemi</span>
                                    </label>
                                    <select class="form-control cursor-pointer" name="payment-systems">
                                        <option value="">Ödeme Sistemi seçin...</option>
                                    </select>
                                </div>

                                <div class="d-flex flex-column mb-4 fv-row">
                                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                        <span class="required">Taksit Sayısı</span>
                                    </label>
                                    <select class="form-control cursor-pointer" name="installment" required>
                                        <option value="">Taksit sayısı</option>
                                    </select>
                                </div>

                                <div class="d-flex flex-column fv-row">
                                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                        <span class="required">Taksit Oranı</span>
                                    </label>
                                    <input type="number" step="0.01" class="form-control" name="payment_system_rate" placeholder="Örn: 3.25" required/>
                                </div>

                                <div class="d-flex flex-column fv-row">
                                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                        <span class="required">Talep Edilen Tutar</span>
                                    </label>
                                    <input type="number" class="form-control" name="requested_amount" placeholder="Örn: 150000" required/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex flex-column fv-row">
                                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                        <span>Gönderilen Tutar</span>
                                    </label>
                                    <input type="number" class="form-control form-control" name="amount_sent" placeholder="Örn: 120000"/>
                                </div>
                                {{--<div class="d-flex flex-column fv-row">
                                    <label class="form-label">Müşteri Seç</label>
                                    <select class="form-select" id="customer_id" data-control="select2" data-placeholder="Müşteri seçin">
                                        <!-- başlangıçta boş -->
                                    </select>
                                </div>--}}

                                <div class="d-flex flex-column fv-row">
                                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                        <span>Referans</span>
                                    </label>
                                    <input type="text" class="form-control" name="reference_name" placeholder="Örn: 6 AY YKB"/>
                                </div>

                                <div class="d-flex flex-column fv-row">
                                    <label class="form-label">Talep Edilen Zaman Dilimi</label>
                                    <input class="kt_datetimepicker form-control" name="requested_at" placeholder="Tarih ve saat seçiniz"
                                           autocomplete="off" value="{{ now() }}">
                                </div>

                                <div class="d-flex flex-column fv-row">
                                    <label class="form-label">Talebin karşılandığı Zaman Dilimi</label>
                                    <input class="kt_datetimepicker form-control" name="sent_at" placeholder="Tarih ve saat seçiniz"
                                           autocomplete="off" value="{{ now() }}">
                                </div>

                                <div class="mt-2 p-4 border-3 border-dashed">
                                    <div class="d-flex flex-column fv-row">
                                        <label class="form-label">Çekim Dekontu: </label>
                                        <input type="file" class="form-control" name="withdrawal_receipt">
                                    </div>
                                </div>

                                <div class="mt-2 p-4 border-3 border-dashed">
                                    <div class="d-flex flex-column fv-row">
                                        <label class="form-label">Ödeme Dekontu: </label>
                                        <input type="file" class="form-control" name="payment_receipt">
                                    </div>
                                </div>

                                <div class="mt-5">
                                    <button type="button" id="addPartialPayment" class="btn btn-sm btn-light-primary">
                                        <i class="bi bi-plus-lg"></i> Parçalı Ödeme Ekle
                                    </button>
                                </div>
                                <div id="partialPaymentsWrapper" class="mt-3"></div>
                            </div>
                        </div>

                        <!--begin::Actions-->
                        <div class="text-center mt-4">
                            <button type="submit" id="transaction-submit-button" class="btn btn-primary">
                                <span class="indicator-label">
                                    Ekle
                                </span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <x-transactions.add-partial-payment/>
@endsection
@section('js')
    <script>
        window.routes = {
            merchantPaymentSystems: "{{ route('admin.merchants.payment-systems.json', ['id' => ':id']) }}",
            paymentSystemRates: "{{ route('admin.payment-systems.merchants.rates.json', ['id' => ':id', 'merchantId' => ':merchantId']) }}"
        };
    </script>
    <script src="{{ asset('assets/js/transaction.js') }}"></script>
    <script>
        initDateTimePicker();

        flatpickr(".kt_datetimepicker_between", {
            mode: "range",
            dateFormat: "Y-m-d",
            rangeSeparator: " - ",
            locale: "tr",
            static: true,
            allowInput: true, // elle yazmaya da izin veriyorsan kalsın; istemiyorsan false yap
        });


        $('.toggle-children').on('click', function(e) {
            e.preventDefault();
            const target = $(this).data('target');
            $(target).toggle();
        });

        transactionFormDefaultDisabled();

        $("#user_select").select2({
            tags: true, // yeni değer eklemeye izin verir
            placeholder: "Bir kullanıcı seçin",
            ajax: {
                url: "/api/users/search", // backend endpoint'in
                dataType: "json",
                delay: 250,
                data: function (params) {
                    return {
                        q: params.term // arama parametresi
                    };
                },
                processResults: function (data) {
                    // Beklenen format: [{id:1, text:"Ad Soyad"}]
                    return {
                        results: data
                    };
                },
                cache: true
            },
            createTag: function (params) {
                var term = $.trim(params.term);
                if (term === '') {
                    return null;
                }
                // Eğer sonuç yoksa yeni option yarat
                return {
                    id: term,
                    text: term,
                    newTag: true
                };
            }
        });

        $(function () {
            let paymentIndex = 0;

            $('#addPartialPayment').on('click', function () {
                paymentIndex++;

                let html = `
                <div class="card card-flush border mb-4 p-4 partial-payment-item">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h6 class="mb-0">Parçalı Ödeme #${paymentIndex}</h6>
                        <button type="button" class="btn btn-sm btn-icon btn-danger removePartialPayment">
                            <i class="bi bi-x-lg"></i>
                        </button>
                    </div>

                    <div class="mb-3">
                        <label class="form-label required">Tutar</label>
                        <input type="number" class="form-control" name="partial_payments[${paymentIndex}][amount]" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Açıklama</label>
                        <input type="text" class="form-control" name="partial_payments[${paymentIndex}][description]">
                    </div>

                    <div class="d-flex flex-column fv-row">
                        <label class="form-label">Gönderim Zamanı</label>
                        <input class="kt_datetimepicker form-control" name="partial_payments[${paymentIndex}][paid_at]" placeholder="Tarih ve saat seçiniz" autocomplete="off">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Dosya Ekle</label>
                        <input type="file" class="form-control" name="partial_payments[${paymentIndex}][file]">
                    </div>
                </div>
            `;

                $('#partialPaymentsWrapper').append(html);
                initDateTimePicker();
            });

            $(document).on('click', '.removePartialPayment', function () {
                $(this).closest('.partial-payment-item').remove();
            });
        });

        $('#store-transaction').on('submit', function(e) {
            e.preventDefault();

            let form = $(this)[0];
            let formData = new FormData(form);
            let url = $(this).attr('action');
            $('#transaction-submit-button').prop('disabled', true);
            //loadingGif();

            $.ajax({
                url: url,
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    toast().success(response.message || 'İşlem başarıyla eklendi.');
                    //form.reset();
                    $('#transaction-submit-button').prop('disabled', false);
                    removeLoadingGif();
                    $('#store-transaction input[name="parent_id"]').val('');
                    $('#store-transaction input[name="requested_amount"]').val('');
                    $('#store-transaction input[name="amount_sent"]').val('');
                    $('#store-transaction input[name="payment_receipt"]').val('');
                    $('#store-transaction input[name="withdrawal_receipt"]').val('');
                    //setTimeout(function() {
                        //location.reload();
                    //}, 3000);
                },
                error: function(xhr) {
                    let errors = xhr.responseJSON?.errors;
                    if(errors) {
                        let messages = Object.values(errors).flat().join(' ');
                        toast().error(messages);
                    } else if(xhr.responseJSON?.message) {
                        toast().error(xhr.responseJSON.message);
                    } else {
                        toast().error('Bir hata oluştu.');
                    }
                    removeLoadingGif();
                    $('#transaction-submit-button').prop('disabled', false);
                }
            });
        });

        const amountSentInput = document.querySelector('input[name="amount_sent"]');
        document.addEventListener("click", function (e) {
            if (e.target.closest(".partial-transaction")) {
                e.preventDefault();

                amountSentInput.disabled = true;
                let link = e.target.closest(".partial-transaction");
                let parentId = link.getAttribute("data-id");

                let input = document.querySelector('input[name="parent_id"]');
                if (input) {
                    input.value = parentId;
                }
            }
        });

        document.addEventListener('DOMContentLoaded', function() {
            const parentInput = document.querySelector('input[name="parent_id"]');

            parentInput.addEventListener('input', function() {
                if (parentInput.value) {
                    amountSentInput.value = '';
                    amountSentInput.disabled = true;
                } else {
                    amountSentInput.disabled = false;
                }
            });
        });

        document.addEventListener('DOMContentLoaded', function () {
            const exportBtn = document.getElementById('export-to-excel');

            exportBtn.addEventListener('click', function (e) {
                e.preventDefault();

                Swal.fire({
                    title: 'Maliyet hesaplansın mı?',
                    showDenyButton: true,
                    confirmButtonText: 'Evet',
                    denyButtonText: 'Hayır',
                }).then((result) => {
                    let url = exportBtn.getAttribute('href');

                    if (result.isConfirmed) {
                        // cost=1 parametresini ekle
                        const separator = url.includes('?') ? '&' : '?';
                        url += separator + 'cost=1';
                    }

                    window.location.href = url;
                });
            });
        });
    </script>
@endsection
