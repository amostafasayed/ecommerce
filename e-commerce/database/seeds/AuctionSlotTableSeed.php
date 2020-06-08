<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;


class AuctionSlotTableSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        foreach (range(1, 15) as $index) {
            $auctionslot = DB::table('auction_slots')->insertGetId([
                'auction_id' => $faker->randomElement(App\Auction::pluck('id')->toArray()),
                'slot_number' => $faker->randomDigit(1, 100 ),
                'duration_time' => '0'.$faker->randomDigit(0, 3 ).':0'.$faker->randomDigit(0, 9 ).':'.$faker->randomDigit(10, 59 ),
                'created_at' => $faker->dateTime($max = 'now', $timezone = null),
                'updated_at' => $faker->dateTime($max = 'now', $timezone = null),
            ]);
        }
    }
}
