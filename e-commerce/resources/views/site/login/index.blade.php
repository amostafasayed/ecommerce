@extends('site.app')
@section('title-meta')
    <title>Firebidder user loged </title>
@endsection

@section('content')

   @include('.site.login.login-partitial.header')

    <section class="slider">
        <div class="container">
           <div class="row">
               <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                   <div class="carousel-inner">
                       <div class="carousel-item active">
                           <img class="d-block w-100" src="/images/slider/3.jpg" alt="First slide">
                       </div>
                       <div class="carousel-item">
                           <img class="d-block w-100" src="/images/slider/2.png" alt="Second slide">
                       </div>
                       <div class="carousel-item">
                           <img class="d-block w-100" src="/images/slider/1.jpg" alt="Third slide">
                       </div>
                   </div>
                   <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                       <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                       <span class="sr-only">Previous</span>
                   </a>
                   <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                       <span class="carousel-control-next-icon" aria-hidden="true"></span>
                       <span class="sr-only">Next</span>
                   </a>
               </div>
           </div>
        </div>
    </section>

   @include('.site.login.login-partitial.nav')


    @include('site.home-partials.auction-bar')
   @include('site.home-partials.auction-products')
   @include('site.home-partials.up-coming-auction-bar')

   {{-- Up Commint AUCTIONS PRODUCTS--}}

   @include('site.home-partials.up-coming-auction')
   {{--Regular products--}}

   @include('site.home-partials.regular-product')
    {{--products--}}
   @include('site.home-partials.closed-product-bar')
   @include('site.home-partials.closed-products')
    {{--@include('.site.home-partials.featuredProduct')--}}

{{--    @include('site.home-partials.scroller')--}}








@endsection



@section('scripts')
        {{--<script src="{{ mix('/js/home.js') }}"></script>--}}
@endsection