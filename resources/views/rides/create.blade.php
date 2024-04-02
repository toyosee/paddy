@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        @include('layouts.sidebar')

        <!-- Main content area -->
        <div class="col-md-9">
            <div class="container">
                <div class="card bg-light">
                    <div class="card-body">
                    <div class="card-header bg-primary text-white">
                    <h5 class="card-title">
                        <strong>Add Car</strong>
                    </h5>    
                        </div>
                        <form method="POST" action="{{ route('rides.store') }}">
                            @csrf
                            <div class="form-group">
                                <label for="ride_type">Car Type</label>
                                <input type="text" name="ride_type" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="ride_name">Car Name</label>
                                <input type="text" name="ride_name" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="details">Details</label>
                                <textarea name="details" class="form-control"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="capacity">Capacity</label>
                                <input type="number" name="capacity" class="form-control" required>
                            </div>
                            <div>
                                <button type="submit" class="btn btn-primary">Create</button>
                                <a href="{{ route('rides.index') }}" class="btn btn-secondary">Back</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
