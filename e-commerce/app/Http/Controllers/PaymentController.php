<?php

namespace App\Http\Controllers;

use App\Auction;
use App\Bid;
use App\Contact;
use App\Http\Requests\PaymentRequest;
use App\Http\Traits\Districts;
use App\Http\Traits\Paypal;
use App\Http\Traits\Ssl;
use App\Package;
use App\Product;
use App\Promotion;
use App\SaleItem;
use App\Sales;
use App\ShippingCost;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Cart;
use Illuminate\Support\Facades\Mail;
use PayPal\Api\Payment;


class PaymentController extends Controller
{

    use Paypal, Ssl, Districts;

    public function buyCredit(Request $request)
    {
        $promotion = 0;
        if ($request->input('pcode')) {
            $promotion = Promotion::whereCode($request->input('pcode'))->first();
            if (!$promotion) {

                $payment = $request->input('payment') ? $request->input('payment') : '';
                $package = $request->input('package') ? $request->input('package') : '';
                return redirect('/credit-product?package=' . $package . '&payment=' . $payment)
                    ->with(['type' => 'error', 'message' => 'Your Promotion code is not valid']);

            } else {
                if ($promotion->at_least_amount > $request->input('package')) {
                    $amount = $promotion->at_least_amount;
                    $promotion = 0;
                    return back()
                        ->with(['type' => 'error',
                            'message' => 'You need to purchase at least this ' .
                                $amount . ' amount']);
                }
            }


        }
        $packages = Package::latest()->take(5)->get();
        return view('site.pages.product.credit-product',
            ['packages' => $packages, 'promotion' => $promotion]);
    }

    public function paymentConfirmation(Request $request)
    {
        if (!auth()->user()) {
            return back()
                ->with(['type' => 'error',
                    'message' => "Please Login First then go to checkout. Don't have account please sign up"]);
        }
        $user = User::with('contact')->find(auth()->user()->id);
        $districts = $this->getDistricts();

        $promotion = 0;
        if ($request->input('pcode')) {
            $promotion = Promotion::whereCode($request->input('pcode'))->first();
            if (!$promotion) {
                $promotion = 0;
            } else {
                if ($promotion->at_least_amount > Cart::subtotal()) {
                    $promotion = 0;
                }
            }
        }

        $cartItems = Cart::content();
        $shippingCost = ShippingCost::orderBy('id', 'desc')->first();
        return view('site.pages.payment.confirmation', [
            'shippingCost' => $shippingCost,
            'cartItems' => $cartItems,
            'promotion' => $promotion,
            'districts' => $districts,
            'user' => $user
        ]);
    }

    public function makePayment(Request $request)
    {
        if(Cart::count() < 1) return redirect()->back()->with([
            'type' => 'error',
            'message' => 'First Select product to order'
        ]);
        $promotionCode = $request->input('package_code');
        $promotion = Promotion::whereCode($promotionCode)->first();
        $shippingCost = ShippingCost::orderBy('id', 'DESC')->first();
        $subTotal = str_replace(",","",Cart::subtotal());
        $grandTotal = 0;
        $promoId = null;
        $discount = 0;
        if ($promotion) {
            if ($promotion->at_least_amount <= $subTotal) {

                $promoId = $promotion->id;
                if ($promotion->sign == 'Amount') {
                    $discount = (float)$promotion->amount;
                    $grandTotal = ((float)$subTotal - (float)$promotion->amount) + $shippingCost->amount;

                } elseif ($promotion->sign == 'Percentage') {
                    $discount = (((float)$subTotal * (float)$promotion->amount) / 100);
                    $grandTotal = ((float)$subTotal - $discount) + (float)$shippingCost->amount;

                }
            } else {
                $grandTotal = (float)$subTotal + $shippingCost->amount;
            }
        } else {
            $grandTotal = (float)$subTotal + $shippingCost->amount;
        }

        $user = User::whereId(auth()->user()->id);
        $user->update([
            'name' => $request->input('name'),
            'mobile' => $request->input('mobile'),
        ]);
        $contact = Contact::updateOrCreate(
            ['user_id' => auth()->user()->id],
            $request->except(['package_code', 'name', 'payment_method'])
        );
        if ($request->input('payment_method') == 'ssl') {
            return $this->sslPayment($request, $grandTotal, null, $promoId, 'product', $discount);
        } elseif ($request->input('payment_method') == 'paypal') {
            return $this->payPalIntegration($request, $grandTotal, null, $promoId, 'product', $discount);

        } elseif ($request->input('payment_method') == 'cash_on_delivery') {
            $orderNo = $this->makeSales($discount, (float)$shippingCost->amount, 'cash on delivery');
            Cart::destroy();
            $mailData = [
                'name' => auth()->user()->name,
                'order_no' => $orderNo,
            ];
            $this->sendEmail('email.email-order-confirmation', $mailData,'Order Confirmation',  auth()->user()->email);
            $this->sendEmail('email.email-admin-order-confirmation', $mailData,'New Order',  env('ADMIN_MAIL_ADDRESS'));
            return redirect('/user-details/all-order')->with([
                'type' => 'success',
                'message' => "Thank you ".auth()->user()->name.", You order has been received.  
                A copy of invoice send to your E-mail: ".auth()->user()->email." and your Order no is ".$orderNo

            ]);

        } else {
            return redirect()->back();
        }
    }

