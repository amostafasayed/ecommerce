@extends('site.app')
@section('title-meta')
    <title>Home</title>
@endsection

@section('content')


    @include('site.home-partials.offers')

    @include('site.home-partials.signUp')

    @include('site.home-partials.winners')

    @include('site.home-partials.features-products')

    @include('site.home-partials.auction-bar')

    @include('site.home-partials.auction-products')

    @include('site.home-partials.up-coming-auction-bar')

    @include('site.home-partials.up-coming-auction')

    @include('site.home-partials.closed-product-bar')

    @include('site.home-partials.closed-products')

    @include('site.home-partials.regular-product')


@endsection



@section('scripts')
@endsection