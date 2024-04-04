<?php

namespace App\Http\Controllers;

use App\Models\Ride;
use App\Models\FriendRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RideController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
         // Retrieve pending friend requests for the logged-in user
         $pendingFriendRequests = FriendRequest::where('receiver_id', auth()->id())
         ->where('status', 'pending')
         ->with('sender')
         ->get();
 
         // Count the number of pending friend requests
        $pendingFriendRequestsCount = $pendingFriendRequests->count();
        
        $rides = Auth::user()->rides()->get();
        return view('rides.index', compact('rides', 'pendingFriendRequestsCount'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
                 // Retrieve pending friend requests for the logged-in user
                 $pendingFriendRequests = FriendRequest::where('receiver_id', auth()->id())
                 ->where('status', 'pending')
                 ->with('sender')
                 ->get();
         
                 // Count the number of pending friend requests
                $pendingFriendRequestsCount = $pendingFriendRequests->count();
        return view('rides.create', compact('pendingFriendRequestsCount'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    // Validate the request data
    $validatedData = $request->validate([
        'ride_type' => 'required',
        'ride_name' => 'required',
        'details' => 'nullable',
        'capacity' => 'required|integer',
    ]);

    // Create the ride
    $ride = Ride::create($validatedData);

    // Attach the authenticated user to the created ride
    Auth::user()->rides()->attach($ride);

    return redirect()->route('rides.index')->with('success', 'Car Added successfully.');
}

    /**
     * Display the specified resource.
     */
    public function show(Ride $ride)
    {
        //
                         // Retrieve pending friend requests for the logged-in user
                         $pendingFriendRequests = FriendRequest::where('receiver_id', auth()->id())
                         ->where('status', 'pending')
                         ->with('sender')
                         ->get();
                 
                         // Count the number of pending friend requests
                        $pendingFriendRequestsCount = $pendingFriendRequests->count();
        $rides = Auth::user()->rides()->get();
        return view('rides.show', compact('ride', 'rides', 'pendingFriendRequestsCount'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ride $ride)
    {
        //
                         // Retrieve pending friend requests for the logged-in user
                         $pendingFriendRequests = FriendRequest::where('receiver_id', auth()->id())
                         ->where('status', 'pending')
                         ->with('sender')
                         ->get();
                 
                         // Count the number of pending friend requests
                        $pendingFriendRequestsCount = $pendingFriendRequests->count();
        return view('rides.edit', compact('ride', 'pendingFriendRequestsCount'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ride $ride)
    {
        //
        $request->validate([
            'ride_type' => 'required',
            'ride_name' => 'required',
            'details' => 'nullable',
            'capacity' => 'required|integer',
        ]);

        $ride->update($request->all());

        return redirect()->route('rides.index')->with('success', 'Car updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ride $ride)
    {
        //
        $ride->delete();

        return redirect()->route('rides.index')->with('success', 'Car deleted successfully.');
    }
}
