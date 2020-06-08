<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
class ShippingCostTableSeed extends Seeder
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
            $shippingcost = DB::table('shipping_costs')->insertGetId([
                'amount' => $faker->randomFloat(2, 1, 100 ),
                'description' => $faker->text(50),
                'created_at' => $faker->dateTime($max = 'now', $timezone = null),
                'updated_at' => $faker->dateTime($max = 'now', $timezone = null),
            ]);
        }
    }

}
