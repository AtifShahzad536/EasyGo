<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('drivers', function (Blueprint $table) {
            // Remove vehicle fields (moved to vehicles table)
            $table->dropColumn([
                'vehicle_make',
                'vehicle_model',
                'vehicle_color',
                'vehicle_plate',
                'vehicle_type',
                'vehicle_year',
            ]);

            // Remove statistics fields (moved to driver_statistics table)
            $table->dropColumn([
                'wallet_balance',
                'total_earnings',
                'average_rating',
                'total_trips',
                'cancellation_count',
            ]);
        });
    }

    public function down(): void
    {
        Schema::table('drivers', function (Blueprint $table) {
            // Restore vehicle fields
            $table->string('vehicle_make')->nullable();
            $table->string('vehicle_model')->nullable();
            $table->string('vehicle_color')->nullable();
            $table->string('vehicle_plate')->nullable();
            $table->enum('vehicle_type', ['bike', 'auto', 'economy_car', 'comfort_car'])->nullable();
            $table->year('vehicle_year')->nullable();

            // Restore statistics fields
            $table->decimal('wallet_balance', 10, 2)->default(0.00);
            $table->decimal('total_earnings', 12, 2)->default(0.00);
            $table->decimal('average_rating', 3, 2)->default(0.00);
            $table->integer('total_trips')->default(0);
            $table->integer('cancellation_count')->default(0);
        });
    }
};
