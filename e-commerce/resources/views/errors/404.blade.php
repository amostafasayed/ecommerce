@extends('site.app')
@section('title-meta')
    <title>404-Unknown Request</title>
@endsection

@section('content')
    @if(auth()->user())
        @include('site.login.login-partitial.header')
    @endif

    <section class="error-404">
        <div class="container p-0">
            <div class="errorPage">
                <div class="inerItem">
                    <div class="error_404">404</div>

                    <div class="mainText">
                        <br>Oops!<br>Something Wrong
                        <h6>Uh Oh! Looks like some Typing mistake</h6>
                        <a href="/" class="link-to-home">
                           Take Me Away!
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </section>

@endsection



@section('scripts')
    {{--<script>--}}
    {{--function setPromoLink() {--}}
    {{--var val = $('#promoInput').val()--}}
    {{--$('#promoLink').attr('href', '/view-cart?pcode=' + val)--}}
    {{--}--}}

    {{--</script>--}}
@endsection