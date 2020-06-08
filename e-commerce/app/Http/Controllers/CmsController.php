<?php

namespace App\Http\Controllers;

use App\Cms;
use Illuminate\Http\Request;

class CmsController extends Controller
{
    public function index()
    {
        $allCms=Cms::all();
        return view('admin.pages.cms.manage',['allCms'=>$allCms]);
    }


    public function create()
    {

        return view('admin.pages.cms.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'page_url'=>'required',
            'section'=>'required',
        ]);
        Cms::create($request->except('files'));
        return redirect('/admin/cms/create')
            ->with(['type'=>'success','message'=>'CMS created Successfully']);
    }


    public function show(Cms $cms)
    {
        //
    }

    public function edit($id)
    {
        $cms=Cms::find($id);
        return view('admin.pages.cms.edit',['cms'=>$cms, 'id'=>$id]);
    }


    public function update(Request $request, $id){

        $request->validate([
            'name'=>'required',
            'page_url'=>'required',
            'section'=>'required',
        ]);
        $cms=Cms::find($id);
        $cms->update($request->except('files'));
        return redirect('/admin/cms')
            ->with(['type'=>'success','message'=>'Cms Updated Successfully']);
    }


    public function destroy(Request $request, $id)
    {
        $cms=Cms::find($id);
        $cms->delete();
        return back()
            ->with(['type'=>'success','message'=>'CMS Deleted Successfully']);
    }
}
