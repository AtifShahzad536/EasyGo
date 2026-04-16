<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('driver_id')->constrained('drivers')->onDelete('cascade');
            
            $table->string('make');
            $table->string('model');
            $table->string('color');
            $table->string('plate_number')->unique();
            $table->enum('type', ['bike', 'auto', 'economy_car', 'comfort_car']);
            $table->year('year');
            
            $table->boolean('is_active')->default(true);
            $table->timestamp('verified_at')->nullable();
            
            $table->timestamps();
            
            $table->index('driver_id');
            $table->index('type');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
