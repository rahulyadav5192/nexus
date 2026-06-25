<?php

use Illuminate\Database\Migrations\Migration;
use App\Models\MetaTags;

return new class extends Migration
{
    public function up(): void
    {
        $pages = [
            1 => [
                'page_name' => 'Home',
                'tag' => 'Nexus Group Holdings — Gold, Luxury & Global Investments',
                'description' => 'Nexus Group Holdings LLC — a diversified, vertically integrated group spanning gold sourcing, refining, jewelry manufacturing, retail and strategic investments across the UAE and Africa.',
            ],
            2 => [
                'page_name' => 'Group (About)',
                'tag' => 'About — Nexus Group Holdings',
                'description' => 'Building a legacy beyond gold. From a 2021 Sharjah bullion firm to a vertically integrated global group across sourcing, refining, manufacturing, retail and investments.',
            ],
            3 => [
                'page_name' => 'Privacy Policy',
                'tag' => 'Privacy Policy — Nexus Group Holdings',
                'description' => 'Privacy Policy for Nexus Group Holdings. Legal information and terms.',
            ],
            4 => [
                'page_name' => 'Terms & Conditions',
                'tag' => 'Terms & Conditions — Nexus Group Holdings',
                'description' => 'Terms & Conditions for Nexus Group Holdings. Legal information and terms.',
            ],
            5 => [
                'page_name' => 'Companies',
                'tag' => 'Group Companies — Nexus Group Holdings',
                'description' => 'A diversified portfolio of operating companies working together within a vertically integrated ecosystem — Nexus Bullion, Nexus Gold & Diamonds, Regalia, Nexus Chains, NEXCORP Africa and the Uganda Refinery.',
            ],
            6 => [
                'page_name' => 'Operations',
                'tag' => 'Operations — Nexus Group Holdings',
                'description' => "The Group's operations across the gold value chain — sourcing, refining, manufacturing, wholesale, retail and investment.",
            ],
            7 => [
                'page_name' => 'Contact Us',
                'tag' => 'Contact — Nexus Group Holdings',
                'description' => "Let's build the future together. Corporate office in Dubai, UAE. Business enquiries and partnerships with Nexus Group Holdings.",
            ],
            8 => [
                'page_name' => 'Expansion',
                'tag' => 'Expansion & Global Presence — Nexus Group Holdings',
                'description' => 'Expanding across borders. A three-phase roadmap from UAE consolidation to GCC expansion, international markets and IPO readiness by 2030.',
            ],
            9 => [
                'page_name' => 'Investors',
                'tag' => 'Investors — Nexus Group Holdings',
                'description' => 'Building sustainable long-term value. A vertically integrated model combining precious-metal assets with strategic participation in global financial markets.',
            ],
            10 => [
                'page_name' => 'Leadership',
                'tag' => 'Leadership — Nexus Group Holdings',
                'description' => 'Leadership driving global growth — the founders, promoters and directors of Nexus Group Holdings.',
            ],
            11 => [
                'page_name' => 'Careers',
                'tag' => 'Careers — Nexus Group Holdings',
                'description' => 'Build your future with Nexus. International exposure, growth opportunities and long-term career development across a fast-growing global group.',
            ],
            12 => [
                'page_name' => 'Insights (Blog)',
                'tag' => 'Insights — Nexus Group Holdings',
                'description' => 'Company news, expansion updates, investment insights and gold-market commentary from Nexus Group Holdings.',
            ],
            13 => [
                'page_name' => 'Disclosures',
                'tag' => 'Disclosures — Nexus Group Holdings',
                'description' => 'Disclosures for Nexus Group Holdings. Legal information and terms.',
            ],
        ];

        foreach ($pages as $pageNumber => $data) {
            MetaTags::updateOrCreate(
                ['page' => $pageNumber],
                array_merge($data, [
                    'page' => $pageNumber,
                    'status' => 1,
                ])
            );
        }
    }

    public function down(): void
    {
        MetaTags::whereIn('page', [5, 6, 8, 9, 10, 11, 12, 13])->delete();
    }
};
