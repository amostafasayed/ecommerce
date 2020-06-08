<?php
/**
 * Created by PhpStorm.
 * User: Raz
 * Date: 12/14/2019
 * Time: 9:17 PM
 */

namespace App\Http\Traits;


use App\Http\Controllers\PaymentController;
use App\Package;
use App\ShippingCost;
use App\StoreIntial;
use App\User;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Session;
use Cart;

trait Ssl
{

    public function sslPayment($request, $grandTotal, $paymentableId,$promoId,$from=null,$discount)
    {
        $store=StoreIntial::whereId(1);
        if($store->count()){
            $store=StoreIntial::whereId(1);
            $store->update([
                'data_1'=>$paymentableId,
                'data_2'=>$promoId,
                'data_3'=>$from,
                'data_4'=>$discount,
            ]);
        }else{
          StoreIntial::create([
              'data_1'=>$paymentableId,
              'data_2'=>$promoId,
              'data_3'=>$from,
              'data_4'=>$discount,
          ]);
        }
        $post_data = array();
        $post_data['store_id'] = env('SSL_ID');
        $post_data['store_passwd'] = env('SSL_SECRET');
        $post_data['total_amount'] = $grandTotal;
        $post_data['currency'] = "BDT";
        $post_data['tran_id'] = "SSLCZ_TEST_" . uniqid();
        $post_data['success_url'] = env('URL_PRE')."/ssl/payment-done";
        $post_data['fail_url'] = env('URL_PRE')."/ssl/payment-fail";
        $post_data['cancel_url'] = env('URL_PRE')."/ssl/payment-cancel";

        
# EMI INFO
        $post_data['emi_option'] = "0";
        $post_data['emi_max_inst_option'] = "9";
        $post_data['emi_selected_inst'] = "9";

# CUSTOMER INFORMATION
        $post_data['cus_name'] = auth()->user()->name;
        $post_data['cus_email'] = auth()->user()->email;
        $post_data['cus_add1'] = "";
        $post_data['cus_add2'] = "";
        $post_data['cus_city'] = "";
        $post_data['cus_state'] = "";
        $post_data['cus_postcode'] = "";
        $post_data['cus_country'] = "";
        $post_data['cus_phone'] = "";
        $post_data['cus_fax'] = "";

# SHIPMENT INFORMATION
        $post_data['ship_name'] = "";
        $post_data['ship_add1 '] = "";
        $post_data['ship_add2'] = "";
        $post_data['ship_city'] = "";
        $post_data['ship_state'] = "";
        $post_data['ship_postcode'] = "";
        $post_data['ship_country'] = "";

# OPTIONAL PARAMETERS
        $post_data['value_a'] = "";
        $post_data['value_b '] = "";
        $post_data['value_c'] = "";
        $post_data['value_d'] = "";

# CART PARAMETERS
        $post_data['cart'] = json_encode(array(
            array("product" => $paymentableId, "amount" => $promoId),
        ));
//        $post_data['product_amount'] = "100";
//        $post_data['vat'] = "5";
//        $post_data['discount_amount'] = "5";
//        $post_data['convenience_fee'] = "3";


        
        $direct_api_url = "https://sandbox.sslcommerz.com/gwprocess/v3/api.php";

        $handle = curl_init();
        curl_setopt($handle, CURLOPT_URL, $direct_api_url);
        curl_setopt($handle, CURLOPT_TIMEOUT, 30);
        curl_setopt($handle, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($handle, CURLOPT_POST, 1);
        curl_setopt($handle, CURLOPT_POSTFIELDS, $post_data);
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, FALSE); # KEEP IT FALSE IF YOU RUN FROM LOCAL PC

        $content = curl_exec($handle);

        $code = curl_getinfo($handle, CURLINFO_HTTP_CODE);

        if ($code == 200 && !(curl_errno($handle))) {
            curl_close($handle);
            $sslcommerzResponse = $content;
        } else {
            curl_close($handle);
            echo "FAILED TO CONNECT WITH SSLCOMMERZ API";
            exit;
        }

        $sslcz = json_decode($sslcommerzResponse, true);

        if (isset($sslcz['GatewayPageURL']) && $sslcz['GatewayPageURL'] != "") {
            # THERE ARE MANY WAYS TO REDIRECT - Javascript,
            # Meta Tag or Php Header Redirect or Other
            # echo "<script>window.location.href = '". $sslcz['GatewayPageURL'] ."';</script>";
            echo "<meta http-equiv='refresh' content='0;url=" . $sslcz['GatewayPageURL'] . "'>";
            # header("Location: ". $sslcz['GatewayPageURL']);
            exit;
        } else {
            echo "JSON Data parsing error!";
        }


    }

