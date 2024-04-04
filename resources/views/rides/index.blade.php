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
                    <div class="card-header bg-info text-light">
                        <h5 class="card-title mb-0"><strong><i class="fas fa-car"></i> Your Cars</strong></h5>
                    </div>
                    <div class="card-body">
                        <a href="{{ route('rides.create') }}" class="btn btn-info mb-3">Add Car</a>
                        @if ($rides->isEmpty())
                        <div>
                            <p class="text-center text-muted">You don't have any cars yet. Click the button above to add.</p>
                        </div>
                        @else
                        @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                        @endif
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col"></th>
                                        <!-- <th scope="col">ID</th> -->
                                        <th scope="col">Type</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($rides as $ride)
                                    <tr data-toggle="collapse" data-target="#ride_{{ $ride->id }}" class="accordion-toggle">
                                        <td><i class="fas fa-plus-circle"></i></td>
                                        <!-- <td>{{ $ride->id }}</td> -->
                                        <td>{{ $ride->ride_type }}</td>
                                        <td>{{ $ride->ride_name }}</td>
                                        <td>
                                            <a href="{{ route('rides.show', $ride->id) }}" class="btn btn-info btn-sm"><i class="fas fa-eye"></i> View</a>
                                            <a href="{{ route('rides.edit', $ride->id) }}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i> Edit</a>
                                            <form action="{{ route('rides.destroy', $ride->id) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you? This action can not be reversed')"><i class="fas fa-trash-alt"></i> Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="4" class="hiddenRow">
                                            <div class="accordion-body collapse" id="ride_{{ $ride->id }}">
                                                <div class="card card-body">
                                                    <p><strong>Details:</strong> {{ $ride->details }}</p>
                                                    <p><strong>Capacity:</strong> {{ $ride->capacity }}</p>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
