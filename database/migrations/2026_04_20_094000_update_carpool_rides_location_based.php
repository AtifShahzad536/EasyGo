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
        Schema::table('carpool_rides', function (Blueprint $table) {
            // Remove old city-based columns
            $table->dropColumn(['from_city', 'to_city']);
            
            // Add vehicle_id foreign key
            $table->foreignId('vehicle_id')->nullable()->after('driver_id')->constrained('vehicles')->onDelete('set null');
            
            // Add location-based columns with coordinates
            $table->string('origin_address')->after('vehicle_id');
            $table->decimal('origin_lat', 10, 8)->after('origin_address');
            $table->decimal('origin_lng', 11, 8)->after('origin_lat');
            
            $table->string('destination_address')->after('origin_lng');
            $table->decimal('destination_lat', 10, 8)->after('destination_address');
            $table->decimal('destination_lng', 11, 8)->after('destination_lat');
            
            // Add departure timestamp for sorting
            $table->timestamp('departure_timestamp')->nullable()->after('destination_lng');
            
            // Add indexes for location-based searches
            $table->index(['origin_lat', 'origin_lng']);
            $table->index(['destination_lat', 'destination_lng']);
            $table->index('departure_timestamp');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('carpool_rides', function (Blueprint $table) {
            // Add back old columns
            $table->string('from_city')->after('driver_id');
            $table->string('to_city')->after('from_city');
            
            // Remove new columns
            $table->dropForeign(['vehicle_id']);
            $table->dropColumn([
                'vehicle_id',
                'origin_address', 'origin_lat', 'origin_lng',
                'destination_address', 'destination_lat', 'destination_lng',
                'departure_timestamp'
            ]);
        });
    }
};
