@extends('site.app')
@section('title-meta')
    <title>Referral</title>
@endsection

@section('content')
    @include('.site.login.login-partitial.header')


    <div class="container bg-white  referral">
        <div class="row p-5 header">
           <div class="col-md-12 headerrefferal">
               <h3>Invite your friends and Earn FREE Credit</h3>
               <h3><u>There are 3 rules to earn Credit</u></h3>
               <p>
                   1. Tell someone you know about us!! you win £… Credit <br>
                   2. Tell someone you know about us!! Every time one of your sponsored friend do
                   signup to us (company name), you win £…Credit<br>
                   3. Tell someone you know about us!! Every time one of your sponsored friend
                   order/buy credit for first time, you win £…Credit<br>
               </p>
           </div>

            <p class="title-referral">
                sender
            </p>

            <div class="w-100 d-flex justify-content-between text-capitalize">
                <div>
                    <label for="">name: </label> <span class="text-danger">*</span><br>
                    <input type="text">
                </div>
                <div>
                    <label for="">email: </label><span class="text-danger">*</span><br>
                    <input type="email">
                </div>

            </div>
            <br>
            <br>
            <p class="title-referral">
                messege
            </p>

            <div class="w-100 d-flex justify-content-between text-capitalize">
                <div>
                    <label for="">subject: </label><span class="text-danger">*</span><br>
                    <input type="text" placeholder="Invitation to Bid">
                    <br>
                    <br>
                   <p>
                       <small>Your messege will be preceded By:
                           <span class="text-danger">*</span> <br>  Dear First Name, Last Name,</small>
                   </p>

                    <label for="">Your messege:</label> <span class="text-danger">*</span><br>
                    <textarea name="" id="" cols="300" rows="10" class="form-control"
                              placeholder="You should visit the website it offers interesting products. "></textarea>
                    <p>
                        And it ends as Follows <span class="text-danger">*</span>
                    </p>

                </div>
                <div>

                </div>

            </div>

            <p class="title-referral">
                recipients
            </p>

           <p><b>Add recipients</b> </p> <br>

            <div class="w-100 d-flex justify-content-between text-capitalize">
                <div>
                    <label for="">First Name: </label> <span class="text-danger">*</span><br>
                    <input type="text">
                    <br>

                    <label for="">email Address: </label><span class="text-danger">*</span><br>
                    <input type="email">
                </div>
                <div>
                    <label for="">Last Name: </label> <span class="text-danger">*</span><br>
                    <input type="text">
                    <br>
                    <button class="rmv-rec">Remove Recipient</button>
                </div>


            </div>

            <hr class="w-100">

            <div class="w-100">
                <button class="rmv-rec float-right">Add Recipient</button>
            </div>

            <hr class="w-100">

            <div class="w-100">
                <button class="rmv-rec float-right">send mail <span class="text-danger">*</span></button>
            </div>

        </div>
    </div>

@endsection



@section('scripts')
@endsection