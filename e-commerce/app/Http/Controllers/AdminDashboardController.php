<?php

namespace App\Http\Controllers;

use App\Auction;
use App\Sales;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
   public function dashboard() {
       $orders = Sales::groupBy('order_no')->select();
       $auctions = Auction::whereStatus('active');
       $totalOrders = count($orders->get());
       $totalTodayOrders = count($orders->whereDate('created_at', Carbon::today())->get());
       $totalAuctions = Auction::count();
       $totalUpComingAuctions = $auctions->where('up_time', '>', Carbon::now()->format('Y-m-d H:i:s'))->count();
       return view('admin.pages.dashboard', [
           'totalOrders'            => $totalOrders,
           'totalTodayOrders'       => $totalTodayOrders,
           'totalAuctions'          => $totalAuctions,
           'totalUpComingAuctions'  => $totalUpComingAuctions,
       ]);
   }
}
