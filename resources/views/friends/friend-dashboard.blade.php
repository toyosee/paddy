@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        @include('layouts.sidebar')

        <!-- Main content area -->
        <div class="col-md-9">
            <div class="row">
                <!-- Profile section -->
                <div class="col-md-4">
                    <div class="card mb-4">
                        <img src="{{ $user->profile_image ? asset('storage/' . $user->profile_image) : asset('storage/farmer.png') }}" alt="Profile Picture" class="card-img-top rounded-circle" style="width: 200px;">
                        <div class="card-body">
                            <h5 class="card-title text-info">{{ $user->name }}</h5>
                            <p class="card-text">{{ $user->email }}</p>
                            <!-- Profile details -->
                            <h5 class="card-title text-primary"><strong class="text-info"><i class="fas fa-user-circle"></i> Profile Details</strong></h5>
                            <p class="card-text">{{ $user->description }}</p>
                            <!-- Button to toggle car details -->
                            <button class="btn btn-info" type="button" data-toggle="collapse" data-target="#carDetails" aria-expanded="false" aria-controls="carDetails">
                                Car Details <i class="fas fa-car"></i>
                            </button>
                        </div>
                    </div>
                    <!-- Car details (Collapsible) -->
                    <div class="collapse" id="carDetails">
                        <div class="card mb-4">
                            <div class="card-body">
                                <h5 class="card-title text-info">Cars <i class="fas fa-car text-info"></i></h5>
                                @foreach ($user->rides as $ride)
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <h6 class="card-subtitle mb-2 text-muted">{{ $ride->ride_name }} <i class="fas fa-car-side"></i></h6>
                                        <p class="card-text"><strong><i class="fas fa-car"></i> Car Type:</strong> {{ $ride->ride_type }}</p>
                                        <p class="card-text"><strong><i class="fas fa-info-circle"></i> Details:</strong> {{ $ride->details }}</p>
                                        <p class="card-text"><strong><i class="fas fa-users"></i> Capacity:</strong> {{ $ride->capacity }}</p>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Additional sections -->
                <div class="col-md-8">
                    <!-- Shoutouts -->
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title text-info">Shoutouts <i class="fas fa-bullhorn text-info"></i></h5>
                            @foreach ($user->posts as $post)
                            <div class="card mb-3">
                                <div class="card-body bg-dark text-light">
                                    <h5 class="card-title">{{ $post->title }}</h5>
                                    <p class="card-text">{{ $post->content }}</p>
                                    <h6 class="comment-info"><strong><em>{{ $post->user->name }} - {{ $post->created_at->format('M d, Y h:i A') }}</em></strong></h6>
                                    <hr>
                                    <!-- Add more shoutout details here -->

                                    <div class="row">
                                        <div class="col-md-4"></div>
                                        <div class="col-md-8">
                                            <!-- Space for response floated to the right -->
                                            <h6 class="comment-toggle">Responses <i class="fas fa-chevron-down"></i></h6>
                                            <!-- Display comments for the post -->
                                            <div class="comments" style="display: none;">
                                                @foreach ($post->comments as $comment)
                                                    <p>{{ $comment->content }}</p>
                                                    <p class="comment-info"><strong><em>{{ $comment->user->name }} - {{ $comment->created_at->format('M d, Y h:i A') }}</em></strong></p>
                                                @endforeach
                                                <!-- Form for adding comments -->
                                                <form class="comment-form" action="{{ route('comments.add', $post->id) }}" method="POST" style="display: none;">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label for="commentContent"></label>
                                                        <textarea class="form-control" id="commentContent" name="content" rows="2"></textarea>
                                                    </div>
                                                    <button type="submit" class="btn btn-info">Respond <i class="fas fa-reply"></i></button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
