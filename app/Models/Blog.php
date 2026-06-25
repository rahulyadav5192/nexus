<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'blog_name',
        'slug',
        'blog_date',
        'blog_image',
        'short_description',
        'content',
        'meta_label',
        'read_time',
        'is_featured',
        'order_no',
        'status',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'blog_date' => 'date',
    ];

    public function category()
    {
        return $this->belongsTo(BlogCategory::class, 'category_id');
    }

    public function sections()
    {
        return $this->hasMany(BlogSections::class, 'blog_id')->where('status', 1)->orderBy('order_no');
    }

    public function imageUrl(): string
    {
        if (!$this->blog_image) {
            return asset('nexus/images/nexus-logo.webp');
        }

        if (Str::startsWith($this->blog_image, ['http://', 'https://'])) {
            return $this->blog_image;
        }

        return asset('uploads/blogs/' . $this->blog_image);
    }

    public function detailUrl(): string
    {
        $slug = $this->slug;

        return route('blogs.details', $slug ?: $this->id);
    }

    public function displayMeta(): string
    {
        $parts = array_filter([
            $this->meta_label,
            $this->blog_date ? $this->blog_date->format('Y') : null,
            $this->read_time,
        ]);

        return implode(' · ', $parts);
    }

    public static function generateSlug(string $name, ?int $ignoreId = null): string
    {
        $base = Str::slug($name);
        $slug = $base;
        $counter = 1;

        while (
            static::where('slug', $slug)
                ->when($ignoreId, fn ($query) => $query->where('id', '!=', $ignoreId))
                ->exists()
        ) {
            $slug = $base . '-' . $counter;
            $counter++;
        }

        return $slug;
    }
}
