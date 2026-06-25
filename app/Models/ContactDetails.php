<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactDetails extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *	
     * @var array
     */
    protected $fillable = [
        'mobile', 'email', 'facebook', 'twitter', 'google_plus', 'linked_in', 'skype', 'address','youtube','instagram'
    ];
}
