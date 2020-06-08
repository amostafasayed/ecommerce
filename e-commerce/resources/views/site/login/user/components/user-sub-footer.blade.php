<section class="bottomBar">
    <div class="container">
        <div class="row">
            <div class="col-lg-9">
                <div class="footerFixedLinks ">
                    <i class="fa fa-cog"></i>
                    <a href="{{url('user-details/bidding-history')}}">
                        My FireBid
                    </a>
                    <i class="fa fa-star"></i>
                    <a href="{{url('user-details/credit-buy-history')}}">
                        Credits({{auth()->user()->credit_balance}})
                    </a>
                    <i class="fa fa-font"></i>
                    <a href="{{url('/auto-bid/create')}}">
                        Auto-bid
                    </a>
{{--                    <i class="fa fa-gift"></i>--}}
{{--                    <a href="">--}}
{{--                        Daily Free--}}
{{--                    </a>--}}
                </div>
            </div>
{{--            <div class="col-lg-3">--}}
{{--                <div class="footerFixedLinksRight ">--}}
{{--                    <i class="fa fa-envelope-o"></i>--}}
{{--                    <i class="fa fa-comment"></i>--}}
{{--                </div>--}}
{{--            </div>--}}
        </div>
    </div>
</section>