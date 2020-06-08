<?php

namespace App\Http\Controllers;

use App\Product;
use App\Promotion;
use App\ShippingCost;
use Cart;
use Gloudemans\Shoppingcart\ShoppingcartServiceProvider;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function goToCartPage(Request $request){
        $promotion=0;
        if($request->input('pcode')){
            $promotion=Promotion::whereCode($request->input('pcode'))->first();
            if(!$promotion){
                return redirect('/view-cart')
                    ->with(['type'=>'error','message'=>'Your Promotion code is not valid']);


            }else{
                if($promotion->at_least_amount>Cart::subtotal()){
                    $amount=$promotion->at_least_amount;
                    $promotion=0;
                    return redirect('/view-cart')
                        ->with(['type'=>'error',
                            'message'=>'You need to purchase at least this '.$amount.' amount']);
                }
            }


        }
        $cartItems=Cart::content();
        $shippingCost=ShippingCost::orderBy('id', 'desc')->first();
        return view('site.pages.cart.cart',[
            'shippingCost'=>$shippingCost,
            'cartItems'=>$cartItems,
            'promotion'=>$promotion
        ]);
    }
    public function addToCart(Request $request){
        $product=Product::find($request->id);
        $currentQuantity = 0;
        $currentCartProduct= Cart::search(function ($cartItem, $rowId) use ($product){
            return $cartItem->id === $product->id ;
        });
        foreach($currentCartProduct as $item) {
            $currentQuantity += (int)str_replace(",","",$item->qty);
        }
        if (($request->qty + $currentQuantity) > $product->quantity ){
            return redirect()->back()
                ->with(['type'=>'error',
                    'message'=>'Product you have selected which we have left '. $product->quantity .' quantity only.']);
        }

        if($request->source){
            $currentCartItem= Cart::search(function ($cartItem, $rowId) use ($product){
                return $cartItem->id === $product->id;
            });
            if (count($currentCartItem)){
                return redirect()->back()
                    ->with(['type'=>'error',
                        'message'=>'Auction product can buy only one.']);
            }
        }

        $price = $request->price;
        $source = $request->source;
        Cart::add([
            'id' => $product->id,
            'name' => $product->name,
            'qty' => $request->qty,
            'price' => $price ? $price : $product->price,
            'weight'=>5,
            'options' => [
                'source' => $source ? $source : 'product',
                'source_id' => $request->source_id
            ]
            ]);

        return back()->with(['type'=>'success',
            'message'=>'Product added to your cart successfully.']);
    }

    public function deleteCartItem(Request $request,$id){
        Cart::remove($id);
        return back();
    }
    public function updateCartItem(Request $request, $id, $quantity){
        $cartItem=Cart::get($id);
        $product=Product::find($cartItem->id);
        if ($quantity > $product->quantity ){
            return redirect()->back()
                ->with(['type'=>'error',
                    'message'=>'Product you have selected which we have left '. $product->quantity .' quantity only.']);
        }
        Cart::update($id, [
            'qty' => $quantity,

        ]);
        return back();
    }


}
