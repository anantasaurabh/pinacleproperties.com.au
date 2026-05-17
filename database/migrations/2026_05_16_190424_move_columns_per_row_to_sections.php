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
        Schema::table('page_sections', function (Blueprint $table) {
            $table->integer('columns_per_row')->default(3)->after('layout');
        });

        Schema::table('page_blocks', function (Blueprint $table) {
            $table->dropColumn('columns_per_row');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('page_blocks', function (Blueprint $table) {
            $table->integer('columns_per_row')->default(3);
        });

        Schema::table('page_sections', function (Blueprint $table) {
            $table->dropColumn('columns_per_row');
        });
    }
};
