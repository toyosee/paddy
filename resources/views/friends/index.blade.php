@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        @include('layouts.sidebar')

        <!-- Main content area -->
        <div class="col-md-9">
            <div class="card">
                <div class="card-header bg-info text-light">
                    <h5 class="card-title"><strong><i class="fas fa-users"></i> Friends ({{ $friendCount }})</strong></h5>
                </div>
                <div class="card-body">
                    @if ($friends->isEmpty())
                    <p class="text-muted">You don't have any friends yet.</p>
                    @else
                    @foreach ($friends as $friend)
                    <div class="row mb-3">
                        <div class="col-md-8">
                            <div class="friend-details" data-toggle="collapse" href="#friend{{ $loop->index }}" role="button" aria-expanded="false" aria-controls="friend{{ $loop->index }}">
                                <span>{{ $friend->name }}</span>
                                <i class="fas fa-angle-double-down ml-2 text-info"></i>
                            </div>
                            <div class="collapse" id="friend{{ $loop->index }}">
                                <div class="card shadow rounded">
                                    <div class="card-body">
                                        @if ($friend->profile_image)
                                        <img src="{{ asset('storage/' . $friend->profile_image) }}" alt="{{ $friend->name }} Profile Picture" class="card-img-top img-thumbnail rounded-circle" style="width: 150px;">
                                        @else
                                        <img src="{{ asset('storage/farmer.png') }}" alt="Default Profile Picture" class="card-img-top img-thumbnail rounded-circle" style="width: 150px;">
                                        @endif
                                    </div>
                                    <div class="card-body">
                                        <p class="card-text"><strong>Email:</strong> {{ $friend->email }}</p>
                                        <hr class="my-2">
                                        <p class="card-text"><strong>About:</strong> {{ $friend->description }}</p>
                                    </div>
                                    <div class="card-footer">
                                    <a href="{{ route('friend.dashboard', $friend->id) }}" class="btn btn-info btn-sm">
                                        <i class="fas fa-eye"></i> View Profile
                                    </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('footer')
@include('layouts.footer')
@endsection
