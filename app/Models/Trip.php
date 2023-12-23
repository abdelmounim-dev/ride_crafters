<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Trip extends Model
{
    protected $fillable = ['start_location', 'destination', 'departure_time', 'driver_id', 'available_seats'];

    public function startLocation(): HasOne
    {
        return $this->HasOne(Location::class);
    }

    public function destination(): HasOne
    {
        return $this->HasOne(Location::class);
    }

    public function driver(): HasOne
    {
        return $this->HasOne(User::class);
    }

    public function passengers(): BelongsToMany
    {
        return $this->BelongsToMany(User::class, 'trips_users', 'trip_id', 'user_id');
    }

    use HasFactory;
}
