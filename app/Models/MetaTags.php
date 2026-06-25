<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MetaTags extends Model
{
    use HasFactory;

    protected $fillable = [
        'page', 'page_name', 'tag', 'description', 'category_id', 'item_id', 'course_id','blog_id', 'slug', 'status','blog_category_id'
    ];

    public static function getTagById($id){
    	$meta_tag	= MetaTags::find($id);
    	if($meta_tag){
    		return $meta_tag;
    	}else{
    		return null;
    	}
    }

    public static function forPage(int $page): ?self
    {
        return static::where('page', $page)->first();
    }
}
