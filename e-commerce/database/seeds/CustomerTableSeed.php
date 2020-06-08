<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
class CustomerTableSeed extends Seeder
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
            $customer = DB::table('customers')->insertGetId([
                'user_id' => $faker->randomElement(App\User::pluck('id')->toArray()),
                'name'=>$faker->name,
                'mobile' => $faker->phoneNumber,
                'shipping_address' => $faker->streetAddress,
                'email' => $faker->safeEmail,
                'postal_code' => $faker->postcode,
                'created_at' => $faker->dateTime($max = 'now', $timezone = null),
                'updated_at' => $faker->dateTime($max = 'now', $timezone = null),
            ]);
        }

    }
}
