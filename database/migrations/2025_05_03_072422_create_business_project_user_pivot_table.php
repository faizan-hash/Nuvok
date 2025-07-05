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
     // In database/migrations/xxxx_create_business_project_user_pivot_table.php
        Schema::create('business_project_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('business_project_id')->constrained()->onDelete('cascade');
            $table->foreignId('business_client_id')->constrained('business_clients')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('business_project_user_pivot');
    }
};
