<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('trips', function (Blueprint $table) {
            $table->id();
            //$table->string('start_location');
            //$table->json('start_location')->nullable();
            //$table->string('destination');
            
            $table->dateTime('departure_time');
            $table->foreignId('driver_id')->constrained('users')->onDelete('cascade');
            $table->foreignIdFor(Driver::class);
            $table->boolean('is_started')->default(false);
            $table->boolean('is_complete')->default(false);
            $table->integer('available_seats');

            //start location and destination = 4 coordinates
            //why not use json to hold each pair?

            $table->json('origin')->nullable();
            $table->json('destination')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trips');
    }
};
