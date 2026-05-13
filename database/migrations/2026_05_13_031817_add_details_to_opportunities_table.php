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
        Schema::table('opportunities', function (Blueprint $table) {
            $table->string('slug')->unique()->nullable()->after('title');
            $table->text('description')->nullable()->after('short_description');
            $table->string('type')->nullable()->after('price_range'); // e.g. Apartment, House, Land
            $table->string('status')->default('Available')->after('type'); // Available, Sold, Under Offer
            $table->decimal('map_lat', 10, 8)->nullable()->after('status');
            $table->decimal('map_lng', 11, 8)->nullable()->after('map_lat');
            $table->string('address')->nullable()->after('location');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('opportunities', function (Blueprint $table) {
            $table->dropColumn(['slug', 'description', 'type', 'status', 'map_lat', 'map_lng', 'address']);
        });
    }
};
