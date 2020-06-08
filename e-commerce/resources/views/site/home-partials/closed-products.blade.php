<section>
    <div class="container products-area">
        <div class="row mx-auto">
            @foreach($closedAuctions as $closedItem)

                <div class="col-lg-3 col-md-2 col-xs-2 ">
                    <div class="product wow fadeInUp" style="position: relative">
                        <div class="sold">
                            <div>closed</div>
                        </div>
                        <p class="name">{{$closedItem->name}}</p>
                        <div class="photo">
                            @if(count($closedItem->medias))
                                <img src="{{asset('storage/'.$closedItem->medias[0]->image)}}" class="photo" alt="">
                            @else
                                <img src="/images/products/1.png" class="photo" alt="">
                            @endif

                        </div>
                        @if(count($closedItem->bids) > 1)
                            <div class="winner has-winner">
                                <img class="trophy" src="/images/trophy.png" alt="">
                                {{substr(($closedItem->bids[count($closedItem->bids)-1]->user->username),0,18)}}

                            </div>

                            <div class="status">ended</div>
                            <div class="status-ended">winner</div>
                        @else
                            <div class="winner">
                                No Winner Selected
                            </div>
                            <div class="status">ended</div>
                        @endif

                        <div class="price font-weight-bold" style="margin-top: 35px">

                            {{$setting->amount_sign}}
                            {{number_format((float)((count($closedItem->bids)*$closedItem->price_increase_every_bid)+$closedItem->starting_price), 2, '.', '')}}</div>
                        {{--<div class="type">Peregnius </div>--}}
                        @if(count($closedItem->bids) > 1)
                            @if(auth()->user())
                                @if($closedItem->bids[count($closedItem->bids)-1]->user->id == auth()->user()->id)

                                    @if(!(\App\Auction::isSold($closedItem)))
                                    <form method="post" action="{{url('/add-to-cart')}}">
                                        @csrf
                                        <div>
                                            <input type="hidden" name="qty" value="1">
                                            <input type="hidden" name="source" value="auction">
                                            <input type="hidden" name="source_id" value="{{$closedItem->id}}">
                                            <input type="hidden"
                                                   name="price"
                                                   value="{{(count($closedItem->bids) * $closedItem->price_increase_every_bid) + $closedItem->starting_price}}">
                                            <input type="hidden" name="id" value="{{$closedItem->product_id}}">
                                        </div>
                                        <button type="submit" class="closed">Buy Now</button>
                                    </form>
                                    @else
                                        <button class="closed">Sold</button>
                                    @endif
                                @else
                                    <button class="closed">Sold</button>
                                @endif
                            @else
                            <button class="closed">Sold</button>
                            @endif

                        @else
                            <button class="closed">Dismiss</button>
                        @endif

                    </div>

                </div>
            @endforeach

        </div>
    </div>
</section>
