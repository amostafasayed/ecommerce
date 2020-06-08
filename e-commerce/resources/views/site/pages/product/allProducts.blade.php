@extends('site.app')
@section('title-meta')
    <title>Products </title>
@endsection

@section('content')
    @if(auth()->user())
        @include('site.login.login-partitial.header')
{{--        @include('site.login.login-partitial.nav')--}}
    @endif


    <div class="container bg-white products-area regular-product  p-0 my-2" id="regularProduct">
      <div class="col-md-12" style="background: #FFA034;">
          <div class="searchProductBar">
              <input type="search"
                     name=""
                     onkeyup="setSearchLink()"
                     onchange="setSearchLink()"
                     id="searchProduct"
                     class="productSearch"
                     value="{{request()->input('search')}}"
                     placeholder="What are you looking for ..."
                      >
              <a href="/all-products"
                 id="searchLink"
                 class="productsrcBtn"
                 >Search </a>
          </div>
      </div>
            <div class="col-md-12 p-0 mt-3">
                <div class="proGallery ">
                    <a href="{{url("/all-products?catName=mobile")}}"
                       class="{{request()->input('catName') == 'mobile' ? 'active': ''}}">
                        <img src="/images/products/mobile.png">
                    </a>
                    <a href="{{url("/all-products?catName=kids")}}"
                       class="{{request()->input('catName') == 'kids' ? 'active': ''}}">
                        <img src="/images/products/kids.png">
                    </a>
                    <a href="{{url("/all-products?catName=laptop")}}"
                       class="{{request()->input('catName') == 'laptop' ? 'active': ''}}">
                        <img src="/images/products/laptop.png">
                    </a>
                    <a href="{{url("/all-products?catName=mens")}}"
                       class="{{request()->input('catName') == 'mens' ? 'active': ''}}"
                    >
                        <img src="/images/products/mens.png">
                    </a>
                    <a href="{{url("/all-products?catName=sports")}}"
                       class="{{request()->input('catName') == 'sports' ? 'active': ''}}"
                    >
                        <img src="/images/products/tv.png">
                    </a>
                    <a href="{{url("/all-products?catName=women")}}"
                       class="{{request()->input('catName') == 'women' ? 'active': ''}}"
                    >
                        <img src="/images/products/women.png">
                    </a>
                </div>
            </div>
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-3 sidebarFilter">

                    <div id="accordion" class="myaccordion">
                        <div class="card">
                            <div class="card-header" id="headingOne">

                                <button class="d-flex align-items-center justify-content-between btn btn-link"
                                        data-toggle="collapse" data-target="#collapseOne" aria-expanded="true"
                                        aria-controls="collapseOne">
                                    Categories
                                    <span class="fa-stack fa-sm">
            <i class="fa fa-circle fa-stack-2x text-dark "></i>
            <i class="fa fa-plus fa-stack-1x fa-inverse"></i>
          </span>
                                </button>

                            </div>
                            <div id="collapseOne" class="collapse show" data="off" aria-labelledby="headingOne"
                                 data-parent="#accordion">
                                <div class="inner">
                                    <ul class="list-group">
                                        @foreach($categories as $category)
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <a href="/all-products?catId={{$category->catId}}&order={{request()->input('order')}}"
                                               class="w-100 d-flex justify-content-between align-items-center {{request()->input('catId') == $category->catId ? 'active': ''}}">
                                             <span>{{$category->name}}</span>
                                             <span class="text-center badge  badge-color badge-pill font-weight-bold">{{$category->catCount}}</span>
                                            </a>
                                        </li>
                                        @endforeach

                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header" id="headingThree">

                                <button class="d-flex align-items-center justify-content-between btn btn-link collapsed"
                                        data-toggle="collapse"
                                        data-target="#collapseThree"
                                        aria-expanded="false"
                                        aria-controls="collapseThree">
                                    Price By
                                    <span class="fa-stack fa-2x">
            <i class="fa fa-circle fa-stack-2x text-dark"></i>
            <i class="fa fa-plus fa-stack-1x fa-inverse"></i>
          </span>
                                </button>

                            </div>
                            <div id="collapseThree" class="collapse" aria-labelledby="headingThree"
                                 data-parent="#accordion">
                                <div class="inner">
                                    <ul class="list-group">
                                        <li
                                                class="list-group-item d-flex
                                                justify-content-between align-items-center">
                                            @if(request()->input('catId'))
                                            <a href="/all-products?catId={{request()->input('catId')}}&order=asc"
                                               class="{{request()->input('order') == 'asc' ? 'active': ''}}"
                                            >
                                                Lowest Price First
                                            </a>
                                            @elseif(request()->input('catName'))
                                                <a href="/all-products?catName={{request()->input('catName')}}&order=asc"
                                                   class="{{request()->input('order') == 'asc' ? 'active': ''}}"
                                                >
                                                    Lowest Price First
                                                </a>
                                            @endif
                                        </li>
                                            <li
                                                    class="list-group-item d-flex
                                            justify-content-between align-items-center">
                                                @if(request()->input('catId'))
                                                <a href="/all-products?catId={{request()->input('catId')}}&order=desc"
                                                   class="{{request()->input('order') == 'desc' ? 'active': ''}}"
                                                >
                                                    Highest Price First
                                                </a>
                                                @elseif(request()->input('catName'))
                                                    <a href="/all-products?catName={{request()->input('catName')}}&order=desc"
                                                       class="{{request()->input('order') == 'desc' ? 'active': ''}}"
                                                    >
                                                        Highest Price First
                                                    </a>
                                                @endif
                                            </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="allProductContainer">

                        @foreach($productList as $product)
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
                                <div class="price font-weight-bold">{{$product->price}}</div>

                                <div class="bottomProductBtn">
                                    <a class="btn closed"
                                       href="{{url('product/details/'.$product->id).'/'.$product->name}}">Details</a>
                                    <div>
                                        <form method="post" action="{{url('/add-to-cart')}}">
                                            @csrf

                                            <input type="hidden" name="qty" min="1" value="1">
                                            <input type="hidden" name="id" value="{{$product->id}}">
                                            <button  type="submit"
                                                    class="btn  closed d-flex justify-content-center align-items-center">
                                                <span>+</span>
                                                <span>&nbsp;Basket</span>
                                            </button>
                                        </form>
                                    </div>
                                </div>

                            </div>
                        @endforeach

                    </div>
                    <div class="productsPaginations">
                        {{ $productList->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
@section('scripts')
    <script>
        function setSearchLink() {
            var val = $('#searchProduct').val()
            $('#searchLink').attr('href', '/all-products?search=' + val)
        }



    </script>
@endsection