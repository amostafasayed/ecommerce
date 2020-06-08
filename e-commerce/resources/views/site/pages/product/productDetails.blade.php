@extends('site.app')
@section('title-meta')
    <title>Auction Details</title>
@endsection

@section('content')
    @if(auth()->user())
    @include('.site.login.login-partitial.header')
    @endif
    <section class="">
        <div class="container product-details">
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
            <div class="row ">
                <div class="col-lg-6 pr-0">
                    <div class="gallery">
                            <h4 class="product_name">{{$item->name}}</h4>
                             <h5 class="product_price">$ {{$item->product->price}}</h5>
                        <hr>

                        @foreach($item->medias as $key=>$media)
                            @if($key==0)
                                <div class="show"
                                     href="{{asset("storage/$media->image")}}" style="z-index: 1">

                                    <img src="{{asset("storage/$media->image")}}" alt=""
                                         id="show-img">
                                </div>
                            @endif
                        @endforeach
                        <div class="gallery-star">
                            <div>{{$item->cost_per_bid}} x
                                <i class="fa fa-star"></i></div>
                        </div>

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
                <auction-slots-single></auction-slots-single>
            </div>

            <div class="row">
                <div class="col-lg-12 product_details">
                    <div class="productDescription p-3">
                        <br>
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#home">Description</a>
                            </li>
                            {{--<li class="nav-item">--}}
                            {{--<a class="nav-link " data-toggle="tab" href="#terms">Terms & Condition</a>--}}
                            {{--</li>--}}

                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div id="home" class="container tab-pane active pt-3">
                                {!! $item->description !!}
                            </div>

                            {{--<div id="terms" class="container tab-pane "><br>--}}
                            {{--<p>--}}
                            {{--Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum iaculis massa nec velit--}}
                            {{--commodo lobortis. Quisque diam lacus, tincidunt vitae eros porta, sagittis rhoncus est.--}}

                            {{--</p>--}}
                            {{--</div>--}}
                        </div>
                    </div>

                </div>
            </div>
        </div>
        </div>
    </section>

@endsection