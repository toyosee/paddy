<!-- resources/views/friend-requests/send.blade.php -->

<form action="{{ route('friend-requests.send') }}" method="POST">
    @csrf
    <input type="hidden" name="receiver_id" value="{{ $receiverId }}">
    <button type="submit">Send Friend Request</button>
</form>
