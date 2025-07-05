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
        Schema::create('business_invoices', function (Blueprint $table) {
            $table->id();
            $table->date('invoice_date');
            $table->date('due_date');
            $table->tinyInteger('status')->default(0); // 0=Due,1=Paid,2=Overdue
            $table->unsignedBigInteger('to_id'); // Client ID
            $table->text('note')->nullable();
            $table->boolean('send_email_notification')->default(false);
            $table->timestamps();
        
            $table->foreign('to_id')->references('id')->on('business_clients')->onDelete('cascade');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('business_invoices');
    }
};
