@extends('admin.layouts.master')
@section('content')
    <div class="card">
        <!--begin::Card header-->
        <div class="card-header border-0 pt-6">
            <!--begin::Card title-->
            <div class="card-title">
                <div class="d-flex align-items-center position-relative my-1">
                    <span class="fw-bold fs-3">Görev Yönetimi</span>
                </div>
            </div>
            <!--begin::Card title-->
            <!--begin::Card toolbar-->
            <div class="card-toolbar">
                <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                    <a href="{{ route('admin.tasks.create') }}" class="btn btn-primary">
                        <i class="fa-solid fa-plus fs-2"></i> Yeni Görev Ekle
                    </a>
                </div>
            </div>
            <!--end::Card toolbar-->
        </div>
        <!--end::Card header-->

        <!--begin::Card body-->
        <div class="card-body py-4">
            <div class="table-responsive">
                <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_tasks">
                    <thead>
                        <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                            <th class="min-w-125px">Başlık</th>
                            <th class="min-w-125px">Tür</th>
                            <th class="min-w-125px">P. Birimi</th>
                            <th class="min-w-125px">Tutar</th>
                            <th class="min-w-125px">Ödül</th>
                            <th class="min-w-125px">Puan</th>
                            <th class="min-w-125px">Durum</th>
                            <th class="min-w-125px">Aktif / Pasif</th>
                            <th class="min-w-125px">Oluşturulma Tarihi</th>
                            <th class="text-end min-w-100px">İşlemler</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600 fw-semibold">
                        @foreach($tasks as $task)
                            <tr>
                                <td>{{ $task->title }}</td>
                                <td>
                                    <div class="badge badge-light-info fw-bold">{{ $task->type->label() }}</div>
                                </td>
                                <td class="fw-bolder text-black">{{ $task->currency }}</td>
                                <td>{{ $task->amount }}</td>
                                <td>{{ $task->reward }}</td>
                                <td>{{ $task->score }}</td>
                                <td>
                                    <span class="badge badge-light-{{ $task->status->value ? 'success' : 'danger' }}">{{ $task->status->label() }}</span>
                                </td>
                                <td>
                                    <div class="badge badge-light-{{ $task->active->value ? 'success' : 'danger' }} fw-bold">
                                        {{ $task->active->label() }}
                                    </div>
                                </td>
                                <td>{{ $task->created_at->format('d.m.Y H:i') }}</td>
                                <td class="text-end">
                                    <a href="#" class="btn btn-light btn-active-light-primary btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                        İşlemler
                                        <i class="fa-solid fa-chevron-down ms-2 fs-5"></i>
                                    </a>
                                    <!--begin::Menu-->
                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="{{ route('admin.tasks.edit', $task->id) }}" class="menu-link px-3">Düzenle</a>
                                        </div>
                                        <!--end::Menu item-->

                                        <div class="menu-item px-3">
                                            <a href="{{ route('admin.tasks.active', [
                                            'id' => $task->id, 'active' => $task->active->toggle()->value
                                            ]) }}" class="menu-link px-3">{{ $task->active->toggle()->label() }}
                                            </a>
                                        </div>

                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <form action="{{ route('admin.tasks.destroy', $task->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="menu-link px-3 w-100 bg-transparent border-0 text-start" onclick="return confirm('Silmek istediğinize emin misiniz?')">Sil</button>
                                            </form>
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
                {{ $tasks->links() }}
            </div>
            <!--end::Pagination-->
        </div>
        <!--end::Card body-->
    </div>
@endsection
