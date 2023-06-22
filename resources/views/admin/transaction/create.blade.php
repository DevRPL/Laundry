@extends('layouts.master')

@section('title', 'transaksi Laundry')

@section('active', 'transaksi Laundry')

@push('css')

@endpush

@push('js')
    <script src="{{ asset('admin/default/crud/forms/widgets/assets/app/custom/general/crud/forms/widgets/bootstrap-datepicker.js') }}" type="text/javascript"></script>
     <script>
        $(document).ready(function() {
            $('.cs_name').prop('disabled', true).hide();
            $('.cs_phone').prop("disabled", true).hide();
            $('.cs_address').prop("disabled", true).hide();
            $('.cs_gender').prop("disabled", true).hide();
            $('.customer_id').prop("disabled", false).hide();
            $('select[name="registration"]').on('change', function(){
                var registration = $(this).val();
                if (registration == 1) {
                   $('.cs_name').prop('disabled', false).hide()
                        .find("input").val("");
                   $('.cs_phone').prop("disabled", false).hide()
                        .find("input").val("");
                   $('.cs_address').prop("disabled", false).hide()
                        .find("textarea").val("");
                   $('.cs_gender').prop("disabled", false).hide();
                   $('.customer_id').prop("disabled", true).show();
                } else {
                   $('.cs_name').prop('disabled', true).show();
                   $('.cs_phone').prop("disabled", true).show();
                   $('.cs_address').prop("disabled", true).show();
                   $('.cs_gender').prop("disabled", true).show();
                   $('.customer_id').prop("disabled", false).hide();
                } 
            });
        }); 
        // $(document).ready(function() {
        //     $('input[name="phone"]').prop("disabled", true);
        //     $('textarea[name="address"]').prop("disabled", true);
        //     $('select[name="customer_id"]').on('change', function(){
        //         var customerId = $(this).val();
        //         if (customerId) {
        //             $.ajax({
        //                 url: "gets/" + customerId,
        //                 type:"GET",
        //                 dataType:"json",
        //                 beforeSend: function(){
        //                     $("#loader").css("visibility", "visible");
        //                 },

        //                 success:function(data) {
        //                     $('input[name="telp"]').empty();
        //                     $('textarea[name="address"]').empty();
        //                     $.each(data, function(key, value){
        //                         $('input[name="phone"]').val(value.phone);
        //                         $('textarea[name="address"]').val(value.address);
        //                     });
        //                 },
        //                 complete: function(){
        //                     $('input[name="phone"]').prop("disabled", true);
        //                     $('textarea[name="address"]').prop("disabled", true);
        //                 }
        //             });
        //         } 
        //     });
        // });
    </script>
    <script>
        $("#m_select2_customer").select2({
            placeholder: "Pilih Customer"
        });

        $("#m_select2_package").select2({
            placeholder: "Pilih Paket"
        });

        $("#m_select2_status").select2({
            placeholder: "Pilih Status Pembayaran"
        });

        $("#m_select2_cs").select2({
            placeholder: "Pilih Status Customer"
        });

        $("#m_select2_gender").select2({
            placeholder: "Pilih Jenis Kelamin"
        });
    </script>
    <script> 
        $(document).ready(function() {
             total();
             var con = $('.package').find('option:selected').val();
             if (!con) {
                  $('.price').prop("disabled", true).val('').trigger("change");
                  $('.amount').prop("disabled", true).val('').trigger("change");
             } 

            $('select[name="package_id"]').on('change', function(){
                var package_id = $(this).val(); 
                if(package_id) {
                    $.ajax({
                        url: 'getPackage/' + package_id,
                        type:"GET",
                        dataType:"json",
                        beforeSend: function(){
                            $('#loader').css("visibility", "visible");
                        },
                        
                        success:function(data) {
                            $.each(data, function(key, value){
                               var price = $('input[name="price"]').val(value.price);
                            });
                        },
                        complete: function(){
                            $('input[name="price"]').prop("disabled", false);
                            $('input[name="weight"]').prop("disabled", false);
                        }
                    });
                } else {
                    $('select[name="package_id"]').empty();
                    $('input[name="price"]').prop("disabled", true);
                    $('input[name="weight"]').prop("disabled", true);
                }
            });
        });

        function total() {
            $('.amount, .price').on('input',function() {
                var qty = parseInt($('.amount').val());
                var price = parseInt($('.price').val());
                var calculate = $('.total').val((qty * price ? qty * price : 0));
                return formatCurrency(calculate.val(), true);
            });
        }
        
        function formatCurrency(number, prefix) {
            var number_string = number.replace(/[^,\d]/g, "").toString(),
            split = number_string.split(","),
            the_rest = split[0].length % 3,
            currency = split[0].substr(0, the_rest),
            format_thousand = split[0].substr(the_rest).match(/\d{3}/gi);
            if (format_thousand) {
                separator = the_rest ? "." : "";
                currency += separator + format_thousand.join(".");
            }
            currency = split[1] != undefined ? currency + "," + split[1] : currency;
            return prefix == undefined ? currency : currency ? "" + currency : "";
        }
    </script>
    
