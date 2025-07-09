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
       // invoice_project table
       Schema::create('business_invoice_project', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('invoice_id');
        $table->unsignedBigInteger('project_id');
        $table->foreign('invoice_id')->references('id')->on('business_invoices')->onDelete('cascade');
        $table->foreign('project_id')->references('id')->on('business_projects')->onDelete('cascade');
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('business_invoice_project');
    }
};
