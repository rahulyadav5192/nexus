<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use App\Models\ProductItems;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('product_items', function (Blueprint $table) {
            if (!Schema::hasColumn('product_items', 'category_tag')) {
                $table->string('category_tag')->nullable()->after('name');
            }
            if (!Schema::hasColumn('product_items', 'category_slug')) {
                $table->string('category_slug')->nullable()->after('category_tag');
            }
            if (!Schema::hasColumn('product_items', 'bullet_points')) {
                $table->json('bullet_points')->nullable()->after('short_description');
            }
            if (!Schema::hasColumn('product_items', 'highlights')) {
                $table->json('highlights')->nullable()->after('bullet_points');
            }
            if (!Schema::hasColumn('product_items', 'image_alt')) {
                $table->string('image_alt')->nullable()->after('image');
            }
            if (!Schema::hasColumn('product_items', 'reveal_delay')) {
                $table->string('reveal_delay')->nullable()->after('order_no');
            }
        });

        $this->seedOperationsDisciplines();
    }

    public function down(): void
    {
        Schema::table('product_items', function (Blueprint $table) {
            $columns = ['category_tag', 'category_slug', 'bullet_points', 'highlights', 'image_alt', 'reveal_delay'];
            foreach ($columns as $column) {
                if (Schema::hasColumn('product_items', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }

    private function seedOperationsDisciplines(): void
    {
        if (ProductItems::where('category_slug', 'sourcing')->exists()) {
            return;
        }

        DB::table('meta_tags')->whereNotNull('item_id')->delete();
        DB::table('product_items')->delete();

        $items = [
            [
                'name' => 'Gold Sourcing',
                'category_tag' => 'Gold Sourcing',
                'category_slug' => 'sourcing',
                'image' => 'nexus/images/nexcorp-internation.webp',
                'image_alt' => 'NEXCORP International Africa',
                'short_description' => 'Direct sourcing at the source through NEXCORP International – Africa, strengthening sourcing and trading operations across Uganda, Congo and Rwanda.',
                'bullet_points' => json_encode(['Uganda', 'Congo', 'Rwanda']),
                'highlights' => null,
                'description' => null,
                'status' => 1,
                'order_no' => 1,
                'reveal_delay' => null,
            ],
            [
                'name' => 'Refining Operations',
                'category_tag' => 'Refining',
                'category_slug' => 'refining',
                'image' => 'nexus/images/nexcorp-elution.webp',
                'image_alt' => 'NEXCORP Gold Elution Plant',
                'short_description' => 'The NEXCORP Gold Elution Plant in Uganda — a specialized facility for gold recovery from activated carbon. Currently operating at 2 tons per cycle, with an immediate expansion to 4 tons planned (100% capacity increase), maximizing gold recovery efficiency and supply reliability.',
                'bullet_points' => json_encode([
                    '2 tons/cycle — current',
                    '4 tons/cycle — planned expansion',
                    'Raw gold processing & supply-chain integration',
                ]),
                'highlights' => null,
                'description' => null,
                'status' => 1,
                'order_no' => 2,
                'reveal_delay' => 'd1',
            ],
            [
                'name' => 'Manufacturing',
                'category_tag' => 'Manufacturing',
                'category_slug' => 'manufacturing',
                'image' => 'nexus/images/nexus-chains-manufacturing.webp',
                'image_alt' => 'Nexus Chains Manufacturing',
                'short_description' => 'An exclusive machine-driven chain manufacturing facility at Al Sarab Goldsmith, Sharjah — operating since 1996. Advanced technology combined with skilled craftsmanship delivers precision, efficiency and international finish standards.',
                'bullet_points' => null,
                'highlights' => json_encode([
                    ['value' => '3', 'suffix' => 'kg', 'label' => 'Daily chain production'],
                    ['value' => '90', 'suffix' => 'kg', 'label' => 'Monthly capacity'],
                ]),
                'description' => null,
                'status' => 1,
                'order_no' => 3,
                'reveal_delay' => 'd2',
            ],
            [
                'name' => 'Wholesale Distribution',
                'category_tag' => 'Wholesale',
                'category_slug' => 'wholesale',
                'image' => 'https://images.pexels.com/photos/2735970/pexels-photo-2735970.jpeg?auto=compress&cs=tinysrgb&w=1200',
                'image_alt' => 'Wholesale distribution',
                'short_description' => 'A growing regional B2B supply operation, distributing gold and diamond items to trade partners across the UAE and the wider Gulf.',
                'bullet_points' => json_encode(['B2B supply', 'Regional logistics', 'Trade partnerships']),
                'highlights' => null,
                'description' => null,
                'status' => 1,
                'order_no' => 4,
                'reveal_delay' => null,
            ],
            [
                'name' => 'Retail Operations',
                'category_tag' => 'Retail',
                'category_slug' => 'retail',
                'image' => 'nexus/images/nexus-gold-and-diamonds.webp',
                'image_alt' => 'Nexus Gold and Diamonds',
                'short_description' => 'Nexus Gold & Diamonds showrooms and the Regalia brand — offering gold, diamond and custom jewelry with premium service. Revenue streams include in-store sales, jewelry customization, buy-back programs and gold investment products. VIP membership and wedding & gift packages available.',
                'bullet_points' => json_encode([
                    'Shop No. 13, Sharjah — Gold Centre, Rolla',
                    'Shop No. 02, Safa Mall, Nesto Hypermarket, Nakheel — Ras Al Khaimah',
                    'Dubai 2026',
                    'Abu Dhabi 2027',
                    'Ajman 2027',
                ]),
                'highlights' => null,
                'description' => null,
                'status' => 1,
                'order_no' => 5,
                'reveal_delay' => 'd1',
            ],
            [
                'name' => 'Investment Division',
                'category_tag' => 'Investment',
                'category_slug' => 'investment',
                'image' => 'https://images.pexels.com/photos/5849577/pexels-photo-5849577.jpeg?auto=compress&cs=tinysrgb&w=1200',
                'image_alt' => 'Investment division',
                'short_description' => 'Strategic participation in global capital markets, managed from the Dubai Group HQ by a dedicated stock-market trading function.',
                'bullet_points' => json_encode([
                    'US Stocks',
                    'ETFs',
                    'Commodities',
                    'Strategic Investments',
                    'International Ventures',
                ]),
                'highlights' => null,
                'description' => null,
                'status' => 1,
                'order_no' => 6,
                'reveal_delay' => 'd2',
            ],
        ];

        $now = now();
        foreach ($items as $item) {
            $item['created_at'] = $now;
            $item['updated_at'] = $now;
            DB::table('product_items')->insert($item);
        }
    }
};
