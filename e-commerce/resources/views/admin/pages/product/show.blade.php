@extends('admin.admin')

@section('content')

    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <p class="pageTitle">
                    <i class="fa fa-cogs"></i> Product Details
                </p>
            </div>
            <div class="col-md-12">
                <div class="product-actions">

                    <a  href="#" @click.prevent="deleteMe('{{'/admin/product/'.$product->id}}')" title="Delete">
                        <i class="fa fa-trash"></i>
                    </a>
                    <a href="{{url('/admin/product/'.$product->id).'/edit'}}" title="Edit">
                        <i class="fa fa-edit text-success"></i>
                    </a>
                </div>
                <div class="product-detail-view">
                    <div class="inner-description">
                        <div class="items">
                            <div class="heading">Product name</div>
                            <div class="content"><b>{{$product->name}}</b> </div>
                        </div>
                        <div class="items">
                            <div class="heading">category name</div>
                            <div class="content"><b>{{$product->category->name}}</b> </div>
                        </div>
                        <div class="items">
                            <div class="heading">SKU Number</div>
                            <div class="content"><b>{{$product->sku_number}}</b> </div>
                        </div>
                        <div class="items">
                            <div class="heading">price</div>
                            <div class="content"><b>{{$product->price}}</b> </div>
                        </div>
                        <div class="items">
                            <div class="heading">Quantity</div>
                            <div class="content"><b>{{$product->quantity}}</b> </div>
                        </div>
                        <div class="items">
                            <div class="heading">Is out of Stock ?</div>
                            <div class="content"><b>{{$product->is_out_of_stock || $product->quantity < 1 ? "Yes" : "No"}}</b> </div>
                        </div>
                        <div class="items">
                            <div class="heading">Product Status</div>
                            <div class="content"> <b>{{$product->status ? "Active" : "Inactive"}}</b> </div>
                        </div>
                        <div class="items">
                            <div class="heading">Product Description</div>
                            <div class="content">  {!! $product->description !!}</div>
                        </div>
                        <div class="items">
                            <div class="heading">Product Images</div>
                            <div class="content">
                                <div class="gallery">
                                   @foreach($product->medias as $media)
                                        <img src="{{asset("storage/$media->image")}}" alt="">
                                   @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- /#page-wrapper -->

@endsection