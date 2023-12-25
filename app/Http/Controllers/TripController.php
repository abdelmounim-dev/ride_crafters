<?php

//Important
//'driver_location' change it to 'origin'

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Trip;

class TripController extends Controller
{


    public function join(Request $request,Trip $trip)
    {   
        //user joining a carpooling
        $request->validate([
            'driver_location' => 'required'
            //'driver_location' change it to 'origin'
            //because in our case driver_location
            //is the point to meet att of carpooling 
        ]
            
        );
    

    $trip->update([
    'driver_id'=> $request->user()->id,
    'driver_location'=>$request->driver_location,
    //'driver_location' change it to 'origin'
    

    ]); 


        //get driver information
        // driver has relationship with user
        $trip->load('driver.user');
        return $trip;
    }

    public function start(Request $request,Trip $trip)
    {
        //a driver has started the carpooling
        $trip->update([
            'is_started'=>true
        ]);

        $trip->load('driver.user');
        return $trip;
    }

    public function end(Request $request,Trip $trip)
    {
        //a driver has completed the carpooling
        $trip->update([
            'is_started'=>false
        ]);

        $trip->load('driver.user');
        return $trip;
    }

    public function location(Request $request,Trip $trip)
    {
        
        $request->validate([
            'driver_location'=> 'required'
        ]);
        $trip->update([
            'driver_location'=>$request->driver_location
        ]);

        $trip->load('driver.user');
        return $trip;
    }


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
            //'start_location' => 'required',
            'origin' => 'required',
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
