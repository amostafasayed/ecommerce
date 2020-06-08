import {Auction} from "../../auctionClass";

export default {
    data() {
        return {
            auctions: {},
            slotRunningCount: 0,
            serverTime: window.serverTime,
            currentPath: window.currentPath,
            auctionObjects: [],
            renderComponent: true,
            bidBtnHit: false,
            onBidServerTime: '',
            autoBids: [],
            costBid:0,
        }
    },
    created() {

        this.getData()
        Echo.channel('bidChannel')
            .listen('.BidUpdate', (e) => {
                var ids = window.setTimeout(function () {
                }, 0);
                while (ids--) {
                    window.clearTimeout(ids);
                }
                this.forceRerender()
                $('#timer' + e.message).html('00:00:00');
                $('#timer' + e.message).css("background-color", "#ffa500")

                this.getData()
                setTimeout(function () {
                    $('#timer' + e.message).css("background-color", "")
                }, 300)


            });

    },

    methods: {

        getData() {
            var urls = window.currentPath.split('/')
            axios.get('/auction-single-data/' + urls[2]).then(res => {
                this.auctions = res.data.auctions
                this.onBidServerTime = res.data.serverTime
                this.autoBids = res.data.autoBidByUser
            })
        },
        auctionTimeSlot(upTime, slots, id, isClosed, costPerBid, price_increase_every_bid, starting_price, bids) {

            var ids = window.setTimeout(function () {
            }, 0);

            while (ids--) {
                window.clearTimeout(ids);
            }

            $('#timer' + id).css("background-color", "")

            var serTime = this.onBidServerTime ? this.onBidServerTime : this.serverTime
            if (this.moment(upTime).format('YYYY-MM-DD HH:mm:ss') <=
                this.moment(serTime).format('YYYY-MM-DD HH:mm:ss')) {

                var currentItemAutoBids = this.autoBids.filter(data => data.auction_id == id)
                var userIds = currentItemAutoBids.map(data => data.user_id)
                var randUserId = userIds[Math.floor(Math.random() * userIds.length)]

                var auction = new Auction(upTime, slots, id, isClosed, serTime,
                    costPerBid, price_increase_every_bid, starting_price, bids, currentItemAutoBids,
                    Math.floor(Math.random() * (9 - 5) + 5).toString(), randUserId, userIds);

                var bids = this.auctions.bids
                if (bids.length < 2) {
                    auction.setTimerWithServerTime()
                } else {
                    auction.setTimerWithBid(bids)
                }

                this.$nextTick(() => {

                    $('#timer' + id).html(auction.currentDiffTime ? auction.currentDiffTime : '');
                    auction.startTimer();
                })

            }

        },
        bidNow(id, costPerBid, is_auto = false) {

            if ($('#timer' + id).html() == '00:00:01') {
                return false;
            }


            var currentBalance = this.$root._data.user.credit_balance - costPerBid

            if (currentBalance >= 0) {
                axios.post('/bid', {
                    auction_id: id,
                    cost_bid: costPerBid,
                    auto: is_auto
                }).then(res => {

                })
            } else {
                alert("You don't have enough credit Please buy first.")
            }


        },

        forceRerender() {
            this.renderComponent = false;
            this.$nextTick(() => {
                this.renderComponent = true;
            });
        },
        getItem() {
            return _.orderBy(this.auctions.bids, ['id'], ['desc'])
        },
        getPriceDrop(item) {
            if (item) {
                if (this.$root._data.user.hasOwnProperty('id')) {
                    var userBids = item.bids.filter(data => data.user_id == this.$root._data.user.id)
                    if (item.product) {
                        var totalExpnes = userBids.length == 0 ? 0 :
                            userBids.length * (parseFloat(item.cost_per_bid)*10)
                        return parseFloat(item.product.price - ((parseFloat(totalExpnes) *
                            item.price_drop_percentage) / 100)).toFixed(2)
                    }

                } else {
                    return item.product.price
                }
            }
        },
        getItemCostBid(cost){

            // this.costBid = (parseFloat(this.costBid)+parseFloat(cost))
            this.costBid+=cost
            return this.costBid
        }


    }

}