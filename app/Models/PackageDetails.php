<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackageDetails extends Model
{
    use HasFactory;
      protected $fillable = [
        'package_type_id','artist_id', 'rate', 'package_name','sets', 'duration','includes_excludes','status'
    ];
}
