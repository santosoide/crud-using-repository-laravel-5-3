<?php

namespace App\Domain\Entities;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = [
        'name', 'email', 'address', 'phone',
    ];

}
