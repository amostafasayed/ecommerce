<?php
/**
 * Created by PhpStorm.
 * User: Raz
 * Date: 12/14/2019
 * Time: 9:14 PM
 */

namespace App\Http\Traits;

use App\Http\Controllers\PaymentController;
use App\Package;
use App\ShippingCost;
use App\User;
use Illuminate\Http\Request;
use Mockery\Exception;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use Cart;
trait Paypal
{
    public function payPalIntegration($request, $grandTotal, $paymentableId,$promoId,$from=null,$discount)
    {

        if (!auth()->user()) {
            return redirect()->back();
        }
        $apiContext = new \PayPal\Rest\ApiContext(
            new \PayPal\Auth\OAuthTokenCredential(
                env('PAYPAL_ID'),
                env('PAYPAL_SECRET')
            )
        );
        $converstionRate=(float)env('CONVERSION_RATE');
        $converstionAmount=$grandTotal/$converstionRate;
        $payer = new Payer();
        $payer->setPaymentMethod("paypal");

        $item1 = new Item();
        $item1->setName('Payment From Billboard')
            ->setCurrency('USD')
            ->setQuantity(1)
            ->setPrice($converstionAmount);
        $itemList = new ItemList();
        $itemList->setItems(array($item1));

        $details = new Details();
        $details->setSubtotal($converstionAmount);

        $amount = new Amount();
        $amount->setCurrency("USD")
            ->setTotal($converstionAmount)
            ->setDetails($details);

        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($itemList)
            ->setDescription("Payment description")
            ->setReferenceId(date('ymdhis'))
            ->setInvoiceNumber(uniqid());

        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl(env('URL_PRE').'/payment-done?success=true')
            ->setCancelUrl(env('URL_PRE').'/payment-done?success=true');

        $payment = new Payment();
        $payment->setIntent("sale")
            ->setPayer($payer)
            ->setRedirectUrls($redirectUrls)
            ->setTransactions(array($transaction));

//        $payment->create($apiContext);
        try {
            $payment->create($apiContext);
        } catch (PayPal\Exception\PayPalConnectionException $e) {
            echo $e->getData(); // This will print a JSON which has specific details about the error.
            exit;
        }
        $request->session()->put('paymentable_id', $paymentableId);
        $request->session()->put('promotion_id', $promoId);
        $request->session()->put('from', $from);
        $request->session()->put('discount', $discount);
        $request->session()->put('original_amount', $grandTotal);
        return redirect($payment->getApprovalLink());


    }

    public function afterPayment(Request $request)
    {

        $apiContext = new \PayPal\Rest\ApiContext(
            new \PayPal\Auth\OAuthTokenCredential(
                env('PAYPAL_ID'),
                env('PAYPAL_SECRET')
            )
        );

        if (isset($_GET['success']) && $_GET['success'] == 'true') {
            if(isset($_GET['paymentId'])){
                $paymentId = $_GET['paymentId'];
                $payment = Payment::get($paymentId, $apiContext);
                $paymentAmount = (float)$payment->transactions[0]->amount->total;
                $execution = new PaymentExecution();
                $execution->setPayerId($_GET['PayerID']);

                $transaction = new Transaction();
                $amount = new Amount();
                $details = new Details();
                $details->setSubtotal($paymentAmount);
                $amount->setCurrency('USD');
                $amount->setTotal($paymentAmount);
                $amount->setDetails($details);
                $transaction->setAmount($amount);
                $execution->addTransaction($transaction);
                $payment->execute($execution, $apiContext);

                if(! $request->session()->get('from')){
                    $pacakge = Package::find($request->session()->get('paymentable_id'));
                    $paymentInsert=\App\Payment::create([
                        'paymentable_id' => $request->session()->get('paymentable_id'),
                        'paymentable_type' => "App\Package",
                        'amount' => $request->session()->get('original_amount'),
                        'dollar_amount' => $paymentAmount,
                        'discount_amount' => $request->session()->get('discount'),
                        'promotion_id' => $request->session()->get('promotion_id'),
                        'payment_gateway' => 'Paypal',
                        'payment_method' => 'Paypal',
                        'credit' => $pacakge->credit,
                        'user_id' => auth()->user()->id
                    ]);
                    ;
                    $orderNo=str_replace("-","",
                        substr($paymentInsert->created_at, 0, 10));
                    $paymentInsert->update(['order_no'=> 'CR'.$orderNo.'000'.$paymentInsert->id]);
                    $user = User::whereId(auth()->user()->id);
                    $user->update(['credit_balance' => auth()->user()->credit_balance + $pacakge->credit]);
                    $request->session()->forget('paymentable_id');
                    $request->session()->forget('promotion_id');
                    $request->session()->forget('from');
                    $creditEmailData = [
                        'name' => auth()->user()->name,
                        'order_no' => 'CR'.$orderNo.'000'.$paymentInsert->id,
                        'order_id' => $paymentInsert->id
                    ];
                    $this->sendEmail('email.email-credit-purchase', $creditEmailData,'Credit Purchase Confirmation',  auth()->user()->email);
                    return redirect('/generate-invoice/'.$paymentInsert->id);
                }else{
                    $shippingCost = ShippingCost::orderBy('id', 'DESC')->first();
                    $orderNo = PaymentController::makeSales($request->session()->get('discount'), (float)$shippingCost->amount, 'paypal');
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
                }
            }else{
                return redirect('/user-home');
            }
        }
    }


}