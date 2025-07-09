<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('business_priorities', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->timestamps();
        });

        // Default priorities
        DB::table('business_priorities')->insert([
            ['title' => 'Low'],
            ['title' => 'Medium'],
            ['title' => 'High'],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('business_priorities');
    }
};
