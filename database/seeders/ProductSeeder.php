<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->insert([
            'product_code' => "",
            'product_name' => "",
            'product_category' => "",
            'brand' => "",
            'model' => "",
            'first_stocks' => "",
            'latest_stock' => "",
            'buying_price' => "",
            'selling_price' => "",
            'unit_type' => "",
            'in_date' => "",
            'expired_date' => "",
            'description' => "",
            'shelf_location' => "",
        ]);
    }
}
