<section id="sign-up">
    <div class="container signup-area">
        <div class="row">
            <div class="col-lg-6">
                <div class="video">

                    <video width="100%" height="100%" controls>
                        <source src="/video/ruth-lorenzo-knocking-on-heavens-door-x-factor-08-11-2008-safe-and-through-to-the-next-round-flv.mp4" type="video/mp4">
                    </video>

                    {{--<iframe width="100%" height="100%"--}}
                            {{--src="https://www.youtube.com/embed/XGSy3_Czz8k"--}}
                            {{--frameborder="0"--}}
                            {{--allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"--}}
                            {{--allowfullscreen></iframe>--}}
                </div>
            </div>
            <div class="col-lg-6">
                <div class="sign-up">
                    <div class="header">
                        <img src="/images/home/free-sign-up.png" width="70px">
                        Sign-up takes less than 30 seconds
                    </div>
                    <div class="content">
                        <form class="form-horizontal manipulate" method="POST" action="{{ url('/admin/register') }}">
                            @csrf
                            <div class="form-group position-relative">
                                <label for="sign_username">Username:</label>
                                <div class="d-flex flex-column w-100">
                                    <input id="sign_username" type="text"
                                           class="form-control @error('sign_username') is-invalid
                                       @enderror" name="sign_username" value="{{ old('sign_username') }}"
                                           required autocomplete="sign_username">
                                    @error('sign_username')
                                    <div class="invalid-feedback text-right" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group position-relative">
                                    <label for="sign_up_password">Password:</label>
                                   <div class="d-flex flex-column w-100">
                                       <input id="sign_up_password" type="password"
                                              class="form-control @error('sign_password') is-invalid @enderror"
                                              name="sign_password" required autocomplete="new-password">

                                       @error('sign_password')
                                       <div class="invalid-feedback text-right" role="alert">
                                           <strong>{{ $message }}</strong>
                                       </div>
                                       @enderror
                                   </div>
                            </div>
                            <div class="form-group position-relative">
                                <label for="sign_up_email">Email:</label>
                                <div class="d-flex flex-column w-100">
                                    <input id="sign_up_email" type="email"
                                           class="form-control @error('sign_email') is-invalid
                                       @enderror" name="sign_email" value="{{ old('sign_email') }}"
                                           required autocomplete="sign_email">
                                    @error('sign_email')
                                    <div class="invalid-feedback text-right" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                    @enderror
                                </div>
                            </div>



                            {{--<div class="form-group">--}}
                                {{--<label for="pwd">Confirm :</label>--}}
                                {{--<input id="password-confirm"--}}
                                       {{--type="password" class="form-control"--}}
                                       {{--name="password_confirmation"--}}
                                       {{--required autocomplete="new-password">--}}
                            {{--</div>--}}

                            <div class="form-group">
                                <label   for="pwd">Mobile:</label>
                                <input type="number" class="form-control" name="mobile"
                                       value="{{ old('moible') }}">
                            </div>
                            <input  type="hidden" name="name" value="user" >

                            <div class="checkbox d-flex">
                                <label for=""></label>
                                <label><input type="checkbox"
                                              v-model="termCheck" @input="changeTerm"> &nbsp;
                                    I Accept the <a href="/terms-and-conditions" style="color:#FFA134;">Terms and Conditions</a> and   <a style="color:#FFA134;" href="/privacy-policy">Privacy
                                    Policy</a> of Firebidders.com.
                                </label>
                            </div>
                            <div class="form-group">
                                <label for="pwd"> </label>
                                <button type="submit"
                                        class="btn btn-success btn-block"
                                        :disabled="!termCheck">
                                    Sign-up and start saving
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>