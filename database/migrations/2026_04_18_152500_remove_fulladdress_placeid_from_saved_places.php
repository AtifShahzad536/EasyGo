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
        Schema::table('saved_places', function (Blueprint $table) {
            $table->dropColumn(['full_address', 'place_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('saved_places', function (Blueprint $table) {
            $table->text('full_address')->nullable()->after('place_name');
            $table->string('place_id')->nullable()->after('longitude');
        });
    }
};
