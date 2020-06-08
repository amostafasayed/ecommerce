@extends('site.app')
@section('title-meta')
    <title>Forgot Password</title>
@endsection

@section('content')
    @if(auth()->user())
        @include('site.login.login-partitial.header')
    @endif

   <section class="forget-pass">
       <div class="container p-0">
           <div class="row bgArea">
               <div class="col-md-6"></div>
               <div class="col-md-6 px-5">
                 <div class="password-right-content">
                        <h1>forgot password ?</h1>
                        <p>please enter your email address below</p>
                         <form method="post" action="" class="mt-5">
                             @csrf
                             <input type="email" placeholder="Enter your email address" class="form-control">
                             <button class="button-global">Submit</button>
                         </form>
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