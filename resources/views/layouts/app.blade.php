<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paddy</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="{{ asset('car.png') }}" />

    <!-- Custom CSS for dark navbar -->
    <!-- <link rel="stylesheet" href="{{ asset('css/app.css') }}"> -->
    <style>
        /* Clear default margins and paddings on all tags */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Optional: Add specific styles for div elements */
        div {
            margin: 0;
            padding: 0;
        }

        .car-link {
            color: inherit; /* Use the parent's color */
            text-decoration: none; /* Remove underline */
        }

        .car-link:hover {
            color: inherit; /* Use the parent's color */
            text-decoration: none; /* Remove underline on hover */
        }

        @keyframes moveCar {
    0% { transform: translateX(0); }
    50% { transform: translateX(100px); }
    100% { transform: translateX(0); }
        }

        .car-moving {
            animation: moveCar 2s infinite;
        }

        .comment-info {
                font-size: smaller;
                font-style: italic;
            }

    </style>
</head>
<body>

    <!-- Navigation bar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="{{ Auth::check() ? route('dashboard') : route('home') }}">Paddy</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mr-auto">
                @auth
                <li class="nav-item {{ Request::is('dashboard') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a>
                </li>
                @endauth
            </ul>
            <ul class="navbar-nav ml-auto">
                <!-- Display friend request icon for logged-in users -->
                @auth
                <li class="nav-item">
                <form action="{{ route('users.search') }}" method="GET" class="form-inline ml-auto mr-5">
                    <div class="input-group">
                        <input type="text" name="query" class="form-control" placeholder="Search users by name" aria-label="Search" aria-describedby="search-icon">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="submit" id="search-icon">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form>

                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('pending-friend-requests') }}">
                        <i class="fas fa-user-friends"></i>
                        @if ($pendingFriendRequestsCount > 0)
                            <span class="badge badge-danger">{{ $pendingFriendRequestsCount }}</span>
                        @endif
                    </a>
                </li>
                @endauth

                @guest
                <li class="nav-item {{ Request::is('login') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('login') }}">
                        <i class="fas fa-sign-in-alt"></i> Login
                    </a>
                </li>
                <li class="nav-item {{ Request::is('register') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('register') }}">
                        <i class="fas fa-user-plus"></i> Register
                    </a>
                </li>

                @else
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-user"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="{{ route('profile.edit') }}">Edit Profile</a>
                        <div class="dropdown-divider"></div>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="dropdown-item">Logout</button>
                        </form>
                    </div>
                </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>


    <!-- Main content area -->
    <div class="container mt-4">
        @yield('content')
    </div>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // for car movement on load
        $(document).ready(function() {
    // Trigger the toggleClass() function after the document has loaded
            $('#car-icon').toggleClass('car-moving');
        });

        // on hover
        // $(document).ready(function() {
        //     $('#car-icon').hover(function() {
        //         $(this).toggleClass('car-moving');
        //     });
        // });
        // for comment drop down
        $('.comment-toggle').click(function() {
            $(this).next('.comments').toggle();
            $(this).next('.comments').find('.comment-form').toggle();
        });
    </script>

    <!-- Include the footer -->
    @include('layouts.footer')
</body>
</html>
