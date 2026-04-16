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
        Schema::create('carpool_rides', function (Blueprint $table) {
            $table->id();
            $table->foreignId('driver_id')->constrained('drivers')->onDelete('cascade');

            // Route details
            $table->string('from_city');
            $table->string('to_city');
            $table->date('ride_date');
            $table->time('ride_time');

            // Ride details
            $table->integer('available_seats');
            $table->decimal('fare_per_seat', 10, 2);
            $table->text('notes')->nullable();

            // Status
            $table->enum('status', ['active', 'completed', 'cancelled'])->default('active');

            $table->timestamps();

            // Indexes
            $table->index('driver_id');
            $table->index(['from_city', 'to_city']);
            $table->index('ride_date');
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carpool_rides');
    }
};
