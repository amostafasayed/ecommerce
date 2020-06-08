<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Login</title>
    <link rel="stylesheet" href="{{asset('/css/login.css')}}">
</head>

<body>
<div class="login-section">
    <div class="login-box">
        <div class="brand">
           <img src="/images/logo-admin.png" width="200px" height="auto">
            {{--<p class="brand-text">Fire Bidders</p>--}}
        </div>
        <form class="login-element" method="POST" action="{{ url('/admin/login') }}">
            @csrf
            <div class="item-rows">
                <label for="">Username :</label>
                <input id="login"
                       type="text"
                       class="form-item{{ $errors->has('username') ||
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

            </div>
            <div class="item-rows">
                <label for="">Password:</label>
                <input id="password"
                       type="password"
                       class="form-item @error('password') is-invalid
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
                <input type="hidden" name="from" value="ad">
            </div>
            <div class="item-rows">
                <!-- <button class='login-btn'>Login</button> -->
                <button class='login-btn' type="submit">Login</button>
            </div>
        </form>
{{--        <p class="register-link">--}}
{{--            dont have an account <a href=''> sign up!</a>--}}
{{--        </p>--}}
    </div>

</div>

</div>




</body>

</html>