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
        Schema::table('plans', function (Blueprint $table) {
            $table->integer('business_invoices_limit')->default(0)->after('ai_models');
            $table->integer('business_clients_limit')->default(0)->after('business_invoices_limit');
            $table->integer('business_projects_limit')->default(0)->after('business_clients_limit');
            $table->integer('business_tasks_limit')->default(0)->after('business_projects_limit');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('plans', function (Blueprint $table) {
            $table->dropColumn(['business_invoices_limit', 'business_clients_limit', 'business_projects_limit', 'business_tasks_limit']);
        });
    }
};
