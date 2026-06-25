<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class Customers extends Authenticatable
{
    use HasFactory;

    protected $guard = 'customers';

    protected $fillable = [
        'first_name',
        'last_name',
        'contact_number',
        'email',
        'password',
        'nationality',
        'country_of_residence',
        'status'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

}
