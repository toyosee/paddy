<!-- resources/views/friends/index.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            @include('layouts.sidebar')

            <!-- Main content area -->
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header bg-primary">
                        <h5 class="card-title text-light"><strong>Your Friends</strong></h5>
                    </div>
                    <div class="card-body">
                        @if ($friends->isEmpty())
                            <p>You don't have any friends yet.</p>
                        @else
                            @foreach ($friends as $friend)
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                    <div class="card">
                                        @if ($friend->profile_image)
                                            <img src="{{ asset('storage/' . $friend->profile_image) }}" alt="{{ $friend->name }} Profile Picture" class="card-img-top img-thumbnail">
                                        @else
                                            <img src="{{ asset('storage/farmer.png') }}" alt="Default Profile Picture" class="card-img-top img-thumbnail">
                                        @endif
                                    </div>

                                    </div>
                                    <div class="col-md-8">
                                        <div class="friend-details" data-toggle="collapse" href="#friend{{ $loop->index }}" role="button" aria-expanded="false" aria-controls="friend{{ $loop->index }}">
                                            <span>{{ $friend->name }}</span>
                                            <i class="fas fa-angle-double-down ml-2"></i>
                                        </div>
                                        <div class="collapse" id="friend{{ $loop->index }}">
                                            <div class="card card-body">
                                                <p><strong>Email:</strong> {{ $friend->email }}</p>
                                            </div>
                                            <div class="card card-body">
                                                <p><strong>About:</strong> {{ $friend->description }}</p>
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
