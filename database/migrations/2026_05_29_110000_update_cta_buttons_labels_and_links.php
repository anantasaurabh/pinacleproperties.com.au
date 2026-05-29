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
        // 1. Update NavItem ID 18 label to 'Speak to a Property Advisor' and link to '/contact'
        DB::table('nav_items')
            ->where('id', 18)
            ->update([
                'label' => 'Speak to a Property Advisor',
                'link' => '/contact'
            ]);

        // 2. Update PageBlock ID 35 content to replace 'https://calendly.com/pinnacle-group' with 'https://calendly.com/brandodigital-support/30min'
        // and 'Book Consultation' with 'Book a Free Consultation'
        $block = DB::table('page_blocks')->where('id', 35)->first();
        if ($block) {
            $newContent = str_replace(
                ['https://calendly.com/pinnacle-group', 'Book Consultation'],
                ['https://calendly.com/brandodigital-support/30min', 'Book a Free Consultation'],
                $block->content
            );
            DB::table('page_blocks')->where('id', 35)->update(['content' => $newContent]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('nav_items')
            ->where('id', 18)
            ->update([
                'label' => 'Talk to Expert',
                'link' => '/talk-to-expert'
            ]);

        $block = DB::table('page_blocks')->where('id', 35)->first();
        if ($block) {
            $newContent = str_replace(
                ['https://calendly.com/brandodigital-support/30min', 'Book a Free Consultation'],
                ['https://calendly.com/pinnacle-group', 'Book Consultation'],
                $block->content
            );
            DB::table('page_blocks')->where('id', 35)->update(['content' => $newContent]);
        }
    }
};
