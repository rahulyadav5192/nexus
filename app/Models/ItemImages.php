<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemImages extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_id', 'name', 'image','order_no', 'status', 'product_image_small'
    ];
}
