<div class="panel-group" id="accordion">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse"   data-parent="#accordion" href="#collapse0" aria-expanded="true">My
                    Information</a>
            </h4>
        </div>
        <div id="collapse0" class="panel-collapse collapse in">
            <div class="panel-body">
                <div class="inner">
                    <a id='my_information' href="{{url('/user-details')}}" >Personal Information</a>
                    <a id='edit_setting' href="{{url('/user-details/settings')}}">Edit Information</a>
                    <a id='changePassword' href="{{url('/user-details/change-password')}}">Change Password</a>
                </div>
            </div>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">My Auctions</a>
            </h4>
        </div>
        <div id="collapse1" class="panel-collapse collapse in">
            <div class="panel-body">
                <div class="inner">
                    <a id="statistic" href="{{url('/user-details/statistic')}}">Statistics</a>
                    <a id="biddingHistory" href="{{url('/user-details/bidding-history')}}">Bidding History</a>
                    <a id="creditBuyingHistory" href="{{url('/user-details/credit-buy-history')}}">Credit buying history</a>
                </div>
            </div>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">My Referral</a>
            </h4>
        </div>
        <div id="collapse2" class="panel-collapse collapse in">
            <div class="panel-body">
                <div class="inner">
                    <a id="addReferral" href="{{url('/user-details/referral')}}">Referral info</a>
                    <a id="referFriend" href="{{url('/user-details/referral-friend')}}">Refer friend</a>
                </div>
            </div>
        </div>
    </div>
{{--    <div class="panel panel-default">--}}
{{--        <div class="panel-heading">--}}
{{--            <h4 class="panel-title">--}}
{{--                <a data-toggle="collapse" data-parent="#accordion" href="#collapse3">My Inbox</a>--}}
{{--            </h4>--}}
{{--        </div>--}}
{{--        <div id="collapse3" class="panel-collapse collapse">--}}
{{--            <div class="panel-body">--}}
{{--                <div class="inner">--}}
{{--                    <a href="#">My Messages(0)</a>--}}
{{--                    <a href="#">My Notifications(0)</a>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <div class="panel panel-default">--}}
{{--        <div class="panel-heading">--}}
{{--            <h4 class="panel-title">--}}
{{--                <a data-toggle="collapse" data-parent="#accordion" href="#collapse4">My--}}
{{--                    Referrals</a>--}}
{{--            </h4>--}}
{{--        </div>--}}
{{--        <div id="collapse4" class="panel-collapse collapse">--}}
{{--            <div class="panel-body">--}}
{{--                <div class="inner">--}}
{{--                    <a href="{{url('/user-details/refferal')}}">Referrals</a>--}}
{{--                    <a href="#">Cash Rewards</a>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapse5">My
                    Orders</a>
            </h4>
        </div>
        <div id="collapse5" class="panel-collapse collapse">
            <div class="panel-body">
                <div class="inner">
                    <a id="allOrder" href="{{url('/user-details/all-order')}}">All Order</a>
                    <a id="shipmentOrder" href="{{url('/user-details/shipment-order')}}">Shipment Order</a>
                    <a id="completedOrder" href="{{url('/user-details/completed-order')}}">Completed Orders</a>
                    <a id="cancelOrder" href="{{url('/user-details/cancel-order')}}">Cancel Order</a>
                </div>
            </div>
        </div>
    </div>

</div>

