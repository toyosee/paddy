<!-- resources/views/connections/make.blade.php -->

<form action="{{ route('connections.make') }}" method="POST">
    @csrf
    <input type="hidden" name="user2_id" value="{{ $userId }}">
    <button type="submit">Make Connection</button>
</form>
