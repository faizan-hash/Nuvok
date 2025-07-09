<?php

// app/Console/Commands/CleanupBusinessData.php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CleanupBusinessData extends Command
{
    protected $signature = 'cleanup:business';
    protected $description = 'Destroy business tables, models, controllers, and views after 30 days';

    public function handle()
    {
        // 1. Drop Tables
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('business_task_user');
        Schema::dropIfExists('business_tasks');
        Schema::dropIfExists('business_clients');
        Schema::enableForeignKeyConstraints();
        $this->info('Tables dropped successfully.');

        // 2. Delete Models
        $models = ['app/Models/BusinessClient.php', 'app/Models/BusinessTask.php'];
        foreach ($models as $model) {
            if (File::exists(base_path($model))) {
                File::delete(base_path($model));
                $this->info("Deleted model: $model");
            }
        }

        // 3. Delete Controllers
        $controllers = [
            'app/Http/Controllers/Business/ClientController.php',
            'app/Http/Controllers/Business/BusinessTaskController.php',
        ];
        foreach ($controllers as $controller) {
            if (File::exists(base_path($controller))) {
                File::delete(base_path($controller));
                $this->info("Deleted controller: $controller");
            }
        }

        // 4. Delete Views
        $viewPaths = [
            'resources/views/default/panel/business/task',
            'resources/views/default/panel/business/clients',
        ];
        foreach ($viewPaths as $viewPath) {
            if (File::isDirectory(base_path($viewPath))) {
                File::deleteDirectory(base_path($viewPath));
                $this->info("Deleted views directory: $viewPath");
            }
        }

        return 0;
    }
}
