@extends('site.app')
@section('title-meta')
    <title>Buy Auction</title>
@endsection

@section('content')
    @if(auth()->user())
        @include('.site.login.login-partitial.header')
    @endif
    <div class="container bg-white">
        <div class="row py-3 ">
            <div class="col-md-12">
                <h2 class="text-center">
                    Here are some common questions about Elegant.
                </h2>
                <hr>

            </div>
        </div>
        <div class="col-md-10 mx-auto text-justify">
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aspernatur assumenda dicta eligendi mollitia
                obcaecati quod tempore? Animi cum et fugiat, ipsum, laborum magnam molestiae nulla obcaecati optio
                pariatur repellendus soluta tempora ullam! Ad asperiores ducimus facere id magnam minima nisi nobis, non
                possimus quos repellendus ut vitae! Cupiditate, deleniti laborum?</p>
        </div>
        <div class="row">
            <div class="col-md-10 mx-auto questionAndAnswers p-3">
                <h5 class="text-warning">Getting started </h5>

                <div class="accordion" id="accordionExample">
                    <div class="card z-depth-0 bordered">
                        <div class="card-header" id="headingOne">
                            <h5 class="mb-0">
                                <button class="btn btn-link" type="button" data-toggle="collapse"
                                        data-target="#collapseOne"
                                        aria-expanded="true" aria-controls="collapseOne">
                                    Question 1
                                </button>
                            </h5>
                        </div>
                        <div id="collapseOne" class="collapse show pointer-none" aria-labelledby="headingOne"
                             data-parent="#accordionExample">
                            <div class="card-body">
                                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad
                                squid. 3
                                wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa
                                nesciunt laborum
                                eiusmod. Brunch 3
                            </div>
                        </div>
                    </div>
                    <div class="card z-depth-0 bordered">
                        <div class="card-header" id="collapseTwo">
                            <h5 class="mb-0">
                                <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                        data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    Question 2
                                </button>
                            </h5>
                        </div>
                        <div id="collapseTwo" class="collapse" aria-labelledby="collapseTwo"
                             data-parent="#accordionExample">
                            <div class="card-body">
                                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad
                                squid. 3
                                wolf moon officia aute,
                            </div>
                        </div>
                    </div>
                    <div class="card z-depth-0 bordered">
                        <div class="card-header" id="collapseThree">
                            <h5 class="mb-0">
                                <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                        data-target="#collapseThree" aria-expanded="false"
                                        aria-controls="collapseThree">
                                    Question 3
                                </button>
                            </h5>
                        </div>
                        <div id="collapseThree" class="collapse" aria-labelledby="collapseThree"
                             data-parent="#accordionExample">
                            <div class="card-body">
                                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad
                                squid. 3
                                wolf moon officia aute, non
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <br>
    </div>

@endsection



@section('scripts')
@endsection