<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\FriendRequest;
use App\Models\Connection;
use Illuminate\Support\Facades\Auth;

class ConnectionController extends Controller
{
    public function send(Request $request, User $user)
    {
        // Check if the current user is already connected with the target user
        if (Auth::user()->isConnectedWith($user)) {
            return redirect()->back()->with('error', 'You are already connected with this user.');
        }

        // Check if the current user has already sent a friend request to the target user
        if (Auth::user()->hasSentFriendRequestTo($user)) {
            return redirect()->back()->with('error', 'You have already sent a friend request to this user.');
        }

        // Check if the current user has received a friend request from the target user
        if (Auth::user()->hasReceivedFriendRequestFrom($user)) {
            return redirect()->back()->with('error', 'You have already received a friend request from this user.');
        }

        // Create a new connection between the current user and the target user
        Connection::create([
            'user1_id' => Auth::id(),
            'user2_id' => $user->id,
        ]);

        return redirect()->back()->with('success', 'Friend request sent successfully.');
    }

    public function accept(Connection $connection)
    {
        // Ensure that the current user is the receiver of the friend request
        if ($connection->user2_id !== Auth::id()) {
            return redirect()->back()->with('error', 'Unauthorized action.');
        }

        // Create a reciprocal connection to establish the friendship
        Connection::create([
            'user1_id' => $connection->user2_id,
            'user2_id' => $connection->user1_id,
        ]);

        // Delete the original connection (friend request)
        $connection->delete();

        return redirect()->back()->with('success', 'Friend request accepted successfully.');
    }

    // listing friends
    public function listFriends()
        {
            // Retrieve the authenticated user
        // $user = auth()->user();
                    // Retrieve pending friend requests for the logged-in user
        $pendingFriendRequests = FriendRequest::where('receiver_id', auth()->id())
        ->where('status', 'pending')
        ->with('sender')
        ->get();

    // Count the number of pending friend requests
        $pendingFriendRequestsCount = $pendingFriendRequests->count();
        $user = auth()->user(); // Assuming you're using authentication
        $friends = $user->friends;
        // Count the number of friends
        $friendCount = $friends->count();

            // Retrieve accepted friend requests where the receiver ID matches the authenticated user's ID
        $acceptedRequests = FriendRequest::where('receiver_id', $user->id)
        ->where('status', 'accepted')
        ->get();

        // Extract the sender information from the accepted friend requests
        $friends = $acceptedRequests->map(function ($request) {
        return $request->sender;
        });

            return view('friends.index', compact('friends', 'pendingFriendRequests', 'pendingFriendRequestsCount', 'friends', 'friendCount'));
        }

    public function reject(Connection $connection)
    {
        // Ensure that the current user is the receiver of the friend request
        if ($connection->user2_id !== Auth::id()) {
            return redirect()->back()->with('error', 'Unauthorized action.');
        }

        // Delete the connection (friend request)
        $connection->delete();

        return redirect()->back()->with('success', 'Friend request rejected successfully.');
    }

    public function cancel(Connection $connection)
    {
        // Ensure that the current user is the sender of the friend request
        if ($connection->user1_id !== Auth::id()) {
            return redirect()->back()->with('error', 'Unauthorized action.');
        }

        // Delete the connection (friend request)
        $connection->delete();

        return redirect()->back()->with('success', 'Friend request canceled successfully.');
    }
}