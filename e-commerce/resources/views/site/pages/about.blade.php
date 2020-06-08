@extends('site.app')
@section('title-meta')
    <title>About Us</title>
@endsection

@section('content')
    @if(auth()->user())
        @include('.site.login.login-partitial.header')
    @endif

    <div class="container bg-white aboutUS">
        <div class="row p-5 header">
            <h1>About us </h1>
            <h4> Welcome to firebidder.com! We're a fun and exciting, fast-paced auction website.</h4>
            <p> You can win all sorts of popular products at incredibly low prices. Look at our homepage to see what products are up for five auction right now, and if one catches your eye, buy some bids <img src="images/about.jpg" alt="Smiley face" width="200" height="200" align="right"> for a low price! When you place a bid, we add a maximum of 10-20 seconds to the timer - to give someone else the chance to bid if they're interested. This is similar to the "Going Once... Twice...SOLD" approach of auctions.
                If no one else bids and the timer reaches zero, you've won a sweet deal on firebidder.com! If you don't win the auction, you never have to go away empty handed. Any time after you've placed your first bid in an auction, you can choose to buy the product for a discount using the Buy Now feature. This will help limit your losses so you don't have to leave all your bids on the table. You'll never have to pay more than the Value Price for any products on firebidder.com.
            </p>
            <h4>How We Got Our Start</h4>
            <p>firebidder.com was started in July 2009 as an attempt to improve the Internet auction model by making it more exciting, safer, and more reliable. We're based out of Oklahoma City, Oklahoma and our goal as a business is simple: To provide an exciting online auction model with better deals for the consumer than any other website in existence.</p>
            <p>Our staff has decades of experience in Internet marketing, economics, finance and computer science, and we wholeheartedly believe that we can deliver our customers to this lofty goal. In everything we do, we strive to keep our costs as low as possible to maximize the number of great deals we can offer at firebidder.com.</p>
            <h4>Are You Interested in Partnering With firebidder.com?</h4>
            <p>If you are interested in becoming a vendor or have business development inquiries, please email Partners @ firebidder.com with detailed information.</p>
        </div>


    </div>

@endsection



@section('scripts')
@endsection