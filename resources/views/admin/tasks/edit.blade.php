@extends('admin.layouts.master')
@section('toolbar-title', 'Görevi Düzenle')
@section('content')
    <div class="card">
        <!--begin::Card header-->
        <div class="card-header">
            <div class="card-title">
                <h3 class="fw-bold m-0">Görevi Düzenle: {{ $task->title }}</h3>
            </div>
        </div>
        <!--end::Card header-->

        <!--begin::Form-->
        <form action="{{ route('admin.tasks.update', $task->id) }}" method="POST" class="form">
            @csrf
            @method('PUT')
            <div class="card-body border-top p-9">
                @include('admin.layouts.partials.errors')
                @include('admin.layouts.partials.alert')

                <!--begin::Input group-->
                <div class="row mb-6">
                    <label class="col-lg-4 col-form-label required fw-semibold fs-6">Başlık</label>
                    <div class="col-lg-8 fv-row">
                        <input type="text" name="title" class="form-control form-control-lg form-control-solid" placeholder="Görev başlığını giriniz" value="{{ old('title', $task->title) }}" required />
                    </div>
                </div>
                <!--end::Input group-->

                <!--begin::Input group-->
                <div class="row mb-6">
                    <label class="col-lg-4 col-form-label required fw-semibold fs-6">Süre (Dakika)</label>
                    <div class="col-lg-8 fv-row">
                        <input type="text" name="duration" class="form-control form-control-lg form-control-solid" placeholder="Örn: 3" value="{{ old('duration', $task->duration) }}" required />
                    </div>
                </div>
                <!--end::Input group-->

                <!--begin::Input group-->
                <div class="row mb-6">
                    <label class="col-lg-4 col-form-label required fw-semibold fs-6">Tutar</label>
                    <div class="col-lg-8 fv-row">
                        <input type="text" name="amount" class="form-control form-control-lg form-control-solid" placeholder="Örn: 200" value="{{ old('amount', $task->amount) }}" required />
                    </div>
                </div>
                <!--end::Input group-->

                <!--begin::Input group-->
                <div class="row mb-6">
                    <label class="col-lg-4 col-form-label fw-semibold fs-6">Ödül (Kazanılacak Tutar)</label>
                    <div class="col-lg-8 fv-row">
                        <input type="text" name="reward" class="form-control form-control-lg form-control-solid" placeholder="Örn: 210" value="{{ old('reward', $task->reward) }}" />
                    </div>
                </div>
                <!--end::Input group-->

                <!--begin::Input group-->
                <div class="row mb-6">
                    <label class="col-lg-4 col-form-label required fw-semibold fs-6">Görev Türü</label>
                    <div class="col-lg-8 fv-row">
                        <select name="type" class="form-select form-select-solid form-select-lg fw-semibold"
                                data-control="select2" data-placeholder="Bir tür seçin">
                            <option value="">Tür Seçiniz...</option>
                            @foreach($types as $type)
                                <option value="{{ $type->value }}" {{ old('type', $task->type->value) == $type->value ? 'selected' : '' }}>{{ $type->label() }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <!--end::Input group-->

                <!--begin::Input group-->
                <div class="row mb-6">
                    <label class="col-lg-4 col-form-label required fw-semibold fs-6">Puan Değeri</label>
                    <div class="col-lg-8 fv-row">
                        <input type="number" name="score" class="form-control form-control-lg form-control-solid" placeholder="Puan değerini giriniz" value="{{ old('score', $task->score) }}" required />
                    </div>
                </div>
                <!--end::Input group-->

                <!--begin::Input group-->
                <div class="row mb-6">
                    <label class="col-lg-4 col-form-label required fw-semibold fs-6">Durum</label>
                    <div class="col-lg-8 fv-row">
                        <select name="status" class="form-select form-select-solid form-select-lg fw-semibold"
                                data-control="select2" data-placeholder="Bir durum seçin">
                            @foreach($statuses as $status)
                                <option value="{{ $status->value }}" {{ old('status', $task->status->value) == $status->value ? 'selected' : '' }}>{{ $status->label() }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <!--end::Input group-->

                <!--begin::Input group-->
                <div class="row mb-6">
                    <label class="col-lg-4 col-form-label fw-semibold fs-6">Kripto Cüzdan Adresi</label>
                    <div class="col-lg-8 fv-row">
                        <select name="wallet_id"
                                class="form-select form-select-solid form-select-lg fw-semibold"
                                data-control="select2"
                                data-placeholder="Wallet seçiniz"
                                data-allow-clear="true">
                            <option value="">Wallet seçiniz</option>
                            @foreach($wallets as $wallet)
                                <option
                                    value="{{ $wallet->id }}" {{ old('wallet_id', $task->wallet_id) == $wallet->id ? 'selected' : '' }}>
                                    {{ $wallet->network . ' - ' . $wallet->address }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <!--end::Input group-->

                <!--begin::Input group-->
                <div class="row mb-6">
                    <label class="col-lg-4 col-form-label fw-semibold fs-6 required">Açıklama</label>
                    <div class="col-lg-8 fv-row">
                        <textarea name="description" class="form-control form-control-solid" rows="4" placeholder="Görev açıklaması..." required>{{ old('description', $task->description) }}</textarea>
                    </div>
                </div>
                <!--end::Input group-->

                <!--begin::Input group-->
                <div class="row mb-6">
                    <label class="col-lg-4 col-form-label fw-semibold fs-6">Aktiflik Durumu</label>
                    <div class="col-lg-8 fv-row">
                        <div class="form-check form-switch form-check-custom form-check-solid me-10">
                            <input type="hidden" name="active" value="0"/>
                            <input class="form-check-input h-30px w-50px" type="checkbox" value="1" name="active" id="active" {{ old('active', $task->active->value ?? $task->is_active) ? 'checked' : '' }}/>
                            <label class="form-check-label" for="active">
                                Aktif Görev
                            </label>
                        </div>
                    </div>
                </div>
                <!--end::Input group-->
            </div>
            <!--end::Card body-->

            <!--begin::Actions-->
            <div class="card-footer d-flex justify-content-end py-6 px-9">
                <a href="{{ route('admin.tasks.index') }}" class="btn btn-light btn-active-light-primary me-2">İptal</a>
                <button type="submit" class="btn btn-primary">Güncelle</button>
            </div>
            <!--end::Actions-->
        </form>
        <!--end::Form-->
    </div>
@endsection
