<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FriendRequest;
use Illuminate\Support\Facades\Auth;

class FriendRequestController extends Controller
{
    public function send(Request $request)
    {

        // handle sending request to self
        $senderId = auth()->id();
        $recipientId = $request->recipient_id;
    
        // Check if sender and recipient IDs are the same
        if ($senderId === $recipientId) {
            return redirect()->back()->with('success', 'You cannot send a friend request to yourself.');
        }
        // dd($request->all());
        $validatedData = $request->validate([
            'receiver_id' => 'required|exists:users,id',
        ]);


        // Check if there is an existing friend request from either the sender or receiver
        $existingRequest = FriendRequest::where(function ($query) use ($request) {
            $query->where('sender_id', Auth::id())
                ->where('receiver_id', $request->receiver_id);
        })->orWhere(function ($query) use ($request) {
            $query->where('sender_id', $request->receiver_id)
                ->where('receiver_id', Auth::id());
        })->whereIn('status', ['pending', 'accepted'])->first();

            // If an existing pending request is found, display an error message
        if ($existingRequest) {
            return redirect()->back()->with('error', 'You have already sent a friend request to this user.');
        }

        $friendRequest = new FriendRequest();
        $friendRequest->sender_id = Auth::id();
        $friendRequest->receiver_id = $validatedData['receiver_id'];
        $friendRequest->status = 'pending';
        $friendRequest->save();
        // dd($friendRequest);

        return redirect()->back()->with('success', 'Friend request sent successfully.');
        // return response()->json(['message' => 'Friend request sent successfully'], 200);
    }

    public function accept(FriendRequest $friendRequest)
    {
        if ($friendRequest->receiver_id !== Auth::id()) {
            return redirect()->back()->with('error', 'Unauthorized action.');
        }

        // creating friendship record for both users
        $friendRequest->status = 'accepted';
        $friendRequest->save();

        // Create a new friend request from the receiver to the sender
        FriendRequest::create([
            'sender_id' => auth()->id(),
            'receiver_id' => $friendRequest->sender_id,
            'status' => 'accepted',
        ]);
    
        // Dump the friend request data before redirecting
        // dd($friendRequest);
    
        // Halt the execution with return and redirect
        return redirect()->back()->with('success', 'Hurray!!! You are now friends.');
    }

    public function reject(FriendRequest $friendRequest)
    {
        if ($friendRequest->receiver_id !== Auth::id()) {
            return redirect()->back()->with('error', 'Unauthorized action.');
        }

        $friendRequest->status = 'rejected';
        $friendRequest->save();

        return redirect()->back()->with('success', 'Friend request rejected.');
    }
}
