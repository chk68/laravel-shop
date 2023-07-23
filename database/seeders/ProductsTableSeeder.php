<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for($i = 1; $i <11; $i ++)
        DB::table('products')->insert([
            'title' => 'Product '.$i,
            'price' => rand(200,1500),
            'in_stock' => 1,
            'description' => 'text',
        ]);
    }
}
