@extends('admin.admin')

@section('content')

        <div id="page-wrapper">
            <br>
            <div class="main-content container-fluid"></div>
            <div class="row site-forms">
                <form method="post" action="{{url('/admin/promotion/'.$promotion->id)}}">
                    @csrf
                    @method('PATCH')
                    <div class="">
                        <div class="form-box-header">
                            Edit Promotion
                        </div>
                    </div>

                    <div class="col-md-12 form-box-body">
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="">Code</label>
                                <input class="form-control"
                                       name="code"
                                       value="{{$promotion->code}}"
                                       type="text"
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
                                        value="{{$promotion->amount}}"
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
                                    <option value="Percentage"
                                    @if ($promotion->sign=='Percentage')
                                        {{ 'selected' }}@endif>Percentage</option>
                                    <option value="Amount"  @if ($promotion->sign=='Amount')
                                        {{ 'selected' }}@endif>Amount</option>
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
                                        value="{{$promotion->at_least_amount}}"
                                        placeholder="Enter Amount" required>
                                @if ($errors->has('at_least_amount'))
                                    <div class="error">{{ $errors->first('at_least_amount') }}</div>
                                @endif

                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <button class="btn btn-primary" type="submit">submit</button>
                            </div>
                        </div>
                    </div>

                </form>

            </div>

        </div>

@endsection