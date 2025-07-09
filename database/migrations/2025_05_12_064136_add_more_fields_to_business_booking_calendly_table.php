<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('business_booking_calendly', function (Blueprint $table) {
            $table->string('cancel_url')->nullable()->after('cancel_reason');
            $table->string('reschedule_url')->nullable()->after('cancel_url');
            $table->string('location')->nullable()->after('reschedule_url');
            $table->datetime('canceled_at')->nullable()->after('location');
            $table->string('canceler_name')->nullable()->after('canceled_at');
            $table->string('payment_status')->default('unpaid')->after('status');
        });
    }

    public function down()
    {
        Schema::table('business_booking_calendly', function (Blueprint $table) {
            $table->dropColumn([
                'cancel_url',
                'reschedule_url',
                'location',
                'canceled_at',
                'canceler_name',
                'payment_status'
            ]);
        });
    }
};