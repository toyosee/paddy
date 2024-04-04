<!-- resources/views/friend-requests/pending.blade.php -->

@foreach($pendingFriendRequests as $request)
    {{ $request->sender_id }} <!-- Display sender ID or any relevant information -->
    <!-- Add buttons to accept and reject the request -->
    <form action="{{ route('friend-requests.accept', $request->id) }}" method="POST">
        @csrf
        @method('PUT')
        <button type="submit">Accept</button>
    </form>
    <form action="{{ route('friend-requests.reject', $request->id) }}" method="POST">
        @csrf
        @method('PUT')
        <button type="submit">Reject</button>
    </form>
@endforeach
