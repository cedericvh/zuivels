<?php

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder {
    public function run() {
        foreach (Role::all() as $item) {
            $item->users()->detach();
        }
        Role::truncate();
        $role_customer = new Role();
        $role_customer->name = 'customer';
        $role_customer->description = 'A Customer User';
        $role_customer->save();
        $role_manager = new Role();
        $role_manager->name = 'manager';
        $role_manager->description = 'A Manager User';
        $role_manager->save();
        $role_manager = new Role();
        $role_manager->name = 'admin';
        $role_manager->description = 'An Admin User';
        $role_manager->save();
    }
}
