@extends('admin.admin')

@section('content')

    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <p class="pageTitle">
                    <i class="fa fa-cogs"></i>  manage customer
                </p>
            </div>
            <div class="col-md-12 ">
                <div class="overflow">
                    <table class="table table-striped  table-bordered table-hover" id="manageTable">
                        <thead>
                        <tr>
                            <th>SL </th>
                            <th>Name</th>
                            <th>Mobile</th>
                            <th>Email</th>
                            <th>Address</th>
                            <th>Status</th>
{{--                            <th>Action</th>--}}
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($customers as $key => $customer)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$customer->name}}</td>
                                <td>{{$customer->contact ? $customer->contact->mobile : ''}}</td>
                                <td>{{$customer->email}}</td>
                                <td>
                                    {{$customer->contact ? $customer->contact->address : ''}} <br>
                                    Post Code: {{$customer->contact ? $customer->contact->post_code : ''}} <br>
                                    City :{{$customer->contact ? $customer->contact->city : ''}} <br>
                                    District : {{$customer->contact ? $customer->contact->district : ''}} <br>
                                </td>
                                <td> {{$customer->is_active ? 'Active' : 'Inactive'}}</td>
{{--                                <td>--}}
{{--                                    <div>--}}
{{--                                        <a href="{{url('/admin/category/'.$customer->id).'/edit'}}" title="Edit">--}}
{{--                                            <i class="fa fa-edit"></i>--}}
{{--                                        </a>--}}
{{--                                        <a  href="#" @click.prevent="deleteMe('{{'/admin/category/'.$customer->id}}')" title="Delete">--}}
{{--                                            <i class="fa fa-trash"></i>--}}
{{--                                        </a>--}}
{{--                                    </div>--}}
{{--                                </td>--}}

                            </tr>
                        @endforeach

                        </tbody>

                    </table>
                </div>

            </div>
        </div>
    </div>

@endsection