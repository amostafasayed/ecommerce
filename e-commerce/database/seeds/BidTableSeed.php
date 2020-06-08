<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;


class BidTableSeed extends Seeder
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
            $bid = DB::table('bids')->insertGetId([
                'user_id' => $faker->randomElement(App\User::pluck('id')->toArray()),
                'auction_id' => $faker->randomElement(App\Auction::pluck('id')->toArray()),
                'cost_bid' => $faker->randomFloat(2, 1, 100 ),
                'created_at' => $faker->dateTime($max = 'now', $timezone = null),
                'updated_at' => $faker->dateTime($max = 'now', $timezone = null),
            ]);
        }
    }

}
