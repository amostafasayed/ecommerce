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
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="password-right-content">
                        <h1>Reset new password?</h1>
                        <form method="post" class="mt-5" action="{{ route('password.update') }}">
                            @csrf
                            <input type="hidden" name="token" value="{{ $token }}">
                            <input type="email"
                                   placeholder="Enter your email address"
                                   name="email"
                                   value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus
                                   class="form-control">

                            @if ($errors->has('email'))
                                <span class="text-danger">
                                    <strong>{{$errors->first('email') }}</strong>
                                            </span>
                            @endif
                            <br>
                            <input id="password"
                                   type="password"
                                   placeholder="Enter New Password"
                                   class="form-control @error('password') is-invalid @enderror"
                                   name="password" required autocomplete="new-password">

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                            <br>
                            <input id="password-confirm"
                                   type="password"
                                   class="form-control"
                                   placeholder="Confirm your password"
                                   name="password_confirmation"
                                   required autocomplete="new-password">


                            <button class="button-global" type="submit">Submit</button>
                            <a href="{{url('/#login-area')}}"
                               class="button-global"
                               style="padding: 10px; background: rgb(247, 247, 247)"
                            >Login</a>
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