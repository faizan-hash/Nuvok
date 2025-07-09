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
       // invoice_tax table
       Schema::create('business_invoice_tax', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('invoice_id');
        $table->unsignedBigInteger('tax_id');
        $table->foreign('invoice_id')->references('id')->on('business_invoices')->onDelete('cascade');
        $table->foreign('tax_id')->references('id')->on('business_taxes')->onDelete('cascade');
    });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('business_invoice_tax');
    }
};
