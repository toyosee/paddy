<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\FriendRequest;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    //
    public function show(User $user)
    {
                // Retrieve pending friend requests for the logged-in user
                $pendingFriendRequests = FriendRequest::where('receiver_id', auth()->id())
                ->where('status', 'pending')
                ->with('sender')
                ->get();
        
            // Count the number of pending friend requests
            $pendingFriendRequestsCount = $pendingFriendRequests->count();
            return view('profiles.show', compact('user', 'pendingFriendRequests', 'pendingFriendRequestsCount'));
    }
}
