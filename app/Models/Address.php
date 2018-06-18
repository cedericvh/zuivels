<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model {

    protected $fillable = [
        'user_id',
        'country',
        'city',
        'address1',
        'address2'
    ];
}
