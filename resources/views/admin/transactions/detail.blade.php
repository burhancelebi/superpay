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
                                <div class="d-flex justify-content-between align-items-center pb-10">
                                    <!--begin::Logo-->
                                    @php $logo = getSettingByKey('logo-image')?->value; @endphp
                                    <a href="{{ route('admin.backoffice') }}">
                                        <img src="{{ asset($logo) }}" alt="Logo" style="width: 55px">
                                    </a>
                                    <!--end::Logo-->

                                    <div class="d-flex gap-2">
                                        <a href="#" class="btn btn-sm btn-success"
                                           data-id="{{ $transaction->id }}"
                                           data-bs-target="#kt_modal_transaction_file_preview_{{ $transaction->id }}"
                                           data-bs-toggle="modal">
                                            Dosya
                                        </a>
                                        <a class="btn btn-sm btn-primary partial-payment"
                                           data-bs-target="#kt_modal_new_partial_payment"
                                           data-bs-toggle="modal"
                                           data-id="{{ $transaction->id }}">
                                            Parçalı Ödeme Ekle
                                        </a>
                                        <a class="btn btn-sm btn-primary" href="{{ route('admin.transactions.edit', $transaction->id) }}">
                                            Güncelle
                                        </a>
                                    </div>
                                </div>
                                <!--end::Top-->
                                <!--begin::Wrapper-->
                                <div class="m-0">
                                    <!--begin::Label-->
                                    <div class="fw-bold fs-3 text-gray-800 mb-8">İşlem #{{$transaction->id}}</div>
                                    <!--end::Label-->

                                    <div class="row g-5 mb-11">
                                        @if(!is_null($transaction->parent_id))
                                            <div class="col-sm-12">
                                                <div class="fw-bold fs-6 text-gray-800">
                                                    <div class="alert text-center alert-warning fw-bold alert-dismissible fade show" role="alert">
                                                        Bu bir Parçalı Çekim işlemidir. Üst çekimine gitmek için
                                                        <a href="{{ route('admin.transactions.show', $transaction->parent_id) }}">Tıklayın</a>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif

                                        <!--end::Col-->
                                        <div class="col-sm-6">
                                            <!--end::Label-->
                                            <div class="fw-semibold fs-7 text-gray-600 mb-1">Talebin Karşılandığı Tarih:</div>
                                            <div class="fw-bold fs-6 text-gray-800 d-flex align-items-center flex-wrap">
                                                <span class="pe-2">{{ $transaction->sent_at }}</span>
                                            </div>
                                        </div>
                                    </div>

                                    <!--begin::Row-->
                                    <div class="row g-5 mb-11">
                                        <!--end::Col-->
                                        <div class="col-sm-6">
                                            <!--end::Label-->
                                            <div class="fw-semibold fs-7 text-gray-600 mb-1">Talep Edilen Tarih:</div>
                                            <!--end::Label-->

                                            <!--end::Col-->
                                            <div class="fw-bold fs-6 text-gray-800">
                                                {{ $transaction->requested_at }}
                                            </div>
                                            <!--end::Col-->
                                        </div>
                                        <!--end::Col-->

                                        <!--end::Col-->
                                        <div class="col-sm-6">
                                            <!--end::Label-->
                                            <div class="fw-semibold fs-7 text-gray-600 mb-1">Talebin Karşılandığı Tarih:</div>
                                            <div class="fw-bold fs-6 text-gray-800 d-flex align-items-center flex-wrap">
                                                <span class="pe-2">{{ $transaction->sent_at }}</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row g-5 mb-12">
                                        <div class="col-sm-6">
                                            <div class="fw-semibold fs-7 text-gray-600 mb-1">İşlem Grubu:</div>
                                            <div class="fw-bold fs-6 text-gray-800">{{ $transaction->group->name }}</div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="fw-semibold fs-7 text-gray-600 mb-1">İşlemi Gerçekleştiren Kullanıcı:</div>
                                            <div class="fw-bold fs-6 text-gray-800">{{ $transaction->user->fullName }}</div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="fw-semibold fs-7 text-gray-600 mb-1">Referans:</div>
                                            <div class="fw-bold fs-6 text-gray-800">{{ $transaction->reference_name }}</div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="fw-semibold fs-7 text-gray-600 mb-1">Tutar:</div>
                                            <div class="fw-bold fs-6 text-gray-800">{{ number_format($transaction->requested_amount, 2, ',', '.') }} ₺</div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="fw-semibold fs-7 text-gray-600 mb-1">Taksit:</div>
                                            <div class="fw-bold fs-6 text-gray-800">{{ $transaction->installment }}</div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="fw-semibold fs-7 text-gray-600 mb-1">Ödeme Sistemi Oranı :</div>
                                            <div class="fw-bold fs-6 text-gray-800">{{ $transaction->payment_system_rate }}</div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="fw-semibold fs-7 text-gray-600 mb-1">Ödeme Sistemi Oran Tutarı :</div>
                                            <div class="fw-bold fs-6 text-gray-800">{{ number_format($transaction->payment_system_fee_amount, 2, ',', '.') }} ₺</div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="fw-semibold fs-7 text-gray-600 mb-1">Bizim Oran :</div>
                                            <div class="fw-bold fs-6 text-gray-800">{{ $transaction->our_rate }}</div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="fw-semibold fs-7 text-gray-600 mb-1">Bizim Oran Tutar :</div>
                                            <div class="fw-bold fs-6 text-gray-800">{{ number_format($transaction->our_fee_amount, 2, ',', '.') }} ₺</div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="fw-semibold fs-7 text-gray-600 mb-1">Bakiye :</div>
                                            <div class="fw-bold fs-6 text-gray-800">{{ number_format($transaction->balance, 2, ',', '.') }} ₺</div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="fw-semibold fs-7 text-gray-600 mb-1">Kalan Tutar :</div>
                                            <div class="fw-bold fs-6 text-gray-800">{{ number_format($transaction->remaining_amount, 2, ',', '.') }} ₺</div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="fw-semibold fs-7 text-gray-600 mb-1">Gönderilen Tutar :</div>
                                            <div class="fw-bold fs-6 text-gray-800">{{ number_format($transaction->amount_sent, 2, ',', '.') }} ₺</div>
                                        </div>
                                    </div>
                                    <!--end::Row-->
                                    <x-transactions.file-preview :model="$transaction"/>

                                    <!--begin::Content-->
                                    <div class="flex-grow-1">
                                        @if($transaction->partialPayments->count())
                                            <!--begin::Table-->
                                            <div class="fw-bold fs-6 text-gray-800">Parçalı Ödemeler: </div>
                                            <div class="table-responsive border-bottom mb-9">
                                                <table class="table mb-3">
                                                    <thead>
                                                    <tr class="border-bottom fs-6 fw-bold text-muted">
                                                        <th class="min-w-175px pb-2">Açıklama</th>
                                                        <th class="min-w-70px text-end pb-2">İşlem Yapan</th>
                                                        <th class="min-w-100px text-end pb-2">Tutar</th>
                                                        <th class="min-w-80px text-end pb-2">Ödendiği Tarih</th>
                                                        <th class="text-end min-w-100px">İşlem</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($transaction->partialPayments as $payment)
                                                        <tr class="fw-bold text-gray-700 fs-5 text-end">
                                                            <td class="d-flex align-items-center pt-6">
                                                                <i class="fa fa-genderless text-danger fs-2 me-2"></i>
                                                                {{ $payment->description }}
                                                            </td>

                                                            <td class="pt-6">{{ $payment->user->fullName }}</td>
                                                            <td class="pt-6">{{ number_format($payment->amount, 2, ',', '.') }} ₺</td>
                                                            <td class="pt-6 text-gray-900 fw-bolder">
                                                                {{ $payment->paid_at }}
                                                            </td>
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
                                                                        <a class="menu-link px-3 text-start update-partial-payment-button"
                                                                           data-id="{{ $payment->id }}"
                                                                           data-bs-target="#kt_modal_update_partial_payment"
                                                                           data-bs-toggle="modal">
                                                                            Güncelle
                                                                        </a>
                                                                    </div>
                                                                    <div class="menu-item px-3">
                                                                        <a href="javascript:void(0)"
                                                                           class="menu-link px-3 text-center text-danger delete-partial-payment-button"
                                                                           data-id="{{ $payment->id }}">
                                                                            <i class="fa-solid fa-trash-can me-2"></i>
                                                                            Sil
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        @endif
                                        <hr>
                                        @if(is_null($transaction->parent_id) & $transaction->subTransactions->count())
                                            <!--begin::Table-->
                                            <div class="fw-bold fs-6 text-gray-800">Parçalı Çekimler: </div>
                                            <div class="table-responsive">
                                                <table class="table align-middle table-row-dashed fs-6 gy-5">
                                                    <thead>
                                                    <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                                                        <th class="min-w-100px">#</th>
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
                                                    @foreach($transaction->subTransactions as $child)
                                                        <tr>
                                                            <td class="text-start" >
                                                                <a href="{{ route('admin.transactions.show', $child->id) }}"
                                                                   class="text-gray-800 text-hover-primary text-primary fw-bold">
                                                                    {{ $child->id }}
                                                                </a>
                                                            </td>
                                                            <td class="text-start">{{ $child->requested_at }}</td>
                                                            <td class="text-start">{{ $child->sent_at }}</td>
                                                            <td class="text-start">{{ $child->reference_name }}</td>
                                                            <td class="text-start">{{ number_format($child->requested_amount, 2, ',', '.') }} ₺</td>
                                                            <td class="text-start">{{ $child->installment }}</td>
                                                            <td class="text-start">{{ $child->payment_system_rate }}</td>
                                                            <td class="text-start">{{ number_format($child->payment_system_fee_amount, 2, ',', '.') }} ₺</td>
                                                            <td class="text-start">{{ $child->our_rate }}</td>
                                                            <td class="text-start">{{ number_format($child->our_fee_amount, 2, ',', '.') }} ₺</td>
                                                            <td class="text-start">{{ number_format($child->balance, 2, ',', '.') }} ₺</td>
                                                            <td class="text-start">{{ number_format($child->amount_sent, 2, ',', '.') }} ₺</td>
                                                            <td class="text-start">{{ number_format($child->remaining_amount, 2, ',', '.') }} ₺</td>
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
                                                                        <a href="{{ route('admin.transactions.show', $child->id) }}"
                                                                           class="menu-link px-3">
                                                                            Detay
                                                                        </a>
                                                                    </div>
                                                                    <div class="menu-item px-3">
                                                                        <a class="menu-link px-3 update-button" data-id="{{ $transaction->id }}">Güncelle</a>
                                                                    </div>
                                                                    <div class="menu-item px-3">
                                                                        <a class="menu-link px-3 text-start" data-id="{{ $child->id }}"
                                                                           data-bs-target="#kt_modal_transaction_file_preview_{{ $child->id }}"
                                                                           data-bs-toggle="modal">
                                                                            Dosya Görüntüle
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                                <!--end::Menu-->
                                                            </td>
                                                        </tr>

                                                        <x-transactions.file-preview :model="$transaction"/>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        @endif
                                        <div class="d-flex justify-content-end">
                                            <!--begin::Section-->
                                            <div class="mw-300px">
                                                <div class="d-flex flex-stack mb-3">
                                                    <div class="fw-semibold pe-10 text-gray-600 fs-7">Toplam Çekim:</div>
                                                    <div class="text-end fw-bold fs-6 text-gray-800">
                                                        {{ number_format($transaction->total_requested_amount, 2, ',', '.') }} ₺
                                                    </div>
                                                </div>

                                                <!--begin::Item-->
                                                <div class="d-flex flex-stack mb-3">
                                                    <div class="fw-semibold pe-10 text-gray-600 fs-7">
                                                        Toplam Ödeme
                                                    </div>
                                                    <div class="text-end fw-bold fs-6 text-gray-800">
                                                        {{ number_format($transaction->total_amount_sent, 2, ',', '.') }} ₺
                                                    </div>
                                                </div>
                                                <!--end::Item-->
                                            </div>
                                            <!--end::Section-->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-transactions.add-partial-payment/>
    <x-transactions.update-partial-payment/>
