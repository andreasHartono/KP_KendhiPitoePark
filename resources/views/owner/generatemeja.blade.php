@extends('layouts.admin')
@section('title')
    Pemilik | Generate Meja
@endsection
@section('content-header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0"> Kendi Pitoe Cafe <small>Data Meja</small></h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="#">Data Meja</a></li>
            </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
@endsection
@section('content')
    <div class="container-fluid">
        <form class="form-inline" action="{{ route('meja.store') }}" method="POST">
            @csrf
            <div class="form-group mb-2">
                <label for="">Nomor Meja : </label><input type="text" class="form-control" name="no_meja" placeholder="Masukkan No Meja" required>
            </div>
            <br>
            <!-- <div class="form-group mb-2 ml-1">
                <label for=""></label><input type="text" class="form-control" name="link" placeholder="Masukkan Link Meja">
            </div> -->
            <button type="submit" class="btn btn-primary ml-1 mb-2">Tambah Meja</button>
        </form><br>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><b>Data Meja dan Membuat QR Code Meja</b></h3>
            </div>
            <div class="card-body">
                <table class="table table-hover" id="example1" >
                    <thead>
                        <tr>
                            <th scope="col">No.Meja</th>
                            <th scope="col">Link</th>
                            <!-- <th scope="col">Generate dan Print QR code Meja</th> -->
                            <th scope="col">QR Code</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($mejas as $meja)
                            <tr>
                                <td>Meja Nomer : {{ $meja->no_meja }}</td>
                                <td> {{ $meja->link }} </td>
                                {{-- <td>
                                    <a href="{{ route('meja.generateUrl', ['idEncrypt' => $meja->no_meja_encrypt]) }}"
                                        class="btn btn-success">Generate & Print
                                        QR Code Meja</a>
                                </td>                                 --}}
                                <td>
                                    {{ QrCode::size(250)->generate($meja->link) }}

                                </td>
                                <td>
                                @can('owner')
                                            <form action="{{ route('meja.destroy', ['meja' => $meja->id]) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <input type="submit" value="Hapus Meja" class="btn btn-danger btn-sm"
                                                onclick="if(!confirm('Apakah anda yakin mau menghapus meja ini? Pastikan anda benar benar yakin untuk hapus data ini')) return false;">
                                            </form>
                                        @endcan
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
