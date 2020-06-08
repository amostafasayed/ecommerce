@extends('site.app')
@section('title-meta')
    <title>Change Password</title>
@endsection

@section('content')
    @include('.site.login.login-partitial.header')
    @include('.site.login.login-partitial.nav')

    <section class="myFirebidder">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>My Firebidders</h2>
                    <hr>
                </div>
                <div class="col-lg-3">
                    @component('site.login.user.components.leftBar') @endcomponent
                </div>
                <div class="col-lg-9 p-0">
                    <div class="userDetailsArea">
                        <h4>Change Password </h4>
                        <form method="post" action="{{url('/user-details/update-password')}}">
                            @csrf
                            <table class="editSettingsTable">
                                <tr>
                                    <td class="text-capitalize">old password</td>
                                    <td>
                                        <input type="password"
                                               name="old_password"
                                               value="{{ old('old_password')}}"
                                               required>
                                        @if ($errors->has('old_password'))
                                            <div class="error">{{ $errors->first('old_password') }}</div>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-capitalize">New password</td>
                                    <td>
                                        <input type="password"
                                               name="new_password"
                                               value="{{ old('new_password')}}"
                                               required>
                                        @if ($errors->has('new_password'))
                                            <div class="error">{{ $errors->first('new_password') }}</div>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-capitalize">Re enter new password</td>
                                    <td>
                                        <input type="password"
                                               name="repeat_password"
                                               value="{{ old('repeat_password')}}"
                                               required>
                                        @if ($errors->has('repeat_password'))
                                            <div class="error">{{ $errors->first('repeat_password') }}</div>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <button class="button-global">Update password</button>
                                    </td>
                                </tr>
                            </table>
                        </form>
                    </div>
                </div>
            </div>

        </div>
        </div>
    </section>

    @component('site.login.user.components.user-sub-footer') @endcomponent
@endsection
