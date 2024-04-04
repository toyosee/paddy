{{-- resources/views/dashboard/pending-friend-requests.blade.php --}}

@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            @include('layouts.sidebar')

            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-primary text-light">
                        <h5 class="card-title"><strong>Pending Friend Requests</strong></h5>
                    </div>
                    <div class="card-body">
                    @foreach ($pendingFriendRequests as $request)
    <div class="mb-3">
        <div class="d-flex align-items-center">
            @if ($request->sender->profile_image)
                <img src="{{ asset('storage/' . $request->sender->profile_image) }}" alt="{{ $request->sender->name }}" class="rounded-circle mr-3" width="50">
            @else
                <img src="{{ asset('storage/farmer.png') }}" alt="Default Profile Image" class="rounded-circle mr-3" width="50">
            @endif
            <div>
                <p><strong>{{ $request->sender->name }}</strong> sent you a friend request.</p>
                <form action="{{ route('friend-requests.accept', $request->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="btn btn-success">Accept</button>
                </form>
                <form action="{{ route('friend-requests.reject', $request->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="btn btn-danger">Reject</button>
                </form>
            </div>
        </div>
    </div>
@endforeach

@if ($pendingFriendRequests->isEmpty())
    <p>No pending friend requests.</p>
@endif
                    </div>
                </div>
            </div>
<!-- Add buttons for friend requests and connections -->
<!-- <div class="col-md-4">
    <div class="card">
        <div class="card-header bg-secondary text-light">
            <h5 class="card-title"><strong>Manage Connections</strong></h5>
        </div>
        <div class="card-body">
            <form action="{{ route('connections.make') }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-info">Make Connection</button>
            </form>
        </div>
    </div>
</div> -->


        </div>
    </div>
@endsection
