@extends('admin.admin')

@section('content')

    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <p class="pageTitle">
                    <i class="fa fa-cogs"></i>  manage bids
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
                            <th>Cost Bid</th>
                            <th>Is AutoBid?</th>
                            <th>Time & Date</th>
{{--                            <th>Action</th>--}}
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($bids as $key => $bid)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$bid->auction->name}}</td>
                                <td>{{$bid->user->name}}</td>
                                <td>{{$bid->cost_bid}}</td>
                                <td>{{$bid->from_auto_bd ? 'Yes' : 'No'}}</td>
                                <td>{{$bid->created_at }}</td>
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