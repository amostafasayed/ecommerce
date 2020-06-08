@extends('admin.admin')

@section('content')

    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <p class="pageTitle">
                    <i class="fa fa-cogs"></i> Manage Package
                </p>
            </div>
            <div class="col-md-12">
                <div class="overflow">
                    <table class="table table-striped  table-bordered table-hover" id="manageTable">
                        <thead>
                        <tr>
                            <th>SL</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Credits</th>
                            <th>Image</th>
                            <th>Action</th>


                        </tr>
                        </thead>
                        <tbody>
                        @foreach($packages as $key=>$package)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$package->name}}</td>
                                <td>{{$package->price}}</td>
                                <td>{{$package->credit}}</td>
                                <td>
                                    @if($package->image)
                                        <img src="{{asset("storage/$package->image")}}"
                                             style="height: 80px;width: 80px;">
                                    @endif
                                </td>


                                <td>
                                    <div>
                                        <a href="{{url('/admin/package/'.$package->id).'/edit'}}" title="Edit">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <a href="#"
                                           @click.prevent="deleteMe('{{'/admin/package/'.$package->id}}')"
                                           title="Delete">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </div>
                                </td>

                            </tr>
                        @endforeach

                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- /#page-wrapper -->

@endsection