<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Hash;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = new User;
        $data->name = 'Super Admin';
        $data->email = 'quickwash@gmail.com';
        $data->password = Hash::make('quickwash123');
        $data->save();

        $data = new User;
        $data->name = 'admin';
        $data->email = 'admin@gmail.com';
        $data->password = Hash::make('admin123');
        $data->save();

        $data = new User;
        $data->name = 'cashier';
        $data->email = 'cashier@gmail.com';
        $data->password = Hash::make('cashier123');
        $data->save();
    }
}
