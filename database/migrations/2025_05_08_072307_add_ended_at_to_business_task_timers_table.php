<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('business_task_timers', function (Blueprint $table) {
            $table->timestamp('ended_at')->nullable()->after('end_time');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('business_task_timers', function (Blueprint $table) {
            $table->dropColumn('ended_at');
        });
    }
};
