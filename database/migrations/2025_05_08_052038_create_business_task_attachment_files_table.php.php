<?php

// database/migrations/2024_05_08_000002_create_business_task_attachment_files_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('business_task_attachment_files', function (Blueprint $table) {
            $table->id();
            $table->foreignId('task_id')->constrained('business_tasks')->onDelete('cascade');
            $table->string('file_path');
            $table->string('file_name');
            $table->string('mime_type')->nullable();
            $table->bigInteger('file_size')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('business_task_attachment_files');
    }
};
