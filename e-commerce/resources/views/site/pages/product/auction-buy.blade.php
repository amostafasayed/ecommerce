@extends('site.app')
@section('title-meta')
    <title>Buy Auction</title>
@endsection

@section('content')
    @if(auth()->user())
        @include('.site.login.login-partitial.header')
    @endif


 <div class="container bg-white">
    <div class="row">
        <div class="col-lg-5">

            <div class="gallery pt-4">
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


        </div>
        <div class="col-lg-7 pr-0">
            <div class="buyAuctionRight">

                <div class="productTitle"><br>
                        <h4>{{$item->product->name}}</h4>
                        <h4>{{$setting->amount_sign}}{{$item->product->price}}</h4>
                </div>

                    <article>
                        Buy now before the auction closes
                    </article>

                <div class="priceplan">
                    <div>
                        <span>value price</span>
                        <span>{{$setting->amount_sign}}{{$item->product->price}}</span>
                    </div>
                    <div style="border-bottom: 1px solid black">
                       <span>Bid Credits Discount({{$item->price_drop_percentage}}%)</span>
                        <span>{{$setting->amount_sign}}
                            {{(($userBid*($item->cost_per_bid*10))*
                        $item->price_drop_percentage)/100}}</span>
                    </div>
                    <div>

                        {{--<input type="range" min="1" max="100" value="50" class="range" id="myRange">--}}

                    </div>
                    <div>
                       <span>Buy now  price</span>
                        <span>
                            {{$setting->amount_sign}}
                            {{$item->product->price-
                            (($userBid*($item->cost_per_bid*10))*
                            $item->price_drop_percentage)/100}}</span>
                    </div>
                </div>

                <form method="post" action="{{url('/add-to-cart')}}">
                    @csrf
                    <div class="product-quantity">
                        <input type="hidden" name="qty" value="1">
                        <input type="hidden" name="source" value="auction">
                        <input type="hidden"
                               name="price"
                               value="{{$item->product->price-
                            (($userBid*($item->cost_per_bid*10))*
                            $item->price_drop_percentage)/100}}">
                        <input type="hidden" name="id" value="{{$item->id}}">
                    </div>
                    <button type="submit" class="buy-now">Buy Now</button>
                </form>

            </div>


        </div>
    </div>
     <div class="row">
            <div class="col-md-12 aucBuydescription pt-3">
                <ul class="nav nav-tabs">
                    <li class="active">
                        <a data-toggle="tab" href="#home">Description</a></li>
                    {{--<li><a data-toggle="tab" href="#others">others</a></li>--}}

                </ul>
                <div class="tab-content">
                    <div id="home" class="tab-pane  fade in active">
                        <br>
                        {!! $item->description !!}
                    </div>
                    {{--<div id="others" class="tab-pane fade">--}}
                        {{--<br>--}}
                        {{--<p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>--}}
                    {{--</div>--}}

            </div>
            </div>
     </div>
 </div>

@endsection



@section('scripts')
@endsection