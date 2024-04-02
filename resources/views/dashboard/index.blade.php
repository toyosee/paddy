@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        @include('layouts.sidebar')

        <!-- Main content area -->
        <div class="col-md-9">
            <div class="row">
                <div class="col-md-12">
                    <!-- Greeting section -->
                    <div class="card bg-dark text-light mb-4">
                        <div class="card-body">
                            <h1 class="card-title">Hello, {{ Auth::user()->name }}!</h1>
                            <p class="card-text">Welcome to your dashboard.</p>
                            <p class="card-text">Good 
                                @php
                                    $hour = date('G'); // Get the current hour in 24-hour format
                                    if ($hour >= 5 && $hour < 12) {
                                        echo 'Morning <i class="fas fa-sun"></i> ';
                                    } elseif ($hour >= 12 && $hour < 18) {
                                        echo 'Afternoon <i class="fas fa-sun"></i> ';
                                    } else {
                                        echo 'Night <i class="fas fa-moon"></i>';
                                    }
                                @endphp 
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Profile image and description section -->
            <div class="row">
                <div class="col-md-4">
                    <div class="card mb-4">
                        <img src="{{ Auth::user()->profile_image ? asset('storage/' . Auth::user()->profile_image) : asset('storage/farmer.png') }}" alt="Profile Image" class="card-img-top" style="border-radius:50px;">
                        <div class="card-body">
                            <strong class="card-title">{{ Auth::user()->name }}</strong>
                            <p class="card-text">{{ Auth::user()->email }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card bg-light">
                        <div class="card-body">
                            <h5 class="card-title"><strong>Profile Details</strong></h5>
                            <p class="card-text">{{ Auth::user()->description }}</p>
                        </div>
                    </div><br>
                    <div class="card bg-light">
                        <div class="card-body">
                            <h5 class="card-title"><strong>Car Details - You Have:</strong></h5>
                            <p class="text-center mb-4">
                                <strong style="font-size: 8rem; color:blue;">{{ $numberOfRides }}</strong>car(s)
                            </p>
                            <div class="d-flex flex-wrap">
                                @foreach ($rides as $ride)
                                    <span class="badge badge-success mr-2 mb-2">{{ $ride->ride_name }}</span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
