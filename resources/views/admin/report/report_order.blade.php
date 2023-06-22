@extends('layouts.master')

@section('title', 'Laporan Order Masuk')

@section('active', 'Laporan Order Masuk')

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
    <script src="{{ asset('admin/default/crud/forms/widgets/assets/app/custom/general/crud/forms/widgets/bootstrap-datepicker.js') }}" type="text/javascript"></script>
@endpush

@section('breadcrumb')
    <span class="kt-subheader__breadcrumbs-separator"></span>
        <a href="{{ route('master.reports.getReportDataOrder') }}" class="kt-subheader__breadcrumbs-link">
            Laporan                  
        </a>
    <span class="kt-subheader__breadcrumbs-separator"></span>
    <span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">
       Order Masuk
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
                Cari Laporan Order Masuk
			</h3>
		</div>
		<div class="kt-portlet__head-toolbar">
			<div class="kt-portlet__head-wrapper">
				<div class="kt-portlet__head-actions"></div>	
			</div>
		</div>
	</div>

    <div class="row">
        <div class="col-lg-12">	
            <div class="kt-portlet__body">
                <form class="kt-form" method="GET" action="{{ route('master.reports.getReportDataOrder') }}">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="kt-section kt-section--first">
                            <div class="kt-section__body">
                                <div class="form-group row">
                                    <label class="col-3 col-form-label">Dari Tanggal*:</label>
                                    <div class="col-9">
                                        <input type="text" class="form-control" name="start_date" value="{{ old('start_date') }}" id="kt_datepicker_2" readonly=""  data-date-format="yyyy-mm-dd" placeholder="Dari Tanggal">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-3 col-form-label">Sampai Tanggal*:</label>
                                    <div class="col-9">
                                        <input type="text" class="form-control" name="end_date" value="{{ old('end_date') }}" id="kt_datepicker_3" readonly=""  data-date-format="yyyy-mm-dd" placeholder="Sampai Tanggal">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="kt-form__actions">
                    <div class="row">
                        <div class="col-lg-3"></div>
                            <div class="col-lg-6">
                                {{ csrf_field() }}
                                @component('component.shared.btn-submit',
                                    ['title' => 'Cari']
                                ) @endcomponent
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


    <div class="content kt-portlet kt-portlet--mobile">
	<div class="kt-portlet__head kt-portlet__head--lg">
		<div class="kt-portlet__head-label">
			<span class="kt-portlet__head-icon">
				<i class="kt-font-brand flaticon2-line-chart"></i>
			</span>
			<h3 class="kt-portlet__head-title">
				Data Order Masuk
			</h3>
		</div>
		<div class="kt-portlet__head-toolbar">
			<div class="kt-portlet__head-wrapper">
				<div class="kt-portlet__head-actions">
					<a href="{{ route('master.exportEntryOrder.excel', ['start_date' => request('start_date'), 'end_date' => request('end_date'),]) }}" class="btn btn-brand btn-elevate btn-icon-sm">
                        Export Ms Excel
                    </a>
                    <br>
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
                    <th>Berat</th>
					<th>Harga</th>
					<th>Status Order</th>
					<th>Total</th>
				</tr>
			</thead>
            <tbody>
            @foreach ($entry_orders ?:[] as $no => $entry_order)
                    <tr>
                        <td class="text-right">{{ $no + 1 }}</td>
                        <td>{{ $entry_order->created_at }}</td>
                        <td class="text-center">{{ $entry_order->customer->name }}</td>
                        <td>{{ $entry_order->package->name }}</td>
                        <td class="text-right">{{ $entry_order->weight }} Kg</td>
                        <td class="text-right">Rp. {{ number_format($entry_order->price) }}</td>
                        <td class="text-center">
                            @if ($entry_order->status_order == 'Selesai')
                                <span class="kt-badge kt-badge--inline kt-badge--success">Selesai</span>
                            @elseif ($entry_order->status_order == 'Ambil')
                                <span class="kt-badge kt-badge--inline kt-badge--success">Ambil</span>
                            @endif
                        </td>
                        <td class="text-right">Rp. {{ number_format($entry_order->total) }}</td>
                    </tr>
                @endforeach
            </tbody>
		</table>
	</div>		
</div>
@endsection

