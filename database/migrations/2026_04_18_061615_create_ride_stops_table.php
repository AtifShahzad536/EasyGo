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
        Schema::create('ride_stops', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ride_id')->constrained('rides')->onDelete('cascade');
            
            // Stop order (1, 2, 3, 4)
            $table->integer('stop_order')->default(1);
            
            // Stop location details
            $table->string('place_name');
            $table->string('address');
            $table->text('full_address')->nullable();
            $table->decimal('latitude', 10, 8);
            $table->decimal('longitude', 11, 8);
            $table->string('place_id')->nullable();
            
            // Stop status
            $table->enum('status', ['pending', 'reached', 'completed', 'skipped'])->default('pending');
            $table->timestamp('reached_at')->nullable();
            
            $table->timestamps();
            
            $table->index(['ride_id', 'stop_order']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ride_stops');
    }
};
