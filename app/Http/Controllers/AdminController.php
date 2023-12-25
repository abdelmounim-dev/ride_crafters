<?php

//Possibilité pour l'administrateur de configurer des paramètres de l'application
//(par exemple, nombre maximal de places dans un trajet, configuration de la
//géolocalisation, etc.).

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function showAllTrips()
    {
        // Fetch all trips from the database
        $trips = Trip::all();

        // Return JSON response with the list of trips
        return response()->json(['trip' => $trip]);;
    }


    public function deleteTrip(Request $request, $id)
    {
        // Find the trip by ID
        $trip = Trip::findOrFail($id);

        // Delete the trip
        $trip->delete();

        // Return JSON response with success message
        return response()->json(['message' => 'Trip deleted successfully']);
    }

    public function deleteUser(Request $request, $id)
    {
        // Find the user by ID
        $user = User::findOrFail($id);

        // Delete the user
        $user->delete();

        // Return JSON response with success message
        return response()->json(['message' => 'User deleted successfully']);
    }
}
