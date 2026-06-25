<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StickyImages extends Model
{
    use HasFactory;
    protected $fillable = [
        'title', 'image', 'button_link','status','product_id'
    ];
}
