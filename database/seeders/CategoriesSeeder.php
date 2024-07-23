<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Categories;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = new Categories;
        $data->categories_name = 'Car Wash';
        $data->save();

        $data = new Categories;
        $data->categories_name = 'Coating';
        $data->save();

        $data = new Categories;
        $data->categories_name = 'Detailing';
        $data->save();

        $data = new Categories;
        $data->categories_name = 'Minuman';
        $data->save();
    }
}
