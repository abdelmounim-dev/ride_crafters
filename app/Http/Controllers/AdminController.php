<?php

//Possibilité pour l'administrateur de configurer des paramètres de l'application
//(par exemple, nombre maximal de places dans un trajet, configuration de la
//géolocalisation, etc.).

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Trip;
use App\Models\User;
use App\Models\Driver;

class AdminController extends Controller
{

    public function showAllTrips()
    {
        // Fetch all trips from the database
        $trips = Trip::all();

        // Return JSON response with the list of trips
        return response()->json(['trip' => $trips]);;
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

    public function showAllDrivers(Request $request)
    {
        // Fetch all drivers from the database
        $drivers = Driver::all();

        // Return JSON response with the list of drivers
        return response()->json(['drivers' => $drivers]);
    }

    public function assignAdmin(Request $request, $userId)
    {
        // Find the user by ID
        $user = User::find($userId);

        // Check if the user exists
        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        // Assign admin status
        $user->is_admin = true;

        // Save the changes
        $user->save();

        // Return JSON response with success message
        return response()->json(['message' => 'User is now an admin']);
    }
}
