<?php

use Illuminate\Database\Seeder;
use App\Models\Product;
use Illuminate\Support\Facades\Schema;

class ProductTableSeeder extends Seeder {
    public function run() {
        Product::all()->each(function ($item) {
            $item->categories()->detach();
        });
        Schema::disableForeignKeyConstraints();
        Product::truncate();
        Schema::enableForeignKeyConstraints();
        $product = new Product();
        $product->title = 'Inex volle melk 1L glas';
        $product->description = 'Inex volle melk 1L glas';
        $product->image = '1.1.1-Inex-volle-melk-1L-glas.jpg';
        $product->sorting_id = 1;
        $product->save();

        $product = new Product();
        $product->title = 'Inex volle melk 0,5L glas';
        $product->description = 'Inex volle melk 0,5L glas';
        $product->image = '1.1.3-Inex-volle-melk-0,5L-glas.jpg';
        $product->sorting_id = 2;
        $product->save();

        $product = new Product();
        $product->title = 'Spa Reine 1L glas';
        $product->description = 'Spa Reine 1L glas';
        $product->image = '5.1.1-Spa-Reine-1L-glas.jpg';
        $product->sorting_id = 3;
        $product->save();

        $product = new Product();
        $product->title = 'Varesa sinaas 1L';
        $product->description = 'Varesa sinaas 1L';
        $product->image = '7.2.1-Varesa-sinaas-1L.jpg';
        $product->sorting_id = 4;
        $product->save();

    }
}
