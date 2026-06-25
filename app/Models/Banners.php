<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banners extends Model
{
    use HasFactory;

    protected $fillable = [
        'title_en',
        'title_ar',
        'image',
        'status',
        'order_no',
        'is_button',
        'description_en',
        'description_ar',
        'button_link_en',
        'button_link_ar'
    ];
}
