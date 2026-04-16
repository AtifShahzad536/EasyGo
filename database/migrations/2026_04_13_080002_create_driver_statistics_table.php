<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('driver_statistics', function (Blueprint $table) {
            $table->id();
            $table->foreignId('driver_id')->constrained('drivers')->onDelete('cascade');
            
            // Earnings
            $table->decimal('wallet_balance', 10, 2)->default(0.00);
            $table->decimal('total_earnings', 12, 2)->default(0.00);
            $table->decimal('total_withdrawn', 12, 2)->default(0.00);
            
            // Rating & Trips
            $table->decimal('average_rating', 3, 2)->default(0.00);
            $table->integer('total_trips')->default(0);
            $table->integer('completed_trips')->default(0);
            $table->integer('cancelled_trips')->default(0);
            $table->integer('cancellation_count')->default(0);
            
            // Time tracking
            $table->integer('total_online_minutes')->default(0);
            $table->timestamp('last_trip_at')->nullable();
            
            $table->timestamps();
            
            $table->unique('driver_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('driver_statistics');
    }
};
