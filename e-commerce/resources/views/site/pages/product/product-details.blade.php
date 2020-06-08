@extends('site.app')
@section('title-meta')
    <title>Product Details</title>
@endsection

@section('content')
    @if(auth()->user())
        @include('.site.login.login-partitial.header')
    @endif
    <section>
        <div class="container">
            @if(auth()->user())
                <div class="row ">
                    <div class="partners">
                        <a href="/user-home##auctionProductRibon" class="section-links">Live Auctions</a>
                        <a href="/user-home#upcoming-auctionsRibon" class="section-links">Upcoming Auctions</a>
                        <a href="/user-home#closedAuctionsRibon" class="section-links">Closed Auctions</a>
                        <a href="/all-products" class="section-links">Regular product</a>
                        <a href="/how-it-works" class="section-links">How it works</a>
                    </div>
                </div>
            @endif
            <div class="row bg-white">
                <div class="col-md-8  row w-100">
                    <div class="col-lg-7 bg-white  pt-2">
                        <div class="gallery product">
                            @foreach($item->medias as $key=>$media)
                                @if($key==0)
                                    <div class="show"
                                         href="{{asset("storage/$media->image")}}" style="z-index: 1">

                                        <img src="{{asset("storage/$media->image")}}" alt=""
                                             id="show-img">
                                    </div>
                                @endif
                            @endforeach

                            <div class="small-img">
                                <img src="/images/online_icon_right@2x.png"
                                     class="icon-left" alt="" id="prev-img">
                                <div class="small-container">
                                    <div id="small-img-roll">
                                        @foreach($item->medias as $key=>$media)
                                            <img src="{{asset("storage/$media->image")}}"
                                                 class="show-small-img" alt="">
                                        @endforeach
                                    </div>
                                </div>
                                <img src="/images/online_icon_right@2x.png"
                                     class="icon-right" alt="" id="next-img">
                            </div>
                        </div>
                        {{--                            <div class="sp-wrap mt-3">]--}}
                        {{--                                @foreach($item->medias as $key=>$media)--}}
                        {{--                                    <a href="{{asset("storage/$media->image")}}">--}}
                        {{--                                        <img src="{{asset("storage/$media->image")}}"--}}
                        {{--                                             alt=""></a>--}}

                        {{--                                @endforeach--}}

                        {{--                            </div>--}}


                    </div>
                    <div class="col-lg-5 bg-white pt-2">
                        <div class="product-varient mt-5">
                            <div class="product-title">{{$item->name}}</div>
                            <div class="product-price">Price: <span>{{$setting->amount_sign}}{{$item->price}}</span>
                            </div>
                            <form method="post" action="{{url('/add-to-cart')}}">
                                @csrf
                                <div class="product-quantity">
                                    <span>quantity:</span>
                                    <input type="text" name="qty" min="1" value="1">
                                    <input type="hidden" name="id" value="{{$item->id}}">
                                </div>
                                <button type="submit" class="cart">add to cart</button>
                            </form>
                        </div>
                    </div>
                    <div class=" p-0 col-md-12">
                        <div class="product_details">
                            <div class="productDescription p-3">
                                <br>
                                <ul class="nav nav-tabs" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#home">Description</a>
                                    </li>
                                </ul>
                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <div id="home" class="container tab-pane active pt-3 pb-3">
                                        {!! $item->description !!}
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-lg-4 ml-5 bg-white p-0 pt-2 pr-2">
                    <div class="your-basket  mt-3">
                        <header>
                            your basket
                        </header>
                        <article>
                            <div class="max-input">
                                <table class="product-list">
                                    @php
                                        $count=1;
                                        $subTotal=0;
                                    @endphp
                                    @foreach($cartItems as $item)

                                        <tr>
                                            <td>{{$count}}. {{$item->name}}</td>
                                            <td>
                                                <input type="number"
                                                       min="1"
                                                       onchange="setCartUpdateUrl({{$item->id.",'".$item->rowId."'"}})"
                                                       onkeyup="setCartUpdateUrl({{$item->id.",'".$item->rowId."'"}})"
                                                       id="cartQuantity{{$item->id}}"
                                                       disabled
                                                       value="{{$item->qty}}"
                                                       style="width: 40px">

                                            </td>
                                            <td>{{$setting->amount_sign}}{{$item->price}}</td>
                                            <td>{{$setting->amount_sign}}{{$item->price*$item->qty}}</td>
                                            <td>
                                                <i class="fa fa-edit"
                                                   title="Edit"
                                                   onclick="editCartItem({{$item->id.",'".$item->rowId."'"}})"
                                                   id="cartEditBtn{{$item->id}}">

                                                </i>
                                                <a href="#" id="cartUpdateUrl{{$item->id}}">
                                                    <i class="fa fa-check"
                                                       title="Update"
                                                       id="cartUpdateBtn{{$item->id}}"
                                                       style="display: none">

                                                    </i>
                                                </a>
                                                <a href="{{url('/delete/cart-item/'.$item->rowId)}}">
                                                    <i class="fa fa-trash text-danger" title="Delete"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        @php
                                            $count++;
                                             $subTotal+=$item->price*$item->qty;
                                        @endphp
                                    @endforeach
                                </table>
                            </div>

                            <table class="additional-list">
                                <tr>
                                    <td>
                                        Promo Code
                                    </td>
                                    <td>
                                        <div class="promoSection">
                                            <input type="text"
                                                   onchange="setPromoLink({{$item->id.",'".$item->name."'"}})"
                                                   onkeyup="setPromoLink({{$item->id.",'".$item->name."'"}})"
                                                   class="promo"
                                                   required
                                                   id="promoInput"
                                            >
                                            <a href="#" id="promoLink"
                                               class="btn btn-sm btn-warning use-btn"
                                            >use</a>
                                        </div>

                                    </td>

                                </tr>
                                <tr>
                                    <td>Sub total</td>
                                    <td>{{$setting->amount_sign}}{{$subTotal}}</td>
                                </tr>
                                @if(count($cartItems))
                                    <tr>
                                        <td>(+) Delivery cost</td>
                                        @if($shippingCost)
                                            <td>{{$setting->amount_sign}}{{$shippingCost->amount}}</td>
                                        @else
                                            <td>{{$setting->amount_sign}}0</td>
                                        @endif
                                    </tr>
                                @else
                                    <tr>
                                        <td>(+) Delivery cost</td>
                                        <td>{{$setting->amount_sign}}0</td>
                                    </tr>
                                @endif
                                <tr>
                                    @if($promotion)

                                        <td>(-) Discount {{$promotion->sign=='Percentage'?
                                        '('.$promotion->amount.'%)':''}}</td>
                                        @if($promotion->sign=='Percentage')
                                            @php
                                                $discountAmount=($subTotal*
                                            $promotion->amount)/100
                                            @endphp
                                            <td>{{$setting->amount_sign}}{{$discountAmount}}</td>
                                        @else
                                            @php
                                                $discountAmount=$promotion->amount
                                            @endphp
                                            <td>{{$setting->amount_sign}}{{$promotion->amount}}</td>
                                        @endif

                                    @else
                                        @php
                                            $discountAmount=0
                                        @endphp
                                        <td>(-) Discount</td>
                                        <td>{{$setting->amount_sign}}0</td>
                                    @endif

                                </tr>
                                @if(count($cartItems))
                                    <tr>
                                        <td>Grand total</td>
                                        @if($shippingCost)
                                            @if($promotion)
                                                <td>
                                                    {{$setting->amount_sign}}{{($subTotal+$shippingCost->amount)
                                                    -$discountAmount}}</td>
                                            @else
                                                <td>{{$setting->amount_sign}}{{$subTotal+$shippingCost->amount}}</td>
                                            @endif

                                        @else
                                            <td>{{$setting->amount_sign}}{{$subTotal}}</td>
                                        @endif
                                    </tr>
                                @else
                                    <tr>
                                        <td>Grand total</td>
                                        <td>{{$setting->amount_sign}}{{$subTotal}}</td>
                                    </tr>
                                @endif
                            </table>

                        </article>

                        <footer>
                            @if(request()->input('pcode'))
                                <a href="{{url('/payment-confirmation?pcode='.request()->
                                input('pcode'))}}"
                                   class="checkout"
                                   style="margin-bottom: 5px;
                                   text-decoration: none">go to checkout</a>
                            @else
                                <a href="{{url('/payment-confirmation')}}"
                                   class="checkout"
                                   style="margin-bottom: 5px;
                                   text-decoration: none">go to checkout</a>
                            @endif

                            <a href="{{url('/all-products')}}"
                               class="checkout shopping" style="text-decoration: none">Continue
                                Shopping!</a>

                        </footer>
                    </div>
                </div>
            </div>

        </div>
    </section>

@endsection


@section('scripts')
    <script>
        function setPromoLink(id, name) {
            var val = $('#promoInput').val()
            $('#promoLink').attr('href', '/product/details/' + id + '/' + name + '?pcode=' + val)
        }

    </script>
@endsection

