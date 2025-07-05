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
        Schema::create('business_projects', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->date('starting_date')->nullable();
            $table->date('ending_date')->nullable();
            $table->decimal('budget', 15, 2)->nullable();
            $table->unsignedTinyInteger('status_id')->default(1); 
            // User who works on the project
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('business_clients')->onDelete('set null');
        
            // Client who owns the project
            $table->unsignedBigInteger('client_id')->nullable();
            $table->foreign('client_id')->references('id')->on('business_clients')->onDelete('set null');
        
            $table->timestamps();
        });        
    }

    public function down(): void {
        Schema::dropIfExists('business_projects');
    }
};
