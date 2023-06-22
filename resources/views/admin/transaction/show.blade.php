@extends('layouts.master')

@section('title', 'transaksi Laundry')

@section('active', 'transaksi Laundry')

@push('css')

@endpush

@push('js')
    <script src="{{ asset('admin/default/crud/forms/widgets/assets/app/custom/general/crud/forms/widgets/bootstrap-datepicker.js') }}" type="text/javascript"></script>
@endpush

@section('breadcrumb')
    <span class="kt-subheader__breadcrumbs-separator"></span>
    <a href="#" class="kt-subheader__breadcrumbs-link">
        Detail Transaksi                    
    </a>
    <span class="kt-subheader__breadcrumbs-separator"></span>
    <span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">
        Detail
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
				Detail Transaksi
			</h3>
		</div>
		<div class="kt-portlet__head-toolbar">
			<div class="kt-portlet__head-wrapper">
				<div class="kt-portlet__head-actions"></div>	
			</div>
		</div>
    </div>

    <form method="POST" action="{{ route('master.update.status.transaction', $transaction->id ) }}">
        {{ csrf_field() }}
        {{ method_field('PUT') }}
        <div class="row">
            <div class="col-lg-12">	
                <div class="kt-portlet__body">
                    <table class="table table-bordered">
                        <tr>
                            <td style="width: 30%">No. Order</td>
                            <td>
                                <input class="form-control" value="{{ $transaction->order_number }}" readonly>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 30%">Nama Lengkap</td>
                            <td>
                                <input class="form-control" value="{{ $transaction->customer->name ?? '' }}" readonly>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 30%">Alamat Lengkap</td>
                            <td>
                                <input class="form-control" value="{{ $transaction->customer->address ?? '' }}" readonly>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 30%">Telepon</td>
                            <td>
                                <input class="form-control" value="{{ $transaction->customer->phone ?? '' }}" readonly>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 30%">Status Pembayaran</td>
                            <td>
                                @if ($transaction->status == 'Lunas')
                                    <input type="text" name="status" class="form-control text-white bg-primary status_payment" value="{{ $transaction->status }}" readonly>  
                                @else
                                    <select class="form-control text-white bg-primary status_payment"  name="status">
                                        <option value="Lunas">Lunas</option>
                                        <option value="Belum">Belum Lunas</option>
                                    </select>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 30%">Status Order</td>
                            <td>
                                @if ($transaction->status_order == 'Proses')
                                    <select name="status_order" class="form-control text-white bg-primary">
                                        <option value="Selesai">Selesai</option>
                                        <option value="Ambil">Diambil</option>
                                    </select>
                                @elseif ($transaction->status_order == 'Selesai' || $transaction->status_order == 'Ambil')
                                <input type="text" name="status" class="form-control text-white bg-primary status_payment" value="{{ $transaction->status_order }}" readonly>  
                                @else
                                    <select name="status_order" class="form-control text-white bg-primary">
                                        <option value="Baru">Baru</option>
                                        <option value="Proses">Proses</option>
                                        <option value="Selesai">Selesai</option>
                                        <option value="Ambil">Diambil</option>
                                        <option value="Batal">Batal</option>
                                    </select>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 30%">Tanggal Ambil</td>
                            <td>
                                <input class="form-control" value="{{ Carbon\Carbon::parse($transaction->date_take)->format('d, M Y') }}" readonly>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <div class="kt-portlet__foot">
            <div class="kt-form__actions">
                <div class="row">
                    <div class="table-responsive">
                        <table class="table table-striped- table-bordered table-hover table-checkable"      id="example">
                            <thead>
                                <tr class="text-center">
                                    <th class="font-weight-bold">No</th>
                                    <th class="font-weight-bold">Tgl Order</th>
                                    <th class="font-weight-bold">Paket Laundry</th>
                                    <th class="font-weight-bold">Berat Cucian</th>
                                    <th class="font-weight-bold">Harga Paket</th>
                                    <th class="font-weight-bold">Sub Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-right">{{ $i = 0 + 1 }}</td>
                                    <td class="text-center">{{ Carbon\Carbon::parse($transaction->created_at)->format('d, M Y') }}</td>
                                    <td class="text-center">{{ $transaction->package->name ?? '' }}</td>
                                    <td class="text-center">{{ $transaction->weight }} Kg</td>
                                    <td class="text-right">Rp. {{ number_format($transaction->package->price) }}</td>
                                    <td class="text-right">Rp. {{ number_format($transaction->total) }}</td>
                                </tr>
                                <tr>
                                    <td colspan="5" class="text-center text-light bg-primary font-weight-bold">TOTAL PESANAN</td>
                                    <td class="text-right font-weight-bold">Rp. {{ number_format($transaction->total) }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="btn-process">
                            <div class="col-4 d-flex">
                                @if ($transaction->status == 'Lunas' && $transaction->status_order == 'Selesai' || 
                                        $transaction->status_order == 'Ambil' || $transaction->status_order == 'Batal')
                                    <a href="{{ route('master.generateInvoice.print', $transaction->id) }}" 
                                        class="col-5 btn btn-secondary font-weight-bold">
                                        Cetak Invoice
                                    </a>
                                @else
                                    <button class="col-5 btn btn-primary mr-2">Proses Order</button>
                                    <a href="{{ route('master.generateInvoice.print', $transaction->id) }}" 
                                        class="col-5 btn btn-secondary font-weight-bold">
                                        Cetak Invoice
                                    </a>
                                @endif
                            </div> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
