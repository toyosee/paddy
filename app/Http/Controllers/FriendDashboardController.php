<?php

// FriendDashboardController.php
namespace App\Http\Controllers;

use App\Models\FriendRequest;
use App\Models\User;
use Illuminate\Http\Request;

class FriendDashboardController extends Controller
{
    public function show($userId)
    {
         // Retrieve pending friend requests for the logged-in user
         $pendingFriendRequests = FriendRequest::where('receiver_id', auth()->id())
         ->where('status', 'pending')
         ->with('sender')
         ->get();
 
     // Count the number of pending friend requests
     $pendingFriendRequestsCount = $pendingFriendRequests->count();
        $user = User::findOrFail($userId);
        // Fetch additional data if needed
        return view('friends.friend-dashboard', compact('user', 'pendingFriendRequests', 'pendingFriendRequestsCount'));
    }
}
