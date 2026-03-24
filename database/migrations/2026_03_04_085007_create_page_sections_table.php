<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('page_sections', function (Blueprint $table) {
            $table->id();
            $table->foreignId('page_id')->constrained()->cascadeOnDelete();
            $table->string('kicker_text')->nullable();
            $table->string('title')->nullable();
            $table->text('lead_text')->nullable();
            $table->longText('content')->nullable();
            $table->json('links')->nullable(); // [{text, link}]
            $table->enum('layout', [
                'small-image','large-image','list','list-numbered',
                'grid','grid-numbered','slider','tabs','faq'
            ])->default('grid');
            $table->integer('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('page_sections');
    }
};
