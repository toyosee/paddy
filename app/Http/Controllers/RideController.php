<?php

namespace App\Http\Controllers;

use App\Models\Ride;
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
        $rides = Auth::user()->rides()->get();
        return view('rides.index', compact('rides'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('rides.create');
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
        $rides = Auth::user()->rides()->get();
        return view('rides.show', compact('ride', 'rides'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ride $ride)
    {
        //
        return view('rides.edit', compact('ride'));
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
