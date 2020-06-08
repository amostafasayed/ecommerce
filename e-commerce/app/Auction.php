<?php

namespace App;

use App\Events\BidUpdate;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class Auction extends Model
{
    protected $guarded = ['id'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function slots()
    {
        return $this->hasMany(AuctionSlot::class);
    }

    public function medias()
    {
        return $this->hasMany(AuctionMedias::class);
    }

    public function bids()
    {
        return $this->hasMany(Bid::class);
    }
    public function payments(){
        return $this->morphMany('App\Payment', 'paymentable');
    }
    public static function isSold($auction)
    {
        if($auction->is_closed && count($auction->bids) > 1) {
            $sale = Sales::with('items')->whereHas('items', function ($query) use ($auction) {
                $query->whereSource('auction')
                    ->whereProductId($auction->product_id)
                    ->whereSourceId($auction->id);
            });
            $sale->first();
            return $sale->exists();

        }else {
            return false;
        }
    }
    public function getWinner($auction)
    {
        if($auction->is_closed && count($auction->bids) > 1) {
            return User::find($auction->bids[count($auction->bids)-1]->user->id);
        }
    }
    public function doAutoBid($userIds, $auction)
    {
        
        $randomUser = array_rand($userIds, 1);
        $randomUser = $userIds[$randomUser];
        $user = User::find($randomUser);

        $auction = Auction::with('bids')->whereId($auction->id)->first();
        if ($auction->auction_type == 'Free') {
            $currentBalance = 1;
        } else {
            $currentBalance = $user->credit_balance - $auction->cost_per_bid;
        }

        $bidItem = Bid::whereAuctionId($auction->id)->orderBy('id', 'DESC');
        $bid = $bidItem->first();
        $autoBidByUser = AutoBid::whereUserId($user->id)->whereAuctionId($auction->id)->first();
        $bidCount = $bidItem->count();
        $userBidCount = $bidItem->whereUserId($user->id)->count();
        $currentAuctionPrice = $bidCount == 0 ? $auction->starting_price : ($auction->starting_price + ($bidCount * $auction->price_increase_every_bid)) ;
        $hasUserAlreadyBid = $bid ? $bid->user_id == $randomUser : false;

        if ($currentBalance >= 0 && !$hasUserAlreadyBid &&
            $autoBidByUser->max_bid > $userBidCount &&
            $autoBidByUser->activate_at_price <= $currentAuctionPrice
        ) {

            Bid::create([
                'user_id' => $randomUser,
                'auction_id' => $auction->id,
                'cost_bid' => $auction->auction_type == 'Free' ? 0 : $auction->cost_per_bid,
                'from_auto_bid' => true,
            ]);
            if ($auction->auction_type != 'Free') {
                $user->credit_balance = $currentBalance;
                $user->save();
            }


//            \Log::info('Bid:' . 'Done by single');
            event(new BidUpdate($user, $auction->id));
            $serverTime = Carbon::now()->format('Y-m-d H:i:s');
            return response()->json([
                'type' => 'success',
                'message' => 'You bid successfully',
                'serverTime' => $serverTime
            ]);


        } else {
            $itemDone = false;
            foreach ($userIds as $item) {
                $otherUser = User::find($item);
                $otherBidItem = Bid::whereAuctionId($auction->id)->orderBy('id', 'DESC');
                $otherBid = $otherBidItem->first();
                if ($auction->auction_type == 'Free') {
                    $currentBalance = 1;
                } else {
                    $currentBalance = $otherUser->credit_balance - $auction->cost_per_bid;
                }

                $autoBidByUserOther = AutoBid::whereUserId($item)->whereAuctionId($auction->id)->first();
                $otherUserBidCount = $otherBidItem->whereUserId($item)->count();
                $hasOtherUserAlreadyBid = $otherBid ? $otherBid->user_id == $item : false;

                if ($currentBalance >= 0 && !$hasOtherUserAlreadyBid &&
                    $autoBidByUserOther->max_bid > $otherUserBidCount &&
                    $autoBidByUserOther->activate_at_price <= $currentAuctionPrice) {
                    Bid::create([
                        'user_id' => $item,
                        'auction_id' => $auction->id,
                        'cost_bid' => $auction->auction_type == 'Free' ? 0 : $auction->cost_per_bid,
                        'from_auto_bid' => true,
                    ]);
                    if ($auction->auction_type != 'Free') {
                        $otherUser->credit_balance = $currentBalance;
                        $otherUser->save();
                    }

                    event(new BidUpdate($otherUser, $auction->id));

                    $itemDone = true;
                    break;


                }
                if ($itemDone) {
                    break;
                }
            }
            if ($itemDone) {
                $serverTime = Carbon::now()->format('Y-m-d H:i:s');
                return response()->json([
                    'type' => 'success',
                    'message' => 'You bid successfully',
                    'serverTime' => $serverTime
                ]);
            }


        }


    }


}
