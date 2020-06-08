@extends('site.app')
@section('title-meta')
    <title>Statistic </title>
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
                        <h4 class="text-capitalize pb-3">My Statistics</h4>
                        <table class="table-striped table text-capitalize">
                            <tr>
                                <td> Auction Participated</td>
                                <td> {{$participate}}</td>
                            </tr>
                            <tr>
                                <td> Auction Won</td>
                                <td>
                                    @php
                                        $won = 0;
                                    @endphp
                                    @foreach($wonAuctions as $item)
                                        @if(count($item->bids) > 1)
                                            @if($item->bids[count($item->bids)-1]->user->id == auth()->user()->id)
                                                @php
                                                    $won++;
                                                @endphp
                                            @endif
                                        @endif
                                    @endforeach
                                    {{$won}}
                                </td>
                            </tr>
                            <tr>
                                <td> Credits Used</td>
                                <td> {{$creditUsed}}</td>
                            </tr>
                            <tr>
                                <td> Credits Bought</td>
                                <td> {{$creditBought}}</td>
                            </tr>
                            <tr>
                                <td> Welcome credit </td>
                                <td> {{$user->singUp_credit}}</td>
                            </tr>
                            <tr>
                                <td> Referral credit </td>
                                <td> {{$user->referral_credit}}</td>
                            </tr>
                            <tr>
                                <td> Credits Left</td>
                                <td> {{$creditLeft + ($user->singUp_credit + $user->referral_credit)}}</td>
                            </tr>
                        </table>

                    </div>
                </div>
            </div>

        </div>
        </div>
    </section>
    @component('site.login.user.components.user-sub-footer') @endcomponent

@endsection
