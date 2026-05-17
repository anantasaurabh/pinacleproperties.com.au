<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::table('nav_items')
            ->where('link', '/properties')
            ->update([
                'link' => '/house-and-land-packages',
                'label' => 'House & Land Packages'
            ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('nav_items')
            ->where('link', '/house-and-land-packages')
            ->update([
                'link' => '/properties',
                'label' => 'Properties'
            ]);
    }
};
