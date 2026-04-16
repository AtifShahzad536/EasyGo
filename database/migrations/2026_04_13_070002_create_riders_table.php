<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('riders', function (Blueprint $table) {
            $table->id();

            // Authentication
            $table->string('full_name');
            $table->string('mobile_number', 20)->unique();
            $table->string('password');
            $table->string('email')->nullable()->unique();
            $table->string('profile_photo')->nullable();
            $table->string('session_token')->nullable();
            $table->rememberToken();

            // Profile Info
            $table->enum('gender', ['male', 'female', 'other'])->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('city')->nullable();

            // Status
            $table->enum('status', ['active', 'inactive', 'banned'])->default('active');

            // Wallet & Trips
            $table->decimal('wallet_balance', 10, 2)->default(0.00);
            $table->integer('total_trips')->default(0);
            $table->decimal('average_rating', 3, 2)->default(0.00);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('riders');
    }
};
