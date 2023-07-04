@extends('layouts.admin')
@section('title')
    DATA MENU
@endsection
@section('content-header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0"> Kendi Pitoe Cafe | <small>Data Menu</small></h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="#">Data Menu</a></li>
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
                <h3 class="float-left"><b>Tabel Daftar Menu</b></h3>
                <a class='btn btn-success btn-large float-right' href="{{ route('cafes.create') }}">Tambah Menu Baru</a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table class="table table-hover" id="example1">
                    <thead>
                        <tr>
                            <th>ID Menu</th>
                            <th>Nama Menu</th>
                            <th>Harga</th>
                            <th>Status Ketersediaan Stok</th>
                            @can('owner')
                                <th>Nama Pemilik Menu</th>
                            @endcan
                            <th>Deskripsi</th>
                            <th>Nama Kategori</th>
                            <th>Foto Makanan</th>
                            <th>Tanggal Dibuat</th>
                            <th>Tanggal Perubahan</th>
                            <th>Detail dan Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cafes as $dataMenu)
                            <tr>
                                <td>{{ $dataMenu->id }}</td>
                                <td>{{ $dataMenu->name }}</td>
                                <td>Rp. {{ number_format($dataMenu->price) }}</td>
                                @if ($dataMenu->status == 'true')
                                    <td><span class="bg-success">Tersedia</span></td>
                                @elseif($dataMenu->status == 'false')
                                    <td><span class="bg-danger">Kosong atau Habis</span></td>
                                @endif
                                @can('owner')
                                    <td>{{ $dataMenu->pemilik_menu }}</td>
                                @endcan
                                <td>{{ $dataMenu->description }}</td>
                                <td>{{ $dataMenu->nama_kategori }}</td>
                                <td><img src="{{ asset('images/' . $dataMenu->image) }}" alt="foto menu"
                                        class="img-responsive" height="150" width="150"></td>
                                <td>{{ $dataMenu->created_at }}</td>
                                <td>{{ $dataMenu->updated_at }}</td>
                                <td>
                                    <div class="col-md-6">
                                        <a href="{{ route('cafes.edit', ['cafe' => $dataMenu->id]) }}"
                                            class="btn btn-warning btn-sm">
                                            Ubah Menu</a><br><br>
                                        @can('owner')
                                            <form action="{{ route('cafes.destroy', ['cafe' => $dataMenu->id]) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <input type="submit" value="Hapus Menu" class="btn btn-danger btn-sm"
                                                onclick="if(!confirm('Apakah anda yakin mau hapus menu ini daftar menu ? pastikan anda benar benar yakin untuk hapus data ini')) return false;">
                                            </form>
                                        @endcan
                                    </div>
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
@endsection
