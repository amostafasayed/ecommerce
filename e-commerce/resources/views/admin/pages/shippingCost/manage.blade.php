@extends('admin.admin')

@section('content')

    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <p class="pageTitle">
                    <i class="fa fa-cogs"></i>  Manage Shipping-cost
                </p>
            </div>
            <div class="col-md-12 ">
                <div class="overflow">
                    <table class="table table-striped  table-bordered table-hover" id="manageTable">
                        <thead>
                        <tr>
                            <th>SL </th>
                            <th>Amount</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($shippingCost as $key=>$shippingCost)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$shippingCost->amount}}</td>
                                <td>{{$shippingCost->description}}</td>
                                <td>
                                    <div>
                                        <a href="{{url('/admin/shipping-cost/'.$shippingCost->id).'/edit'}}" title="Edit">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <a  href="#" @click.prevent="deleteMe('{{'/admin/shipping-cost/'.$shippingCost->id}}')" title="Delete">
                                            <i class="fa fa-trash"></i>
                                        </a>
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
    <!-- /#page-wrapper -->

@endsection