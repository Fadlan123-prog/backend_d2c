<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Size;
use App\Models\Categories;
use App\Models\Item;


class SizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $data = new Size;
        $data->size = 'S';
        $data->save();

        $data = new Size;
        $data->size = 'M';
        $data->save();

        $data = new Size;
        $data->size = 'L';
        $data->save();

        $data = new Size;
        $data->size = 'XL';
        $data->save();

        $data = new Size;
        $data->size = 'S/M';
        $data->save();

        $data = new Size;
        $data->size = 'L/XL';
        $data->save();

        $data = new Size;
        $data->size = 'VAC';
        $data->save();

        $data = new Size;
        $data->size = 'NV';
        $data->save();

        $data = new Size;
        $data->size = 'Front All Size';
        $data->save();

        $data = new Size;
        $data->size = 'Full All Size';
        $data->save();

        $data = new Size;
        $data->size = 'Full Coating';
        $data->save();
    }
}
