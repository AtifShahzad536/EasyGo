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
        Schema::create('saved_places', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rider_id')->constrained('riders')->onDelete('cascade');
            
            // Place type: home, work, or custom
            $table->enum('type', ['home', 'work', 'other'])->default('other');
            $table->string('name'); // Display name like "Home", "Work", "Gym"
            
            // Address details
            $table->string('address');
            $table->string('place_name')->nullable(); // Building/Place name

            // Location coordinates
            $table->decimal('latitude', 10, 8);
            $table->decimal('longitude', 11, 8);
            
            $table->boolean('is_default')->default(false);
            $table->integer('order_index')->default(0); // For custom ordering
            
            $table->timestamps();
            
            // Indexes
            $table->index(['rider_id', 'type']);
            $table->index(['latitude', 'longitude']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('saved_places');
    }
};
