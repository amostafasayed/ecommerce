<section>
    <div class="container products-area regular-product" id="regularProduct">
        <div class="row mx-auto">
            <div class="col-lg-12 p-1">
                <a href="{{url('/all-products')}}" class="title" style="position: relative">
                    Regular Products
                    {{--< class="allProductBtn">All Products</a>--}}
                    <span class="hints">View All Products</span>
                </a>
            </div>
            @foreach($productList as $product)
            <div class="col-md-2 p-1">
                <div class="product wow fadeInUp default-a">
                    <a href="{{url('product/details/'.$product->id).'/'.$product->name}}">
                    <p class="name">{{$product->name}}</p>
                      <div class="photo">
                            @foreach($product->medias as $key=>$media)
                              @if($key==0)
                                  <img src="{{asset("storage/$media->image")}}" alt=""
                                       class="photo">
                              @endif
                            @endforeach
                      </div>
                    </a>
                    <div class="price font-weight-bold">{{$setting->amount_sign}}{{$product->price}}</div>
                    <div class="byNowBasket">
                        <a class="btn closed " href="{{url('product/details/'.$product->id).'/'.$product->name}}">Details</a>
                            <form method="post" action="{{url('/add-to-cart')}}">
                                @csrf

                                <input type="hidden" name="qty" min="1" value="1">
                                <input type="hidden" name="id" value="{{$product->id}}">
                                <button type="submit" class="btn  closed d-flex justify-content-center align-items-center">
                                    <span>+</span>
                                    <span>&nbsp;Basket</span>
                                </button>
                            </form>
                        {{--<a class="btn closed" href="#"> + Basket</a>--}}
                    </div>
                </div>

            </div>
                @endforeach


        </div>
    </div>
</section>
