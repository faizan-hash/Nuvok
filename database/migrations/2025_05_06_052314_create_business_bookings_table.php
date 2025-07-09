<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('business_bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('business_clients');
            $table->string('title');
            $table->text('description')->nullable();
            $table->datetime('start_time');
            $table->datetime('end_time');
            $table->string('timezone')->default('UTC');
            $table->string('status')->default('scheduled');
            $table->string('meeting_link')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('business_bookings');
    }
};