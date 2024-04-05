<?php

namespace App\Http\Controllers;

use App\Models\FriendRequest;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    //
    // Dashboard View
    public function index()
    {
        // Retrieve pending friend requests for the logged-in user
        $pendingFriendRequests = FriendRequest::where('receiver_id', auth()->id())
        ->where('status', 'pending')
        ->with('sender')
        ->get();

        // Count the number of pending friend requests
        $pendingFriendRequestsCount = FriendRequest::pendingFriendRequestsCount(auth()->id());

        // Retrieve posts for the dashboard
        // $posts = Post::all();
        // Retrieve only posts belonging to the current user
        $posts = auth()->user()->posts()->orderBy('created_at', 'desc')->get();

        // Retrieve rides for the dashboard
        $rides = auth()->user()->rides()->get();

        // Count the number of rides
        $numberOfRides = $rides->count();

        return view('dashboard.index', compact('posts', 'rides', 'numberOfRides', 'pendingFriendRequests', 'pendingFriendRequestsCount'));
    }

    // see pending friend requests
    public function pendingFriendRequests()
    {
        // Retrieve pending friend requests for the logged-in user
        $pendingFriendRequests = FriendRequest::where('receiver_id', auth()->id())
            ->where('status', 'pending')
            ->with('sender')
            ->get();

        // Count the number of pending friend requests
        $pendingFriendRequestsCount = $pendingFriendRequests->count();

        // Return the view with the pending friend requests data
        return view('dashboard.pending-friend-requests', compact('pendingFriendRequests', 'pendingFriendRequestsCount'));
    }

    // Show the update form
    public function showProfileForm()
    {
         // Retrieve pending friend requests for the logged-in user
         $pendingFriendRequests = FriendRequest::where('receiver_id', auth()->id())
         ->where('status', 'pending')
         ->with('sender')
         ->get();
 
     // Count the number of pending friend requests
     $pendingFriendRequestsCount = $pendingFriendRequests->count();
        return view('dashboard.update', ['user' => Auth::user()], compact('pendingFriendRequestsCount'));
    }

    // Updating profile
    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust max file size as needed
        ]);

        $user = Auth::user();
        $user->name = $request->name;
        $user->description = $request->description;

        if ($request->hasFile('profile_image')) {
            // Handle profile image upload
            $profileImage = $request->file('profile_image');
            $path = $profileImage->store('profile_images', 'public');
            $user->profile_image = $path;
        }

        $user->save();

        return redirect('/dashboard')->with('success', 'Profile updated successfully.');
    }

    // search for users
        public function search(Request $request)
            {
                        // Retrieve pending friend requests for the logged-in user
        $pendingFriendRequests = FriendRequest::where('receiver_id', auth()->id())
        ->where('status', 'pending')
        ->with('sender')
        ->get();

            // Count the number of pending friend requests
            $pendingFriendRequestsCount = $pendingFriendRequests->count();
                $query = $request->input('query');
                $users = User::where('name', 'like', "%$query%")->get();

                // Exclude the logged-in user from the search results
            $query = $request->input('query');
            $users = User::where('id', '!=', auth()->id()) // Exclude the logged-in user
                ->where('name', 'like', "%$query%")
                ->get();

                return view('dashboard.search-results', compact('users', 'query','pendingFriendRequests', 'pendingFriendRequestsCount'));
            }

    // Rewturn user details for search
    public function profile(User $user)
    {
        // Retrieve pending friend requests for the logged-in user
        $pendingFriendRequests = FriendRequest::where('receiver_id', auth()->id())
            ->where('status', 'pending')
            ->with('sender')
            ->get();
    
        // Count the number of pending friend requests
        $pendingFriendRequestsCount = $pendingFriendRequests->count();
    
        return view('users.profile', compact('user', 'pendingFriendRequests', 'pendingFriendRequestsCount'));
    }
}
