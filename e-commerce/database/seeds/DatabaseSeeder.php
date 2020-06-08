<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $this->call(UserTableSeed::class);
        $this->call(CategoryTableSeed::class);
        $this->call(ProductTableSeed::class);
//        $this->call(AuctionTableSeed::class);
//        $this->call(BidTableSeed::class);
//        $this->call(AuctionSlotTableSeed::class);
//        $this->call(AuctionMediaTableSeed::class);
        $this->call(CustomerTableSeed::class);
//        $this->call(SaleTableSeed::class);
        $this->call(ShippingCostTableSeed::class);


    }
}
