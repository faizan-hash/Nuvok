<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('business_clients', function (Blueprint $table) {
            $table->string('industry')->nullable()->after('password');
            $table->string('country')->nullable()->after('industry');
            $table->string('city')->nullable()->after('country');
            $table->text('purchase_history')->nullable()->after('city');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('business_clients', function (Blueprint $table) {
            $table->dropColumn(['industry', 'country', 'city', 'purchase_history']);
        });
    }
};