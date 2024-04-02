<!-- resources/views/sidebar.blade.php -->

<div class="col-md-3 bg-dark sidebar">
    <!-- Sidebar content here -->
    <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link text-light" href="{{ route('profile.edit') }}">Edit Profile</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-light" href="{{ route('rides.index') }}">My Cars</a>
        </li>
        <!-- Add more sidebar options as needed -->
    </ul>
</div>
