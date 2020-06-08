@extends('admin.admin')

@section('content')

    <div id="page-wrapper">
        <br>
        <div class="main-content container-fluid"></div>
        <div class="row site-forms">
            <form method="post" action="{{url('/admin/package')}}" enctype="multipart/form-data">
                @csrf
                <div class="">
                    <div class="form-box-header">
                        + Add Package
                    </div>
                </div>

                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="">Name</label>
                            <input class="form-control"
                                   name="name" type="text"
                                   placeholder="Enter Name" required>
                            @if ($errors->has('name'))
                                <div class="error">{{ $errors->first('name') }}</div>
                            @endif

                        </div>

                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="">Price</label>
                            <input  type ="number"
                                    name="price"
                                    step="any"
                                    class="form-control"
                                    placeholder="Enter Amount" required>
                            @if ($errors->has('price'))
                                <div class="error">{{ $errors->first('price') }}</div>
                            @endif

                        </div>
                    </div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <label for="">Credit</label>
                        <input  type ="number"
                                name="credit"
                                step="any"
                                class="form-control"
                                placeholder="Enter Credit" required>
                        @if ($errors->has('credit'))
                            <div class="error">{{ $errors->first('credit') }}</div>
                        @endif

                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="">Image</label>
                        <input type="file" class="form-control" name="image" accept="image/*">
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