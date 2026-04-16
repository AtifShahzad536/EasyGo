<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('drivers', function (Blueprint $table) {
            $table->id();

            // Authentication
            $table->string('full_name');
            $table->string('mobile_number', 20)->unique();
            $table->string('password');
            $table->string('email')->nullable()->unique();
            $table->string('profile_photo')->nullable();
            $table->string('cnic', 15)->unique();               // Pakistani National ID
            $table->string('session_token')->nullable();
            $table->rememberToken();

            // KYC Verification status
            $table->enum('kyc_status', ['pending', 'in_review', 'approved', 'rejected'])->default('pending');

            // Online/Offline Status
            $table->enum('status', ['offline', 'online', 'on_trip', 'suspended', 'banned'])->default('offline');
            $table->boolean('is_available')->default(false);

            // Vehicle Info
            $table->string('vehicle_make')->nullable();
            $table->string('vehicle_model')->nullable();
            $table->string('vehicle_color')->nullable();
            $table->string('vehicle_plate')->nullable();
            $table->enum('vehicle_type', ['bike', 'auto', 'economy_car', 'comfort_car'])->nullable();
            $table->year('vehicle_year')->nullable();

            // Location (last known)
            $table->decimal('current_lat', 10, 7)->nullable();
            $table->decimal('current_lng', 10, 7)->nullable();

            // Earnings
            $table->decimal('wallet_balance', 10, 2)->default(0.00);
            $table->decimal('total_earnings', 12, 2)->default(0.00);

            // Rating & Trips
            $table->decimal('average_rating', 3, 2)->default(0.00);
            $table->integer('total_trips')->default(0);
            $table->integer('cancellation_count')->default(0);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('drivers');
    }
};
