<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model {
    
    use SoftDeletes;
  
    protected $fillable = ['title', 'description','toorder','image', 'sorting_id'];
    protected $dates = ['deleted_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categories() {
        return $this->belongsToMany('App\Models\Category', 'products_categories');
    }

    /**
     * @param               $query
     * @param Category|null $category
     * @return mixed
     */
    public function scopeCategorized($query, Category $category = null) {
        if (is_null($category)) return $query->with('categories');
        $categoryIds = $category->getDescendantsAndSelf()->pluck('id');
        return $query->with('categories')
            ->join('products_categories', 'products_categories.product_id', '=', 'products.id')
            ->whereIn('products_categories.category_id', $categoryIds);
    }
}
