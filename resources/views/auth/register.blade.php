@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-info text-white">
                        <h5 class="card-title mb-0"><strong><i class="fas fa-user-plus"></i> Register</strong></h5>
                    </div>

                    <div class="card-body bg-light">
                        <form method="POST" action="{{ route('register.submit') }}">
                            @csrf

                            <div class="form-group">
                                <label for="name">Name:</label>
                                <input type="text" id="name" name="name" value="{{ old('name') }}" class="form-control" required autofocus>
                            </div>

                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" id="email" name="email" value="{{ old('email') }}" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="password">Password:</label>
                                <input type="password" id="password" name="password" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="password_confirmation">Confirm Password:</label>
                                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-info">Register</button>
                                <a href="{{ route('login') }}" class="btn btn-secondary">Login</a>
                                <strong class="text-muted" style="color:red;">Already have an account?</strong>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
