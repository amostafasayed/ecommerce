<section>
    <div class="container products-area" id="auctionProductRibon">
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
                        @if(count($closedItem->bids))
                            <div class="winner has-winner">
                                <img class="trophy" src="/images/trophy.png" alt="">
                                {{substr(($closedItem->bids[count($closedItem->bids)-1]->user->name),0,18)}}

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

                            ${{number_format((float)((count($closedItem->bids)*$closedItem->price_increase_every_bid)+$closedItem->starting_price), 2, '.', '')}}</div>
                        {{--<div class="type">Peregnius </div>--}}
                        @if(count($closedItem->bids))
                            <button class="closed">Sold</button>
                        @else
                            <button class="closed">Dismiss</button>
                        @endif

                    </div>

                </div>
            @endforeach

        </div>
    </div>
</section>
