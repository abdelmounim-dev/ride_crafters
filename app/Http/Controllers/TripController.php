<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Trip;

class TripController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $trips = Trip::all();
        return response()->json($trips);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'start_location' => 'required',
            'destination' => 'required',
            'departure_time' => 'required',
            'driver_id' => 'required',
            'available_seats' => 'required',
        ]);

        $trip = Trip::create($request->all());
        return response()->json($trip, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $trip = Trip::findOrFail($id);
        return response()->json($trip);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'start_location' => 'required',
            'destination' => 'required',
            'departure_time' => 'required',
            'driver_id' => 'required',
            'available_seats' => 'required',
        ]);

        $trip = Trip::findOrFail($id);
        $trip->update($request->all());

        return response()->json($trip);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $trip = Trip::findOrFail($id);
        $trip->delete();

        return response()->json(['message' => 'Trip deleted successfully']);
    }

    /**
     * Add passengers to a trip.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $tripId
     * @return \Illuminate\Http\Response
     */
    public function addPassengers(Request $request, $tripId)
    {
        // Validate the request
        $request->validate([
            'passenger_ids' => 'required|array',
            'passenger_ids.*' => 'exists:users,id',
        ]);

        // Find the trip
        $trip = Trip::findOrFail($tripId);

        // Attach passengers to the trip
        $trip->passengers()->attach($request->input('passenger_ids'));

        return response()->json(['message' => 'Passengers added successfully'], 200);
    }
}
