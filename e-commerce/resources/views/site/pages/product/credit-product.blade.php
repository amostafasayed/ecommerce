@extends('site.app')
@section('title-meta')
    <title>Buy Auction</title>
@endsection

@section('content')
    @if(auth()->user())
        @include('site.login.login-partitial.header')
        @include('site.login.login-partitial.nav')
    @endif



    <div class="container bg-white creditProduct">
        <div class="row">

            <h3 class="mt-5 pl-5 text-capitalize"><br> Choose a credit package</h3>

            <div class="creditPack">

                @foreach($packages as $package)
                    <div class="credit">
                        <div class="medium">
                            <span>{{$package->name}}</span>
                            <span>{{$package->price}}</span>
                        </div>

                        <label>

                            <input type="radio" name="package"
                                   id="{{$package->id}}"
                                   value="{{$package->price}}"
                                   oninput="doCalculation()"
                                   class="checkPackages"
                                   @if(request()->input('package')==$package->price)
                                   checked @endif>

                            <div class="photo"
                                 title="Select Package">
                                @if($package->image)
                                    <img src="{{asset("storage/$package->image")}}"
                                         class="img-fluid">
                                @else
                                    <img src="images/1000-credits-min.png"
                                         class="img-fluid">
                                @endif

                            </div>
                        </label>

                        <p class="text-center font-weight-bold">
                            {{$package->credit}} Credits</p>
                    </div>
                @endforeach


            </div>
        </div>
        <br>

        <div class="row p-4">
            <div class="col-md-5">
                <p class="font-weight-bold ">Please your
                    preffered payment method from those
                    listed below. be complete
                    until payment has cleared.</p>
                <br>

                <ul class="payments">
                    <li>
                        <label class="payment-items">
                            <img src="/images/bkash.png" class="img-fluid">
                            <p>Bkash, Rocket, U-cash, Debit Card,
                                Credit Card or Online Banking</p>
                            <input type="radio" name="payments" value="ssl"
                                   @if(request()->input('payment')=='ssl') checked @endif>
                        </label>
                    </li>
                    <li>
                        <label class="payment-items">
                            <img src="/images/dbbl.png" class="img-fluid">
                            <p>PayPal</p>
                            <input type="radio" name="payments" value="paypal"
                                   @if(request()->input('payment')=='paypal') checked @endif>
                        </label>
                    </li>
                </ul>
            </div>

            <div class="col-md-1"></div>
            <div class="col-md-6">

                <div class="promo d-flex m-0">
                    <label for="">Promo code <br>(optional )</label>
                    <input type="text"
                           class="promo"
                           id="promoInput"
                           value="{{request()->input('pcode')}}"
                           onchange="setPromoLink()"
                           onkeyup="setPromoLink()"
                           style="width:53%;"
                    >
                    <a href="#"
                       id="promoLink"
                       class="btn btn-sm btn-warning use-btn
                       text-uppercase font-weight-bold"
                       style=" width: 118px; height: 35px;margin: 0 4px; line-height: 25px;">use</a>
                </div>
                <span class="text-danger" id="errorMessage"></span>
                <div class="PaymentGrandTotal">
                    <p><span>Package Cost </span><span id="packageCost">0.00</span></p>

                    <p><span>Discount </span>
                            @if($promotion)
                            <input type="hidden" value="{{$promotion->amount}}" id="promo">
                                @if($promotion->sign=='Amount')
                                <span id="discountPirce">{{$promotion->amount}}</span>

                                 @elseif($promotion->sign=='Percentage')
                                <span id="discountPirce" class="uniDiscount">

                                </span>

                                @endif

                            @else
                            <span id="discountPirce">0.00</span>
                            @endif
                        </p>
                    <p><span>Grand Total </span><span id="grandTotal">0.00</span></p>
                </div>
                <button class="proceedToPayment" onclick="doSubmit()">
                    Proceed to Payment <i class="fa fa-arrow-right" aria-hidden="true"></i>
                </button>

            </div>
        </div>
    </div>

@endsection



@section('scripts')
    <script>
        var packagePrice = $("input[name='package']:checked").val()
        var discountPrice = $("#discountPirce").text()
        $(document).ready(function () {
            getPromotion()
            doCalculation()
            var csrf=$('meta[name="csrf-token"]').attr('content')
            $('#sslczPayBtn').attr('token',csrf)

        })

        function doCalculation() {
            packagePrice=$("input[name='package']:checked").val()
            discountPrice = $("#discountPirce").text()
            $('#packageCost').text(packagePrice)
            $('#grandTotal').text((parseFloat(packagePrice ? packagePrice : 0)
                - parseFloat(discountPrice ? discountPrice : 0)).toFixed(2))
        }

        function doSubmit() {

            var packageChecked = $("input[name='package']:checked").val()
            packageChecked = packageChecked ? packageChecked : ''
            var paymentChecked = $("input[name='payments']:checked").val()
            paymentChecked = paymentChecked ? paymentChecked : ''

            if (packageChecked && paymentChecked) {
                var grandTotal=(parseFloat(packagePrice ? packagePrice : 0)
                    - parseFloat(discountPrice ? discountPrice : 0)).toFixed(2)
                if(grandTotal>0){
                    $('#errorMessage').text('')
                    var promo=promoLink()
                    if($("input[name='payments']:checked").val()=='ssl'){
                        location.href='/credit/ssl/make-payment?pcode=' + promo[0] + '&pid=' + promo[3]

                    }else if( $("input[name='payments']:checked").val()=='paypal'){
                        location.href='/credit/make-payment?pcode=' + promo[0] + '&pid=' + promo[3]
                    }
                    $("input[name='payments']:checked").val()

                }else{
                    $('#errorMessage').text('Your Grand ' +
                        'total amount should be at least 1.00')
                }


            } else {
                $('#errorMessage').text('Please select both ' +
                    'Package and Payment method')

            }
        }

        function setPromoLink() {
            var promo=promoLink()
            $('#promoLink').attr('href',
                '/credit-product?pcode=' + promo[0] + '&package=' + promo[1] + '&payment=' + promo[2])

        }
        function promoLink() {
            var val = $('#promoInput').val()
            var packageChecked = $("input[name='package']:checked").val()
            packageChecked = packageChecked ? packageChecked : ''
            var paymentChecked = $("input[name='payments']:checked").val()
            console.log(paymentChecked)
            paymentChecked = packageChecked ? paymentChecked : ''
            var credit_id = $("input[name='package']:checked").attr("id")
            credit_id=credit_id?credit_id:''
           return[val,packageChecked,paymentChecked,credit_id]
        }

        function getPromotion() {
            var val =$('#promo').val()
            packagePrice=$("input[name='package']:checked").val()
            $('.uniDiscount').text(((parseFloat(packagePrice)*
                parseFloat(val))/100).toFixed(2))
        }



    </script>

@endsection