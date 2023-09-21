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
        Schema::create('ventures', function (Blueprint $table) {
            $table->id();
            $table->string('venture_name');
            $table->string('venture_name_slug')->unique();
            $table->text('venture_description')->nullable();
            $table->integer('number_of_plot', false);
            $table->float('per_square_feet_price', 8, 2);
            $table->string('venture_brochure')->nullable();
            $table->string('venture_layout')->nullable();
            $table->tinyInteger('active_status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ventures');
    }
};
