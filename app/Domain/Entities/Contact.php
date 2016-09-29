<?php

namespace App\Domain\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Contact
 * @package App\Domain\Entities
 */
class Contact extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'address', 'phone',
    ];

}
