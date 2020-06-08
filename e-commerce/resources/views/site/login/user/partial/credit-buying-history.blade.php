@extends('site.app')
@section('title-meta')
    <title>Credit Buy History </title>
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
                        <h4 class="text-capitalize pb-3">Credit Buy History</h4>
                        <table class="table-striped table text-capitalize">
                            <thead>
                            <tr>
                                <th>Order No</th>
                                <th>Amount</th>
                                <th>Credit</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(count($creditHistory))
                                @foreach($creditHistory as $history)
                                    <tr>
                                        <td> <a href="{{'/generate-invoice/'.$history->id}}">
                                                #{{$history->order_no}}
                                            </a>
                                        </td>
                                        <td>
                                            {{$setting->amount_sign}}
                                            {{$history->amount}}
                                        </td>
                                        <td> {{$history->credit}}</td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="3"> No credit buy history found.</td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                        {{ $creditHistory->links() }}
                    </div>
                </div>
            </div>

        </div>
        </div>
    </section>
    @component('site.login.user.components.user-sub-footer') @endcomponent
@endsection
