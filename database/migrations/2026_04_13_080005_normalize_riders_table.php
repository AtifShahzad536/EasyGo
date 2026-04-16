<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('riders', function (Blueprint $table) {
            // Remove statistics fields (moved to rider_statistics table)
            $table->dropColumn([
                'wallet_balance',
                'total_trips',
                'average_rating',
            ]);
        });
    }

    public function down(): void
    {
        Schema::table('riders', function (Blueprint $table) {
            // Restore statistics fields
            $table->decimal('wallet_balance', 10, 2)->default(0.00);
            $table->integer('total_trips')->default(0);
            $table->decimal('average_rating', 3, 2)->default(0.00);
        });
    }
};
