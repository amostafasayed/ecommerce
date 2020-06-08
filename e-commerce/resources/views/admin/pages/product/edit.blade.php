@extends('admin.admin')

@section('content')

    <div id="page-wrapper">
        <br>
        <div class="row site-forms">
            <form method="post" action="{{url('/admin/product/'.$product->id)}}" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="">
                    <div class="form-box-header">
                        Edit Product
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="">Name *</label>
                            <input
                                    class="form-control"
                                    name="name"
                                    type="text"
                                    placeholder="name"
                                    value="{{ old('name', $product->name) }}"
                            >

                            @if ($errors->has('name'))
                                <div class="error">{{ $errors->first('name') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">SKU Number *</label>
                            <input
                                    class="form-control"
                                    name="sku_number"
                                    type="text"
                                    placeholder="SKU Number"
                                    value="{{ old('sku_number',$product->sku_number)}}"
                            >

                            @if ($errors->has('sku_number'))
                                <div class="error">{{ $errors->first('sku_number') }}</div>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div>
                            <label for="">Category *</label>
                            <select class="js-example-basic-multiple form-control"
                                    name="category_id"  id="select1">
                                <option value="">Select Category</option>
                                @foreach($category as $categories)
                                    <option value="{{$categories->id}}"
                                    @if (old('category_id', $categories->id ) == $product->category_id) {{ 'selected' }} @endif>
                                        {{$categories->name}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('category_id'))
                                <div class="error">{{ $errors->first('category_id') }}</div>
                            @endif

                        </div>
                    </div>
                    {{--</div>--}}
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Price *</label>
                            <input
                                    class="form-control"
                                    name="price"
                                    type="number"
                                    step="any"
                                    value="{{ old('price', $product->price) }}"
                                    placeholder="Price">

                            @if ($errors->has('price'))
                                <div class="error">{{ $errors->first('price') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Quantity *</label>
                            <input
                                    class="form-control"
                                    name="quantity"
                                    type="number"
                                    step="any"
                                    value="{{ old('quantity',$product->quantity) }}"
                                    placeholder="Quantity">

                            @if ($errors->has('quantity'))
                                <div class="error">{{ $errors->first('quantity') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">Description</label>
                            <textarea name="description" id="description">{{old('description', $product->description) }}</textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Meta Tag</label>
                            <input
                                    class="form-control"
                                    name="meta_tag"
                                    type="text"
                                    value="{{ old('meta_tag',$product->meta_tag) }}"
                                    placeholder="Meta Tag">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Meta Description</label>
                            <textarea name="meta_description" class="form-control"
                                      placeholder="Meta Description">{{ old('meta_description',$product->meta_description) }}</textarea>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">Product Image</label>
                            <input type="file" class="form-control" name="images[]" accept="image/*" multiple><br>
                        </div>
                        <div>
                            @if(count($product->medias))
                            <div class="product-image-container">
                                @foreach($product->medias as $key=>$media)
                                    <div class="image-box">
                                        <img src="{{asset("storage/$media->image")}}" alt="">
                                        <label class="check-product">
                                            <input type="checkbox" name="deleted_images[]" value="{{$media->id}}" checked/>
                                            <span><i class="fa fa-times"></i></span>
                                        </label>
                                    </div>
                                @endforeach

                            </div>
                           @endif
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group"><br>
                            <label for="">Is Out of Stock? *</label><br>
                            <input type="radio"  name="is_out_of_stock" value="1" id="yes"
                                   {{ old('is_out_of_stock', $product->is_out_of_stock) =='1' ? 'checked' : ""}}>
                            <label for="yes">Yes</label>

                            <input type="radio"  name="is_out_of_stock" value="0" id="no"
                            {{ old('is_out_of_stock',$product->is_out_of_stock) =='0' ? 'checked' : ""}}>
                            <label for="no">No</label>
                            @if ($errors->has('is_out_of_stock'))
                                <div class="error">{{ $errors->first('is_out_of_stock') }}</div>
                            @endif
                        </div>

                    </div>
                    <div class="col-md-4">
                        <div class="form-group"><br>
                            <label for="">Status *</label><br>
                            <input type="radio" checked name="status" value="1" id="active"
                                 {{old('status', $product->status) =="1" ? 'checked' : ""}}
                            >
                            <label for="active">Active</label>

                            <input type="radio" name="status" value="0" id="inactive"
                                    {{old('status', $product->status) =="0" ? 'checked' : ""}}
                            >
                            <label for="inactive">Inactive</label>
                            @if ($errors->has('status'))
                                <div class="error">{{ $errors->first('status') }}</div>
                            @endif
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