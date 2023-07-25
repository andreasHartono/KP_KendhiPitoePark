@extends('layouts.admin')
@section('title')
    TAMBAH PEGAWAI
@endsection
@section('content-header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0"> Kendi Pitoe Cafe | <small>Tambah Pegawai Baru</small></h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="#">Tambah Pegawai Baru</a></li>
            </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- jquery validation -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Tambah Data Pegawai Baru</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form id="quickForm" role="form" method="GET"
                        action="{{ route('store_data_pegawai') }}">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputName">Nama Pegawai</label>
                                <input type="text" name="nama" class="form-control" id="exampleInputName"
                                    placeholder="Contoh: Budi Santoso" required>
                            </div>                           
                            <div class="form-group">
                                <label for="exampleInputHarga">No. Telepon Pegawai</label>
                                <input type="number" name="notelepon" class="form-control" id="exampleInputHarga"
                                    placeholder="Contoh: 081--------" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleStatus">Jabatan</label>
                                <select class="form-control" name="jabatan" id="exampleStatus">
                                    <option value="owner">Owner</option>
                                    <option value="pegawai">Pegawai</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputHarga">Alamat Pegawai</label>
                                <input type="text" name="alamat" class="form-control" id="exampleInputHarga"
                                    placeholder="Contoh: Jalan Sultan No.1" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputHarga">Username Pegawai</label>
                                <input type="text" name="username" class="form-control" id="exampleInputHarga"
                                    placeholder="Contoh: budisantoso" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputHarga">Password Pegawai</label>
                                <input type="text" name="password" class="form-control" id="exampleInputHarga"
                                    placeholder="Contoh: password123" required>
                            </div>
                           
                            
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-success btn-block">Simpan Data</button>
                        </div>
                    </form>
                </div>
                <!-- /.card -->
            </div>
            <!--/.col (left) -->
            <!-- right column -->
            <div class="col-md-6">

            </div>
            <!--/.col (right) -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
@endsection
@section('javascript')
    <!-- jquery-validation -->
    <script src="{{ asset('admin/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/jquery-validation/additional-methods.min.js') }}"></script>
    <script>
        $(function() {
            $.validator.setDefaults({
                submitHandler: function() {
                    alert("Form successful submitted!");
                }
            });
            $('#quickForm').validate({
                rules: {
                    name: {
                        required: true,
                    },
                    price: {
                        required: true,
                    },
                    status: {
                        required: true
                    },
                    kategori: {
                        required: true
                    },
                    image: {
                        required: true
                    },
                    deskripsi: {
                        required: true
                    },
                },
                messages: {
                    name: {
                        required: "Silahkan masukkan nama Pegawai dengan benar dan tidak boleh dikosongi",
                    },
                    price: {
                        required: "Silahkan masukkan harga Pegawai dengan benar dan tidak boleh dikosongi",
                    },
                    status: {
                        required: "Silahkan pilih status ketersediaan stok Pegawai dengan benar dan tidak boleh dikosongi",
                    },
                    kategori: {
                        required: "Silahkan pilih jenis kategori Pegawai dengan benar dan tidak boleh dikosongi",
                    },
                    image: {
                        required: "Silahkan masukkan foto Pegawai dengan benar dan tidak boleh dikosongi",
                    },
                    deskripsi: {
                        required: "Silahkan masukkan deskripsi Pegawai dengan benar dan tidak boleh dikosongi",
                    },
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });
        });
    </script>
@endsection
