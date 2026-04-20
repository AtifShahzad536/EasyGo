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
        Schema::create('rides', function (Blueprint $table) {
            $table->id();
            
            // Rider & Driver
            $table->foreignId('rider_id')->constrained('riders')->onDelete('cascade');
            $table->foreignId('driver_id')->nullable()->constrained('drivers')->onDelete('set null');
            
            // Pickup Location
            $table->string('pickup_place_name');
            $table->string('pickup_address');
            $table->text('pickup_full_address')->nullable();
            $table->decimal('pickup_lat', 10, 8);
            $table->decimal('pickup_lng', 11, 8);
            $table->string('pickup_place_id')->nullable();
            
            // Destination Location
            $table->string('destination_place_name');
            $table->string('destination_address');
            $table->text('destination_full_address')->nullable();
            $table->decimal('destination_lat', 10, 8);
            $table->decimal('destination_lng', 11, 8);
            $table->string('destination_place_id')->nullable();
            
            // Ride Details
            $table->enum('ride_type', ['bike', 'auto', 'economy', 'business', 'car_pool']);
            $table->enum('status', ['searching', 'accepted', 'driver_arrived', 'ongoing', 'completed', 'cancelled', 'no_driver'])->default('searching');
            $table->enum('payment_method', ['cash', 'wallet', 'card'])->default('cash');
            $table->enum('payment_status', ['pending', 'paid', 'failed'])->default('pending');
            
            // Timestamps
            $table->timestamp('scheduled_at')->nullable();
            $table->timestamp('accepted_at')->nullable();
            $table->timestamp('driver_arrived_at')->nullable();
            $table->timestamp('started_at')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->timestamp('cancelled_at')->nullable();
            
            // Fare & Pricing
            $table->decimal('estimated_fare', 10, 2);
            $table->decimal('final_fare', 10, 2)->nullable();
            $table->decimal('discount', 10, 2)->default(0);
            $table->string('promo_code')->nullable();
            
            // Ride Stats
            $table->decimal('distance_km', 8, 2)->nullable();
            $table->integer('duration_minutes')->nullable();
            
            // Cancellation
            $table->enum('cancelled_by', ['rider', 'driver', 'system'])->nullable();
            $table->text('cancellation_reason')->nullable();
            
            // Ratings
            $table->tinyInteger('rider_rating')->nullable();
            $table->text('rider_review')->nullable();
            $table->tinyInteger('driver_rating')->nullable();
            $table->text('driver_review')->nullable();
            
            $table->timestamps();
            
            // Indexes
            $table->index(['rider_id', 'status']);
            $table->index(['driver_id', 'status']);
            $table->index(['status', 'created_at']);
            $table->index(['pickup_lat', 'pickup_lng']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rides');
    }
};
