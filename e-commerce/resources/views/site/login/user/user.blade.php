@extends('site.app')
@section('title-meta')
    <title>Firebidder user loged </title>
@endsection

@section('content')
    @include('site.login.login-partitial.header')
    @include('site.login.login-partitial.nav')

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
                      <a href="{{url('/user-details/settings')}}"
                         class="float-right text-right btn btn-warning text-dark">Edit Info</a>
                      <h4 class="text-capitalize pb-3">
                          <span>My Information</span>
                      </h4>
                      <table class="table-striped table text-capitalize">
                          <tr>
                              <td> Name</td>
                              <td>: {{ auth()->user()->name }} </td>
                          </tr>
                          <tr>
                              <td> Email</td>
                              <td>: {{ auth()->user()->email }} </td>
                          </tr>
                          <tr>
                              <td> Mobile</td>
                              <td> : {{ auth()->user()->contact ? auth()->user()->contact->mobile : '' }} </td>
                          </tr>
                          <tr>
                              <td> Address</td>
                              <td> : {{ auth()->user()->contact ? auth()->user()->contact->address : '' }} </td>
                          </tr>
                          <tr>
                              <td> post code</td>
                              <td> : {{ auth()->user()->contact ? auth()->user()->contact->post_code : '' }}</td>
                          </tr>
                          <tr>
                              <td> city</td>
                              <td> : {{ auth()->user()->contact ? auth()->user()->contact->city : '' }} </td>
                          </tr>
                          <tr>
                              <td> District</td>
                              <td> : {{ auth()->user()->contact ? auth()->user()->contact->district : '' }}</td>
                          </tr>

                      </table>
                  </div>

                </div>
            </div>
        </div>
        </div>
    </section>
    @component('site.login.user.components.user-sub-footer') @endcomponent

@endsection
