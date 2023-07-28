@extends('layouts.frontend')
@section('content')
    <div class="container">
        @if ($msg != null)
            <div class="alert alert-success" role="alert"><b>{{ $msg }}</b></div>
        @endif
        <div class="card">
            <div class="alert alert-light" role="alert">
                Profile Pelanggan
            </div>
            <div class="card-body">
                <h4 class="card-title heading-6">Nama Pelanggan : {{ Auth::user()->name }}</h4><br>
                <h4 class="card-title heading-6">Nomor Telepon : {{ Auth::user()->phone }}</h4><br>
                <h4 class="card-title heading-6">Alamat Pelanggan : {{ Auth::user()->address }}</h4><br>
            </div>
        </div><br>
        <div class="card-header p-2">
            {{-- <ul class="nav nav-pills">
            <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Settings</a></li>
        </ul> --}}
        </div><!-- /.card-header -->
        <div class="card-body">
            <div class="tab-content">
                <div class="active tab-pane" id="activity">
                    <div class="tab-pane" id="settings">
                        <form class="form-horizontal" action="{{ route('update_profil') }}">
                            <div class="form-group row">
                                <label for="inputName" class="col-sm-2 col-form-label">Nama</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="inputNama" id="inputNama"
                                        placeholder="{{ Auth::user()->name }}">
                                </div>
                            </div><br>
                            <div class="form-group row">
                                <label for="inputEmail" class="col-sm-2 col-form-label">Nomor Telepon</label>
                                <div class="col-sm-10">
                                    <input type="tel" class="form-control" name="inputTelepon" id="inputTelepon"
                                        placeholder="{{ Auth::user()->phone }}">
                                </div>
                            </div><br>
                            <div class="form-group row">
                                <label for="inputAlamat" class="col-sm-2 col-form-label">Alamat</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" name="inputAlamat" id="inputAlamat" placeholder="{{ Auth::user()->address }}"></textarea>
                                </div>
                            </div><br>
                            <div class="form-group row">
                                <div class="offset-sm-2 col-sm-10">
                                    <button type="submit" class="btn btn-block btn-success">Ubah Profil</button>
                                </div>
                            </div><br>
                        </form>
                    </div>
                    <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
            </div><!-- /.card-body -->
        </div>
    </div>
@endsection
