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
        Schema::table('business_invoices', function (Blueprint $table) {
            $table->text('payment_link')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('business_invoices', function (Blueprint $table) {
            // Revert to original string length if needed, or null out if not nullable before
            $table->string('payment_link', 255)->change(); 
        });
    }
};
