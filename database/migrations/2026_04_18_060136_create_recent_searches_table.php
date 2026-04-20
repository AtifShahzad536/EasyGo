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
        Schema::create('recent_searches', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rider_id')->constrained('riders')->onDelete('cascade');
            
            // Search query details
            $table->string('query_text'); // What user typed
            $table->string('place_name'); // Result place name
            $table->string('address');
            $table->text('full_address')->nullable();
            
            // Location coordinates
            $table->decimal('latitude', 10, 8);
            $table->decimal('longitude', 11, 8);
            
            // Google Places ID (if available)
            $table->string('place_id')->nullable();
            
            // Search type: destination, stop, pickup
            $table->enum('search_type', ['destination', 'stop', 'pickup'])->default('destination');
            
            $table->timestamp('searched_at');
            $table->timestamps();
            
            // Keep only recent searches (configurable, e.g., last 30 days)
            $table->index(['rider_id', 'searched_at']);
            $table->index(['latitude', 'longitude']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recent_searches');
    }
};
