<!-- resources/views/auth/login.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-primary text-light"><strong>Login</strong></div>

                <div class="card-body bg-light">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" id="email" name="email" value="{{ old('email') }}" class="form-control" required autofocus>
                        </div>

                        <div class="form-group">
                            <label for="password">Password:</label>
                            <input type="password" id="password" name="password" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Login</button>
                            <a href="{{ route('register') }}" class="btn btn-secondary">Register</a>
                            <strong style="color:red;">Don't have an account yet?</strong>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
