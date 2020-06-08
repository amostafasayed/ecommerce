<?php

namespace App\Http\Controllers;

use App\ShippingCost;
use Illuminate\Http\Request;

class ShippingCostController extends Controller
{

    public function index()
    {
        $shippingCost=ShippingCost::all();
        return view('admin.pages.shippingCost.manage',['shippingCost'=>$shippingCost]);
    }


    public function create()
    {
        return view('admin.pages.shippingCost.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'amount'=>'required',

        ]);

        ShippingCost::create($request->all());
        return redirect('/admin/shipping-cost/create')
            ->with(['type'=>'success','message'=>'Shipping Cost created Successfully']);
    }


    public function show(ShippingCost $shippingCost)
    {
        //
    }


    public function edit($id)
    {
        $shippingCost=ShippingCost::find($id);
        return view('admin.pages.shippingCost.edit',['shippingCost'=> $shippingCost, 'id'=>$id]);
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'amount'=>'required'

        ]);
        $shippingCost=ShippingCost::find($id);
        $shippingCost->update($request->all());
        return redirect('/admin/shipping-cost')
            ->with(['type'=>'success','message'=>'Shipping Cost Updated Successfully']);
    }


    public function destroy(ShippingCost $shippingCost)
    {
       $shippingCost->delete();
        return back()
            ->with(['type'=>'success','message'=>'Shipping Cost Deleted Successfully']);
    }
}
