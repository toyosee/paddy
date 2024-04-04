@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Include the sidebar -->
        @include('layouts.sidebar')

        <!-- Main content area -->
        <div class="col-md-9">
            <div class="container">
                <div class="card bg-light">
                    <div class="card-header bg-primary text-white">
                        <h5><strong>Car Details</strong></h5>
                    </div>
                    <div class="card-body">
                        <!-- <p><strong>ID:</strong> {{ $ride->id }}</p> -->
                        <p><strong>Car Type:</strong> {{ $ride->ride_type }}</p>
                        <p><strong>Car Name:</strong> {{ $ride->ride_name }}</p>
                        <p><strong>Details:</strong> {{ $ride->details }}</p>
                        <p><strong>Capacity:</strong> {{ $ride->capacity }}</p>
                        <!-- Add more details here as needed -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
