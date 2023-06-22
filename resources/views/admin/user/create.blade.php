@extends('layouts.master')

@section('title', 'Pengguna')

@section('active', 'Pengguna')

@push('css')

@endpush

@push('js')
    <script src="{{ asset('admin/default/crud/forms/widgets/assets/app/custom/general/crud/forms/widgets/bootstrap-datepicker.js') }}" 
        type="text/javascript"></script>
    <script>
        $("#m_select2_roles").select2({
            placeholder: "Pilih Roles"
        });

        $("#m_select2_branch").select2({
            placeholder: "Pilih Cabang"
        });
    </script>

    <script>
        $(document).ready(function() {
            var selected =  $('.roles').find(":selected").text();
            if (!selected) {
                form_birthday(true);
                form_phone(true);
                form_address(true);
            } else {
                form_birthday(false);
                form_phone(false);
                form_address(false);
            }
            $('select[name="roles"]').on('change', function(){
                var roles = $('.roles').find(":selected").text();
                if ((roles == 'Pegawai') || (roles == 'pegawai')) {
                    form_birthday(false);
                    form_phone(false);
                    form_address(false);
                } else {
                    form_birthday(true);
                    form_phone(true);
                    form_address(true);
                }
            });
        });
        
        function form_birthday(bool) {
            $('input[name="birthday"]').prop("disabled", bool);
            $('input[name="birthday"]').val('');
        }

        function form_phone(bool) {
            $('input[name="phone"]').prop("disabled", bool);
            $('input[name="phone"]').val('');
        }

        function form_address(bool) {
            $('textarea[name="address"]').prop("disabled", bool);
            $('textarea[name="address"]').val('');
        }
    </script>
@endpush

@section('breadcrumb')
    <span class="kt-subheader__breadcrumbs-separator"></span>
        <a href="" class="kt-subheader__breadcrumbs-link">
            Kelola Pengguna Laundry                  
        </a>
    <span class="kt-subheader__breadcrumbs-separator"></span>
    <span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">
        Tambah
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
				Kelola Pengguna Laundry
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
            <form class="kt-form" method="POST" action="{{ route('master.users.store') }}">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="kt-section kt-section--first">
                            <div class="kt-section__body">
                                <div class="form-group row">
                                    <label class="col-3 col-form-label">Nama *:</label>
                                    <div class="col-9">
                                        <input class="form-control" type="text" name="name" placeholder="Nama" value="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-3 col-form-label">Email *:</label>
                                    <div class="col-9">
                                        <input class="form-control" type="email" name="email" placeholder="Email" value="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-3 col-form-label">password*:</label>
                                    <div class="col-9">
                                        <input type="password" name="password" class="form-control" placeholder="Password">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-3 col-form-label">Konfirmasi password*:</label>
                                    <div class="col-9">
                                        <input type="password" name="confirm-password" class="form-control" placeholder="Konfirmasi Password">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-3 col-form-label">Cabang *:</label>
                                    <div class="col-9">
                                        <select class="form-control" name="branch_id" id="m_select2_branch">
                                            @foreach ($branches as $branch)
                                                <option value="{{ $branch->id }}" {{ Auth::user()->id == Auth::user()->branch_id ? 'selected' : '' }}>{{ $branch->name }}</option>
                                            @endforeach
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
                                    @component('component.shared.btn-submit',
                                        ['title' => 'Simpan']
                                    ) @endcomponent
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>	
@endsection
