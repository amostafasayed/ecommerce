<section class="site-header" v-if="regularHeader">

    @if(!auth()->user())
        <div class="container">
            <div class="row bg-white">
                <div class="col-lg-4 pr-0">
                    <div class="brand">
                        <a href="{{url('/')}}">
                            <img src="/images/site-logo.png" class="img-fluid d-block" alt="">
                        </a>
                    </div>
                </div>

                <div class="col-lg-5">
                    @if(!($uri === 'forget-password' || strpos($uri, 'password/reset')))
                    <form method="POST" action="{{ url('/admin/login') }}" class="form-inline">
                        @csrf
                        <div class="authPanel" id="login-area">
                            <div class="loged_area">
                                <div>
                                        <input id="login"
                                               type="text"
                                               class="form-control{{ $errors->has('username') ||
                                               $errors->has('email') ? ' is-invalid' : '' }}"
                                               placeholder="Username or email"
                                               name="login" value="{{ old('username') ?: old('email')
                                                }}" required autofocus>
                                        @if ($errors->has('username') || $errors->has('email'))
                                            <span class="invalid-feedback">
                                    <strong>{{ $errors->first('username') ?:
                                    $errors->first('email') }}</strong>
                                            </span>
                                        @endif


                                    {{--<input id="email"--}}
                                           {{--type="text"--}}
                                           {{--class="form-control{{ $errors->has('username') || $errors->has('email') ? ' is-invalid' : '' }}"--}}
                                           {{--name="email"--}}
                                           {{--value="{{ old('email') }}"--}}
                                           {{--required autocomplete="email"--}}
                                           {{--autofocus--}}
                                           {{--placeholder="Email">--}}
                                    {{--@error('email')--}}
                                    {{--<div class="invalid-feedback" role="alert">--}}
                                        {{--<strong>{{ $message }}</strong>--}}
                                    {{--</div>--}}
                                    {{--@enderror--}}

                                </div>
                                <div>

                                    <input id="password"
                                           type="password"
                                           class="form-control @error('password') is-invalid
                                               @enderror"
                                           name="password"
                                           required
                                           autocomplete="current-password"
                                           placeholder="Password">

                                    @error('password')
                                    <div class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                    @enderror
                                    <input type="hidden" name="from" value="st">

                                </div>
                                <div>
                                    <div class="form-group mb-2 flex-column">
                                        <button type="submit" class="btn  login  ">Login</button>
                                    </div>
                                </div>
                            </div>
                            <div class="middle-bottom">
                                <div>
                                    Forgot password? <a href="{{url('/forget-password')}}">Click Here</a>
                                </div>
                                <div>
                                    New? <a href="/#sign-up">Sign Up</a>
                                </div>
                            </div>
                        </div>

                    </form>

                    @endif()
                </div>

                <div class="col-lg-3">
                    <div class="social">
                        <div class="mb-3 homeCart">
                            <a href="/view-cart" title="view shopping cart" class="shoppingCart">
                                <i class="fa fa-cart-arrow-down"  ></i>
                                <div class="counter">{{Cart::content()->count()}}</div>
                            </a>
                        </div>
                        <div class="links">
                            {{--<a href="http://facebook.com/billboardbd" target="_blank">--}}
                                {{--<i class="fa fa-facebook-official"></i>--}}
                                {{--<img src="/images/home/facebook.png" alt="" title="facebook">--}}
                            {{--</a>--}}
                            {{--<a href="http://twitter.com/billboardbd" target="_blank">--}}
                                {{--<img src="/images/home/twitter.png" alt="" title="twitter">--}}
                            {{--</a>--}}
                            {{--<a href="http://web.skype.com/billboardbd" target="_blank">--}}
                                {{--<img src="/images/home/skype.png" alt="" title="skype">--}}
                            {{--</a>--}}
                            @if(auth()->user())
                                <div>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                          style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

            </div>
            <div class="row ">
                <div class="partners">
                    <a href="/#auctionProductRibon" class="section-links">Live Auctions</a>
                    <a href="/#upcoming-auctionsRibon" class="section-links">Upcoming Auctions</a>
                    <a href="/#closedAuctionsRibon" class="section-links">Closed Auctions</a>
                    <a href="{{url('/all-products')}}" class="section-links">Regular product</a>
                    <a href="{{url('/how-it-works')}}" class="section-links">How it works</a>

                </div>

            </div>

        </div>

    @endif




</section>

