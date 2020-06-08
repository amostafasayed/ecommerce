@extends('admin.admin')

@section('content')

    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <p class="pageTitle">
                    <i class="fa fa-cogs"></i>  manage sales
                </p>
            </div>
            <div class="col-md-12 ">

                <div class="overflow">
                    <table class="table table-striped  table-bordered table-hover" id="manageTable">
                        <thead>
                        <tr>
                            <th>SL </th>
                            <th>Order No</th>
                            <th>Total Price</th>
                            <th>Payment Type</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($sales as $key => $sale)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>
                                    <a href="{{url('/order-invoice/'. $sale->order_no)}}" target="_blank">
                                        #{{$sale->order_no}}
                                    </a>
                                </td>
                                <td>{{$sale->total}}</td>
                                <td>{{$sale->payment_type}}</td>
                                <td>
                                    <select  class="form-control"
                                             name="section"
                                             id="orderStatus{{$sale->id}}"
                                             required
                                             placeholder="Select Section">
                                                @foreach( ['On Process', 'Shipped', 'Delivered', 'Cancel'] as $item)
                                                    <option value="{{$item}}"
                                                            @if($item == $sale->order_status) selected @endif
                                                    > {{$item}}</option>
                                                @endforeach
                                    </select>
                                </td>
                                <td>
                                    <div>
                                        <a href="#" onclick="changeOrderStatus({{$sale->id}})" title="Update">
                                            <i class="fa fa-check"></i>
                                        </a>
{{--                                        <a  href="#" @click.prevent="deleteMe('{{'/admin/sales/'.$category->id}}')" title="Delete">--}}
{{--                                            <i class="fa fa-trash"></i>--}}
{{--                                        </a>--}}
                                    </div>
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $('.modal-btn').click(function () {
            const order = JSON.parse($(this).attr('data-order'));
            $('#orderDettails').text("#" + order.order_no +" order details")
            console.log(order)
        })
    </script>
@endsection