<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogSections extends Model
{
    use HasFactory;
    protected $fillable = [
        'blog_id', 'title', 'description', 'section_image', 'order_no', 'status'
    ];
}
