<?php

namespace App\Models;

use Baum\Node;

class Category extends Node {
    protected $fillable = ['title', 'sorting_id'];
    protected $orderColumn = 'sorting_id';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function products() {
        return $this->belongsToMany('App\Models\Product', 'products_categories', 'product_id', 'category_id');
    }
}
