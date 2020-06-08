<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class CategoryTableSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arrayValues = ['Active', 'Inactive'];
        $faker =Faker::create();
        foreach (range(1,15) as $index){
            DB::table('categories')->insert([
                'name'=>$faker->name,
                'description'=>$faker->text(50),
                'status'=>$arrayValues[rand(0,1)],
            ]);
        }
        DB::table('categories')->insert([
            'name'=>'mobile',
            'description'=>$faker->text(50),
            'status'=>1,
        ]);
        DB::table('categories')->insert([
            'name'=>'sports',
            'description'=>$faker->text(50),
            'status'=>1,
        ]);
        DB::table('categories')->insert([
            'name'=>'kids',
            'description'=>$faker->text(50),
            'status'=>1,
        ]);
        DB::table('categories')->insert([
            'name'=>'laptop',
            'description'=>$faker->text(50),
            'status'=>1,
        ]);
        DB::table('categories')->insert([
            'name'=>'mens',
            'description'=>$faker->text(50),
            'status'=>1,
        ]);
        DB::table('categories')->insert([
            'name'=>'women',
            'description'=>$faker->text(50),
            'status'=>1,
        ]);
    }

}