@endsection
@section('js')
    <script src="{{ asset('assets/js/transaction.js') }}"></script>

    <script>
        initDateTimePicker();
        $(document).on('click', '.update-partial-payment-button', function () {
            let id = $(this).data('id');
            let url = "{{ route('admin.partial-payments.show', ':id') }}".replace(':id', id);
            $.get(url, function (response) {
                console.log(response)
                fillUpdateModal(response);
            });
        });

        function fillUpdateModal(payment) {
            let form = $('#update-partial-payment');
            form.attr('action', "{{ route('admin.partial-payments.update', ':id') }}".replace(':id', payment.data.id));

            form.find('input[name="amount"]').val(payment.data.amount ?? '');
            form.find('input[name="description"]').val(payment.data.description ?? '');
            form.find('input[name="paid_at"]').val(payment.data.paid_at ?? '');
        }

        $(document).on('click', '.delete-partial-payment-button', function (e) {
            e.preventDefault();

            let id = $(this).data('id');
            let url = "{{ route('admin.partial-payments.destroy', ':id') }}".replace(':id', id);

            if (!confirm("Bu parçalı ödemeyi silmek istediğine emin misin?")) {
                return;
            }

            $.ajax({
                url: url,
                type: 'POST',
                data: {
                    _method: 'DELETE',
                    _token: '{{ csrf_token() }}'
                },
                success: function (response) {
                    toast().success("Parçalı ödeme başarıyla silindi.");
                    setTimeout(() => location.reload(), 3000);
                },
                error: function (xhr) {
                    toast().error("Silme sırasında bir hata oluştu.");
                }
            });
        });
    </script>
@endsection
