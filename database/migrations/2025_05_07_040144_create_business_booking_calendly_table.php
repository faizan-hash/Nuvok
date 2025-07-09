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
        Schema::create('business_booking_calendly', function (Blueprint $table) {
            $table->id();
            $table->string('calendly_event_id');
            $table->string('event_type');
            $table->string('invitee_name');
            $table->string('invitee_email');
            $table->text('invitee_details')->nullable();
            $table->datetime('start_time');
            $table->datetime('end_time');
            $table->string('status')->default('scheduled');
            $table->text('cancel_reason')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('business_booking_calendly');
    }
};
