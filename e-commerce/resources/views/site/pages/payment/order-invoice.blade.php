@extends('site.app')
@section('title-meta')
    <title>Order Invoice</title>
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
                        Order Number  #{{$order->order_no}} <br>
                        Order Date & Time <br>
                        {{$order->created_at}}
                    </strong>
                </div>
            </div>
            <hr>
            <div class="rows">
                <div class="column">
                    Invoice to:<br>
                    <strong>
                        {{$order->user_name}}<br>
                        Phone: {{$order->mobile}}<br>
                    </strong>
                    <br>
                    <br>
                </div>
                <div class="column">
                    Delivery Address<br>
                    <strong>
                        {{$order->address}}<br>
                        {{$order->city}}<br>
                        {{$order->district}} {{$order->post_code}} <br>
                    </strong>
                </div>
            </div>


            <table class="table invoiceTable">
                <thead>
                <tr>
                    <th scope="col">Sl</th>
                    <th scope="col">Product</th>
                    <th scope="col">Qty</th>
                    <th scope="col">Price</th>
                    <th scope="col">Total Per Item</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    @php
                        $subTotal = 0;
                    @endphp
                    @foreach($order->items as $item)
                        <tr>
                            <td scope="row">{{$loop->iteration}}</td>
                            <td>{{$item->product->name}}</td>
                            <td>{{$item->quantity}}</td>
                            <td>{{$setting->amount_sign}}{{$item->unit_price}}</td>
                            <td>{{$setting->amount_sign}}{{number_format((float)($item->quantity * $item->unit_price), 2, '.', '')}}</td>
                            @php
                                $subTotal += ($item->quantity * $item->unit_price)
                            @endphp
                        </tr>
                    @endforeach

                </tbody>
            </table>
            <div class="rows-invoice">
                <div class="items">&nbsp; </div>
                <div class="items">

                       <div class="item-row">
                           <span>Sub total :</span>
                           <span>{{$setting->amount_sign}}{{number_format((float)($subTotal), 2, '.', '')}}</span>
                       </div>
                       <div class="item-row">
                           <span>(-) Discount :</span>
                           <span>{{$setting->amount_sign}}{{number_format((float)($order->discount), 2, '.', '')}}</span>
                       </div>
                       <div class="item-row">
                           <span> (+) Shipping Cost :</span>
                           <span> {{$setting->amount_sign}}{{number_format((float)($order->shipping_cost), 2, '.', '')}}</span>
                       </div>
                       <div class="item-row">
                           <span> Grand total :</span>
                           <span> {{$setting->amount_sign}}{{number_format((float)(($subTotal - $order->discount) + $order->shipping_cost ), 2, '.', '')}}</span>
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

