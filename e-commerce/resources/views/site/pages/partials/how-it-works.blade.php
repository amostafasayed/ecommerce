@extends('site.app')
@section('title-meta')
    <title>Buy Auction</title>
@endsection

@section('content')
    @if(auth()->user())
    @include('.site.login.login-partitial.header')
    @endif

    <div class="container bg-white">
        <div class="row">
            <div class="col-md-12 h-first-row">
                <h1>You can always save on BillBoardbd.com </h1>
                <h3>win an auction or use Buy Now</h3>
                <hr>
            </div>
            <div class="phototext">
                <div>
                    <div class="firstRow">
                        <div class="bullet">
                            <div class="badge">1</div>
                        </div>
                        <img src="/images/pen.png" alt="">
                    </div>
                    <div class="lastRow">
                        <p>sign up & buy credits</p>
                    </div>
                </div>
                <div>
                    <div class="firstRow">
                        <div class="bullet">
                            <div class="badge">2</div>
                        </div>
                         <img src="/images/monitor.png" alt="">
                    </div>
                    <div class="lastRow">
                        <p>use credits to place a bid </p>
                    </div>
                </div>
                <div>
                    <div class="firstRow">
                        <div class="bullet">
                            <div class="badge">3</div>
                        </div>
                         <img src="/images/3.png" alt="">
                    </div>
                    <div class="lastRow">
                        <p>wait for the timer to reach zero </p>
                    </div>
                </div>
                <div>
                    <div class="firstRow">
                        <div class="bullet">
                            <div class="badge">4</div>
                        </div>
                         <img src="/images/9.png" alt="">
                    </div>
                    <div class="lastRow">
                        <p>if someone bids the timer restarts</p>
                    </div>
                </div>
                <div>
                    <div class="firstRow">
                        <div class="bullet">
                            <div class="badge">5</div>
                        </div>
                        <img src="/images/dfrt.png" alt="">
                    </div>
                    <div class="lastRow">
                        <p>if no one is bids , you are the winner </p>
                    </div>
                </div>

            </div>
            <div class="col-md-12">
                <hr>
                <h5 class="text-danger text-center">some text and images will go here as suggestion later</h5>
                <hr>
                <br>
                <h5 class="text-center text-capitalize">still unsure how it works? watch our <b>tutorial video</b> or
                    try the <b>demo auction</b> below. </h5>
            </div>
        </div>
        <br>
        <div class="row mt-5">
            <div class="col-md-7">
                <video width="100%" controls="controls">
                    <source src="/video/ruth-lorenzo-knocking-on-heavens-door-x-factor-08-11-2008-safe-and-through-to-the-next-round-flv.mp4"
                            type="video/mp4">
                </video>
            </div>
            <div class="col-md-5">
                <img src="/images/demp-credits.png" style="max-width: 300px; margin:0 auto;" alt="" class="img-fluid d-block">
            </div>
        </div>

    </div>

@endsection



@section('scripts')
@endsection