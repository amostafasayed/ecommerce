@extends('admin.admin')

@section('content')

    <div id="page-wrapper">
        <br>
        <div class="row site-forms">
            <form method="post" action="{{url('/admin/cms/'. $cms->id)}}">
                @csrf
                @method('patch')
                <div class="">
                    <div class="form-box-header">
                        + Add Cms
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="">Cms Name</label>
                            <input class="form-control"
                                   name="name"
                                   type="text"
                                   value="{{old('name', $cms->name)}}"
                                   placeholder="Name">

                            @if ($errors->has('name'))
                                <div class="error">{{ $errors->first('name') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="">Page Url <small>(after main url include back slash)</small></label>
                            <input  class="form-control"
                                    name="page_url"
                                    type="text"
                                    value="{{old('page_url', $cms->page_url)}}"
                                    placeholder="Page Url">

                            @if ($errors->has('page_url'))
                                <div class="error">{{ $errors->first('page_url') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="">Section</label>
                            <select  class="form-control"
                                     name="section"
                                     required
                                     placeholder="Select Section">
                                @foreach(['Section 1','Section 2','Section 3','Section 4',
                'Section 5','Section 6','Section 7','Section 8', 'Section 9', 'Section 10'] as $item)
                                    <option value="{{$item}}"
                                            @if(old('section', $cms->section) == $item) selected @endif
                                    > {{$item}}</option>
                                @endforeach
                            </select>

                            @if ($errors->has('section'))
                                <div class="error">{{ $errors->first('section') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="">Title</label>
                            <input class="form-control"
                                   name="title"
                                   type="text"
                                   value="{{old('title', $cms->title)}}"
                                   placeholder="Title">

                            @if ($errors->has('title'))
                                <div class="error">{{ $errors->first('title') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="">Sub Title</label>
                            <input class="form-control"
                                   name="sub_title"
                                   type="text"
                                   value="{{old('sub_title', $cms->sub_title)}}"
                                   placeholder="Sub Title">

                            @if ($errors->has('sub_title'))
                                <div class="error">{{ $errors->first('sub_title') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="">Content</label>
                            <textarea class="form-control" name="content" id="description">{{old('content', $cms->content)}}</textarea>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group"><br>
                            <label for="">Status *</label><br>
                            <input type="radio" checked name="is_active" value="1" id="active"
                                   @if(!old('is_active')) checked @endif
                                   @if(old('is_active', $cms->is_active) == '1') checked @endif
                            >
                            <label for="active">Active</label>

                            <input type="radio" name="is_active" value="0" id="inactive"
                                   @if(old('is_active', $cms->is_active) == '0') checked @endif
                            >
                            <label for="inactive">Inactive</label>
                            @if ($errors->has('is_active'))
                                <div class="error">{{ $errors->first('is_active') }}</div>
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