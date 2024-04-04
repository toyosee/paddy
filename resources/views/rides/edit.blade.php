@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Include the sidebar -->
        @include('layouts.sidebar')

        <!-- Main content area -->
        <div class="col-md-9">
            <div class="container">
                <div class="card">
                    <div class="card-header bg-info text-white">
                        <h5 class="card-title mb-0"><strong><i class="fas fa-car"></i> Edit Car Information</strong></h5>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('rides.update', $ride->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="ride_type">Ride Type</label>
                                <input type="text" name="ride_type" class="form-control" value="{{ $ride->ride_type }}" required>
                            </div>
                            <div class="form-group">
                                <label for="ride_name">Ride Name</label>
                                <input type="text" name="ride_name" class="form-control" value="{{ $ride->ride_name }}" required>
                            </div>
                            <div class="form-group">
                                <label for="details">Details</label>
                                <textarea name="details" class="form-control">{{ $ride->details }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="capacity">Capacity</label>
                                <input type="number" name="capacity" class="form-control" value="{{ $ride->capacity }}" required>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-info"><i class="fas fa-save"></i> Update</button>
                                <a href="{{ route('rides.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Back</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
