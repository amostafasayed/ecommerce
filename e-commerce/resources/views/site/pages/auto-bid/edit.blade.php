@extends('site.app')
@section('title-meta')
    <title>Auto Bid</title>
@endsection

@section('content')
    @include('.site.login.login-partitial.header')

    <div class="container p-5 bg-white">
        <form method="post" action="{{url('/auto-bid/'.$autoBid->id)}}">
            @csrf
            @method('patch')
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
                                        @if($auction->id == $autoBid->auction_id)
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
                                   value="{{old('max_bid', $autoBid->max_bid)}}"
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
                                   value="{{old('max_bid', $autoBid->activate_at_price)}}"
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
                                   required
                                   name="bid_strategy"
                                   value="10sec"
                                   @if( $autoBid->bid_with_sec == 1)
                                       checked
                                    @endif

                            >
                            Bid within last 10 seconds
                        </label>
                        <label class="mb-0 cp  ">
                            <input type="radio"
                                   name="bid_strategy"
                                   @if( $autoBid->bid_randomly == 1)
                                   checked
                                   @endif
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
                        <a href="{{url('/auto-bid/create')}}" class="btn btn-default ">Back</a>

                    </div>
                </div>

            </div>
        </form>
        <br>
    </div>


@endsection



@section('scripts')
@endsection