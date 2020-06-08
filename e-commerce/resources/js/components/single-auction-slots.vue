<template>
    <div class="col-lg-6">

        <div class="details">
            <div class="top-box">
                <div class="doller-closed">
                    <template v-if="auctions.bids?auctions.bids.length:false">
                        ${{auctions.starting_price +
                    (auctions.price_increase_every_bid * auctions.bids.length)}}
                    </template>
                    <template v-else>
                        ${{auctions.starting_price}}
                    </template>
                    <br>
                    <span :id="'liveClose'+auctions.id">Live</span>
                </div>
                <div class="middle-content">

                    <template v-if="auctions.slots?auctions.slots.length:false">
                        <div class="count" :id="'timer'+auctions.id" style="padding: 9px"></div>
                        <div :id="'bid'+auctions.id" v-show="false">false</div>
                        <!--<div  :id="''+item.id" v-show="false">{{item.id}}</div>-->
                        <div style="display: none;">
                            {{ auctionTimeSlot(auctions.up_time, auctions.slots,
                            auctions.id, auctions.is_closed, auctions.cost_per_bid,
                            auctions.price_increase_every_bid,
                            auctions.starting_price, auctions.bids)}}
                        </div>
                    </template>
                </div>
                <div class="button-closed">
                    <button type="button">
                        <a href="#" @click.prevent="bidNow(auctions.id, auctions.cost_per_bid)"
                           :id="'putAuction'+auctions.id">
                            <img src="/images/home/hammer-bidding.png" alt="">
                        </a>

                    </button>

                    <button type="button">
                        <a href="/auto-bid/create">
                            <img src="/images/home/auto-bid.png" alt="">
                        </a>
                    </button>
                    <!--<button><img src="/images/home/hammer-bidding.png" alt=""></button>-->
                    <!--<button><img src="/images/home/auto-bid.png" alt=""></button>-->
                </div>
            </div>
            <div class="bottom-box">
                <div>
                    Price Drop As YOU BID <br>
                    YOUR Price ${{getPriceDrop(auctions)}}
                </div>
                <a :href="'/auction-buy/'+auctions.id">
                    <img src="/images/home/buy.png " alt="">
                </a>
            </div>

            <div class="bidderAmount">
                <div class="bidder"> Bidder Name</div>
                <div class="amount"> Cost</div>
            </div>
            <div class="userContainer">


                <div class="usersBidder" v-for="(item,index) in getItem(auctions.bids)">
                    <div>{{item.user ? item.user.name : ''}}</div>

                    <div>
                        {{(parseFloat(auctions.price_increase_every_bid) *
                    ((auctions.bids.length) - index))+parseFloat(auctions.starting_price)}}
                    </div>
                </div>


            </div>


        </div>


    </div>
</template>
<script src="./js/single-auction.js"></script>

