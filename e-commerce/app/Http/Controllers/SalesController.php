<?php

namespace App\Http\Controllers;

use App\Sales;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SalesController extends Controller
{

    public function index()
    {
        $sales=Sales::all();
        return view('admin.pages.sales.manage',['sales'=>$sales]);
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }


    public function show(Sales $sales)
    {
        //
    }


    public function edit(Sales $sales)
    {
        //
    }


    public function update(Request $request, Sales $sales)
    {
        //
    }


    public function destroy(Sales $sales)
    {
        //
    }

    public function updateOrderStatus (Request $request, $orderId, $status) {
       $sale = Sales::find($orderId);
       $sale->update(['order_status' => $status]);
       return back()->with([
          'type'     => 'success',
           'message' => 'Order status updated successfully'
       ]);
    }
}
