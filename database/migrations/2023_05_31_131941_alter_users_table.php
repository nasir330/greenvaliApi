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
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('name');
            $table->unsignedBigInteger('role_id')->after('id')->default(3);
            $table->string('first_name')->after('role_id');
            $table->string('last_name')->after('first_name')->nullable();

            $table->foreign('role_id')
                ->references('id')
                ->on('user_roles');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('name');
            $table->dropColumn('role_id');
            $table->dropColumn('first_name');
            $table->dropColumn('last_name');
        });
    }
};
