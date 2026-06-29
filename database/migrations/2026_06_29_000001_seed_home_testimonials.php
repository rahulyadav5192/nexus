<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use App\Models\Testimonials;

return new class extends Migration
{
    public function up(): void
    {
        if (Testimonials::exists()) {
            return;
        }

        $items = [
            [
                'person_name' => 'Mohammed Al Rashidi',
                'designation' => 'Wholesale Partner — Dubai',
                'quotes' => 'Working with Nexus Group Holdings has been a seamless experience from day one. Their direct sourcing from Africa and the quality of gold they deliver to our wholesale operations is consistently exceptional. A partner you can genuinely rely on.',
                'order_no' => 1,
                'status' => 1,
            ],
            [
                'person_name' => 'Priya & Anand Menon',
                'designation' => 'Retail Clients — Sharjah',
                'quotes' => 'We purchased our wedding jewelry from the Sharjah showroom and were blown away by the craftsmanship and the personalised service. The team guided us through every detail with patience and expertise. We couldn\'t have asked for more.',
                'order_no' => 2,
                'status' => 1,
            ],
            [
                'person_name' => 'Faisal Al Hamdan',
                'designation' => 'Strategic Investor — UAE',
                'quotes' => 'What impressed me most about Nexus is their vertical integration — from mine to market under one group. The transparency in operations and their disciplined expansion roadmap gave me real confidence as an early-stage investor.',
                'order_no' => 3,
                'status' => 1,
            ],
        ];

        $now = now();
        foreach ($items as $item) {
            $item['created_at'] = $now;
            $item['updated_at'] = $now;
            DB::table('testimonials')->insert($item);
        }
    }

    public function down(): void
    {
        DB::table('testimonials')->whereIn('person_name', [
            'Mohammed Al Rashidi',
            'Priya & Anand Menon',
            'Faisal Al Hamdan',
        ])->delete();
    }
};
