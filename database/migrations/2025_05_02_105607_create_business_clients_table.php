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
        Schema::create('business_clients', function (Blueprint $table) {
            $table->id();
            $table->string('avatar')->nullable();
            $table->string('first_name');
            $table->string('last_name')->nullable();
            $table->string('id_number')->unique();
            $table->string('company_name');
            $table->string('email')->unique();
            $table->string('mobile');
            $table->string('password');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('business_clients');
    }
};
