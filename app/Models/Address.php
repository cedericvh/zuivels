<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model {

    protected $fillable = [
        'user_id',
        'country',
        'city',
        'address1',
        'address2',
        'telephone',
        'fax',
        'remark',
        'exists',
        'shippinground_id'
    ];
  
  
   /**
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
    public function user() {
        return $this->belongsTo('App\Models\User');
    }
  
  
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function shippinground() {
        return $this->belongsTo('App\Models\Shippinground');
    }  
  
}
