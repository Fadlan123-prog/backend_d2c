<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        $super_admin = Role::findByName('superadmin', 'web');
        $admin_manager = Role::findByName('admin', 'web');
        $cashier_admin = Role::findByName('cashier', 'web');

        $super_user = User::where('email', 'quickwash@gmail.com')->first();
        $admin_user = User::where('email', 'admin@gmail.com')->first();
        $cashier_user = User::where('email', 'cashier@gmail.com')->first();

        $super_user->assignRole($super_admin);
        $admin_user->assignRole($admin_manager);
        $cashier_user->assignRole($cashier_admin);
    }
}
