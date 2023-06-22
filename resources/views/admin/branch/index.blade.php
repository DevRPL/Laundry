@extends('layouts.master')

@section('title', 'Cabang')

@section('active', 'Cabang')

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
        <a href="{{ route('master.cabangs.index') }}" class="kt-subheader__breadcrumbs-link">
            Cabang                  
        </a>
    <span class="kt-subheader__breadcrumbs-separator"></span>
    <span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">
       Tampil
    </span>
@endsection

@section('content')
    @if ($message = Session::get('error'))
      <div class="alert alert-danger alert-block">
        <button type="button" class="close" data-dismiss="alert"></button> 
        <strong>{{ $message }}</strong>
      </div>
    @endif

<div class="content kt-portlet kt-portlet--mobile">
	<div class="kt-portlet__head kt-portlet__head--lg">
		<div class="kt-portlet__head-label">
			<span class="kt-portlet__head-icon">
				<i class="kt-font-brand flaticon2-line-chart"></i>
			</span>
			<h3 class="kt-portlet__head-title">
				Data Cabang
			</h3>
		</div>
		<div class="kt-portlet__head-toolbar">
			<div class="kt-portlet__head-wrapper">
				<div class="kt-portlet__head-actions">
                    @component('component.shared.btn-create-modal', [
                        'id' => '#crete_branch',
                        'title' => 'Tambah Cabang Lundry',
                    ]) @endcomponent
				</div>	
			</div>
		</div>
        
        <div class="modal fade" id="crete_branch" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" data-keyboard="false" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Kelola Cabang Lundry</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="m-form" method="POST" action="{{ route('master.cabangs.store') }}">
                            <div class="form-group">
                                <label for="name" class="form-control-label">Nama*:</label>
                                <input type="text" name="name" class="form-control" id="name">
                            </div>
                            <div class="form-group">
                                <label for="branch_name" class="form-control-label">Nama Cabang*:</label>
                                <input type="text" name="branch_name" class="form-control" id="branch_name">
                            </div>
                            <div class="form-group">
                                <label for="address" class="form-control-label">Alamat*:</label>
                                <textarea class="form-control" name="address" id="address"></textarea>
                            </div>
                             <div class="form-group">
                                <label for="phone" class="form-control-label">No Telp*:</label>
                                <input type="text" name="phone" class="form-control" id="phone">
                            </div>
                             <div class="form-group">
                                <label for="email" class="form-control-label">Email:</label>
                                <input type="text" name="email" class="form-control" id="email">
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

	<div class="kt-portlet__body">
		<table class="table table-striped- table-bordered table-hover table-checkable" id="example">
            <thead>
				<tr>
					<th class="text-center">No</th>
					<th class="text-center">Nama</th>
					<th class="text-center">Alamat</th>
					<th class="text-center">Telp</th>
					<th class="text-center">Status</th>
					<th class="text-center" style="width:120px">Aksi</th>
				</tr>
			</thead>
            <tbody>
                @foreach ($branches as $no => $branch)
                    <tr>
                        <td class="text-center">{{ $no + 1 }}</td>
                        <td class="text-center">{{ $branch->name }}</td>
                        <td class="text-center">{{ $branch->address }}</td>
                        <td class="text-center">{{ $branch->phone }}</td>
                        <td class="text-center">
                            @if ($branch->status == 1)
                                <span class="kt-badge kt-badge--inline kt-badge--success">Aktif</span>
                            @else 
                                <span class="kt-badge kt-badge--inline kt-badge--danger">Non Aktif</span>
                            @endif
                        </td>
                        <td class="d-flex justify-content-center text-center">
                            @component('component.shared.btn-edit', [
                                'route' => 'master.cabangs.edit',
                                'params' => $branch->id,
                                'title' => 'Edit',
                                'detail' => 'Edit'
                            ]) @endcomponent
                            @component('component.shared.btn-delete', [
                                'route' => 'master.cabangs.destroy',
                                'params' => $branch->id,
                                'title' => 'Hapus',
                                'detail' => 'Hapus'
                            ]) @endcomponent
                        </td>
                    </tr>
                @endforeach
            </tbody>
		</table>
	</div>		
@endsection
