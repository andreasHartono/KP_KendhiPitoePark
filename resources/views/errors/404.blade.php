@extends('layouts.auth')
@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="error-page">
            <h2 class="headline text-warning"> 404</h2>

            <div class="error-content">
                <h3><i class="fas fa-exclamation-triangle text-warning"></i> Oops, We can't seem to find the page you are
                    looking for.</h3>

                <p>
                    The page you are looking for might have been removed, had its name changed, or is temporarily
                    unavailable.
                    <a class="btn btn-success" href="{{ url('/') }}">return to main apps</a>
                </p>
                </form>
            </div>
            <!-- /.error-content -->
        </div>
        <!-- /.error-page -->
    </section>
    <!-- /.content -->
@endsection
