<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('business_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->timestamps();
        });

        // Default statuses
        DB::table('business_statuses')->insert([
            ['title' => 'To Do'],
            ['title' => 'In Progress'],
            ['title' => 'In Review'],
            ['title' => 'Completed'],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('business_statuses');
    }
};