    public function afterPaymentSsl()
    {

        $val_id = urlencode($_POST['val_id']);
        $store_id = urlencode(env('SSL_ID'));
        $store_passwd = urlencode(env('SSL_SECRET'));
        $requested_url = ("https://sandbox.sslcommerz.com/validator/api/validationserverAPI.php?val_id=" . $val_id . "&store_id=" . $store_id . "&store_passwd=" . $store_passwd . "&v=1&format=json");

        $handle = curl_init();
        curl_setopt($handle, CURLOPT_URL, $requested_url);
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($handle, CURLOPT_SSL_VERIFYHOST, false); # IF YOU RUN FROM LOCAL PC
        curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, false); # IF YOU RUN FROM LOCAL PC

        $result = curl_exec($handle);

        $code = curl_getinfo($handle, CURLINFO_HTTP_CODE);

        if ($code == 200 && !(curl_errno($handle))) {
            # TO CONVERT AS ARRAY
            # $result = json_decode($result, true);
            # $status = $result['status'];
            # TO CONVERT AS OBJECT
            $result = json_decode($result);
            # TRANSACTION INFO
            $status = $result->status;
            $tran_date = $result->tran_date;
            $tran_id = $result->tran_id;
            $val_id = $result->val_id;
            $amount = $result->amount;
            $store_amount = $result->store_amount;
            $bank_tran_id = $result->bank_tran_id;
            $card_type = $result->card_type;

            # EMI INFO
            $emi_instalment = $result->emi_instalment;
            $emi_amount = $result->emi_amount;
            $emi_description = $result->emi_description;
            $emi_issuer = $result->emi_issuer;

            # ISSUER INFO
            $card_no = $result->card_no;
            $card_issuer = $result->card_issuer;
            $card_brand = $result->card_brand;
            $card_issuer_country = $result->card_issuer_country;
            $card_issuer_country_code = $result->card_issuer_country_code;

            # API AUTHENTICATION
            $APIConnect = $result->APIConnect;
            $validated_on = $result->validated_on;
            $gw_version = $result->gw_version;

            $store=StoreIntial::whereId(1)->first();
            if(!$store->data_3){
                $pacakge = Package::find($store->data_1);
                $paymentInsert=\App\Payment::create([
                    'paymentable_id' =>$store->data_1,
                    'paymentable_type' => "App\Package",
                    'amount' => $amount,
                    'discount_amount' => $store->data_4,
                    'promotion_id' =>$store->data_2,
                    'payment_gateway' => 'Ssl',
                    'payment_method' => 'Ssl',
                    'credit' => $pacakge->credit,
                    'user_id' => auth()->user()->id
                ]);
                ;
                $orderNo=str_replace("-","",
                    substr($paymentInsert->created_at, 0, 10));
                $paymentInsert->update(['order_no'=>'CR'.$orderNo.'000'.$paymentInsert->id]);
                $user = User::whereId(auth()->user()->id);
                $user->update(['credit_balance' => auth()->user()->credit_balance + $pacakge->credit]);
                $creditEmailData = [
                    'name' => auth()->user()->name,
                    'order_no' => 'CR'.$orderNo.'000'.$paymentInsert->id,
                    'order_id' => $paymentInsert->id
                ];
                $this->sendEmail('email.email-credit-purchase', $creditEmailData,'Credit Purchase Confirmation',  auth()->user()->email);
                return redirect('/generate-invoice/'.$paymentInsert->id);
            }else{
                $shippingCost = ShippingCost::orderBy('id', 'DESC')->first();
                $orderNo = PaymentController::makeSales($store->data_4, (float)$shippingCost->amount, 'ssl');
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

        } else {

            echo "Failed to connect with SSLCOMMERZ";
        }
    }

    public function failPaymentSsl()
    {
        return redirect('/user-home');
    }

    public function cancelPaymentSsl()
    {
        return redirect('/user-home');
    }
}