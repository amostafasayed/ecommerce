@extends('admin.admin')

@section('content')

    <div id="page-wrapper">
        <br>
        <div class="row site-forms">
            <form method="post" action="{{url('/admin/auction/'.$auction->id)}}" enctype="multipart/form-data">
                @csrf
                @method('PATCH')

                <div class="">
                    <div class="form-box-header">
                        Update Auction
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Product *</label>

                            <select class="js-example-basic-multiple form-control"
                                    name="product_id" id="select1">
                                <option value="">Select Product</option>

                                @foreach($products as $item)
                                    <option value="{{$item->id}}"
                                    @if (old('product_id', $auction->product_id) == $item->id) {{ 'selected' }} @endif>
                                        {{$item->name}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('product_id'))
                                <div class="error">{{ $errors->first('product_id') }}</div>
                            @endif

                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="">Name *</label>
                            <input
                                    class="form-control"
                                    name="name"
                                    type="text"
                                    placeholder="name"
                                    value="{{ old('name',$auction->name) }}"
                            >

                            @if ($errors->has('name'))
                                <div class="error">{{ $errors->first('name') }}</div>
                            @endif
                        </div>
                    </div>

                </div>
                <div class="col-md-12">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Auction Type *</label>
                            <select class="js-example-basic-multiple form-control"
                                    name="auction_type" id="select1">
                                <option value="">{{$auction->auction_type}}</option>
                                <option value="Paid"
                                @if (old('auction_type', $auction->auction_type) == 'Paid') {{ 'selected' }} @endif>Paid</option>

                                <option value="Free"
                                @if (old('auction_type', $auction->auction_type) == 'Free') {{ 'selected' }} @endif>Free</option>

                            </select>
                            @if ($errors->has('auction_type'))
                                <div class="error">{{ $errors->first('auction_type') }}</div>
                            @endif

                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Starting Price *</label>
                            <input
                                    class="form-control"
                                    name="starting_price"
                                    type="number"
                                    step="any"
                                    value="{{ old('starting_price', $auction->starting_price) }}"
                                    placeholder="Price">

                            @if ($errors->has('starting_price'))
                                <div class="error">{{ $errors->first('starting_price') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Cost Per Bid *</label>
                            <input
                                    class="form-control"
                                    name="cost_per_bid"
                                    type="number"
                                    step="any"
                                    value="{{ old('cost_per_bid', $auction->cost_per_bid) }}"
                                    placeholder="Cost Per Bid">

                            @if ($errors->has('cost_per_bid'))
                                <div class="error">{{ $errors->first('cost_per_bid') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Price increase every bid *</label>
                            <input
                                    class="form-control"
                                    name="price_increase_every_bid"
                                    type="number"
                                    step="any"
                                    value="{{ old('price_increase_every_bid', $auction->price_increase_every_bid)}}"
                                    placeholder="Price increase every bid">

                            @if ($errors->has('price_increase_every_bid'))
                                <div class="error">{{ $errors->first('price_increase_every_bid') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Price drop percentage </label>
                            <input
                                    class="form-control"
                                    name="price_drop_percentage"
                                    type="number"
                                    step="any"
                                    value="{{old('price_drop_percentage', $auction->price_drop_percentage) }}"
                                    placeholder="Price drop percentage">

                            @if ($errors->has('price_drop_percentage'))
                                <div class="error">{{ $errors->first('price_drop_percentage') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">Description</label>
                            <textarea name="description" id="description">{{ old('description', $auction->description) }}</textarea>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">Up Time</label>
                            <input type="text"
                                   id="datetimepicker"
                                   name="up_time"
                                   class="form-control"
                                   value="{{ old('up_time', $auction->up_time) }}"
                                   placeholder="Set Up Time"
                            />
                        </div>
                    </div>
                    <div class="col-md-6" style="display: none">
                        <div class="form-group">
                            <label for="">Duration Time</label>
                            <input
                                    class="form-control"
                                    name="duration_time_range"
                                    id="durationtimepicker"
                                    type="text"
                                    value="{{ old('duration_time_range', $auction->duration_time_range) }}"
                                    placeholder="Set Duration Time">
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="form-group">
                            <label for="">Slot range and Time range</label>

                            @if(count($auction->slots))
                                @{{ initialSlotRange({!! '\''.$auction->slots.'\''!!}) }}
                            @endif
                            <div class="slot-range" v-for="(item,index) in slotRangeData" :key="index">
                                <input type="number"

                                       v-model="item.slot_number"
                                       @keyup="getSlotRage(item.slot_number,index)"
                                       name="slot_number[]" class="form-control"

                                >

                                <input type="text"
                                       v-model="item.slotRange"
                                       disabled readonly
                                       class="form-control">
                                <input type="text"
                                       class="form-control"
                                       :id="'slotDuration'+index"
                                       @click="getSlotDurationDate(index)"
                                       name="duration_time[]">

                                <button class="btn btn-primary btn-sm" style="margin-right:3px "
                                        @click.prevent="addRow()" v-if="index==0"   title="Add More">+</button>
                                <button class="btn btn-danger btn-sm "  @click.prevent="removeRow()"
                                        v-if="index==slotRangeData.length-1" title="Delete This Row">x</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">Auction Image</label>
                            <input type="file" class="form-control" name="images[]" accept="image/*" multiple>
                        </div>
                        <div>
                            @if(count($auction->medias))
                                <div class="product-image-container">
                                    @foreach($auction->medias as $key=>$media)
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
                    <div class="col-md-4"><br>

                        <div class="form-group">
                            <div v-if="statusShow == true">
                                @{{ setStatus({!! '\''.$auction->status.'\''!!}) }}
                            </div>



                            <label for="">Status *</label><br>
                            <input type="radio"
                                   name="status"
                                   value="Active" id="active"
                                    v-model="status"
                                   @input="setStatus('Active')"
                            >
                            <label for="active">Active</label>

                            {{--<input type="radio"--}}
                                   {{--name="status"--}}
                                   {{--value="Pause"--}}
                                   {{--id="pause"--}}
                                   {{--v-model="status"--}}
                                   {{--@input="setStatus('Pause')"--}}
                            {{-->--}}
                            {{--<label for="pause">Pause</label>--}}

                            <input type="radio"
                                   name="status"
                                   value="Inactive"
                                   id="inactive"
                                   v-model="status"
                                   @input="setStatus('inactive')"
                            >
                            <label for="inactive">Inactive</label>
                            @if ($errors->has('status'))
                                <div class="error">{{ $errors->first('status') }}</div>
                            @endif
                        </div>

                    </div>
{{--                    <div class="col-md-6" v-show="status =='Pause'"><br>--}}
{{--                        <div class="form-group">--}}
{{--                            <label for="">Re Open Time</label>--}}
{{--                            <input--}}
{{--                                    class="form-control"--}}
{{--                                    name="re_open_time"--}}
{{--                                    type="text"--}}
{{--                                    id="reOpentimepicker"--}}
{{--                                    value="{{$auction->re_open_time}}"--}}
{{--                                    placeholder="Re Open Time">--}}
{{--                        </div>--}}
{{--                    </div>--}}

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
