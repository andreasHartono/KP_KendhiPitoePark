{{-- Jaga Jaga kalo disuruh nampilin QR Code mejanya saja --}}
@extends('layouts.admin')
@section('title')
    Pemilik | Detail QR Code Meja
@endsection
@section('content-header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0"> Kendi Pitoe Cafe <small>Detail QR Code Meja</small></h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="#">Detail QR Code Meja</a></li>
            </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                  <div class="card-body d-flex justify-content-center">
                     <img src="data:image/png;base64,{!! base64_encode($qrcode) !!}" />
                     {{-- {!! $qrcode !!} --}}
                  </div>
                    <div class="card-footer">
                        {{-- <a href="{{ route('meja.print',['qrcode' => $qrcode]) }}" class="btn btn-success btn-block">Print QR Code Meja</a> --}}
                        {{-- <a href="#" class="btn btn-success btn-block">Print QR Code Meja</a> --}}
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
