@extends('admin.admin')

@section('content')

    <div id="page-wrapper">
        <br>
        <div class="row site-forms">
            <form method="post" action="{{url('/admin/shipping-cost/'.$id)}}">
                @csrf
                @method('PATCH')
                <div class="">
                    <div class="form-box-header">
                        Update Shipping-cost
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="">Amount</label>
                            <input class="form-control"
                                   name="amount"
                                   type="float"
                                   value="{{$shippingCost->amount}}"
                                   placeholder="Amount"
                            >

                            @if ($errors->has('amount'))
                                <div class="error">{{ $errors->first('amount') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="">Description</label>
                            <textarea class="form-control" name="description"> {{$shippingCost->description}}</textarea>
                        </div>
                    </div>

                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <button class="btn btn-primary ml-2" type="submit">Update</button>
                    </div>
                </div>
            </form>

        </div>

    </div>
    <!-- /#page-wrapper -->

@endsection