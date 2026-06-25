<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\MetaTags;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('blog_categories', function (Blueprint $table) {
            if (!Schema::hasColumn('blog_categories', 'slug')) {
                $table->string('slug')->nullable()->after('category_name');
            }
        });

        Schema::table('blogs', function (Blueprint $table) {
            if (!Schema::hasColumn('blogs', 'slug')) {
                $table->string('slug')->nullable()->unique()->after('blog_name');
            }
            if (!Schema::hasColumn('blogs', 'is_featured')) {
                $table->boolean('is_featured')->default(false)->after('status');
            }
            if (!Schema::hasColumn('blogs', 'meta_label')) {
                $table->string('meta_label')->nullable()->after('is_featured');
            }
            if (!Schema::hasColumn('blogs', 'read_time')) {
                $table->string('read_time')->nullable()->after('meta_label');
            }
            if (!Schema::hasColumn('blogs', 'content')) {
                $table->longText('content')->nullable()->after('short_description');
            }
        });

        $this->seedNexusBlogData();
    }

    public function down(): void
    {
        Schema::table('blogs', function (Blueprint $table) {
            $columns = ['slug', 'is_featured', 'meta_label', 'read_time', 'content'];
            foreach ($columns as $column) {
                if (Schema::hasColumn('blogs', $column)) {
                    $table->dropColumn($column);
                }
            }
        });

        Schema::table('blog_categories', function (Blueprint $table) {
            if (Schema::hasColumn('blog_categories', 'slug')) {
                $table->dropColumn('slug');
            }
        });
    }

    private function seedNexusBlogData(): void
    {
        if (Blog::where('slug', 'phase-one-begins-dubai-flagship')->exists()) {
            return;
        }

        Blog::query()->update(['status' => 0]);

        $categories = [
            ['slug' => 'company', 'name' => 'Company News', 'order' => 1],
            ['slug' => 'expansion', 'name' => 'Expansion Updates', 'order' => 2],
            ['slug' => 'investment', 'name' => 'Investment Insights', 'order' => 3],
            ['slug' => 'gold', 'name' => 'Gold Market', 'order' => 4],
            ['slug' => 'manufacturing', 'name' => 'Manufacturing', 'order' => 5],
            ['slug' => 'corporate', 'name' => 'Corporate Announcements', 'order' => 6],
        ];

        $categoryIds = [];
        foreach ($categories as $category) {
            $record = BlogCategory::updateOrCreate(
                ['slug' => $category['slug']],
                [
                    'category_name' => $category['name'],
                    'order_no' => $category['order'],
                    'status' => 1,
                ]
            );
            $categoryIds[$category['slug']] = $record->id;
        }

        $featuredContent = <<<'HTML'
<p>Nexus Group Holdings has entered the first phase of its five-year roadmap &mdash; a period focused on consolidating the Group's position in the United Arab Emirates before its wider regional and international expansion. At the centre of this phase is a new flagship showroom in Dubai and the establishment of the Nexus Group HQ.</p>
<p>The Dubai headquarters is more than an office. It is designed as the strategic, fundraising and investment centre of the Group &mdash; bringing together retail oversight, a dedicated capital-markets function and centralised administration under one roof.</p>
<h2>A deliberate, vertical model</h2>
<p>What distinguishes Nexus is its vertically integrated structure. The Group sources gold directly at the mines in Africa, refines it through the NEXCORP plant in Uganda, manufactures through its Sharjah facility, and sells through its own retail and wholesale channels &mdash; capturing value at every stage.</p>
<blockquote>Every initiative is a deliberate step toward long-term value, sustainable growth and international leadership.</blockquote>
<p>Phase One also sees the launch of the Group's wholesale division for B2B supply, the commissioning of the Uganda elution plant, and the rollout of a full-stack e-commerce platform &mdash; laying the groundwork for showrooms in Ajman and Al Ain to follow.</p>
<h2>Looking ahead</h2>
<p>With the UAE foundation strengthened, the Group's attention turns to the GCC and, ultimately, to international markets and IPO readiness by 2030. The first phase is where that ambition becomes tangible.</p>
HTML;

        $blogs = [
            [
                'slug' => 'phase-one-begins-dubai-flagship',
                'blog_name' => 'Phase One begins: Dubai flagship and Group HQ anchor the next chapter',
                'category' => 'expansion',
                'short_description' => 'The Group enters its UAE-consolidation phase — a flagship Dubai showroom, a strategic investment-focused HQ, and the launch of the wholesale division.',
                'meta_label' => 'Corporate Announcement',
                'read_time' => '4 min read',
                'blog_date' => '2025-01-15',
                'blog_image' => 'https://images.pexels.com/photos/3183150/pexels-photo-3183150.jpeg?auto=compress&cs=tinysrgb&w=1200',
                'is_featured' => true,
                'content' => $featuredContent,
                'order_no' => 1,
            ],
            [
                'slug' => 'from-mine-to-market-vertical-integration',
                'blog_name' => 'From mine to market: the logic of vertical integration',
                'category' => 'gold',
                'short_description' => 'How Nexus captures value at every stage of the gold value chain.',
                'meta_label' => 'Insight',
                'read_time' => null,
                'blog_date' => '2025-02-10',
                'blog_image' => 'https://images.pexels.com/photos/844124/pexels-photo-844124.jpeg?auto=compress&cs=tinysrgb&w=1200',
                'is_featured' => false,
                'content' => null,
                'order_no' => 2,
            ],
            [
                'slug' => 'balancing-precious-metals-global-capital-markets',
                'blog_name' => 'Balancing precious metals with global capital markets',
                'category' => 'investment',
                'short_description' => 'A perspective on combining physical gold assets with strategic market participation.',
                'meta_label' => 'Investors',
                'read_time' => null,
                'blog_date' => '2025-03-05',
                'blog_image' => 'https://images.pexels.com/photos/265906/pexels-photo-265906.jpeg?auto=compress&cs=tinysrgb&w=1200',
                'is_featured' => false,
                'content' => null,
                'order_no' => 3,
            ],
            [
                'slug' => 'sharjah-chain-facility-90kg-capacity',
                'blog_name' => 'Inside the Sharjah chain facility: 90kg of capacity a month',
                'category' => 'manufacturing',
                'short_description' => 'A look inside Nexus Chains manufacturing operations in Sharjah.',
                'meta_label' => 'Operations',
                'read_time' => null,
                'blog_date' => '2025-03-20',
                'blog_image' => 'https://images.pexels.com/photos/5849577/pexels-photo-5849577.jpeg?auto=compress&cs=tinysrgb&w=1200',
                'is_featured' => false,
                'content' => null,
                'order_no' => 4,
            ],
            [
                'slug' => 'gcc-roadmap-saudi-bahrain-qatar',
                'blog_name' => 'The GCC roadmap: Saudi, Bahrain and Qatar on the horizon',
                'category' => 'expansion',
                'short_description' => 'The Group outlines its next phase of regional expansion across the GCC.',
                'meta_label' => 'Strategy',
                'read_time' => null,
                'blog_date' => '2025-04-01',
                'blog_image' => 'https://images.pexels.com/photos/3183150/pexels-photo-3183150.jpeg?auto=compress&cs=tinysrgb&w=1200',
                'is_featured' => false,
                'content' => null,
                'order_no' => 5,
            ],
            [
                'slug' => 'nexcorp-africa-sourcing-uganda-congo-rwanda',
                'blog_name' => 'NEXCORP Africa deepens sourcing across Uganda, Congo and Rwanda',
                'category' => 'company',
                'short_description' => 'Expanding direct mine relationships across East and Central Africa.',
                'meta_label' => 'Company',
                'read_time' => null,
                'blog_date' => '2024-11-12',
                'blog_image' => 'https://images.pexels.com/photos/6801648/pexels-photo-6801648.jpeg?auto=compress&cs=tinysrgb&w=1200',
                'is_featured' => false,
                'content' => null,
                'order_no' => 6,
            ],
            [
                'slug' => 'toward-2030-ipo-readiness',
                'blog_name' => 'Toward 2030: the Group sets its sights on IPO readiness',
                'category' => 'corporate',
                'short_description' => 'Long-term corporate strategy aligned with public-market readiness by 2030.',
                'meta_label' => 'Corporate',
                'read_time' => null,
                'blog_date' => '2025-05-08',
                'blog_image' => 'https://images.pexels.com/photos/2735970/pexels-photo-2735970.jpeg?auto=compress&cs=tinysrgb&w=1200',
                'is_featured' => false,
                'content' => null,
                'order_no' => 7,
            ],
            [
                'slug' => 'regalia-lightweight-luxury-brand',
                'blog_name' => 'Regalia: building a brand around lightweight luxury',
                'category' => 'company',
                'short_description' => 'How Regalia is positioning itself in the lightweight luxury segment.',
                'meta_label' => 'Brand',
                'read_time' => null,
                'blog_date' => '2024-09-18',
                'blog_image' => 'https://images.pexels.com/photos/2735970/pexels-photo-2735970.jpeg?auto=compress&cs=tinysrgb&w=1200',
                'is_featured' => false,
                'content' => null,
                'order_no' => 8,
            ],
            [
                'slug' => 'gold-anchor-diversified-portfolio',
                'blog_name' => 'Why gold remains the anchor of a diversified portfolio',
                'category' => 'gold',
                'short_description' => 'Gold market commentary on portfolio diversification and long-term value.',
                'meta_label' => 'Insight',
                'read_time' => null,
                'blog_date' => '2025-06-01',
                'blog_image' => 'https://images.pexels.com/photos/265906/pexels-photo-265906.jpeg?auto=compress&cs=tinysrgb&w=1200',
                'is_featured' => false,
                'content' => null,
                'order_no' => 9,
            ],
        ];

        foreach ($blogs as $blogData) {
            $blog = Blog::create([
                'category_id' => $categoryIds[$blogData['category']],
                'blog_name' => $blogData['blog_name'],
                'slug' => $blogData['slug'],
                'short_description' => $blogData['short_description'],
                'content' => $blogData['content'],
                'blog_image' => $blogData['blog_image'],
                'blog_date' => $blogData['blog_date'],
                'meta_label' => $blogData['meta_label'],
                'read_time' => $blogData['read_time'],
                'is_featured' => $blogData['is_featured'],
                'order_no' => $blogData['order_no'],
                'status' => 1,
            ]);

            MetaTags::updateOrCreate(
                ['blog_id' => $blog->id],
                [
                    'page_name' => $blog->blog_name,
                    'tag' => $blog->blog_name . ' — Nexus Group Holdings',
                    'description' => $blog->short_description,
                    'slug' => $blog->slug,
                    'status' => 1,
                ]
            );
        }
    }
};
