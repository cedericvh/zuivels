<?php

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder {
    public function run() {
        $role_customer = Role::where('name', 'customer')->first();
        $role_manager = Role::where('name', 'manager')->first();
        $role_admin = Role::where('name', 'admin')->first();
        $customer = new User();
        $customer->name = 'Testklant';
        $customer->email = 'cedericvh@matica.be';
        $customer->password = bcrypt('Welkom123!');
        $customer->save();
        $customer->roles()->attach($role_customer);
        $manager = new User();
        $manager->name = 'Support Matica';
        $manager->email = 'support@matica.be';
        $manager->password = bcrypt('Welkom123!');
        $manager->save();
        $manager->roles()->attach($role_manager);
        $manager = new User();
        $manager->name = 'admin';
        $manager->email = 'admin@admin.com';
        $manager->password = bcrypt('Welkom123!');
        $manager->save();
        $manager->roles()->attach($role_admin);
    }
}
