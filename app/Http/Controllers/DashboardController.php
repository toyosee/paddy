<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    //
    // Dashboard View
    public function index()
    {
        $rides = Auth::user()->rides()->get();
        $numberOfRides = Auth::user()->rides()->count();
        return view('dashboard.index', compact('rides', 'numberOfRides'));
    }

    // Show the update form
    public function showProfileForm()
    {
        return view('dashboard.update', ['user' => Auth::user()]);
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
}
