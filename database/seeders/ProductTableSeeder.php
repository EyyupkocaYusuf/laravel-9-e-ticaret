<?php

namespace Database\Seeders;

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
        $faker = Faker::create();
        for ($i=0;$i<30;$i++)
        {
            $product_name=$faker->sentence(2);
            DB::table("products")->insert([
                'product_name'=>$product_name,
                'slug'=>Str::slug($product_name),
                'explanation'=>$faker->paragraph(5),
                'price'=>$faker->randomFloat(3,1,20)
            ]);

        }

    }
}
