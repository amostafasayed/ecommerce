<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;


class AuctionTableSeed extends Seeder
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
            $auction = DB::table('auctions')->insertGetId([
                'product_id' => $faker->randomElement(App\Product::pluck('id')->toArray()),
                'name' => $faker->name,
                'description' => $faker->text(50),
                'price_drop_percentage' => $faker->randomDigit(1, 100),
                'starting_price' => $faker->randomDigit(1, 5),
                'auction_type' => 'Paid',
                'cost_per_bid' => $faker->randomDigit(1, 10),
                'price_increase_every_bid' => $faker->randomDigit(1, 5),
                'up_time' => $faker->dateTime($max = 'now', $timezone = null),
                'duration_time_range' => '',
                'status' => "Active",
                'is_closed' => 0,
                'closed_amount' => $faker->randomFloat(2, 1, 100),
                're_open_time' => $faker->dateTime($max = 'now', $timezone = null),
                'image' => $faker->image('public/images', 400, 300, null, false),
                'created_at' => $faker->dateTime($max = 'now', $timezone = null),
                'updated_at' => $faker->dateTime($max = 'now', $timezone = null),
            ]);
        }


    }
}
