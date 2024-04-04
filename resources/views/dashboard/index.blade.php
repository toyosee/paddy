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
            </div> <br>
                       <!-- Post creation section -->
                       <div class="row">
                        <div class="col-md-4">
                        <div class="card bg-light">
                        <div class="card-body">
                            <h5 class="card-title"><strong>Profile Details</strong></h5>
                            <p class="card-text">{{ Auth::user()->description }}</p>
                        </div>
                    </div><br>
                        </div>
                <div class="col-md-8">
                    <div class="card mb-4">
                        <div class="card-body bg-dark text-light">
                            <h5 class="card-title">Shout Out...</h5>
                            <form action="{{ route('posts.store') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="postContent"></label>
                                    <textarea class="form-control" id="postContent" name="content" rows="3"></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Shout</button>
                            </form><br>
                        </div>
                    </div>
                </div>
            </div> <br>

            <!-- Display posts section -->
            <div class="row">
                <div class="col-md-4">

                </div>
                <div class="col-md-8">
                    <h5>Your Shoutouts</h5>
                    @foreach ($posts as $post)
                    @if ($post->user_id === auth()->id() || auth()->user()->isFriend($post->user))
                        <div class="card mb-3">
                            <div class="card-body bg-light">
                                <h5 class="card-title">{{ $post->title }}</h5>
                                <p class="card-text">{{ $post->content }}</p>
                                <h6 class="comment-info"><strong><em>{{ $post->user->name }} - {{ $post->created_at->format('M d, Y h:i A') }}</em></strong></h6>
                                <!-- <div class="post-actions">
                    @if(Auth::id() === $post->user_id) -->
                        <!-- Edit button -->
                        <!-- <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-sm btn-primary mr-2">Edit</a> -->
                        <!-- Delete button -->
                        <!-- <form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this post?')">Delete</button>
                        </form>
                    @endif
                </div> -->
            <hr>
            <h6 class="comment-toggle">Responses<i class="fas fa-chevron-down"></i></h6>
            <!-- Display comments for the post -->
            <div class="comments" style="display: none;">
                @foreach ($post->comments as $comment)
                    <p>{{ $comment->content }}</p>
                    <p class="comment-info"><strong>
                        <em>{{ $comment->user->name }} - {{ $comment->created_at->format('M d, Y h:i A') }}</em>
                    </strong></p>
                @endforeach
                <!-- Form for adding comments -->
                <form class="comment-form" action="{{ route('comments.add', $post->id) }}" method="POST" style="display: none;">
                    @csrf
                    <div class="form-group">
                        <label for="commentContent"></label>
                        <textarea class="form-control" id="commentContent" name="content" rows="2"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Respond</button>
                </form>
            </div>
        </div>
    </div>
    @endif
@endforeach
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
