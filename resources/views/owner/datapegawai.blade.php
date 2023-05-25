@extends('layouts.admin')
@section('title')
    Pemilik
@endsection
@section('content-header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0"> Kendi Pitoe Cafe <small>Data Pegawai</small></h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="#">Data Pegawai</a></li>
            </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
@endsection
@section('content')
<div class="row">
   <div class="col-12">
      <div class="card">
          <div class="card-header">
              <h3 class="card-title"><b>Data Pegawai</b></h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
              <table id="example1" class="table table-bordered table-hover">
                  <thead>
                      <tr>
                          <th>Rendering engine</th>
                          <th>Browser</th>
                          <th>Platform(s)</th>
                          <th>Engine version</th>
                          <th>CSS grade</th>
                      </tr>
                  </thead>
                  <tbody>
                      <tr>
                          <td>Trident</td>
                          <td>Internet
                              Explorer 4.0
                          </td>
                          <td>Win 95+</td>
                          <td> 4</td>
                          <td>X</td>
                      </tr>
                  </tbody>
                  <tfoot>
                      <tr>
                          <th>Rendering engine</th>
                          <th>Browser</th>
                          <th>Platform(s)</th>
                          <th>Engine version</th>
                          <th>CSS grade</th>
                      </tr>
                  </tfoot>
              </table>
          </div>
          <!-- /.card-body -->
      </div>

   </div>
</div>
@endsection
