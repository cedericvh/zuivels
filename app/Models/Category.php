<?php

namespace App\Models;

use Baum\Node;

class Category extends Node {
    protected $table = 'categories';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function products() {
        return $this->belongsToMany('App\Models\Product', 'products_categories', 'product_id', 'category_id');
    }
}
