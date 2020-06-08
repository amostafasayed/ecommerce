@extends('admin.admin')

@section('content')

    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <p class="pageTitle">
                    <i class="fa fa-cogs"></i>  Manage CMS
                </p>
            </div>
            <div class="col-md-12 ">
                <div class="overflow">
                    <table class="table table-striped  table-bordered table-hover" id="manageTable">
                        <thead>
                        <tr>
                            <th>SL </th>
                            <th>Name</th>
                            <th>Page Url</th>
                            <th>Section</th>
                            <th>Title</th>
                            <th>Sub Title</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($allCms as $key=>$item)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$item->name}}</td>
                                <td>{{$item->page_url}}</td>
                                <td>{{$item->section}}</td>
                                <td>{{$item->title}}</td>
                                <td>{{$item->sub_title}}</td>
                                <td>{{$item->is_active}}</td>
                                <td>
                                    <div>
                                        <a href="{{url('/admin/cms/'.$item->id).'/edit'}}" title="Edit">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <a  href="#" @click.prevent="deleteMe('{{'/admin/cms/'.$item->id}}')" title="Delete">
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