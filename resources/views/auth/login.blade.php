
 @extends('layouts.auth')
 @section('title') Login @endsection
 @section('content')
 @if(session()->has('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      {{ session('success') }}
    </div>
    @endif

    @if(session()->has('loginError'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      {{ session('loginError') }}
    </div>
    @endif

        <!-- /.login-logo -->
        <div class="card card-outline">
            <div class="card-header text-center">
                <img src="{{ asset('template/assets/images/pitoe.png') }}" alt="logo" height="300" width="300">
            </div>
            <div class="card-body">
                <form method="POST" action="{{ url('login_detail') }}">
                  @csrf  
                  <div class="input-group mb-3">
                        <input required type="text" name="username"
                            class="form-control @error('name') is-invalid @enderror " id="name"
                            placeholder="Silahkan Isikan Username" value="{{ old('username') }}">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="input-group mb-3">
                        <input required type="password" name="password"
                            class="form-control @error('password') is-invalid @enderror" id="password"
                            placeholder="Password">
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-success btn-block">{{ __('Login') }}</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>

                <div class="social-auth-links text-center mt-2 mb-3">
                    <a href="#" class="btn btn-block btn-danger">
                        <i class="fab fa-google-plus mr-2"></i> Login Without Email
                    </a>
                    <a href="#" class="btn btn-block btn-outline-success">
                        Continue As Guest
                    </a>
                </div>
                <!-- /.social-auth-links -->
                <p class="mb-0">
                    <a href="{{ url('register')}}" class="btn btn-block btn-outline-secondary">Register a new membership</a>
                </p>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
@endsection
