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
        Schema::create('business_booking_client', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id')->constrained('business_bookings')->cascadeOnDelete();
            $table->foreignId('client_id')->constrained('business_clients')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('business_booking_client');
    }
};
