<!-- resources/views/connections/list.blade.php -->

@foreach($connections as $connection)
    {{ $connection->user1_id }} <!-- Display user ID or any relevant information -->
    <!-- Add button to remove the connection -->
    <form action="{{ route('connections.remove', $connection->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit">Remove</button>
    </form>
@endforeach
