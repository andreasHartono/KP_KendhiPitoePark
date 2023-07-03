@extends('layouts.admin')
@section('title')
    Data Kategori Menu
@endsection
@section('content-header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0"> Kendi Pitoe Cafe | <small>Data Kategori Menu</small></h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="#">Data Kategori Menu</a></li>
            </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
@endsection
@section('content')
    <div class="container-fluid">
        @if (session('success'))
            {{ session('sucess') }}
        @elseif(session('error'))
            {{ session('error') }}
        @endif
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><b>Tabel Daftar Menu</b></h3><br>
                <a class='btn btn-success' href="#modal-create" data-toggle='modal' class="btn btn-success">Tambah Menu
                    Baru</a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table class="table table-hover" id="example1">
                    <thead>
                        <tr>
                            <th>ID Kategori Menu</th>
                            <th>Nama Kategori Menu</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $dataKategori)
                            <tr>
                                <td>{{ $dataKategori->id }}</td>
                                <td>{{ $dataKategori->name }}</td>
                                <td>
                                    <a href="{{ route('categories.edit', ['category' => $dataKategori->id]) }}" class="btn btn-warning btn-sm">
                                        Ubah Kategori Menu</a><br><br>
                                    <form action="{{ route('categories.destroy', ['category' => $dataKategori->id]) }}"
                                        method="post">
                                        @csrf
                                        @method('DELETE')
                                        <input type="submit" value="Hapus Kategori Menu" class="btn btn-danger btn-sm"
                                            onclick="if(!confirm('Apakah anda yakin mau kategori menu ini ? Pastikan data kategori tidak terpakai di salah satu atau banyak menu')) return false;">
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        <!-- Kalo data kosong -->
                        {{-- <tr> 
                            <td colspan="5" class="text-center"></span></td>
                        </tr> --}}
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div><br>
    </div>

    <div class="modal fade" id="modal-create">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Form Tambah Kategori Menu</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="quickForm" role="form" method="POST" action="{{ route('categories.store') }}">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="exampleInputName">Nama Menu</label>
                            <input type="text" name="name" class="form-control" id="exampleInputName"
                                placeholder="Contoh: Makanan">
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Simpan Data</button>
                        <button type="button" data-dismiss="modal" class="btn btn-secondary">Close</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
    <!-- /.modal -->
@endsection