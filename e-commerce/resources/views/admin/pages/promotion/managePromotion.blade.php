@extends('admin.admin')

@section('content')

    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <p class="pageTitle">
                    <i class="fa fa-cogs"></i>  manage Promotion
                </p>
            </div>
            <div class="col-md-12">
                <div class="overflow">
                    <table class="table table-striped  table-bordered table-hover" id="manageTable">
                        <thead>
                        <tr>
                            <th>SL </th>
                            <th>Code</th>
                            <th>Value</th>
                            <th>Sign</th>
                            <th>At Least Amount</th>
                            <th>Action</th>


                        </tr>
                        </thead>
                        <tbody>
                        @foreach($promos as $key=>$promo)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$promo->code}}</td>
                                <td>{{$promo->amount}}</td>
                                <td>{{$promo->sign}}</td>
                                <td>{{$promo->at_least_amount}}</td>


                                <td>
                                    <div>
                                        <a href="{{url('/admin/promotion/'.$promo->id).'/edit'}}" title="Edit">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <a  href="#"
                                            @click.prevent="deleteMe('{{'/admin/promotion/'.$promo->id}}')" title="Delete">
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