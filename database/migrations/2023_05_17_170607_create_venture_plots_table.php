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
        Schema::create('venture_plots', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('venture_id')->comment('FK of table:ventures');
            $table->integer('plot_id', false);
            $table->string('plot_name');
            $table->float('number_of_square_feet')->nullable();
            $table->float('total_price')->nullable();
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->unsignedBigInteger('staff_id')->nullable();
            $table->date('sale_date')->nullable();
            $table->date('handover_date')->nullable();
            $table->timestamps();

            $table->foreign('customer_id')
                ->references('id')
                ->on('users');

            $table->foreign('staff_id')
                ->references('id')
                ->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('venture_plots');
    }
};
