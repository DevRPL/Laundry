@extends('layouts.master')

@section('title', 'Paket Laundry')

@section('active', 'Paket Laundry')

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
        <a href="{{ route('master.pakets.index') }}" class="kt-subheader__breadcrumbs-link">
            paket                  
        </a>
    <span class="kt-subheader__breadcrumbs-separator"></span>
    <span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">
       Tampil
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
				Data Paket Laundry
			</h3>
		</div>
		<div class="kt-portlet__head-toolbar">
			<div class="kt-portlet__head-wrapper">
				<div class="kt-portlet__head-actions">
					@component('component.shared.btn-create-modal', [
                        'id' => '#crete_package',
                        'title' => 'Tambah Package Laundry',
                    ]) @endcomponent
				</div>	
			</div>
		</div>
		<div class="modal fade" id="crete_package" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" data-keyboard="false" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Kelola Package Laundry</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="m-form" method="POST" action="{{ route('master.pakets.store') }}">
                            <div class="form-group">
                                <label for="name" class="form-control-label">Paket*:</label>
                                <input type="text" name="name" class="form-control" id="name">
                            </div>
                             <div class="form-group">
                                <label for="price" class="form-control-label">Harga*:</label>
                                <input type="text" name="price" class="form-control" id="price">
                            </div>
                        </div>
                        <div class="modal-footer">
                            {{ csrf_field() }}
                            @component('component.shared.btn-save', [
                                'close' => 'Batal', 'save' => 'Simpan'
                            ]) @endcomponent
                        </div>
                    </form>
                </div>
            </div>
        </div>
	</div>

	<div class="table-responsive">
	<div class="kt-portlet__body">
		<table class="table table-striped- table-bordered table-hover table-checkable" id="example">
            <thead>
				<tr>
					<th class="text-center" style="width:10px">No</th>
					<th class="text-center">Jenis</th>
					<th class="text-center">Harga Paket</th>
					<th class="text-center" style="width:120px">Aksi</th>
				</tr>
			</thead>
            <tbody>
                @foreach ($packages as $no => $package)
                    <tr>
                        <td class="text-right">{{ $no + 1 }}</td>
                        <td class="text-center">{{ $package->name }}</td>
                        <td class="text-right">Rp. {{ number_format($package->price) }}</td>
                        <td class="d-flex justify-content-center text-center">
                            @component('component.shared.btn-edit', [
                                'route' => 'master.pakets.edit',
                                'params' => $package->id,
                                'title' => 'Edit',
                                'detail' => 'Edit'
                            ]) @endcomponent
                            @component('component.shared.btn-delete', [
                                'route' => 'master.pakets.destroy',
                                'params' => $package->id,
                                'title' => 'Hapus',
                                'detail' => 'Hapus'
                            ]) @endcomponent
                        </td>
                    </tr>
                @endforeach
            </tbody>
		</table>
	</div>		
</div>

@endsection
