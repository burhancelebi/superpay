@extends('admin.layouts.master')
@section('toolbar-title', 'Yeni Cüzdan Oluştur')
@section('content')
    <div class="card">
        <!--begin::Card header-->
        <div class="card-header">
            <div class="card-title">
                <h3 class="fw-bold m-0">Yeni Cüzdan Oluştur</h3>
            </div>
        </div>
        <!--end::Card header-->

        <!--begin::Form-->
        <form action="{{ route('admin.wallets.store') }}" method="POST" class="form">
            @csrf
            <div class="card-body border-top p-9">
                @include('admin.layouts.partials.errors')
                @include('admin.layouts.partials.alert')
                <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                <!--begin::Input group-->
                <div class="row mb-6">
                    <label class="col-lg-4 col-form-label required fw-semibold fs-6">Kripto Ağı (Network)</label>
                    <div class="col-lg-8 fv-row">
                        <select name="network" class="form-select form-select-solid form-select-lg fw-semibold"
                                data-control="select2" data-placeholder="Bir ağ seçin">
                            <option value="">Ağ Seçiniz...</option>
                            @foreach(\App\enums\Wallets\NetworkTypeEnum::cases() as $network)
                                <option
                                    value="{{ $network->value }}" {{ old('network') == $network->value ? 'selected' : '' }}>{{ $network->label() }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <!--end::Input group-->

                <!--begin::Input group-->
                <div class="row mb-6">
                    <label class="col-lg-4 col-form-label required fw-semibold fs-6">Para Birimi (Currency)</label>
                    <div class="col-lg-8 fv-row">
                        <select name="currency" class="form-select form-select-solid form-select-lg fw-semibold"
                                data-control="select2" data-placeholder="Bir para birimi seçin">
                            <option value="">Para Birimi Seçiniz...</option>
                            @foreach(\App\enums\Wallets\CurrencyTypeEnum::cases() as $currency)
                                <option
                                    value="{{ $currency->value }}" {{ old('currency') == $currency->value ? 'selected' : '' }}>{{ $currency->label() }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <!--end::Input group-->

                <!--begin::Input group-->
                <div class="row mb-6">
                    <label class="col-lg-4 col-form-label required fw-semibold fs-6">Cüzdan Adresi</label>
                    <div class="col-lg-8 fv-row">
                        <input type="text" name="address" class="form-control form-control-lg form-control-solid" placeholder="Cüzdan adresini giriniz" value="{{ old('address') }}" />
                    </div>
                </div>
                <!--end::Input group-->

                <!--begin::Input group-->
                <div class="row mb-6">
                    <label class="col-lg-4 col-form-label fw-semibold fs-6">Durum</label>
                    <div class="col-lg-8 fv-row">
                        <div class="form-check form-switch form-check-custom form-check-solid me-10">
                            <input type="hidden" name="active" value="0"/>
                            <input class="form-check-input h-30px w-50px" type="checkbox" value="1" name="active" id="active" checked="checked"/>
                            <label class="form-check-label" for="active">
                                Aktif
                            </label>
                        </div>
                    </div>
                </div>
                <!--end::Input group-->

            </div>
            <!--end::Card body-->

            <!--begin::Actions-->
            <div class="card-footer d-flex justify-content-end py-6 px-9">
                <a href="{{ route('admin.wallets.index') }}" class="btn btn-light btn-active-light-primary me-2">İptal</a>
                <button type="submit" class="btn btn-primary">Kaydet</button>
            </div>
            <!--end::Actions-->
        </form>
        <!--end::Form-->
    </div>
@endsection
