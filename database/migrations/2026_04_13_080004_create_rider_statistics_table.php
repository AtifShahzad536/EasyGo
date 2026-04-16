<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rider_statistics', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rider_id')->constrained('riders')->onDelete('cascade');
            
            // Wallet & Payments
            $table->decimal('wallet_balance', 10, 2)->default(0.00);
            $table->decimal('total_spent', 12, 2)->default(0.00);
            $table->decimal('total_refunded', 12, 2)->default(0.00);
            
            // Trips & Ratings
            $table->integer('total_trips')->default(0);
            $table->integer('completed_trips')->default(0);
            $table->integer('cancelled_trips')->default(0);
            $table->decimal('average_rating', 3, 2)->default(0.00);
            $table->integer('cancellation_count')->default(0);
            
            // Activity
            $table->timestamp('last_ride_at')->nullable();
            
            $table->timestamps();
            
            $table->unique('rider_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rider_statistics');
    }
};
