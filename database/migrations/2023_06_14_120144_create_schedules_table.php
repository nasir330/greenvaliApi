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
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('venture_id');
            $table->unsignedBigInteger('user_id');
            $table->string('schedule_title');
            $table->date('schedule_date');
            $table->time('schedule_time');
            $table->string('schedule_description');
            $table->timestamps();

            $table->foreign('venture_id')
                ->references('id')
                ->on('ventures');
            $table->foreign('user_id')
                ->references('id')
                ->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedules');
    }
};
