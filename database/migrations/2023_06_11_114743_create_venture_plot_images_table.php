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
        Schema::create('venture_plot_images', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('venture_id');
            $table->unsignedBigInteger('venture_plot_id');
            $table->string('plot_image');
            $table->timestamps();

            $table->foreign('venture_id')
                ->references('id')
                ->on('ventures');

            $table->foreign('venture_plot_id')
                ->references('id')
                ->on('venture_plots');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('venture_plot_images');
    }
};
