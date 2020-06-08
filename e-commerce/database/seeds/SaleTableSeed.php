<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;


class SaleTableSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker =Faker::create();
        foreach (range(1,15) as $index) {
            $slae = DB::table('sales')->insertGetId([
                'product_id' => $faker->randomElement(App\Product::pluck('id')->toArray()),
                'quantity' => $faker -> randomFloat(2, 1, 100 ),
                'unit_price' => $faker->randomFloat(2, 1, 100 ),
                'total_price' => $faker->randomElement(App\User::pluck('id')->toArray()),
                'user_id' => $faker->randomElement(App\User::pluck('id')->toArray()),
                'created_at' => $faker->dateTime($max = 'now', $timezone = null),
                'updated_at' => $faker->dateTime($max = 'now', $timezone = null),
            ]);
        }
    }
}
