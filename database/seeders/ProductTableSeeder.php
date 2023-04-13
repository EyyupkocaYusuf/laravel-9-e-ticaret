<?php

namespace Database\Seeders;

use App\Models\Product_detail;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Product::truncate();
        Product_detail::truncate();
        $faker = Faker::create();
        for ($i=0;$i<30;$i++)
        {
            $product_name = $faker->streetName;
            $product = Product::create([
                'product_name'=>$product_name,
                'slug'=>Str::slug($product_name),
                'explanation'=>$faker->paragraph(5),
                'price'=>$faker->randomFloat(3,1,20)
            ]);

            $detail = $product->details()->create([
                'show_slider'=>rand(0,1),
                'show_opportunity_day'=>rand(0,1),
                'show_featured'=>rand(0,1),
                'show_bestseller'=>rand(0,1),
                'show_discount'=>rand(0,1)
            ]);

        }


    }
}
