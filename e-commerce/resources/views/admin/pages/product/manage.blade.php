@extends('admin.admin')

@section('content')

    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <p class="pageTitle">
                    <i class="fa fa-cogs"></i>  manage products
                </p>
            </div>

            <div class="col-md-12">
                <div class="overflow">
                    <table class="table table-striped  table-bordered table-hover" id="manageTable">
                        <thead>
                        <tr>
                            <th>SL</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Photo</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($products as $key => $product)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$product->name}}</td>
                                <td>{{$product->category->name}}</td>
                                <td>{{$product->price}}</td>
                                <td>{{$product->quantity}}</td>
                                <td width="100px">
                                    @foreach($product->medias as $key=>$media)
                                        @if($key==0)
                                    <img src="{{asset("storage/$media->image")}}" alt="" >
                                        @endif
                                    @endforeach
                                </td>
                                <td>
                                   <div>
                                       <a href="{{url('/admin/show-product/'.$product->id)}}" title="Show">
                                           <i class="fa fa-eye"></i>
                                       </a>
                                       <a href="{{url('/admin/product/'.$product->id).'/edit'}}" title="Edit">
                                           <i class="fa fa-edit"></i>
                                       </a>
                                       <a  href="#" @click.prevent="deleteMe('{{'/admin/product/'.$product->id}}')" title="Delete">
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