@extends('layouts.app')

@section('content')
<div class="container-fluid d-flex flex-column justify-content-center align-items-center bg-dark text-light py-5" style="height: 100vh;">
    <h1 class="display-4 mb-4 font-weight-bold"><strong>Paddy!</strong></h1>
    <i class="fas fa-car fa-10x mb-4 text-info" id="car-icon"></i>
    <p class="lead mb-4">Welcome to Paddy! Please log in or register to continue.</p>
    <div class="d-flex justify-content-center">
        <a href="{{ route('login') }}" class="btn btn-lg btn-outline-light mr-3">
            <i class="fas fa-sign-in-alt mr-1"></i>Login
        </a>
        <a href="{{ route('register') }}" class="btn btn-lg btn-light">
            <i class="fas fa-user-plus mr-1"></i>Register
        </a>
    </div>
</div>
@endsection


<!-- @section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    // Add animation to the car icon
    $('#car-icon').hover(function() {
        $(this).toggleClass('fa-spin');
    });
});
</script>
@endsection -->
