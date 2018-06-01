<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model {
    //

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'orders';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [

        'email',
        'bestelling',
        'rejected',
        'dategetorder',
        'hide'
    ];

    public function user() {
        return $this->belongsTo('App\Models\User', 'email', 'email');
    }

}
