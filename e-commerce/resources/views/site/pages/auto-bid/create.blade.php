@extends('site.app')
@section('title-meta')
    <title>Auto Bid</title>
@endsection

@section('content')
    @include('.site.login.login-partitial.header')

        <div class="container p-5 bg-white">
            <form method="post" action="{{url('/auto-bid')}}">
                @csrf
            <div class="row">
                <div class="col-12">
                    <p>Auto-bid monitors the auctions and places bids automatically for
                        you when necessary. The bids will be subtracted from your bidding account.
                        If Auto-bid reaches the maximum bid count, it will stop automatically.</p>
                </div>

                <div class="col-md-9 mb-4">
                    <h5>Choose an auction</h5>
                    <div class="from-group">
                        <select class="form-control" name="auction_id">
                            @foreach($auctionList as $auction)
                                <option value="{{$auction->id}}"
                                @if($currentId == $auction->id)
                                    selected
                                @endif
                                >{{$auction->name}}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('auction_id'))
                            <div class="error">{{ $errors->first('auction_id') }}</div>
                        @endif

                    </div>
                </div>
                <div class="col-md-12">
                    <h5>Bids to place</h5>
                </div>
                <div class="d-flex mb-3 flex-wrap">
                    <div class="col-md-6 ">
                        <div class="from-group">
                            <input type="number"
                                   name="max_bid"
                                   placeholder="Maximum bid count"
                                   class="form-control">
                            @if ($errors->has('max_bid'))
                                <div class="error">{{ $errors->first('max_bid') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6 ">
                        <div class="from-group">
                            <input type="number"
                                   name="activate_at_price"
                                   placeholder="Activate at price"
                                   class="form-control">
                            @if ($errors->has('activate_at_price'))
                                <div class="error">{{ $errors->first('activate_at_price') }}</div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-md-12 mt-4">
                    <h5>Bidding Strategy</h5>
                </div>

                <div class="col-md-6">
                    <div class="from-group flex-column d-flex ">
                        <label class="mb-0 cp  ">
                            <input type="radio"
                                   name="bid_strategy"
                                   value="10sec" checked>
                            Bid within last 10 seconds
                        </label>
                        <label class="mb-0 cp  ">
                            <input type="radio"
                                   name="bid_strategy"
                                   value="randomly">
                            Bid randomly
                        </label>

                        @if ($errors->has('bid_strategy'))
                            <div class="error">{{ $errors->first('bid_strategy') }}</div>
                        @endif
                    </div>
                </div>
                <div class="col-md-12  pt-5">
                    <div class="from-group">
                        <small class="error">Live bid can not edit or delectable upcoming bid you can.</small><br>
                        <input type="submit"
                               placeholder="Maximum bid count"
                               class="submitBid">

                    </div>
                </div>

            </div>
            </form>
            <br>
            <div class="row mt-4">
                <div class="col-md-12 mb-4">
                    <h5>Active Auto Bids</h5>
                    <table class="  autoBidsTable">
                        <thead>
                        <tr>
                            <th>Auction</th>
                            <th>status</th>
                            <th>max Bids</th>
                            <th>Activate at</th>
                            <th>credits used</th>
                            <th>type</th>
                            <th>action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($activeAutoBids))
                            @foreach($activeAutoBids as $autoBid)
                                <tr>
                                    <td>{{$autoBid->auction->name}}</td>
                                    <td>Live / Upcoming</td>
                                    <td>{{$autoBid->max_bid}}</td>
                                    <td>{{$autoBid->activate_at_price}}</td>
                                    <td>
                                        @php
                                            $creditCount = 0;
                                        @endphp
                                        @foreach($autoBid->auction->bids as $bid)
                                            @if($bid-> user_id == auth()->user()->id && $bid->from_auto_bid == 1)
                                                @php
                                                    $creditCount += $bid->cost_bid
                                                @endphp
                                            @endif
                                        @endforeach
                                        {{$creditCount}}
                                    </td>
                                    <td>{{$autoBid->bid_randomly?'Random':$autoBid->bid_with_sec?'With In last 10 Sec':''}}</td>
                                    <td>
                                        <a href="{{url('/auto-bid/'.$autoBid->id.'/edit')}}" title="Edit" class="fa fa-edit text-success mr-1"></a>
                                        <form action="{{ url('/auto-bid', ['id' => $autoBid->id]) }}" method="post">
                                            <button class="fa fa-trash text-danger"
                                                   onclick="return confirm('Are you sure you want to delete this?')"
                                                   type="submit"
                                                    />
                                            @method('delete')
                                            @csrf
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="7"> No auto bid found. </td>
                            </tr>
                        @endif

                        </tbody>
                    </table>
                    {{ $activeAutoBids->links() }}
                </div>
            </div>

            <div class="row mt-2">
                <div class="col-md-12 mb-4">
                    <h5 class="font-weight-bold">Inactive Auto Bids History</h5>
                    <table class="autoBidsTable">
                        <thead>
                        <tr>
                            <th>Auction</th>
                            <th>status</th>
                            <th>max Bids</th>
                            <th>activate at</th>
                            <th>credits used</th>
                            <th>type</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($closedAutoBids))
                            @foreach($closedAutoBids as $autoBid)

                                <tr>
                                    <td>{{$autoBid->auction->name}}</td>
                                    <td>Closed</td>
                                    <td>{{$autoBid->max_bid}}</td>
                                    <td>{{$autoBid->activate_at_price}}</td>
                                    <td>
                                        @php
                                            $creditInActiveCount = 0;
                                        @endphp
                                        @foreach($autoBid->auction->bids as $bid)
                                            @if($bid-> user_id == auth()->user()->id && $bid->from_auto_bid == 1)
                                                @php
                                                    $creditInActiveCount += $bid->cost_bid
                                                @endphp
                                            @endif
                                        @endforeach
                                        {{$creditInActiveCount}}
                                    </td>
                                    <td>{{$autoBid->bid_randomly ? 'Random':$autoBid->bid_with_sec?'With In last 10 Sec':''}}</td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="7"> No auto bid found. </td>
                            </tr>
                        @endif

                        </tbody>
                    </table>
                    {{ $closedAutoBids->links() }}
                </div>
            </div>
        </div>


@endsection



@section('scripts')
@endsection