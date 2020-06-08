<?php

namespace App\Http\Controllers;

use App\Package;
use App\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class PackageController extends Controller
{


    public function index()
    {
        $packages=Package::all();
        return view('admin.pages.package.manage',['packages'=>$packages]);
    }


    public function create()
    {
        return view('admin.pages.package.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'price'=>'required',
            'credit'=>'required',

        ]);

        $package=Package::create($request->all());
        $file=$request->file('image');
        if($file){
                $extension = $file->getClientOriginalExtension();
                $name='package/'.time().'.'.$extension;
                Storage::disk('public')->put($name,  File::get($file));
            $package->update(['image'=>$name]);
        }
        return redirect('/admin/package/create')
            ->with(['type'=>'success','message'=>'Package created Successfully']);
    }


    public function show(Package $package)
    {
        //
    }


    public function edit($id)
    {
        $package=Package::find($id);

        return view('admin.pages.package.edit',['package'=> $package]);
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'name'=>'required',
            'price'=>'required',
            'credit'=>'required',
        ]);
        $package=Package::find($id);
        $packageImage=$package->image;
        $package->update($request->all());

        $file=$request->file('image');

        if($file){
            if($packageImage){
                Storage::disk('public')->delete($packageImage);
            }
            $extension = $file->getClientOriginalExtension();
            $name='package/'.time().'.'.$extension;
            Storage::disk('public')->put($name,  File::get($file));
            $package->update(['image'=>$name]);
        }
        return redirect('/admin/package')
            ->with(['type'=>'success','message'=>'Package Updated Successfully']);
    }


    public function destroy(Package $package)
    {
        $package->delete();
        return back()
            ->with(['type'=>'success','message'=>'Package Deleted Successfully']);
    }
}
