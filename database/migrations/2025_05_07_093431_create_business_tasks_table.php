<<<<<<< HEAD
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('business_tasks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('project_id')->nullable();

           $table->foreignId('job_type_id')->constrained('business_jobs_checklist')->onDelete('cascade'); 

           
            $table->string('initial_task_image')->nullable(); // NEW
            $table->string('completed_task_image')->nullable(); // NEW

            $table->string('title');
            $table->text('description')->nullable();
            $table->date('starting_date')->nullable();
            $table->date('due_date')->nullable();

            $table->foreignId('priority_id')->constrained('business_priorities')->onDelete('cascade');
            $table->foreignId('status_id')->constrained('business_statuses')->onDelete('cascade');

            $table->timestamps();
        });

        // Optional: pivot table for assigned users (clients)
        Schema::create('business_task_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('business_task_id')->constrained('business_tasks')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('business_clients')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('business_task_user');
        Schema::dropIfExists('business_tasks');
    }
};
=======
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('business_tasks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('project_id')->nullable();

           $table->foreignId('job_type_id')->constrained('business_jobs_checklist')->onDelete('cascade'); 

           
            $table->string('initial_task_image')->nullable(); // NEW
            $table->string('completed_task_image')->nullable(); // NEW

            $table->string('title');
            $table->text('description')->nullable();
            $table->date('starting_date')->nullable();
            $table->date('due_date')->nullable();

            $table->foreignId('priority_id')->constrained('business_priorities')->onDelete('cascade');
            $table->foreignId('status_id')->constrained('business_statuses')->onDelete('cascade');

            $table->timestamps();
        });

        // Optional: pivot table for assigned users (clients)
        Schema::create('business_task_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('business_task_id')->constrained('business_tasks')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('business_clients')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('business_task_user');
        Schema::dropIfExists('business_tasks');
    }
};
>>>>>>> f4799b86f474e344473c5131907406fc349bf0dc
