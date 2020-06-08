<section id="live-auctions">
    <div class="container auction-products-area">
        <div class="row mx-auto">

            @foreach($upCommingAuction as $upItem)
            <div class="col-lg-4">
                <div class="products">
                    <div class="product-head default-a">
                        <a href="{{url('auction/details/'.$upItem->id).'/'.$upItem->name}}">
                        <div>{{$upItem->name}}</div>
                        <div>RRP ${{$upItem->product->price}}</div>
                        </a>
                        <a href="" class="buy">
                            <img src="/images/home/clip_pin.png">
                        </a>
                    </div>
                    <a href="{{url('auction/details/'.$upItem->id).'/'.$upItem->name}}">
                    <div class="photo">
                        @foreach($upItem->medias as $key=>$media)
                            @if($key==0)
                                <img src="{{asset("storage/$media->image")}}" alt=""
                                     class="img-fluid d-block">
                            @endif
                        @endforeach

                    </div>
                    </a>
                    <div class="stars align-items-center justify-content-end d-flex">

                        {{$upItem->cost_per_bid}} x  <i class="fa fa-star"></i>

                    </div>

                    <div class="bottom-box">
                        <div id="{{'countDownValue'.$upItem->id}}" v-show="false">{{$upItem->up_time}}
                        </div>

                        <div v-show="false">
                            @{{ countDown({!! '\''.$upItem->id.'\','.'\''.$upItem->up_time.'\'' !!}) }}
                        </div>

                        <div class="pl-2">
                             ${{number_format((float)$upItem->starting_price, 2, '.', '')}}
                        </div>

                         <div id="{{'getting-started'.$upItem->id}}"> </div>

                        <div>
                            <button type="button">
                                <img src="/images/home/reminder.png">
                            </button>
                       </div>

                </div>
            </div>
        </div>
            @endforeach
        </div>
        </div>
    </div>

</section>