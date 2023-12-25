<?php

//Important
//'driver_location' change it to 'origin'

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

