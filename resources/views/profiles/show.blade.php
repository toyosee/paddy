@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
        <!-- Sidebar -->
        @include('layouts.sidebar')
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Friend Profile</div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $user->name }}</h5>
                        <p class="card-text">{{ $user->email }}</p>
                        <!-- Add more profile information here -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
