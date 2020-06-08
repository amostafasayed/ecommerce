@extends('site.app')
@section('title-meta')
    <title>Firebidder user loged </title>
@endsection

@section('content')
    @include('.site.login.login-partitial.header')
    @include('.site.login.login-partitial.nav')

    <section class="myFirebidder">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>My Firebidders</h2>
                    <hr>
                </div>
                <div class="col-lg-3">
                    @component('site.login.user.components.leftBar') @endcomponent
                </div>
                <div class="col-lg-9 p-0">
                    <div class="userDetailsArea">
                        <h4 class="text-capitalize pb-3">Bid History</h4>
                        <table class="table-striped table text-capitalize">
                            <thead>
                            <tr>
                                <th>Auction Name</th>
                                <th>Cost Bid</th>
                                <th>Bidding Time</th>
                            </tr>
                            </thead>
                            <tbody>
                                @if(count($bids))
                                    @foreach($bids as $bid)
                                        <tr>
                                            <td> {{$bid->auction->name}}</td>
                                            <td> {{$bid->cost_bid}}</td>
                                            <td> {{$bid->created_at}}</td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="3"> No Bid History found.</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    {{ $bids->links() }}
                </div>
            </div>

        </div>
        </div>
    </section>
    @component('site.login.user.components.user-sub-footer') @endcomponent
@endsection
