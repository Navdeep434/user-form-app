<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserForm extends Model
{
    use HasFactory;
    protected $fillable = [
        'profile_image', 'name', 'phone', 'email',
        'street_address', 'city', 'state', 'country'
    ];
}

