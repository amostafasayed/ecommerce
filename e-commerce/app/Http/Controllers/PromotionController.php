<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Promotion;
use Illuminate\Http\Request;

class PromotionController extends Controller
{

    public function index()
    {
        $promo=Promotion::all();
        return view('admin.pages.promotion.managePromotion',['promos'=>$promo]);
    }

    public function create()
    {
        return view('admin.pages.promotion.createPromotion');
    }

    public function store(Request $request)
    {

        $request->validate([
            'code'=>'required|unique:promotions,code',
            'amount'=>'required',
            'sign'=>'required',

        ]);

        Promotion::create($request->all());
        return redirect('/admin/promotion/create')
            ->with(['type'=>'success','message'=>'Promotion created Successfully']);

    }

    public function show(Promotion $promotion)
    {
        //
    }

    public function edit(Request $request,$id)
    {
        $promotion=Promotion::find($id);
        return view('admin.pages.promotion.editPromotion',
            ['promotion'=>$promotion]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'code'=>'required|unique:promotions,code,'.$id,
            'amount'=>'required',
            'sign'=>'required',

        ]);
        $promotion=Promotion::find($id);
        $promotion->update($request->all());
        return redirect('/admin/promotion')
            ->with(['type'=>'success','message'=>'Promotion updated Successfully']);
    }


    public function destroy(Request $request,$id)
    {
        $promotion=Promotion::find($id);
        $promotion->delete();
        return redirect('/admin/promotion')
            ->with(['type'=>'success','message'=>'Promotion Deleted Successfully']);

    }
}
