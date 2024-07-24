<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Customer;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Customer::updateOrCreate([
            'plate_number' => 'B 1234 AA',
        ], [
            'plate_number' => 'B 1234 AA'
        ]);

        Customer::updateOrCreate([
            'plate_number' => 'B 1234 AB',
        ], [
            'plate_number' => 'B 1234 AB'
        ]);

        Customer::updateOrCreate([
            'plate_number' => 'B 1234 AC',
        ], [
            'plate_number' => 'B 1234 AC'
        ]);
    }
}
