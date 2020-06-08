<template>
    <div>
        <div class="container bid-products-area " id="auctionProduct" >
            <div class="row mx-auto ">
                <div class="col-lg-4 col-md-4 col-xs-4" v-for="item in auctions">
                    <div class="products wow fadeInUp">

                        <div class="product-head default-a">
                            <a :href="'/auction/details/'+item.id+'/'+item.name">
                                <div>{{item.name}} </div>
                                <div v-if="item.product">RRP ${{item.product.price}}</div>
                            </a>

                        </div>
                        <a :href="'/auction/details/'+item.id+'/'+item.name">
                            <div class="photo">
                                <template v-for="(media,index) in item.medias">
                                    <img :src="'storage/'+media.image"
                                         class="img-fluid d-block" v-if="index==0">
                                </template>


                            </div>
                        </a>

                        <div class="stars">
                            {{item.cost_per_bid}} x <i class="fa fa-star"></i>
                        </div>
                        <div class="bottom-box">
                            <div>
                                <template v-if="item.bids.length">
                                    <b>
                                        ${{item.starting_price +
                                    (item.price_increase_every_bid * item.bids.length)}}
                                    </b>
                                </template>
                                <template v-else>
                                    <b>
                                        ${{item.starting_price}}
                                    </b>

                                </template>

                                <br>
                                <span :id="'liveClose'+item.id">Live</span>
                            </div>
                            <div id="stopMama">
                                <template v-if="item.bids.length">
                                    <template v-if="item.bids[item.bids.length-1].user">
                                        {{item.bids[item.bids.length - 1].user.username}} <br>
                                    </template>
                                </template>
                                <template v-else>
                                    No bid place yet
                                </template>

                                <b>
                                    <template v-if="item.slots.length">
                                        <div class="count" :id="'timer'+item.id"></div>
                                        <div :id="'bid'+item.id" v-show="false">false</div>
                                        <!--<div  :id="''+item.id" v-show="false">{{item.id}}</div>-->
                                        <div style="display: none;">
                                            {{ auctionTimeSlot(item.up_time, item.slots,
                                            item.id, item.is_closed, item.cost_per_bid,
                                            item.price_increase_every_bid,
                                            item.starting_price, item.bids)}}
                                        </div>
                                    </template>

                                </b>
                            </div>
                            <div :id="'hideBidOption'+item.id">

                                <button type="button" v-if="currentPath=='/'" >
                                    <a href="#login-area">
                                        <img src="/images/home/hammer-bidding.png" alt="">
                                    </a>

                                </button>
                                <button type="button" v-if="currentPath=='user-home'"

                                >
                                    <a href="#" @click.prevent="bidNow(item.id, item.cost_per_bid)"
                                       :id="'putAuction'+item.id" >
                                        <img src="/images/home/hammer-bidding.png" alt="">
                                    </a>

                                </button>

                                <button type="button">
                                    <template v-if="$root._data.user.hasOwnProperty('id')">
                                        <a :href="'/auto-bid/create?id='+item.id">
                                            <img src="/images/home/auto-bid.png" alt="">
                                        </a>
                                    </template>
                                    <template v-else>
                                        <a href="#login">
                                            <img src="/images/home/auto-bid.png" alt="">
                                        </a>
                                    </template>

                                </button>
                            </div>
                        </div>

                        <div class="bottom-box-two">
                            <div>

                                Price Drop as YOU BID <br> YOUR Price ${{getPriceDrop(item)}}

                            </div>
                            <div>
                                <a :href="'/auction-buy/'+item.id"> <img src="/images/home/buy.png" alt=""></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script src="./js/auction.js"></script>

<style scoped>
</style>