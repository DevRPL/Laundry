@extends('layouts.master')

@section('title', 'Transaksi')

@section('active', 'Transaksi')

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
            Transaksi                    
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
				Data Transaksi
			</h3>
		</div>
		<div class="kt-portlet__head-toolbar">
			<div class="kt-portlet__head-wrapper">
				<div class="kt-portlet__head-actions">
					<a href="{{ route('master.transaksis.create') }}" class="btn btn-brand btn-elevate btn-icon-sm">
                        Tambah Transaksi
                    </a>
				</div>	
			</div>
		</div>
	</div>

	<div class="table-responsive">
	<div class="kt-portlet__body">
		<table class="table table-striped- table-bordered table-hover table-checkable" id="example">
            <thead>
                <tr class="text-center">
					<th>No</th>
					<th>Tgl Transaksi</th>
					<th>Customer</th>
                    <th>Paket</th>
					<th>Pembayaran</th>
					<th>Status Order</th>
					<th>Total</th>
					<th>Aksi</th>
				</tr>
			</thead>
            <tbody>
                @foreach ($transactions as $no => $transaction)
                    <tr>
                        <td class="text-right">{{ $no + 1 }}</td>
                        <td>{{ Carbon\Carbon::parse($transaction->date_take)->format('d, M Y') }}</td>
                        <td class="text-center">{{ $transaction->customer->name ?? '' }}</td>
                        <td>{{ $transaction->package->name ?? '' }}</td>
                        <td class="text-center">
                            @if ($transaction->status == 'Lunas')
                                <span class="kt-badge kt-badge--inline kt-badge--primary">Lunas</span>
                            @else 
                                <span class="kt-badge kt-badge--inline kt-badge--info">Belum Lunas</span>
                            @endif
                        </td>
                        <td class="text-center">
                            @if ($transaction->status_order == 'Baru')
                                <span class="kt-badge kt-badge--inline kt-badge--warning">Baru</span>
                            @elseif ($transaction->status_order == 'Proses')
                                <span class="kt-badge kt-badge--inline kt-badge--primary">Proses</span>
                            @elseif ($transaction->status_order == 'Selesai')
                                <span class="kt-badge kt-badge--inline kt-badge--success">Selesai</span>
                            @elseif ($transaction->status_order == 'Ambil')
                                <span class="kt-badge kt-badge--inline kt-badge--success">Ambil</span>
                            @elseif ($transaction->status_order == 'Batal')
                                <span class="kt-badge kt-badge--inline kt-badge--danger">Batal</span>
                            @endif
                        </td>
                        <td class="text-right">Rp. {{ number_format($transaction->total) }}</td>
                        <td class="text-center">
                            @component('component.shared.btn-detail', [
                                'route' => 'master.transaksis.show',
                                'params' => $transaction->id,
                                'title' => 'Detail Transaksi',
                                'detail' => 'Detail Transaksi',
                                'type' => 'primary'
                            ]) @endcomponent
                        </td>
                    </tr>
                @endforeach
            </tbody>
		</table>
	</div>		
</div>
@endsection




