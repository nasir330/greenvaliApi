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
        Schema::table('ventures', function (Blueprint $table) {
            $table->longText('highlights')->nullable()->after('venture_layout');
            $table->longText('near_by_infos')->nullable()->after('highlights');
            $table->double('latitude')->nullable()->after('near_by_infos');
            $table->double('longitude')->nullable()->after('latitude');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ventures', function (Blueprint $table) {
            $table->dropColumn('highlights');
            $table->dropColumn('near_by_infos');
            $table->dropColumn('latitude');
            $table->dropColumn('longitude');
        });
    }
};
