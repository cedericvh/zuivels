<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shippinground extends Model {

    protected $fillable = [
        'name',
        'description',
        'extra_remark',
        'file1',
        'file2',
        'file3',
        'sorting_id'
    ];
  
  
  
     /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function addresses() {
        return $this->hasMany('App\Models\Address');
    }

  
  
}
