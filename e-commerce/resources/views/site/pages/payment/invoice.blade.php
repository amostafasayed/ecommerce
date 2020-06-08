@extends('site.app')
@section('title-meta')
    <title>Invoice</title>
@endsection

@section('content')
    @include('site.login.login-partitial.header')


    <div class="container bg-white mt-5">

        <i class="fa fa-print printInvoiceBtn" onclick="printMe()"></i>


        <div id="orderInvoice" class="invoiceArea">
            <div class="rows">
                <div class="column">
                    <img width='190px' src="/images/logo.png" alt="">
{{--                    <br> <strong><h6 class="ml-5"> <i>slogan  will be here</i> </h6></strong>--}}
                </div>
                <div class="column">
                    <strong>
                        Order Number  #{{$paymentInfo->order_no}} <br>
                        Order Date & Time <br>
                        {{$paymentInfo->created_at}}
                    </strong>
                </div>
            </div>
            <hr>
            <div class="rows">
                <div class="column">
                    <strong>
                        Invoice to<br>
                        {{$paymentInfo->user->name}}<br>
                        @if($paymentInfo->user->mobile)
                        Phone: {{$paymentInfo->user->mobile}}<br>
                        @endif
                    </strong>
                </div>
{{--                <div class="column">--}}
{{--                    <strong>--}}
{{--                        Delivery Address<br>--}}
{{--                        34 West kazipara<br>--}}
{{--                        Dhaka 2340<br>--}}
{{--                    </strong>--}}
{{--                </div>--}}
            </div>


            <table class="table invoiceTable">
                <thead>
                <tr>
                    <th scope="col">Sl</th>
                    <th scope="col">Product</th>
                    <th scope="col">Qty</th>
                    <th scope="col">Price</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td scope="row">1</td>
                    <td>{{$paymentInfo->paymentable->name}}</td>
                    <td>1</td>
                    <td>
                        @php
                            $subTotal=$paymentInfo->amount;
                            $discount=$paymentInfo->discount_amount;

                        @endphp

                        {{$setting->amount_sign}}{{number_format((float)($subTotal+$discount), 2, '.', '')}}


                    </td>
                </tr>

                </tbody>
            </table>
            <div class="rows-invoice">
                <div class="items">&nbsp; </div>
                <div class="items">
                    <div class="item-row">
                        <span>Sub total :</span>
                        <span>{{$setting->amount_sign}}{{number_format((float)($subTotal+$discount), 2, '.', '')}}</span>
                    </div>
                    <div class="item-row">
                        <span>(-) Discount :</span>
                        <span>{{$setting->amount_sign}}{{number_format((float)($discount), 2, '.', '')}}</span>
                    </div>
                    <div class="item-row">
                        <span> Grand total :</span>
                        <span> {{$setting->amount_sign}}{{number_format((float)($subTotal), 2, '.', '')}}</span>
                    </div>
                </div>
            </div>


            <strong>
                <h6 align='center'> www.billboardbd.com Dhaka Bangladesh Phone: 77665544222, Email:
                    order@billboardbd.com
                </h6>
            </strong>

        </div>

        <br>
        <br>
    </div>




@endsection



@section('scripts')
    <script>

        function printMe() {
            window.print();
        }

    </script>
@endsection

