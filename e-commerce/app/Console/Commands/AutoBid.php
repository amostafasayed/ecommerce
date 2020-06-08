<?php

namespace App\Console\Commands;

use App\Auction;
use App\Bid;
use App\Events\BidUpdate;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AutoBid extends Command
{

    protected $signature = 'bid:autobid';


    protected $description = 'Command description';


    public function __construct()
    {
        parent::__construct();
    }


    public function handle()
    {

        while (true) {

            \Log::info('keep Alive:' . 'Yes');
            $auctionList = Auction::with('slots', 'bids.user')
                ->whereStatus('Active')
                ->whereIsClosed(0)
                ->where('up_time', '<=', Carbon::now()->format('Y-m-d H:i:s'))
                ->latest()->get();

            if (count($auctionList)) {
                // iterate over auction list
                foreach ($auctionList as $auction) {// 2ta
                    $autoBidByUser = \App\AutoBid::whereAuctionId($auction->id)->get();

                    if (count($autoBidByUser)) {
                        // flag to exit from loop
                        $outFromLoop = false;
                        $auctionBids = Bid::whereAuctionId($auction->id)->count();
                        // running slot except the first one
                        $runingSlot = $auctionBids == 0 ? 0 :
                            $auctionBids - 1;
                        $currentSlot = $runingSlot + 1;
                        // autobid list


                        // autobid list of ids
                        $ids = [];
                        foreach ($autoBidByUser as $autoBidUser) {
                            $ids[] = $autoBidUser->user_id;
                        }
                        $slotNumbers = 0;
                        $slotIndex = 0;
                        $count = 0;

                        foreach ($auction->slots as $slot) {
                            if ($slotNumbers < $currentSlot) {
                                $slotNumbers += $slot->slot_number;
                                if ($count) {
                                    $slotIndex++;
                                }
                                $count++;


                            }
                        }

                        // auction up time
                        $mainTime = Carbon::parse($auction->up_time);

//                    if($auction->id==2){
                        $lastBid = Bid::whereAuctionId($auction->id)->orderBy('id','DESC')->first();

                        if ($lastBid) {
                            $lastBidTime = Carbon::parse($lastBid->created_at);
                        }
                        $index = $slotIndex;
                        $auctionSlot = $auction->slots[$index];
//                        $slotNumber = $auctionSlot->slot_number;

                        if ($currentSlot == $auction->slots->sum('slot_number')) {
                            break;
                        }
                        $crTime = Carbon::now();

                        if ($currentSlot > 1) {
                            $endTime = $lastBidTime->addHours((int)(substr($auctionSlot->duration_time, 0, 2)))
                                ->addMinutes((int)substr($auctionSlot->duration_time, 3, 2))
                                ->addSeconds((int)substr($auctionSlot->duration_time, 6, 2));
//                            \Log::info('End Time (check):'.$endTime);
                        } else {
                            $endTime = $mainTime->addHours((int)(substr($auctionSlot->duration_time, 0, 2)))
                                ->addMinutes((int)substr($auctionSlot->duration_time, 3, 2))
                                ->addSeconds((int)substr($auctionSlot->duration_time, 6, 2));
                        }

                        if ($currentSlot > $runingSlot) {
                            if ($crTime < $endTime) {
                                if ($crTime->diffInSeconds($endTime) < 8) {

                                    $bid = new Auction();
                                    $bid->doAutoBid($ids, $auction);
                                }
                            }
                        }

//                    }


                    }

                }
            }

            sleep(2);
        }

    }
}
