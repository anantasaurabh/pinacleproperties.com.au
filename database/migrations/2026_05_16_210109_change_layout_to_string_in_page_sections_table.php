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
            $table->string('layout')->default('grid')->change();
        });
    }

    public function down(): void
    {
        Schema::table('page_sections', function (Blueprint $table) {
            $table->enum('layout', [
                'small-image','large-image','list','list-numbered',
                'grid','grid-numbered','slider','tabs','faq'
            ])->default('grid')->change();
        });
    }
};
