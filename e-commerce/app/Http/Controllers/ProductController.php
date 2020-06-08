<?php

namespace App\Http\Controllers;

use App\Auction;
use App\Category;
use App\Http\Requests\ProductRequest;
use App\Media;
use App\Product;
use App\Promotion;
use App\Sales;
use App\ShippingCost;
use Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
class ProductController extends Controller
{

    public function index()
    {
        $products=Product::with('category','medias')->get();
        return view('admin.pages.product.manage',['products'=>$products]);

    }


    public function create()
    {
        $categories=Category::whereStatus('Active')->get();
       return view('admin.pages.product.create',['categories'=>$categories]);
    }


    public function store(ProductRequest $request)
    {
        $product = Product::create($request->except('files','images'));
        $this->addImage($request, $product);
        return redirect('/admin/product/create')
            ->with(['type'=>'success','message'=>'Product created Successfully']);
    }
    public function showProduct(Request $request, $id) {
        $product = Product::find($id);
        return view('admin.pages.product.show', ['product' => $product]);
    }

    public function show(Request $request,$id,$name)
    {
        $promotion=0;
        if($request->input('pcode')){
            $promotion=Promotion::whereCode($request->input('pcode'))->first();
            if(!$promotion){
                return back()->with(['type'=>'error','message'=>'Your Promotion code is not valid']);


            }else{
                if($promotion->at_least_amount>Cart::subtotal()){
                    $amount=$promotion->at_least_amount;
                    $promotion=0;
                    return back()->with(['type'=>'error',
                            'message'=>'You need to purchase at least this '.$amount.' amount']);
                }
            }


        }
        $item=Product::with('category')->whereId($id)->first();
        $shippingCost=ShippingCost::orderBy('id', 'desc')->first();
        $cartItems=Cart::content();
        return view('site.pages.product.product-details',[
            'item'=>$item,
            'shippingCost'=>$shippingCost,
            'cartItems'=>$cartItems,
            'promotion'=>$promotion
        ])->with(['type'=>'success','message'=>'Product created Successfully']);
    }


    public function edit(Product $product)
    {
        $category=Category::select('categories.name','categories.id')->get();

        return view('admin.pages.product.edit',['category'=>$category,'product'=>$product]);
    }


    public function update(ProductRequest $request, $id)
    {
        $product = Product::with('medias')->whereId($id)->select();
        $product->first()->update($request->except('files','images','deleted_images'));
        foreach ($product->first()->medias as $media) {
            if(!in_array($media->id, $request->input('deleted_images')?:[])){
                $this->removeImage($media);
            }
        }
        $this->addImage($request, $product->first());
        return redirect('/admin/product')
            ->with(['type'=>'success','message'=>'Product updated Successfully']);
    }

    public function destroy(Product $product)
    {

        $auctionProduct = Auction::whereProductId($product->id)->count();
        $saleProduct = Sales::whereProductId($product->id)->count();
        $totalProduct =$auctionProduct + $saleProduct;
        if($totalProduct){
            return back()
                ->with([
                    'type'=>'error',
                    'message'=> "You have already ".$totalProduct." 
                    auction or order with this Product. Please delete auction or order first."]);
        } else {
            foreach ($product->medias as $media) {
               $this->removeImage($media);
            }
            $product->delete();
            return back()
                ->with(['type'=>'success','message'=>'Product deleted successfully']);
        }
    }

    public function addImage($request, $product){
        if($request->file('images')){
            foreach ($request->images as $key=>$item){
                $extension = $item->getClientOriginalExtension();
                $name='product/'.$key.time().'.'.$extension;
                Storage::disk('public')->put($name,  File::get($item));
                Media::create(['product_id'=>$product->id, 'image'=>$name]);
            }
        }
    }
    public function removeImage($media){
        Storage::disk('public')->delete($media->image);
        $mediaItem =Media::find($media->id);
        $mediaItem->delete();
    }

    public function getAllProduct(Request $request){
        $productList=Product::with('category','medias');
        if($request->input('search')){
            $productList=$productList->where('name','LIKE','%'.$request->input('search').'%');
        }
        if($request->input('catId')){
            $productList=$productList->whereCategoryId($request->input('catId'));
        }
        if($request->input('catName')){
            $productList = $productList->whereHas('category', function ($productList) use ($request) {
                $productList->where('name','like', $request->input('catName'));
            });
        }
        if($request->input('order')){
                $productList=$productList->orderBy('price',$request->input('order'));

        }
        $productList=$productList->where('quantity','>', 0)->paginate(20);
        $categories=DB::table('categories')
            ->join('products','categories.id','=','products.category_id')
            ->select('categories.name','categories.id as catId',DB::raw('count(*) as catCount'))
            ->groupBy('products.category_id','categories.name','categories.id')
            ->get();
        return view('site.pages.product.allProducts',['categories'=>$categories,'productList'=>$productList]);
    }

}
