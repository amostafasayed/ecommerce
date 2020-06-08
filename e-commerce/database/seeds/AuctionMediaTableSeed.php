<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class AuctionMediaTableSeed extends Seeder
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

        $faker = Faker::create();
        foreach (range(1, 15) as $index) {
            $auctionmedia = DB::table('auction_medias')->insertGetId([
                'auction_id' => $faker->randomElement(App\Auction::pluck('id')->toArray()),
                'image' => $arrayValues[rand(0,6)],
                'created_at' => $faker->dateTime($max = 'now', $timezone = null),
                'updated_at' => $faker->dateTime($max = 'now', $timezone = null),
            ]);
        }
    }
}
