@extends('layouts.master')

@section('title', 'Karyawan')

@section('active', 'Karyawan')

@push('css')
    <link href="{{ asset('admin/default/crud/datatables/basic/assets/vendors/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
@endpush

@push('js')
    <script>
        $(document).ready(function() {
           $('#example').dataTable( {
                "paging": true,
                "pageLength": 10
            });
        });
    </script>
	<script src="{{ asset('admin/default/crud/datatables/data-sources/assets/vendors/custom/datatables/datatables.bundle.js') }}" type="text/javascript"></script>
@endpush

@section('breadcrumb')
    <span class="kt-subheader__breadcrumbs-separator"></span>
        <a href="#" class="kt-subheader__breadcrumbs-link">
            Karyawan                   
        </a>
    <span class="kt-subheader__breadcrumbs-separator"></span>
    <span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">
        index
    </span>
@endsection

@section('content')
    <div class="content kt-portlet kt-portlet--mobile">
	<div class="kt-portlet__head kt-portlet__head--lg">
		<div class="kt-portlet__head-label">
			<span class="kt-portlet__head-icon">
				<i class="kt-font-brand flaticon2-line-chart"></i>
			</span>
			<h3 class="kt-portlet__head-title">
				Data Karyawan
			</h3>
		</div>
		{{-- <div class="kt-portlet__head-toolbar">
			<div class="kt-portlet__head-wrapper">
				<div class="kt-portlet__head-actions">
					<a href="{{ route('master.users.create') }}" class="btn btn-brand btn-elevate btn-icon-sm">
                        Tambah Karyawan
                    </a>
				</div>	
			</div>
		</div> --}}
	</div>

	<div class="table-responsive">
	<div class="kt-portlet__body">
		<table class="table table-striped- table-bordered table-hover table-checkable" id="example">
            <thead>
                <tr class="text-center">
                    <th>No</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Tanggal Lahir</th>
                    <th>No Telepon</th>
                    <th>Alamat</th>
                    <th>Roles</th>
				</tr>
			</thead>
            <tbody>
                @foreach ($employees as $no => $employee)
                    <tr>
                        <td class="text-right">{{ $no + 1 }}</td>
                        <td class="text-center">{{ $employee->name }}</td>
                        <td class="text-center">{{ $employee->email }}</td>
                        <td class="text-center">{{ $employee->birthday }}</td>
                        <td class="text-center">{{ $employee->phone }}</td>
                        <td class="text-center">{{ $employee->address }}</td>
                        <td class="text-center">
                            @foreach($employee->getRoleNames() ?:[] as $item)
                                <span class="kt-badge kt-badge--inline kt-badge--warning">
                                    {{ $item }}
                                </span>
                            @endforeach
                        </td>
                    </tr>
                @endforeach
            </tbody>
		</table>
	</div>		
</div>
@endsection