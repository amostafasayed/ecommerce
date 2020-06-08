@extends('site.app')
@section('title-meta')
    <title>Confirm Payments</title>
@endsection

@section('content')
    @if(auth()->user())
        @include('site.login.login-partitial.header')
        @include('site.login.login-partitial.nav')
    @endif

    <div class="container bg-white">
        <form method="post" action="{{url('/make-payment')}}">
            @csrf
            <div class="row py-2 header">
                <div class="col-md-4"><br>
                    <h6 class="font-weight-bold">Delivery Information </h6>
                    <p></p>
                    <div class="deliverInfo">
                        <div class="form-group">
                            <label for="">Full Name <span class="text-danger">*</span></label>
                            <input type="text"
                                   class="form-control" id=""
                                   name="name"
                                   required
                                   value="{{ old('name', $user->name) }}"
                                   placeholder="Enter your full name ">
                            @if ($errors->has('name'))
                                <div class="error">{{ $errors->first('name') }}</div>
                            @endif
                            <input type="hidden" value="{{request()->get('pcode')}}" name="package_code">
                        </div>

                        <div class="form-group">
                            <label for="">Mobile No <span class="text-danger">*</span></label>
                            <input type="number"
                                   name="mobile"
                                   class="form-control"
                                   required
                                   value="{{ old('mobile', $user->contact ? $user->contact->mobile: '') }}"
                                   placeholder="Mobile No">
                            @if ($errors->has('mobile'))
                                <div class="error">{{ $errors->first('mobile') }}</div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Address</label>
                            <input type="text" class="form-control" name="address"
                                   value="{{ old('address', $user->contact ? $user->contact->address: '') }}"
                                   placeholder="For example : House 123, Street 123 "
                                   required
                            >
                            @if ($errors->has('address'))
                                <div class="error">{{ $errors->first('address') }}</div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for=""> District <span class="text-danger">*</span></label>

                            <select class="form-control" name="district" required>
                                @foreach($districts as $district)
                                <option value="{{$district['name']}}"
                                    @if ( old('district', $user->contact ? $user->contact->district : '' ) == $district['name'] )
                                        selected
                                    @endif
                                >{{$district['name']}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('district'))
                                <div class="error">{{ $errors->first('district') }}</div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for=""> City <span class="text-danger">*</span> </label>
                            <input type="text"
                                   name="city"
                                   required
                                   value="{{ old('city', $user->contact ? $user->contact->city : '') }}"
                                   class="form-control"
                                   placeholder="City name">
                            @if ($errors->has('city'))
                                <div class="error">{{ $errors->first('city') }}</div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for=""> Post Code</label>
                            <input type="number"
                                   name="post_code"
                                   value="{{ old('post_code', $user->contact ? $user->contact->post_code : '') }}"
                                   class="form-control"
                                   placeholder="Post Code">
                        </div>
                    </div>

                </div>
                <div class="col-md-4"><br>
                    <h6 class="font-weight-bold">Select a Payment Method</h6>
                    <p></p>
                    <ul class="payments">
                        <li>
                            <label class="payment-items">
                                <img src="/images/bkash.png" class="img-fluid">
                                <p>Bkash, Rocket, U-cash, Debit Card, Credit Card or Online Banking</p>
                                <input type="radio"
                                       name="payment_method"
                                       value="ssl" required
                                       @if (old('payment_method')=='ssl')
                                            checked
                                        @endif>
                            </label>
                        </li>
                        <li>
                            <label class="payment-items">
                                <img src="/images/dbbl.png" class="img-fluid">
                                <p>PayPal</p>
                                <input type="radio"
                                       name="payment_method"
                                       value="paypal"
                                       @if (old('payment_method')=='paypal')
                                             checked
                                        @endif>
                            </label>
                        </li>
                        <li>
                            <label class="payment-items">
                                <img src="/images/master-card.png" class="img-fluid">
                                <p>Cash On Deliver</p>
                                <input type="radio"
                                       name="payment_method"
                                       value="cash_on_delivery"
                                       @if (old('payment_method')=='cash_on_delivery')
                                        checked
                                        @endif>
                            </label>
                        </li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <br>


                    <div class="basket">
                        <p class="title">Your Items</p>
                        <div class="confirmCart">
                            <div class="productList">
                                @php
                                    $count=1;
                                    $subTotal=0;
                                @endphp
                                <p class="font-weight-bold">
                                    <span>Product</span>
                                    <span>Quantity</span>
                                    <span>Total</span>
                                </p>
                                @foreach($cartItems as $item)
                                    <p>
                                        <span>{{$count}}. {{$item->name}}</span>
                                        <span>{{$item->qty}}</span>
                                        <span>{{$setting->amount_sign}}{{$item->price}}</span>
                                    </p>
                                    @php
                                        $count++;
                                         $subTotal+=$item->price*$item->qty;
                                    @endphp
                                @endforeach
                            </div>
                            <div class="fix">
                                <p><span>Sub total </span><span>{{$setting->amount_sign}}{{$subTotal}}</span></p>
                                <p><span>(+) Delivery cost </span>
                                    <span>{{$setting->amount_sign}}{{$shippingCost?$shippingCost->amount:0}}</span>
                                </p>
                                <p>
                                @if($promotion)

                                    <span>(-) Discount {{$promotion->sign=='Percentage'?
                                        '('.$promotion->amount.'%)':''}}</span>
                                    @if($promotion->sign=='Percentage')
                                        @php
                                            $discountAmount=($subTotal*
                                        $promotion->amount)/100
                                        @endphp
                                        <span>{{$setting->amount_sign}}{{$discountAmount}}</span>
                                    @else
                                        @php
                                            $discountAmount=$promotion->amount
                                        @endphp
                                        <span>{{$setting->amount_sign}}{{$promotion->amount}}</span>
                                    @endif

                                @else
                                        @php
                                            $discountAmount=0
                                        @endphp
                                    <span>(-) Discount</span>
                                    <span>{{$setting->amount_sign}}0</span>
                                @endif
                                </p>
                                <p class="mt-2 font-weight-bold">
                                    <span>Grand Total </span>
                                    <span>{{$setting->amount_sign}}
                                        {{($subTotal+($shippingCost?$shippingCost->amount:0)-$discountAmount)}}</span>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="buttonSection">

                            <a href="{{url('/all-products')}}"
                               class="confirmPay shopping"
                               style="color: black;text-decoration: none"
                            >Continue Shopping!</a>

                        <button type="submit" class="confirmPay">Confirm Order!</button>
                    </div>

                </div>
            </div>
        </form>
    </div>




@endsection



@section('scripts')

    <style>


        .payments li {
            list-style: none;
            border-bottom: 3px double #ececec;
            border-top: 3px double #ececec;
            margin-bottom: 9px;
            transition: 0.4s all;
        }

        .payments li label {
            cursor: pointer;
            margin: 0;
        }

        .payments li:hover {
            border-bottom: 3px double #f4b234;
            border-top: 3px double #f4b234;
            background: #ececec;
        }

        .payments li .payment-items {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .payments li .payment-items:focus-within {
            background: #ffeeb3;
        }

        .payments li .payment-items img {
            flex: 1;
            max-width: 50px;
            border: 1px solid #ececec;
            padding: 8px;
            filter: saturate(0.4);
            transition: 0.4s all;
        }

        .payments li .payment-items p {
            flex: 3;
            margin-bottom: 0;
            padding: 6px 5px;
            line-height: 14px;
            font-size: 13px;
            color: #424242;
        }

        .payments li .payment-items input[type='radio'] {
            flex: 0.4;
            cursor: pointer;
        }

        .payments li .payment-items:hover img {
            filter: saturate(1);
        }
        .use-btn{
            line-height: 1.25;margin-top: -2px;
        }
    </style>



@endsection