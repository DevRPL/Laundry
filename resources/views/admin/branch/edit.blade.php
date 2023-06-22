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
       Edit
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
				Edit Data Cabang
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
                <form class="kt-form" method="POST" action="{{ route('master.cabangs.update', $branch->id ) }}">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="kt-section kt-section--first">
                                <div class="kt-section__body">
                                    <div class="form-group row">
                                        <label class="col-3 col-form-label">Nama*:</label>
                                        <div class="col-9">
                                            <input class="form-control" type="text" name="name" value="{{ $branch->name }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-3 col-form-label">Nama Cabang*:</label>
                                        <div class="col-9">
                                            <input class="form-control" type="text" name="branch_name" value="{{ $branch->branch_name }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-3 col-form-label">Alamat*:</label>
                                        <div class="col-9">
                                            <input class="form-control" type="text" name="address" value="{{ $branch->address}}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-3 col-form-label">Telp*:</label>
                                        <div class="col-9">
                                            <input class="form-control" type="text" name="phone" value="{{ $branch->phone }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-3 col-form-label">Email</label>
                                        <div class="col-9">
                                            <input class="form-control" type="text" name="email" value="{{ $branch->email }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="kt-portlet__foot">
                        <div class="kt-form__actions">
                            <div class="row">
                                <div class="col-lg-3"></div>
                                    <div class="col-lg-6">
                                        {{ csrf_field() }}
                                        @component('component.shared.btn-submit', ['title' => 'Edit']) @endcomponent
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
        </div>
    </div>	
@endsection
