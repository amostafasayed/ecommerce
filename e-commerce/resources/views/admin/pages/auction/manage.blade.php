@extends('admin.admin')

@section('content')

    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <p class="pageTitle">
                    <i class="fa fa-cogs"></i>  manage auction
                </p>
            </div>
            <div class="col-md-12">
                <div class="overflow">
                    <table class="table table-striped  table-bordered table-hover" id="manageTable">
                        <thead>
                        <tr>
                            <th>SL </th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($auctions as $key=>$auction)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$auction->name}}</td>
                                <td>{{$auction->product->category->name}}</td>
                                <td>{{$auction->starting_price}}</td>
                                <td>{{$auction->cost_per_bid}}</td>
                                <td width="100px">
                                    @foreach($auction->medias as $key=>$media)
                                        @if($key==0)
                                            <img src="{{asset("storage/$media->image")}} "
                                                 style="height: 80px;width: 80px;">
                                        @endif
                                    @endforeach
                                </td>
                                <td>
                                   <div>
                                       <a href="{{url('/admin/show-auction/'.$auction->id)}}" title="Show">
                                           <i class="fa fa-eye"></i>
                                       </a>
                                       <a href="{{url('/admin/auction/'.$auction->id).'/edit'}}" title="Edit">
                                           <i class="fa fa-edit"></i>
                                       </a>
                                       <a  href="#" @click.prevent="deleteMe('{{'/admin/auction/'.$auction->id}}')" title="Delete">
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