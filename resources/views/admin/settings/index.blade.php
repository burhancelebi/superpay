@extends('admin.layouts.master')
@section('toolbar-title', 'Settings')
@section('content')
    <!--begin::Products-->
    <div class="card card-flush">

        <!--begin::Card body-->
        <div class="card-body pt-0 table-responsive">
            <!--begin::Table-->
            <table class="table align-middle table-row-dashed fs-6 gy-5">
                <thead>
                <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                    <th class="min-w-175px">Key</th>
                    <th class="text-end min-w-100px">Action</th>
                </tr>
                </thead>
                <tbody class="fw-semibold text-gray-600">
                <tr>
                    <td>Site Title</td>
                    <td class="text-start" data-dt-column="0">
                        <a href="{{ route('admin.settings.site_title') }}" class="text-gray-800 text-hover-primary fw-bold">
                            Update
                        </a>
                    </td>
                </tr>
                <tr>
                    <td>Logo</td>
                    <td class="text-start" data-dt-column="1">
                        <a href="{{ route('admin.settings.logo') }}" class="text-gray-800 text-hover-primary fw-bold">
                            Update
                        </a>
                    </td>
                </tr>
                </tbody>
            </table>
            <!--end::Table-->
        </div>
        <!--end::Card body-->
    </div>
    <!--end::Products-->

@endsection
