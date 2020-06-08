@extends('admin.admin')

@section('content')

    <div id="page-wrapper">
        <br>
        <div class="main-content container-fluid"></div>
        <div class="row site-forms">
            <form method="post" action="{{url('/admin/promotion')}}">
                @csrf
                <div class="">
                    <div class="form-box-header">
                        + Add Promotion
                    </div>
                </div>

                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="">Code</label>
                            <input class="form-control"
                                   name="code" type="text"
                                   placeholder="Enter Code" required>
                            @if ($errors->has('code'))
                                <div class="error">{{ $errors->first('code') }}</div>
                            @endif

                        </div>

                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="">Value</label>
                            <input  type ="number"
                                    name="amount"
                                    step="any"
                                    class="form-control"
                                    placeholder="Enter Amount" required>
                            @if ($errors->has('amount'))
                                <div class="error">{{ $errors->first('amount') }}</div>
                            @endif

                        </div>
                    </div>

                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="">Sign</label>
                            <select class="js-example-basic-multiple form-control"
                                    name="sign" required>
                                <option value="">Select Option</option>
                                    <option value="Percentage">Percentage</option>
                                    <option value="Amount">Amount</option>
                            </select>
                            @if ($errors->has('sign'))
                                <div class="error">{{ $errors->first('sign') }}</div>
                            @endif

                        </div>
                    </div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <label for="">At Least Price</label>
                        <input  type ="number"
                                name="at_least_amount"
                                step="any"
                                class="form-control"
                                placeholder="Enter Amount" required>
                        @if ($errors->has('at_least_amount'))
                            <div class="error">{{ $errors->first('at_least_amount') }}</div>
                        @endif

                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <button class="btn btn-primary ml-2" type="submit">submit</button>
                    </div>
                </div>
            </form>

        </div>

    </div>
    <!-- /#page-wrapper -->

@endsection