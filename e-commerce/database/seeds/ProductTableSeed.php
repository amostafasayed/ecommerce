<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ProductTableSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arrayValues = [
            'product/01561948198.jpg',
            'product/01561948215.jpg',
            'product/01561948320.jpg',
            'product/01561948321.jpg',
            'product/01561948322.jpg',
            'product/01561948323.jpg',
            'product/01561948324.jpg',
        ];
        $faker =Faker::create();
        foreach (range(1,15) as $index){
            $product = DB::table('products')->insertGetId([
                'name' => $faker->name,
                'sku_number' => $faker->text(50),
                'category_id' => $faker->randomElement(App\Category::pluck('id')->toArray()),
                'description' => $faker->text(50),
                'price' => $faker->randomFloat(2, 1, 100 ),
                'quantity' => $faker -> numberBetween($min = 0, $max = 2147483647),
                'is_out_of_stock' => 1,
                'status' =>1,
                'meta_tag' =>$faker->text(10),
                'meta_description' => $faker->text(20),
                'created_at' => $faker->dateTime($max = 'now', $timezone = null),
                'updated_at' =>$faker->dateTime($max = 'now', $timezone = null),
            ]);
            foreach (range(1,2) as $index) {
                DB::table('media')->insert([
                    'product_id' => $product,
                    'image' => $arrayValues[rand(0,6)],
                ]);

            }


        }
    }
}
