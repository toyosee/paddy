@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        @include('layouts.sidebar')

        <!-- Main content area -->
        <div class="col-md-9">
            <div class="card">
                @if(session('success'))
                    <div class="alert alert-success" role="alert">
                        <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
                    </div>
                @endif

                <!-- Display error message if it exists in the session -->
                @if(session('error'))
                    <div class="alert alert-danger" role="alert">
                        <i class="fas fa-exclamation-circle mr-2"></i>{{ session('error') }}
                    </div>
                @endif
                <div class="card-header bg-info text-light">
                    <h5 class="card-title"><i class="fas fa-search mr-2"></i>Search Results</h5>
                </div>
                <div class="card-body">
                    @if ($users->isEmpty())
                        <p class="text-muted">No user name found for "{{ $query }}".</p>
                    @else
                        <ul class="list-unstyled">
                            @foreach ($users as $user)
                                <li class="media mb-3">
                                    <img src="{{ $user->profile_image ? asset('storage/' . $user->profile_image) : asset('storage/farmer.png') }}" alt="{{ $user->name }}" class="rounded-circle mr-3" width="50">
                                    <div class="media-body">
                                        <h5 class="mt-0">
                                            <a href="{{ route('users.profile', $user->id) }}">{{ $user->name }}</a>
                                        </h5>
                                        <p class="text-muted">{{ $user->description }}</p>
                                        <p>
                                            <form id="friend-request-form" action="{{ route('friend-requests.send') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="receiver_id" value="{{ $user->id }}">
                                                <button type="submit" class="btn btn-info btn-sm send-request-btn"><i class="fas fa-user-plus mr-1"></i>Send Friend Request</button>
                                            </form>
                                        </p>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
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

@section('scripts')
<script>

document.addEventListener('DOMContentLoaded', function() {
    const sendRequestButtons = document.querySelectorAll('.send-request-btn');

    sendRequestButtons.forEach(button => {
        button.addEventListener('click', function(event) {
            event.preventDefault(); // Prevent default form submission
            
            const userId = button.getAttribute('data-user-id'); // Get user ID from data attribute
            
            // Send AJAX request
            fetch('{{ route("friend-requests.send") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ receiver_id: userId }) // Include receiver_id in the request body
            })
            .then(response => {
                if (response.ok) {
                    console.log('Friend request sent successfully.');
                    // Update the UI to show a success message
                    const listItem = button.closest('li');
                    listItem.innerHTML = '<p>Friend request sent successfully.</p>';
                } else {
                    console.error('Failed to send friend request.');
                }
            })
            .catch(error => {
                console.error('An error occurred:', error);
            });
        });
    });
});


</script>
@endsection
