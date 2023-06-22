@extends('layouts.master')

@section('title', 'Pengguna')

@section('active', 'Pengguna')

@push('css')

@endpush

@push('js')
    <script src="{{ asset('admin/default/crud/forms/widgets/assets/app/custom/general/crud/forms/widgets/bootstrap-datepicker.js') }}" type="text/javascript"></script>
@endpush

@section('breadcrumb')
    <span class="kt-subheader__breadcrumbs-separator"></span>
    <a href="#" class="kt-subheader__breadcrumbs-link">
        Detail Pengguna                    
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
				Detail Pengguna
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
                <table class="table table-bordered">
                    <tr>
                        <td style="width: 30%">Nama</td>
                        <td>
                            <input class="form-control" value="{{ $user->name }}" readonly>
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 30%">Email</td>
                        <td>
                            <input class="form-control" value="{{ $user->email }}" readonly>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
@endsection
