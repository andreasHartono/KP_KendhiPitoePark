@extends('layouts.auth')
@section('content')
    <!-- Main content -->
        <div class="error-page d-flex justify-content-center align-items-center">
            <div class="error-content">
                <img src="{{ asset('images/404.svg') }}" alt="Error Image" class="img-responsive" height="300" width="300">
                <h3><i class="fas fa-exclamation-triangle text-warning"></i> Oops, We can't seem to find the page you are
                    looking for.</h3>
                <p>
                    The page you are looking for might have been removed, had its name changed, or is temporarily
                    unavailable.
                </p>
                <a class="btn btn-success" href="{{ url('/') }}"><i class="fa fa-arrow-left"></i> Back to main apps</a>
                </form>
            </div>
            <!-- /.error-content -->
        </div>
        <!-- /.error-page -->
    <!-- /.content -->
@endsection
