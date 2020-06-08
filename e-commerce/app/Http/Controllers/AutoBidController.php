<?php

namespace App\Http\Controllers;

use App\Auction;
use App\AutoBid;
use App\Http\Requests\AutoBidRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AutoBidController extends Controller
{
    public function manageAutoBid() {
        $autoBids=AutoBid::all();
        return view('admin.pages.bid.manage-auto-bid',['autoBids'=>$autoBids]);
    }
    public function create(){
        $auctionList=Auction::whereStatus('Active')
            ->whereIsClosed(0)
            ->latest()->get();
        $activeAutoBids=AutoBid::with('auction.bids')
            ->whereHas('auction', function ($query) {
                $query->where('is_closed', '=', 0);
            })
            ->whereUserId(auth()->user()->id)
            ->orderBy('id','DESC')
            ->paginate(10);
        $closedAutoBids=AutoBid::with('auction.bids')
            ->whereHas('auction', function ($query) {
                $query->where('is_closed', '=', 1);
            })
            ->whereUserId(auth()->user()->id)
            ->orderBy('id','DESC')
            ->paginate(10);
        return view('site.pages.auto-bid.create',[
            'auctionList' => $auctionList,
            'activeAutoBids'    => $activeAutoBids,
            'closedAutoBids'    => $closedAutoBids,
            'currentId'   => request()->input('id')
            ]);
    }
    public function store(AutoBidRequest $request){

        AutoBid::create([
            'user_id'=>auth()->user()->id,
            'auction_id'=>$request->input('auction_id'),
            'max_bid'=>$request->input('max_bid'),
            'activate_at_price'=>$request->input('activate_at_price'),
            'bid_randomly'=>$request->input('bid_strategy')=='randomly'?true:false,
            'bid_with_sec'=>$request->input('bid_strategy')=='10sec'?true:false,
        ]);

        return redirect('/auto-bid/create');
    }
    public function edit(Request $request, $id){
        $auctionList=Auction::whereStatus('Active')
            ->whereIsClosed(0)
            ->latest()->get();
        $autoBid = AutoBid::find($id);
        if($autoBid->user_id != auth()->user()->id) {
            return redirect()->back()->with([
                'type' => 'error',
                'message' => 'You are not valid person to do that'
            ]);
        }
        return view('site.pages.auto-bid.edit',[
            'auctionList' => $auctionList,
            'autoBid' => $autoBid,
        ]);
    }

    public function update(Request $request, $id){
        $autoBid=AutoBid::with('auction')->whereId($id)->whereUserId(auth()->user()->id)->first();

        if ($result = $this->checkEditOrDeletableAutoBid($id,
            $request->input('auction_id'))) return $result;
        $autoBid->update([
            'auction_id'=>$request->input('auction_id'),
            'max_bid'=>$request->input('max_bid'),
            'activate_at_price'=>$request->input('activate_at_price'),
            'bid_randomly'=>$request->input('bid_strategy')=='randomly'? true : false,
            'bid_with_sec'=>$request->input('bid_strategy')=='10sec'? true : false,
        ]);
        return redirect('/auto-bid/create')->with([
            'type' => 'success',
            'message' => 'Auto Bid updated successfully'
        ]);;
    }

    public function destroy($id){
        if ($result = $this->checkEditOrDeletableAutoBid($id)) return $result;
        $autoBid = AutoBid::find($id);
        $autoBid->delete();
        return redirect('/auto-bid/create')->with([
            'type' => 'success',
            'message' => 'Auto Bid Deleted successfully'
        ]);;
    }

    public function checkEditOrDeletableAutoBid($id, $auctionId = null) {
        $autoBid=AutoBid::with('auction')->whereId($id)->whereUserId(auth()->user()->id)->first();
        if($autoBid->user_id != auth()->user()->id) {
            return redirect('/auto-bid/create')->with([
                'type' => 'error',
                'message' => 'You are not valid person to do that'
            ]);
        }
        if ($auctionId) {
            $checkAbleAuction = Auction::whereId($auctionId)->first()->up_time;
        }else{
            $checkAbleAuction = $autoBid->auction->up_time;
        }

        if(Carbon::parse($checkAbleAuction) < Carbon::now()) {
            return redirect('/auto-bid/create')->with([
                'type' => 'error',
                'message' => 'Sorry Live auction auto bid can not edit or deletable'
            ]);
        }
    }
}
