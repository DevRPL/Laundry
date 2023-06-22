@extends('layouts.master')

@section('title', 'customer')

@section('active', 'customer')

@push('css')
 
@endpush

@push('js')

@endpush

@section('breadcrumb')
    <span class="kt-subheader__breadcrumbs-separator"></span>
        <a href="{{ route('master.customers.index') }}" class="kt-subheader__breadcrumbs-link">
            Customer                  
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
				Data Customer
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
                <form class="kt-form" method="POST" action="{{ route('master.customers.update', $customer->id ) }}">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="kt-section kt-section--first">
                                <div class="kt-section__body">
                                    <div class="form-group row">
                                        <label class="col-3 col-form-label">Nama Lengkap*:</label>
                                        <div class="col-9">
                                            <input class="form-control" type="text" name="name" value="{{ $customer->name }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-3 col-form-label">Alamat*:</label>
                                        <div class="col-9">
                                            <input class="form-control" type="text" name="address" value="{{ $customer->address}}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-3 col-form-label">Telp*:</label>
                                        <div class="col-9">
                                            <input class="form-control" type="text" name="phone" value="{{ $customer->phone }}">
                                        </div>
                                    </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-3 col-form-label">Jenis Kelamin:</label>
                                        <div class="col-9">
                                        <select class="form-control" name="gender">
                                            <option value="Laki-Laki" {{ $customer->gender == 'Laki-Laki' ? 'selected' : '' }}>Laki-Laki</option>
                                            <option value="Perempuan" {{ $customer->gender == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                         </select>
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
