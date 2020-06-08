@extends('site.app')
@section('title-meta')
    <title>Inforation Edit</title>
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
                        <h4>Edit settings</h4>
                        <form method="post" action="{{url('user-details/update')}}">
                            @csrf
                        <table class="editSettingsTable">
                        <tr>
                            <td>Name <span class="mandatory">*</span> </td>
                            <td>
                                <input type="text"
                                       required
                                       name="name"
                                       value="{{ old('name', auth()->user()->name) }}">
                                @if ($errors->has('name'))
                                    <div class="error">{{ $errors->first('name') }}</div>
                                @endif
                            </td>

                        </tr>
                        <tr>
                            <td>Email<span class="mandatory">*</span></td>
                            <td>
                                <input type="email"
                                       required
                                       name="email"
                                       value="{{ old('email', auth()->user()->email) }}">
                                @if ($errors->has('email'))
                                    <div class="error">{{ $errors->first('email') }}</div>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>Mobile <span class="mandatory">*</span> </td>
                            <td>
                                <input type="number"
                                       required
                                       name="mobile"
                                       value="{{ old('mobile', auth()->user()->contact ? auth()->user()->contact->mobile : '') }}">
                                @if ($errors->has('mobile'))
                                    <div class="error">{{ $errors->first('mobile') }}</div>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>Address <span class="mandatory">*</span> </td>
                            <td>
                                <input type="text"
                                       required
                                       name="address"
                                       value="{{ old('address', auth()->user()->contact ? auth()->user()->contact->address : '' ) }}">
                                @if ($errors->has('address'))
                                    <div class="error">{{ $errors->first('address') }}</div>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>Post Code </td>
                            <td>
                                <input type="number"
                                       name="post_code"
                                       value="{{ old('post_code', auth()->user()->contact ? auth()->user()->contact->post_code : '') }}">
                                @if ($errors->has('post_code'))
                                    <div class="error">{{ $errors->first('post_code') }}</div>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>City <span class="mandatory">*</span> </td>
                            <td>
                                <input type="text"
                                       required
                                       name="city"
                                       value="{{ old('city', auth()->user()->contact ? auth()->user()->contact->city : '') }}">
                                @if ($errors->has('city'))
                                    <div class="error">{{ $errors->first('city') }}</div>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>District <span class="mandatory">*</span> </td>
                            <td>
                                <select name="district" required>
                                    @foreach($districts as $district)
                                        <option value="{{$district['name']}}"
                                                @if ( old('district', auth()->user()->contact ? auth()->user()->contact->district : '' ) == $district['name'] )
                                                selected
                                                @endif
                                        >{{$district['name']}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('district'))
                                    <div class="error">{{ $errors->first('district') }}</div>
                                @endif
                            </td>
                        </tr>

                        <tr>
                        <td colspan="2" class="text-center" >
                        <input type="checkbox"
                               name="news_letter"
                               id="newsletterEmail"
                               @if(old('news_letter', auth()->user()->news_letter == 1))
                                   checked
                               @endif
                        >
                        <label for="newsletterEmail">  I want to receive the Firebidder newsletter and notification by email</label>

                        </td>
                        </tr>
                        <tr> <td><button class="button-global">Update Info</button></td></tr>
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
