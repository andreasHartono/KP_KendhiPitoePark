@extends('layouts.admin')
@section('title')
    TAMBAH MENU
@endsection
@section('content-header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0"> Kendi Pitoe Cafe | <small>Ubah Data Menu</small></h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="#">Ubah Data Menu</a></li>
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
                        <h3 class="card-title">Ubah Data Menu</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form id="quickForm" role="form" enctype="multipart/form-data" method="POST"
                        action="{{ route('cafes.update',['cafe'=> $cafes[0]->id]) }}">
                        @csrf
                        @method("PUT")
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputName">Nama Menu</label>
                                <input type="text" name="name" class="form-control" id="exampleInputName"
                                    placeholder="Contoh: Nasi Ayam Goreng" value="{{ $cafes[0]->name }}">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputFile">Foto Menu</label><br>
                                <img id="img" src="{{ asset('storage/menu_images/'.$cafes[0]->image) }}" alt="foto menu" height="150" width="150" class="img-responsive">    
                                <input type="file" name="image" class="" id="exampleInputFile" >
                                
                            </div>
                            <div class="form-group">
                                <label for="exampleInputHarga">Harga</label>
                                <input type="number" name="price" class="form-control" id="exampleInputHarga"
                                    placeholder="Contoh: 10000" value="{{ $cafes[0]->price }}">
                            </div>
                            <div class="form-group">
                                <label for="exampleStatus">Status Stok</label>
                                <select class="form-control" name="status" id="exampleStatus">
                                    <option value="true" {{ ($cafes[0]->status == 'true') ? 'selected' : ''}}>Tersedia</option>
                                    <option value="false" {{ ($cafes[0]->status == 'false') ? 'selected' : ''}}>Kosong atau Habis</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleKategori">Kategori</label>
                                <select class="form-control" name="category_id" id="exampleKategori">
                                    @foreach ($dataKategori as $data)
                                        <option value="{{ $data->id }}" {{ ($cafes[0]->category_id == $data->id) ? 'selected' : ''}}>{{ $data->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleDescription">Deskripsi Menu</label>
                                <div class="col-md-9">
                                    <textarea name="description" class="form-control" id="exampleDescription" rows="3"
                                        placeholder="isi deskripsi menu">{{ $cafes[0]->description }}</textarea>
                                </div>
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
         let img = document.getElementById('img');
         let input = document.getElementById('exampleInputFile');

         input.onchange = (e) => {
            if(input.files[0])
            img.src = URL.createObjectURL(input.files[0]);
         }
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
                        required: "Silahkan masukkan nama menu dengan benar dan tidak boleh dikosongi",
                    },
                    price: {
                        required: "Silahkan masukkan harga menu dengan benar dan tidak boleh dikosongi",
                    },
                    status: {
                        required: "Silahkan pilih status ketersediaan stok menu dengan benar dan tidak boleh dikosongi",
                    },
                    kategori: {
                        required: "Silahkan pilih jenis kategori menu dengan benar dan tidak boleh dikosongi",
                    },
                    image: {
                        required: "Silahkan masukkan foto menu dengan benar dan tidak boleh dikosongi",
                    },
                    deskripsi: {
                        required: "Silahkan masukkan deskripsi menu dengan benar dan tidak boleh dikosongi",
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
