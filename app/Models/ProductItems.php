<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductItems extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'name_ar',
        'category_tag',
        'category_slug',
        'image',
        'image_alt',
        'description',
        'description_ar',
        'short_description',
        'short_description_ar',
        'bullet_points',
        'highlights',
        'order_no',
        'reveal_delay',
        'status',
    ];

    protected $casts = [
        'bullet_points' => 'array',
        'highlights' => 'array',
        'status' => 'integer',
    ];

    public function getImageUrlAttribute(): string
    {
        $image = $this->image ?? '';

        if ($image === '') {
            return '';
        }

        if (filter_var($image, FILTER_VALIDATE_URL)) {
            return $image;
        }

        if (str_starts_with($image, 'nexus/')) {
            return asset($image);
        }

        return asset('uploads/product_items/' . $image);
    }
}
