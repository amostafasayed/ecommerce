@extends('admin.admin')

@section('content')

    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <p class="pageTitle">
                    <i class="fa fa-cogs"></i>  manage categories
                </p>
            </div>
            <div class="col-md-12 ">
                <div class="overflow">
                    <table class="table table-striped  table-bordered table-hover" id="manageTable">
                        <thead>
                        <tr>
                            <th>SL </th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($categories as $key=>$category)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$category->name}}</td>
                                <td>{{$category->description}}</td>
                                <td>{{$category->status}}</td>
                                <td>
                                  <div>
                                      <a href="{{url('/admin/category/'.$category->id).'/edit'}}" title="Edit">
                                          <i class="fa fa-edit"></i>
                                      </a>
                                      <a  href="#" @click.prevent="deleteMe('{{'/admin/category/'.$category->id}}')" title="Delete">
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