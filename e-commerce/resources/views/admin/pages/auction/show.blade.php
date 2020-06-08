@extends('admin.admin')

@section('content')

    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <p class="pageTitle">
                    <i class="fa fa-cogs"></i> Auction Details
                </p>
            </div>
            <div class="col-md-12">
                <div class="product-actions">

                    <a  href="#" @click.prevent="deleteMe('{{'/admin/auction/'.$auction->id}}')" title="Delete">
                        <i class="fa fa-trash"></i>
                    </a>
                    <a href="{{url('/admin/product/'.$auction->id).'/edit'}}" title="Edit">
                        <i class="fa fa-edit text-success"></i>
                    </a>
                </div>
                <div class="product-detail-view">
                    <div class="inner-description">
                        <div class="items">
                            <div class="heading">Auction name</div>
                            <div class="content"><b>{{$auction->name}}</b> </div>
                        </div>
                        <div class="items">
                            <div class="heading">Product name</div>
                            <div class="content">
                                <b><a href="{{url('/admin/show-product/'.$auction->product->id)}}">{{$auction->product->name}}</a></b>
                            </div>
                        </div>

                        <div class="items">
                            <div class="heading">Starting Price</div>
                            <div class="content"><b>{{$auction->starting_price}}</b> </div>
                        </div>
                        <div class="items">
                            <div class="heading">Cost per bid</div>
                            <div class="content"><b>{{$auction->cost_per_bid}}</b> </div>
                        </div>
                        <div class="items">
                            <div class="heading">Price Increase per bid</div>
                            <div class="content"><b>{{$auction->price_increase_every_bid}}</b> </div>
                        </div>
                        <div class="items">
                            <div class="heading">Price Drop Percentage</div>
                            <div class="content"><b>{{$auction->price_drop_percentage}}%</b> </div>
                        </div>
                        <div class="items">
                            <div class="heading">Auction Type</div>
                            <div class="content"><b>{{$auction->auction_type}}</b> </div>
                        </div>
                        <div class="items">
                            <div class="heading">Up Time</div>
                            <div class="content"> <b>{{$auction->up_time}}</b> </div>
                        </div>
                        <div class="items">
                            <div class="heading">Auction Slots</div>
                            <div class="content">
                                <table class="table table-bordered table-hover table-striped">
                                    <thead>
                                    <tr>
                                        <th>Slot</th>
                                        <th>Slot Range</th>
                                        <th>Duration Time</th>
                                    </tr>

                                    </thead>
                                    <tbody>
                                        @foreach($auction->slots as $key => $slot)
                                        <tr>
                                            <td>{{$key + 1}}</td>
                                            @if($key == 0)
                                            <td> 0 - {{$slot->slot_number}}</td>
                                            @else
                                                <td>{{$auction->slots[$key-1]->slot_number + 1}} - {{$slot->slot_number }}</td>
                                            @endif
                                            <td>{{$slot->duration_time }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="items">
                            <div class="heading">Product Description</div>
                            <div class="content">  {!! $auction->description !!}</div>
                        </div>
                        <div class="items">
                            <div class="heading">Auction Images</div>
                            <div class="content">
                                <div class="gallery">
                                    @foreach($auction->medias as $media)
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