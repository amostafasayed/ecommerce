<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class UserTableSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker =Faker::create();
        DB::table('users')->insert([
            'name'=>'Admin',
            'email'=>'admin@admin.com',
            'username'=>'admin',
            'role'=>'admin',
            'credit_balance'=>5000,
            'password'=>bcrypt(123123),
        ]);
        foreach (range(1,15) as $index){
            DB::table('users')->insert([
                'name'=>$faker->name,
                'email'=>$faker->email,
                'username'=>'user'.$index,
                'role'=>'user',
                'credit_balance'=>$faker->numberBetween(2000,10000),
                'password'=>bcrypt(123123),
            ]);
        }
        \App\Setting::create([
            'amount_sign' => '',
            'sign_up_credit' => 10,
            'referral_get_credit' => 10,
        ]);
    }
}
