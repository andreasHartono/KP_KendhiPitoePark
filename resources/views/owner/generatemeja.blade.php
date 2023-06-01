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
    <div class="container">
        <div class="row col-12">
            <form class="form-inline" action="{{ route('meja.store') }}" method="POST">
                @csrf
                <div class="form-group mb-2">
                    <input type="text" class="form-control" name="no_meja" placeholder="Masukkan No Meja">
                </div>
                <div class="form-group mb-2 ml-1">
                    <input type="text" class="form-control" name="link" placeholder="Masukkan Link Meja">
                </div>
                <button type="submit" class="btn btn-primary ml-1 mb-2">Tambah Meja</button>
            </form><br>
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><b>Data Meja dan Membuat QR Code Meja</b></h3>
                </div>
                <div class="card-body">
                    <table id="example1"class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">No.Meja</th>
                                <th scope="col">Link</th>
                                <th scope="col">Generate QR code Meja</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($mejas as $meja)
                                <tr>
                                    <td>{{ $meja->no_meja }}</td>
                                    <td>{{ route('meja.generateUrl', ['hash' => $meja->link]) }} </td>
                                    <td>
                                        <a href="{{ route('meja.generate', ['id' => $meja->id]) }}"
                                            class="btn btn-success">Generate
                                            QR Code Meja</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
