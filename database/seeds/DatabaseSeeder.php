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
        $this->call(ProductTableSeeder::class);
        //        $this->call(RoleTableSeeder::class);
        //        $this->call(UserTableSeeder::class);

        $this->command->info('Categories table seeded!');
    }
}

class CategoriesSeeder extends Seeder {

    public function run() {
        Category::truncate();
        Category::buildTree([
            [
                'id'         => 1,
                'title'      => 'Productgroepen',
                'sorting_id' => 1,
                'children'   => [
                    [
                        'id'         => 2,
                        'title'      => 'Zuivel',
                        'sorting_id' => 2,
                        'children'   => [
                            [
                                'id'         => 3,
                                'title'      => 'Melkproducten in fles',
                                'sorting_id' => 3,
                            ],
                            [
                                'id'         => 4,
                                'title'      => 'Melkproducten in brik',
                                'sorting_id' => 4,
                            ]
                        ]
                    ],
                    [
                        'id'         => 5,
                        'title'      => 'Water',
                        'sorting_id' => 5,
                    ],
                    [
                        'id'         => 6,
                        'title'      => 'Frisdranken',
                        'sorting_id' => 6,
                    ]
                ]
            ],
        ]);

    }

}
