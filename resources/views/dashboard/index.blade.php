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
                        <img src="{{ Auth::user()->profile_image ? asset('storage/' . Auth::user()->profile_image) : asset('storage/farmer.png') }}" alt="Profile Image" class="card-img-top rounded-circle" style="width: 200px;">
                        <div class="card-body">
                            <strong class="card-title text-info">{{ Auth::user()->name }}</strong>
                            <p class="card-text">{{ Auth::user()->email }}</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title text-info"><strong><i class="fas fa-car"></i> Car Details - You Have:</strong></h5>
                            <p class="text-center text-info mb-4">
                                <strong style="font-size: 4rem;">{{ $numberOfRides }}</strong> <span class="text-muted"><i class="fas fa-car"></i></span>
                            </p>
                            <div class="d-flex flex-wrap justify-content-center">
                                @foreach ($rides as $ride)
                                    <span class="badge badge-info mr-2 mb-2">{{ $ride->ride_name }}</span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Post creation section -->
            <div class="row">
                <div class="col-md-4">
                    <div class="card bg-light">
                        <div class="card-body">
                            <h5 class="card-title text-primary"><strong class="text-info"><i class="fas fa-user-circle"></i> Profile Details</strong></h5>
                            <p class="card-text">{{ Auth::user()->description }}</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="card shadow-sm">
                        <div class="card-body bg-dark">
                            <h5 class="card-title text-info"><strong>Shout Out...</strong></h5>
                            <form action="{{ route('posts.store') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="postContent"></label>
                                    <textarea class="form-control" id="postContent" name="content" rows="3"></textarea>
                                </div>
                                <button type="submit" class="btn btn-info"><i class="fas fa-bullhorn"></i> Shout</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Display Cars section -->
            <div class="row">
                <div class="col-md-4">
                    <h5 class="text-info text-center"><i class="fas fa-car"></i> Your Cars</h5>
                    @foreach ($rides as $ride)
                        <div class="card mb-3">
                            <div class="card-body bg-light">
                                <h6 class="card-title text-info">
                                    <a data-toggle="collapse" href="#collapseCar{{ $loop->iteration }}" role="button" aria-expanded="false" aria-controls="collapseCar{{ $loop->iteration }}" class="car-link">
                                        {{ $ride->ride_name }}
                                        <i class="fas fa-chevron-circle-down"></i>
                                    </a>
                                </h6>
                                <div class="collapse" id="collapseCar{{ $loop->iteration }}">
                                    <p><strong><i class="fas fa-car-side"></i> Car Type:</strong> {{ $ride->ride_type }}</p>
                                    <p><strong><i class="fas fa-info-circle"></i> Details:</strong> {{ $ride->details }}</p>
                                    <p><strong><i class="fas fa-users"></i> Capacity:</strong> {{ $ride->capacity }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="col-md-8">
                    <h5 class="text-info font-weight-bold">Your Shoutouts <i class="fas fa-bullhorn text-info"></i></h5>
                    @foreach ($posts as $post)
                        @if ($post->user_id === auth()->id() || auth()->user()->isFriend($post->user))
                            <div class="card mb-3">
                                <div class="card-body bg-dark text-light">
                                    <h5 class="card-title">{{ $post->title }}</h5>
                                    <p class="card-text">{{ $post->content }}</p>
                                    <h6 class="comment-info"><strong><em>{{ $post->user->name }} - {{ $post->created_at->format('M d, Y h:i A') }}</em></strong></h6>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-4"></div>
                                        <div class="col-md-8">
                                            <!-- Space for response floated to the right -->
                                            <h6 class="comment-toggle">Responses<i class="fas fa-chevron-down"></i></h6>
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
                                                    <button type="submit" class="btn btn-info">Respond</button>
                                                </form>
                                            </div>
                                        </div>
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
