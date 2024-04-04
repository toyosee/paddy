@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        @include('layouts.sidebar') <br>

        <!-- Main content area -->
        <div class="col-md-9 mt-1">
            <div class="container">
                <div class="card">
                    <div>
                        <div class="card-header bg-info text-white">
                            <strong><i class="fas fa-user-edit"></i> Edit Profile</strong>
                        </div>
                        <div class="card-body">
                            @if(session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                            @endif
                            @if ($errors->any())
                            <div class="alert alert-danger" role="alert">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif
                            <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="name"><i class="fas fa-user"></i> Name:</label>
                                    <input type="text" name="name" value="{{ $user->name }}" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="description"><i class="fas fa-info-circle"></i> Description:</label>
                                    <textarea name="description" class="form-control">{{ $user->description }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="profile_image"><i class="fas fa-image"></i> Profile Image:</label>
                                    <div class="custom-file">
                                        <input type="file" name="profile_image" class="custom-file-input" id="profile_image">
                                        <label class="custom-file-label" for="profile_image">Choose file</label>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-info"><i class="fas fa-save"></i> Update Profile</button>
                            </form>
                            @if (!$user->profile_image)
                            <div class="mt-3">
                                <p>No profile image set? You can upload one above.</p>
                                <!-- Add default profile image here -->
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
