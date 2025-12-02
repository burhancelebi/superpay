@extends('components.user-profile-page')
@section('profile-content')
    <div class="col-xl-9 col-lg-8 col-md-12 m-b30">
        <div class="twm-right-section-panel candidate-save-job site-bg-gray">
            <!--Filter Short By-->
            <div class="product-filter-wrap d-flex justify-content-between align-items-center">
                <span class="woocommerce-result-count-left">Ödeme Yöntemlerim</span>
            </div>

            <div class="table-responsive">
                <table class="table twm-table table-striped table-borderless">
                    <thead>
                    <tr>
                        <th>Banka Adı</th>
                        <th>IBAN</th>
                        <th>Ekleme Tarihi</th>
                        <th>İşlem</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($methods as $method)
                        <tr>
                            <td class="order-id text-primary">{{ $method->bank_name }}</td>
                            <td class="job-name">{{ $method->iban }}</td>
                            <td class="amount text-primary">{{ $method->created_at }}</td>
                            <td class="expired" style="cursor: pointer">
                                <i class="fa fa-trash text-danger"></i>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="align-items-center justify-content-center d-flex">
                {{ $methods->links('vendor.pagination') }}
            </div>
        </div>
    </div>
@endsection
