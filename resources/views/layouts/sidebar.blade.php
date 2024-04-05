<div class="col-md-3 bg-dark sidebar">
    <!-- Sidebar content here -->
    <ul class="nav flex-column">
        <!-- <li class="nav-item">
            <a class="nav-link text-light" href="{{ route('profile.edit') }}"><i class="fas fa-user-edit mr-2"></i>Edit Profile</a>
        </li> -->
        <li class="nav-item" style="padding-top:20px;">
            <a class="nav-link text-light" href="{{ route('dashboard') }}"><i class="fas fa-home mr-2"></i>Dashboard</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-light" href="{{ route('rides.index') }}"><i class="fas fa-car mr-2"></i>My Cars</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-light" href="{{ route('friends.index') }}"><i class="fas fa-users mr-2"></i>My Friends</a>
        </li>
        <!-- <li class="nav-item">
            <a class="nav-link text-light" href="{{ route('pending-friend-requests') }}"><i class="fas fa-user-friends mr-2"></i>Friend Requests</a>
        </li> -->
        <!-- Add more sidebar options as needed -->
    </ul>
</div>
