<?php

namespace App\Http\Controllers;

use App\Auction;
use App\AutoBid;
use App\Bid;
use App\Category;
use App\Events\BidUpdate;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BidController extends Controller
{

    public function manageBid()
    {
        $bids=Bid::all();
        return view('admin.pages.bid.manage-bid-history',['bids'=>$bids]);
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $auction = Auction::with('bids')->whereId($request->input('auction_id'))->first();

        if($auction->is_closed){
            return response()->json([
                'type'=>'error',
                'message'=>'Auction already closed',
            ]);
        }
        if(count($auction->bids)){
            if($auction->bids[count($auction->bids) -1 ]->user->id == auth()->user()->id) {
                return response()->json([
                    'type'=>'error',
                    'message'=>'You already placed bid in this slot',
                ]);
            }
        }

        Bid::create([
            'user_id'=>auth()->user()->id,
            'auction_id'=>$request->input('auction_id'),
            'cost_bid'=>$request->input('cost_bid'),
            'from_auto_bid'=>$request->input('auto')?$request->input('auto'):false,
        ]);
        event(new BidUpdate(auth()->user(),$request->input('auction_id')));

        if ($auction->auction_type != 'Free') {
            $user=User::whereId(auth()->user()->id);
            $currentBalance = $user->first()->credit_balance - $request->input('cost_bid');
            $user->update([
                'credit_balance'=>$currentBalance
            ]);
        }
        $serverTime = Carbon::now()->format('Y-m-d H:i:s');

        return response()->json([
            'type'=>'success',
            'message'=>'You bid successfully',
            'serverTime'=>$serverTime
        ]);
    }

    public function autoBid(Request $request){

        $user=User::find($request->input('random_user_id'));
        $auction=Auction::with('bids')->whereId($request->input('auction_id'))->first();
        $currentPrice=$auction->bids->count()*$auction->price_increase_every_bid;
        $autoBid=AutoBid::whereAuctionId($request->input('auction_id'))
            ->whereUserId($request->input('random_user_id'))->first();
        $hasBidByThisUser=Bid::whereAuctionId($request->input('auction_id'))
                                ->whereUserId($request->input('random_user_id'))
                                ->latest('id')->first();
        $currentBalance=$user->credit_balance - $auction->cost_per_bid;
        $serverTime = Carbon::now()->format('Y-m-d H:i:s');

        if($currentBalance>=0 && !$hasBidByThisUser &&
            $currentPrice >= $autoBid->activate_at_price && $currentPrice <= $autoBid->max_bid){
            Bid::create([
                'user_id'=>$request->input('random_user_id'),
                'auction_id'=>$auction->id,
                'cost_bid'=>$auction->cost_per_bid,
                'from_auto_bid'=>true,
            ]);
            $user->update([
                'credit_balance'=>$currentBalance
            ]);
            event(new BidUpdate(auth()->user(),'event message'));

            return response()->json([
                'type'=>'success',
                'message'=>'You bid successfully',
                'serverTime'=>$serverTime
            ]);

        }else{
            foreach ($request->input('all_user_ids') as $item){
                $otherUser=User::find($item);
                $autoBid=AutoBid::whereAuctionId($request->input('auction_id'))
                    ->whereUserId($item)->first();
                $hasBidByThisUser=Bid::whereAuctionId($request->input('auction_id'))
                    ->whereUserId($item)->latest('id')->first();
                $currentBalance=$otherUser->credit_balance-$auction->cost_per_bid;
                if($currentBalance>=0 && !$hasBidByThisUser &&
                    $currentPrice >= $autoBid->activate_at_price && $currentPrice <= $autoBid->max_bid){
                    Bid::create([
                        'user_id'=>$item,
                        'auction_id'=>$auction->id,
                        'cost_bid'=>$auction->cost_per_bid,
                        'from_auto_bid'=>true,
                    ]);
                    $user->update([
                        'credit_balance'=>$currentBalance
                    ]);

                    event(new BidUpdate(auth()->user(),'event message'));


                    break;
                }
            }

            return response()->json([
                'type'=>'success',
                'message'=>'You bid successfully',
                'serverTime'=>$serverTime
            ]);

        }


    }

    public function show(Bid $bid)
    {
        //
    }


    public function edit(Bid $bid)
    {
        //
    }

    public function update(Request $request, Bid $bid)
    {
        //
    }


    public function destroy(Bid $bid)
    {
        //
    }



}
