<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Frontend\Concerns\ResolvesPageMeta;

use Illuminate\Http\Request;

use App\Models\ContactDetails;
use App\Models\MetaTags;
use App\Models\BlogCategory;
use App\Models\Blog;
use App\Models\BlogSections;
use Illuminate\Support\Facades\DB;

class BlogsController extends Controller
{
    use ResolvesPageMeta;

    public function __construct()
    {
        date_default_timezone_set('Asia/Dubai');
    }

    public function index(Request $request)
    {
        $meta_tags = $this->pageMeta('blogs');
        $blog_categories = BlogCategory::where('status', 1)->orderBy('order_no', 'ASC')->get();

        $categoryFilter = $request->query('category');
        $categoryId = null;

        if ($categoryFilter) {
            if (is_numeric($categoryFilter)) {
                $categoryId = (int) $categoryFilter;
            } else {
                $category = BlogCategory::where('slug', $categoryFilter)->where('status', 1)->first();
                if ($category) {
                    $categoryId = $category->id;
                }
            }
        }

        $blogsQuery = Blog::with('category')
            ->where('blogs.status', 1)
            ->orderBy('blogs.order_no', 'ASC');

        if ($categoryId) {
            $blogsQuery->where('blogs.category_id', $categoryId);
        }

        $allBlogs = $blogsQuery->get();
        $featuredBlog = $allBlogs->firstWhere('is_featured', true) ?? $allBlogs->first();
        $gridBlogs = $allBlogs->filter(function ($blog) use ($featuredBlog) {
            return !$featuredBlog || $blog->id !== $featuredBlog->id;
        })->values();

        return view('frontend.nexus.blog', compact(
            'meta_tags',
            'blog_categories',
            'featuredBlog',
            'gridBlogs',
            'categoryId'
        ));
    }

    public function details($blog_id)
    {
        $contact_details = ContactDetails::find(1);
        $blog = $this->resolveBlog($blog_id);

        if (!$blog) {
            return view('frontend.page_not_found', compact('contact_details'));
        }

        $blog_categories = BlogCategory::where('status', 1)->orderBy('order_no', 'ASC')->get();
        $blog_sections = BlogSections::where('blog_id', $blog->id)->where('status', 1)->orderBy('order_no', 'ASC')->get();
        $meta_tags = MetaTags::where('status', 1)->where('blog_id', $blog->id)->first();

        $relatedBlogs = Blog::with('category')
            ->where('status', 1)
            ->where('id', '<>', $blog->id)
            ->orderBy('order_no', 'ASC')
            ->limit(3)
            ->get();

        return view('frontend.nexus.blog-post', compact(
            'contact_details',
            'meta_tags',
            'blog_categories',
            'blog',
            'blog_sections',
            'relatedBlogs'
        ));
    }

    public function ShowCategoryWiseBlogs($category_id)
    {
        $contact_details = ContactDetails::find(1);

        if (!is_numeric($category_id)) {
            $category = BlogCategory::where('slug', $category_id)->where('status', 1)->first();
            if (!$category) {
                $meta_details = MetaTags::where('slug', $category_id)->where('status', 1)->first();
                if ($meta_details && $meta_details->blog_category_id) {
                    $category_id = $meta_details->blog_category_id;
                } else {
                    return view('frontend.page_not_found', compact('contact_details'));
                }
            } else {
                $category_id = $category->id;
            }
        }

        return redirect()->route('blogs', ['category' => $category_id]);
    }

    protected function resolveBlog($blog_id): ?Blog
    {
        if (is_numeric($blog_id)) {
            return Blog::with('category')->where('status', 1)->find($blog_id);
        }

        $blog = Blog::with('category')->where('status', 1)->where('slug', $blog_id)->first();
        if ($blog) {
            return $blog;
        }

        $meta_details = MetaTags::where('slug', $blog_id)->where('status', 1)->first();
        if ($meta_details && $meta_details->blog_id) {
            return Blog::with('category')->where('status', 1)->find($meta_details->blog_id);
        }

        return null;
    }
}
