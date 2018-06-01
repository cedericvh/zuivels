<?php

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $this->call(CategoriesSeeder::class);

        $this->command->info('Categories table seeded!');
    }
}

class CategoriesSeeder extends Seeder {

    public function run() {

        $categories = [
            [
                'id' => 1, 'title' => 'Productgroepen', 'children' => [
                [
                    'id' => 2, 'title' => 'Zuivel', 'children' => [
                    ['id' => 3, 'title' => 'Melkproducten in fles'],
                    ['id' => 4, 'title' => 'Melkproducten in brik']
                ]
                ],
                ['id' => 5, 'title' => 'Water'],
                ['id' => 6, 'title' => 'Frisdranken']
            ]
            ],
        ];

        Category::buildTree($categories); // => true
        // Product seeder will use the roles above created.
        $this->call(ProductTableSeeder::class);

        // Role comes before User seeder here.
        $this->call(RoleTableSeeder::class);
        // User seeder will use the roles above created.
        $this->call(UserTableSeeder::class);

    }

}
