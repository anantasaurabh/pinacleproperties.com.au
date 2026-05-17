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
            $table->foreignId('agent_id')->nullable()->after('id')->constrained('agents')->nullOnDelete();
            $table->integer('bed')->nullable()->after('address');
            $table->integer('bath')->nullable()->after('bed');
            $table->integer('garage')->nullable()->after('bath');
            $table->string('area')->nullable()->after('garage');
            $table->string('block_width')->nullable()->after('area');
            $table->string('block_depth')->nullable()->after('block_width');
            $table->decimal('price', 12, 2)->nullable()->after('block_depth');
            $table->string('estate')->nullable()->after('price');
            $table->string('suburb')->nullable()->after('estate');
            $table->string('country')->nullable()->after('suburb'); // Storing QLD/VIC
            $table->string('plan_image')->nullable()->after('image');
            $table->json('images')->nullable()->after('plan_image');
            $table->string('brochure_pdf')->nullable()->after('images');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('opportunities', function (Blueprint $table) {
            $table->dropForeign(['agent_id']);
            $table->dropColumn([
                'agent_id', 'bed', 'bath', 'garage', 'area',
                'block_width', 'block_depth', 'price', 'estate',
                'suburb', 'country', 'plan_image', 'images', 'brochure_pdf'
            ]);
        });
    }
};
