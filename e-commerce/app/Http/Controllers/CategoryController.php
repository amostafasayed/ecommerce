<?php

namespace App\Http\Controllers;

use App\Auction;
use App\Category;
use App\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{


    public function index()
    {
        $categories=Category::all();
        return view('admin.pages.category.manage',['categories'=>$categories]);
    }


    public function create()
    {

       return view('admin.pages.category.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'status'=>'required'
        ]);

        Category::create($request->all());
        return redirect('/admin/category/create')
            ->with(['type'=>'success','message'=>'Category created Successfully']);
    }


    public function show(Category $category)
    {
        //
    }

    public function edit($id)
    {
        $category=Category::find($id);
        return view('admin.pages.category.edit',['category'=>$category, 'id'=>$id]);
    }


    public function update(Request $request, $id){

        $request->validate([
            'name'=>'required',
            'status'=>'required'
        ]);
       $category=Category::find($id);
       $category->update($request->all());
       return redirect('/admin/category')
           ->with(['type'=>'success','message'=>'Category Updated Successfully']);
    }


    public function destroy(Category $category)
    {
        $productCategory = Product::whereCategoryId($category->id)->count();
        if($productCategory){
            return back()
                ->with([
                    'type'=>'error',
                    'message'=> "You have already ".$productCategory." product with this Category. Please delete product first."]);
        } else {
            $category->delete();
            return back()
                ->with(['type'=>'success','message'=>'Category deleted successfully']);
        }
    }
}
