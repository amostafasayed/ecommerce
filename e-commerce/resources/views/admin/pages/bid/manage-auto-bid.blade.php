@extends('admin.admin')

@section('content')

    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <p class="pageTitle">
                    <i class="fa fa-cogs"></i>  manage auto bids
                </p>
            </div>
            <div class="col-md-12 ">
                <div class="overflow">
                    <table class="table table-striped  table-bordered table-hover" id="manageTable">
                        <thead>
                        <tr>
                            <th>SL </th>
                            <th>Auction Name</th>
                            <th>Bidder Name</th>
                            <th>Activate at price</th>
                            <th>Max Bix</th>
                            <th>Biding Type</th>
                            <th>Date & Time</th>
{{--                            <th>Action</th>--}}
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($autoBids as $key => $autoBid)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$autoBid->auction->name}}</td>
                                <td>{{$autoBid->user->name}}</td>
                                <td>{{$autoBid->activate_at_price}}</td>
                                <td>{{$autoBid->max_bid}}</td>
                                <td>
                                    {{$autoBid->bid_randomly ? 'Bid Randomly' : ''}}
                                    {{$autoBid->bid_with_sec ? 'Bid With in last 10 sec' : ''}}
                                </td>
                                <td>
                                    {{$autoBid->created_at}}
                                </td>
{{--                                <td>--}}
{{--                                    <div>--}}
{{--                                        <a href="{{url('/admin/category/'.$category->id).'/edit'}}" title="Edit">--}}
{{--                                            <i class="fa fa-edit"></i>--}}
{{--                                        </a>--}}
{{--                                        <a  href="#" @click.prevent="deleteMe('{{'/admin/category/'.$category->id}}')" title="Delete">--}}
{{--                                            <i class="fa fa-trash"></i>--}}
{{--                                        </a>--}}
{{--                                    </div>--}}
{{--                                </td>--}}

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