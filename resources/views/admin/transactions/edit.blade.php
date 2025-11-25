@php use Permissions\Permissions; @endphp
@extends('admin.layouts.master')
@section('toolbar-title', 'İşlem - ' . $transaction->id)
@section('content')
    <div id="kt_app_toolbar" class="app-toolbar  py-3 py-lg-6 ">
        <div id="kt_app_toolbar_container" class="app-container  container-xxl d-flex flex-stack ">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 ">
                <!--begin::Title-->
                <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                    {{ 'İşlem - ' . $transaction->id }}
                </h1>
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                    <li class="breadcrumb-item text-muted">
                        <a href="{{ route('admin.backoffice') }}" class="text-muted text-hover-primary">Anasayfa</a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-500 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted">
                        <a href="{{ route('admin.transactions.index') }}" class="text-muted text-hover-primary">
                            İşlemler Listesi
                        </a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-500 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted">{{ 'İşlem - ' . $transaction->id }}</li>
                </ul>
                <!--end::Breadcrumb-->
            </div>
            <!--end::Page title-->
            <!--begin::Actions-->
            <div class="d-flex align-items-center gap-2 gap-lg-3">
                <a href="{{ route('admin.transactions.index') }}" class="btn btn-sm fw-bold btn-primary">
                    İşlemler Listesi
                </a>
                <!--end::Primary button-->
            </div>
            <!--end::Actions-->
        </div>
        <!--end::Toolbar container-->
    </div>

    <div id="kt_app_content" class="app-content  flex-column-fluid ">
        <!--begin::Content container-->
        <div id="kt_app_content_container" class="app-container  container-xxl ">
            <!--begin::Invoice 2 main-->
            <div class="card">
                <!--begin::Body-->
                <div class="card-body p-lg-20">
                    <!--begin::Layout-->
                    <div class="d-flex flex-column flex-xl-row">
                        <!--begin::Content-->
                        <div class="flex-lg-row-fluid me-xl-18 mb-10 mb-xl-0">
                            <!--begin::Invoice 2 content-->
                            <div class="mt-n1">
                                <!--begin::Top-->
                                <div class="d-flex flex-stack pb-10">
                                    @php $logo = getSettingByKey('logo-image')?->value; @endphp
                                    <a href="{{ route('admin.backoffice') }}">
                                        <img src="{{ asset($logo) }}" alt="Logo" style="width: 55px">
                                    </a>

                                    <div class="d-flex gap-2">
                                        <a href="{{ route('admin.transactions.show', $transaction->id) }}" class="btn btn-sm btn-primary">
                                            Detay
                                        </a>

                                        <a href="#" class="btn btn-sm btn-success"
                                        data-id="{{ $transaction->id }}"
                                        data-bs-target="#kt_modal_transaction_file_preview_{{ $transaction->id }}"
                                        data-bs-toggle="modal">
                                            Dosya
                                        </a>
                                    </div>
                                </div>
                                <div class="m-0">
                                    <!--begin::Label-->
                                    <div class="fw-bold fs-3 text-gray-800 mb-8">İşlem #{{$transaction->id}}</div>
                                    <!--end::Label-->

                                    <form id="update-transaction" method="POST" class="form" action="{{ route('admin.transactions.update', $transaction->id) }}"
                                    enctype="multipart/form-data">
                                        @method('PUT')
                                        @csrf
                                        <div class="mb-13 text-center">
                                            <h1 class="mb-3">İşlem Güncelle</h1>
                                        </div>

                                        @include('admin.layouts.partials.errors')
                                        @include('admin.layouts.partials.alert')

                                        <div class="row">
                                            <div class="col-md-12">

                                                <div class="d-flex flex-column mb-4 fv-row">
                                                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                                        <span>Üst İşlem ID: </span>
                                                    </label>
                                                    <input type="number" class="form-control form-control-solid" name="parent_id"
                                                               value="{{ old('parent_id', $transaction->parent_id) }}" placeholder="Üst işlem ID"/>
                                                </div>

                                                <div class="d-flex flex-column mb-4 fv-row">
                                                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                                        <span class="required">İşlem Grubu: </span>
                                                    </label>
                                                    <select class="form-control cursor-pointer" name="transaction_group_id" required>
                                                        <option value="">İşlem grubu seçin...</option>
                                                        @foreach($groups as $group)
                                                            <option value="{{ $group->id }}" {{ $transaction->transaction_group_id == $group->id ? 'selected':'' }}>
                                                                {{ $group->name }}
                                                            </option>
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
                                                            <option value="{{ $merchant->id }}"
                                                                {{ $transaction->merchantPayment->merchant_id == $merchant->id ? 'selected':'' }}>
                                                                {{ $merchant->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="d-flex flex-column mb-4 fv-row">
                                                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                                        <span class="required">Ödeme Sistemi</span>
                                                    </label>
                                                    <select class="form-control cursor-pointer" name="payment-systems">
                                                        <option value="">Ödeme Sistemi seçin...</option>
                                                        @foreach($merchantPayments as $merchantPayment)
                                                            <option value="{{ $merchantPayment->id }}"
                                                                {{ $transaction->merchantPayment->payment_system_id == $merchantPayment->id ? 'selected':'' }}>
                                                                {{ $merchantPayment->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="d-flex flex-column mb-4 fv-row">
                                                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                                        <span class="required">Taksit Sayısı</span>
                                                    </label>
                                                    <select class="form-control cursor-pointer" name="installment" required>
                                                        <option value="{{ $transaction->installment }}">{{ $transaction->installment }}</option>
                                                    </select>
                                                </div>

                                                <div class="d-flex flex-column fv-row">
                                                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                                        <span class="required">Taksit Oranı</span>
                                                    </label>
                                                    <input type="number" step="0.01" class="form-control" name="payment_system_rate" placeholder="Örn: 3.25" required
                                                           value="{{ $transaction->payment_system_rate }}"/>
                                                </div>

                                                <div class="d-flex flex-column fv-row">
                                                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                                        <span class="required">Talep Edilen Tutar</span>
                                                    </label>
                                                    <input type="number" class="form-control" name="requested_amount" placeholder="Örn: 150000" required
                                                           value="{{ $transaction->requested_amount }}"/>
                                                </div>

                                                <div class="d-flex flex-column fv-row">
                                                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                                        <span>Gönderilen Tutar</span>
                                                    </label>
                                                    <input type="number" class="form-control form-control" name="amount_sent" placeholder="Örn: 120000"
                                                           value="{{ $transaction->amount_sent }}"/>
                                                </div>

                                                <div class="d-flex flex-column fv-row">
                                                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                                        <span>Referans</span>
                                                    </label>
                                                    <input type="text" class="form-control" name="reference_name" placeholder="Örn: 6 AY YKB"
                                                           value="{{ $transaction->reference_name }}"/>
                                                </div>

                                                <div class="d-flex flex-column fv-row">
                                                    <label class="form-label">Talep Edilen Zaman Dilimi</label>
                                                    <input class="kt_datetimepicker form-control" name="requested_at" placeholder="Tarih ve saat seçiniz"
                                                           value="{{ $transaction->requested_at }}" autocomplete="off">
                                                </div>

                                                <div class="d-flex flex-column fv-row">
                                                    <label class="form-label">Talebin karşılandığı Zaman Dilimi</label>
                                                    <input class="kt_datetimepicker form-control" name="sent_at" placeholder="Tarih ve saat seçiniz"
                                                           value="{{ $transaction->sent_at }}" autocomplete="off">
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
                                            </div>
                                        </div>

                                        <!--begin::Actions-->
                                        <div class="text-center mt-4">
                                            <button type="submit" class="btn btn-primary">
                                                <span class="indicator-label">
                                                    Güncelle
                                                </span>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end::Body-->
            </div>
        </div>
    </div>
    <x-transactions.file-preview :model="$transaction"/>
@endsection
@section('js')
    <script src="{{ asset('assets/js/transaction.js') }}"></script>
    <script>
        window.routes = {
            merchantPaymentSystems: "{{ route('admin.merchants.payment-systems.json', ['id' => ':id']) }}",
            paymentSystemRates: "{{ route('admin.payment-systems.merchants.rates.json', ['id' => ':id', 'merchantId' => ':merchantId']) }}"
        };

        removeDisabled();
        initDateTimePicker();
    </script>
@endsection
