<?php

namespace App\Http\Controllers;

use App\Auction;
use App\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class HomeDataController extends Controller
{
    public function index(){
        if(auth()->user()){
            return redirect('/user-home');
        }
        if(request()->input('ref')) {
            Session::put('ref', request()->input('ref'));
        }
        $auctionList=Auction::with('product.category','medias','slots','bids.user')
            ->whereStatus('Active')
            ->whereIsClosed(0)
            ->where('up_time', '<=', Carbon::now()->format('Y-m-d H:i:s'))
            ->latest()->get();

        $productList=Product::with('category','medias')
            ->whereStatus(1)->where('quantity','>', 0)->latest()->take(15)->get();
        $closedAuctions=Auction::with('product.category','medias','bids.user')
            ->whereIsClosed(1)->latest()->take(10)->get();

        $upCommingAuction=Auction::with('product.category','medias')
            ->whereStatus('Active')
            ->whereIsClosed(0)
            ->where('up_time', '>', Carbon::now()->format('Y-m-d H:i:s'))
            ->latest()->get();
        return view('site.pages.home',[
            'auctionList'=>$auctionList,
            'productList'=>$productList,
            'closedAuctions'=>$closedAuctions,
            'upCommingAuction'=>$upCommingAuction,
        ]);
    }
}