@endpush

@section('breadcrumb')
    <span class="kt-subheader__breadcrumbs-separator"></span>
        <a href="" class="kt-subheader__breadcrumbs-link">
            Kelola Transaksi Laundry                  
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
				Kelola Transaksi Laundry
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
                <form class="kt-form" method="POST" action="{{ route('master.transaksis.store') }}">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="kt-section kt-section--first">
                            <div class="kt-section__body">
                                <div class="form-group row">
                                    <label class="col-3 col-form-label">No Order:</label>
                                    <div class="col-9">
                                        <input class="form-control" type="text" value="{{ $numberNew }}" disabled>
                                        <input class="form-control" type="hidden" name="order_number" value="{{ $numberNew }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-3 col-form-label">Status Customer*:</label>
                                    <div class="col-9">
                                        <select name="registration" class="form-control" id="m_select2_cs">
                                            <option></option>
                                            <option value="1">Customer Sudah Terdaftar</option>
                                            <option value="2">Customer Belum Terdaftar</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row customer_id">
                                    <label class="col-3 col-form-label">Nama Customer*:</label>
                                    <div class="col-9">
                                        <select name="customer_id" class="form-control" id="m_select2_customer">
                                            <option></option>
                                            @foreach ($customers ?:[] as $customer)
                                                <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row cs_name">
                                    <label class="col-3 col-form-label">Customer Name*:</label>
                                    <div class="col-9">
                                        <input class="form-control" name="name" type="text" placeholder="Customer Name">
                                    </div>
                                </div>
                                <div class="form-group row cs_phone">
                                    <label class="col-3 col-form-label">Telp*:</label>
                                    <div class="col-9">
                                        <input class="form-control" name="phone" type="text" placeholder="No Handphone">
                                    </div>
                                </div>
                                <div class="form-group row cs_address">
                                    <label class="col-3 col-form-label">Alamat*:</label>
                                    <div class="col-9">
                                      <textarea class="form-control" name="address"  placeholder="Alamat"></textarea>
                                    </div>
                                </div>
                                <div class="form-group row cs_gender">
                                    <label class="col-3 col-form-label" >Jenis Kelamin*:</label>
                                    <div class="col-9">
                                        <select  id="m_select2_gender" name="gender" class="form-control">
                                            <option></option>
                                            <option value="Laki-Laki">Laki-Laki</option>
                                            <option value="Perempuan">Perempuan</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-3 col-form-label">Paket Laundry*:</label>
                                    <div class="col-9">
                                        <select name="package_id" class="form-control package" id="m_select2_package">
                                            <option></option>
                                            @foreach ($packages as $package)
                                                <option value="{{ $package->id }}">{{ $package->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-3 col-form-label">Harga :</label>
                                    <div class="col-9">
                                        <input class="form-control price" type="number" name="price" placeholder="Harga">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-3 col-form-label">Berat (kg)*:</label>
                                    <div class="col-9">
                                        <input class="form-control amount" type="number" min="1" name="weight" placeholder="Berat">
                                    </div>
                                </div>
                                 <div class="form-group row">
                                <label class="col-3 col-form-label">
                                    Total:
                                </label>
                                <div class="col-9">
                                    <input class="form-control total" type="text" name="total" 
                                        placeholder="Total" readonly>
                                </div>
                            </div>
                                <div class="form-group row">
                                    <label class="col-3 col-form-label">Tanggal Ambil*:</label>
                                    <div class="col-9">
                                    <input type="text" class="form-control" name="date_take" id="kt_datepicker_3" readonly=""  data-date-format="yyyy-mm-dd" placeholder="Tanggal Ambil">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-3 col-form-label">Status Pembayaran*:</label>
                                    <div class="col-9">
                                        <select name="status" class="form-control" id="m_select2_status">
                                            <option>Lunas</option>
                                            <option>Belum</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-3 col-form-label">Catatan:</label>
                                    <div class="col-9">
                                      <textarea class="form-control" name="description"  placeholder="Catatan"></textarea>
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
