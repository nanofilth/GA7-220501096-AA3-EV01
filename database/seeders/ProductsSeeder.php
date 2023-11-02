<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            ['id' => 1, 'name' => 'Página web', 'state' => true],
            ['id' => 2, 'name' => 'Landing page', 'state' => true],
            ['id' => 3, 'name' => 'e-commerce básico', 'state' => true],
            ['id' => 4, 'name' => 'App móvil', 'state' => false]
        ];
        DB::table('products')->insert( $products );
    }
}
