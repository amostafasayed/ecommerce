@extends('site.app')
@section('title-meta')
    <title>Shopping Cart </title>
@endsection

@section('content')
    @if(auth()->user())
        @include('site.login.login-partitial.header')
    @endif


    <div class="container bg-white aboutUS">
        <div class="row p-5 header">
            <div class="col-md-9 mx-auto">
                <br>
                <h3 class="shoppingTitle"
                    style="    background: rgb(249, 243, 220);
                    color: black">At a glance Your Shopping cart</h3><br>
                <div class="basket">
                    <p class="title">Your Basket</p>
                    <div class="confirmCart">
                        <div class="productList">
                            @php
                                $count=1;
                                $subTotal=0;
                            @endphp
                            <p class="font-weight-bold">
                                <span>Product</span>
                                <span style="flex: 1">Quantity</span>
                                <span style="width: 50px;">Total</span>
                                <span>Action</span>
                            </p>
                            @foreach($cartItems as $item)
                                <p>
                                    <span>{{$count}}. {{$item->name}}</span>
                                    <span style="flex: 1">
                                              <input type="number"
                                                     min="1"
                                                     class="text-center"
                                                     onchange="setCartUpdateUrl({{$item->id.",'".$item->rowId."'"}})"
                                                     onkeyup="setCartUpdateUrl({{$item->id.",'".$item->rowId."'"}})"
                                                     id="cartQuantity{{$item->id}}"
                                                     disabled
                                                     value="{{$item->qty}}"
                                                     style="width: 45px; padding:0 5px;">
                                    </span>
                                    <span style="width: 50px;">{{$setting->amount_sign}}{{$item->price}}</span>
                                    <span class="d-flex justify-content-end align-items-center">

                                     @if($item->options['source'] != 'auction')
                                     <i class="fa fa-edit" onclick="editCartItem({{$item->id.",'".$item->rowId."'"}})"
                                        id="cartEditBtn{{$item->id}}" title="Edit"></i>
                                    @endif
                                    <a href="{{url('/delete/cart-item/'.$item->rowId)}}"
                                       title="Delete">
                                        <i class="fa fa-trash text-danger mx-2"></i>
                                    </a>

                                            <a href="#" id="cartUpdateUrl{{$item->id}}" class="text-success" title="Update">
                                                                    <i class="fa fa-check"
                                                                       id="cartUpdateBtn{{$item->id}}"
                                                                       style="display: none;"></i>

                                             </a>



                                </span>
                                </p>
                                @php
                                    $count++;
                                     $subTotal+=$item->price*$item->qty;
                                @endphp
                            @endforeach

                        </div>
                        <div class="fix px-2 fixCart">
                            <p class="mb-3">
                                <small class="font-weight-bold">Promo Code</small>
                                <span>
                                        <input type="text"
                                               class="promo"
                                               id="promoInput"
                                               onchange="setPromoLink()"
                                               onkeyup="setPromoLink()"
                                               style=" height: 30px;  vertical-align: middle;"
                                        >
                                        <a href="#"
                                           id="promoLink"
                                           class="btn btn-sm btn-warning use-btn"
                                        >use</a>
                               </span>
                            </p>
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
                <div class="buttonSection" style="width: 50%;float: right;">
                    <a href="{{url('/all-products')}}"
                       class="confirmPay shopping"
                       style="color: black;
                                background: #dadada;
                           text-decoration: none;"
                    >Continue Shopping!</a>

                    @if(request()->input('pcode'))
                        <a href="{{url('/payment-confirmation?pcode='.request()->
                                input('pcode'))}}"
                           class="confirmPay"
                           style="background: #6174ff;color:black;
                                   text-decoration: none">Go to checkout</a>
                    @else
                        <a href="{{url('/payment-confirmation')}}"
                           class="confirmPay"
                           style="background: #6174ff;
                           color:black;
                           text-decoration: none"
                        >
                            Go to checkout</a>
                    @endif

                </div>

            </div>
        </div>


    </div>

@endsection



@section('scripts')
    <script>
        function setPromoLink() {
            var val = $('#promoInput').val()
            $('#promoLink').attr('href', '/view-cart?pcode=' + val)
        }

    </script>
@endsection