    public function makeCreditPayment(Request $request)
    {

        $creditPayment = $this->prepareCreditPayment($request);
        return $this->payPalIntegration($request, $creditPayment[0], $creditPayment[1], $creditPayment[2], null, $creditPayment[3]);
    }


    public function sslCreditPayment(Request $request)
    {
        $creditPayment = $this->prepareCreditPayment($request);
        return $this->sslPayment($request, $creditPayment[0], $creditPayment[1], $creditPayment[2], null, $creditPayment[3]);
    }


    public function auctionPaymentConfirmation(Request $request, $id)
    {

        $item = Auction::with('product.category', 'bids.user')->whereId($id)->first();
        $currentUserId = auth()->user() ? auth()->user()->id : 0;

        if(!$item){
            return redirect('/')->with([
                'type' => 'error',
                'message' => 'Your are trying closed auction for buying.'
            ]);
        }
        if($item->is_closed) {
            if(!(count($item->bids) > 1 &&  $item->bids[count($item->bids)-1]->user->id == $currentUserId)){
                return back()->with([
                    'type' => 'error',
                    'message' => 'Your are trying closed auction for buying.'
                ]);
            }
        }
        $userBid = 0;
        if (auth()->user()) {
            $userBid = Bid::whereAuctionId($id)->whereUserId(auth()->user()->id)->count();
        }

        return view('site.pages.product.auction-buy',
            ['item' => $item, 'userBid' => $userBid]);
    }

    public function prepareCreditPayment($request)
    {
        $packageId = $request->input('pid');
        $promotionCode = $request->input('pcode');
        $promotion = Promotion::whereCode($promotionCode)->first();

        $package = Package::find($packageId);
        $grandTotal = 0;
        $promoId = null;
        $discount = 0;

        if ($promotion) {
            if ($promotion->at_least_amount <= $package->price) {

                $promoId = $promotion->id;
                if ($promotion->sign == 'Amount') {
                    $discount = (float)$promotion->amount;
                    $grandTotal = (float)$package->price - $discount;

                } elseif ($promotion->sign == 'Percentage') {
                    $discount = (((float)$package->price * (float)$promotion->amount) / 100);
                    $grandTotal = (float)$package->price - $discount;


                }
            }
        } else {
            $grandTotal = (float)$package->price;
        }

        if ($grandTotal < 1) {
            return redirect()->back();
        }

        return [$grandTotal, $packageId, $promoId, $discount];

    }

    public function generateCreditInvoice($id)
    {
        $paymentInfo = \App\Payment::with('paymentable', 'user', 'promotion')->whereId($id)->first();
        if(!$paymentInfo) {
            return $this->invalidMessage();
        }
        if($check = $this->checkAuthenticate($paymentInfo->user_id)) return $check;
        return view('site.pages.payment.invoice')->with(['paymentInfo' => $paymentInfo]);
    }
    public function generateOrderInvoice($order_no)
    {
        $order = Sales::with('items.product','user')->whereOrderNo($order_no)->first();
        if(!$order) {
            return $this->invalidMessage();
        }
        if($check = $this->checkAuthenticate($order->user_id)) return $check;
        return view('site.pages.payment.order-invoice',['order' => $order]);
    }

    public function makeSales($discount, $shippingCost, $payment_type) {
        $contact = Contact::whereUserId(auth()->user()->id)->first();
        $year = Carbon::now()->year;
        $month = Carbon::now()->month;
        $orderCount = Sales::whereYear('created_at', $year)
            ->whereMonth('created_at', $month)->count();
        $order_no = (string)($orderCount + 1);
        $order_no=strlen($order_no)>= 4 ? $order_no:strlen($order_no) == 3 ? '0'.$order_no :
            strlen($order_no) == 2 ? '00'.$order_no: strlen($order_no) == 1 ?'000'.$order_no:'';
        $order_no =(int)(date("y").date("m").$order_no);

        $sales= Sales::create([
            'order_no' => $order_no,
            'user_id' => auth()->user()->id,
            'user_name' => auth()->user()->name,
            'mobile' => $contact->mobile,
            'post_code' => $contact->post_code,
            'city' => $contact->city,
            'district' => $contact->district ,
            'address' => $contact->address,
            'discount' => $discount,
            'shipping_cost' => $shippingCost,
            'payment_type' => $payment_type,
        ]);

        foreach (Cart::content() as $item){
          SaleItem::create([
             'sales_id' => $sales->id,
             'product_id' => $item->id,
             'quantity' => $item->qty,
             'unit_price' => $item->price,
             'total_price' => $item->price * (float)$item->qty,
             'source' => $item->options['source'],
             'source_id' => $item->options['source_id'],
          ]);

          $product= Product::find($item->id);
          $product->update(['quantity' => $product->quantity - (int)$item->qty]);
        }
        return $order_no;
    }

}
