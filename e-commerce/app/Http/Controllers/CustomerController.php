<?php

namespace App\Http\Controllers;

use App\Contact;
use App\Customer;
use App\User;
use Illuminate\Http\Request;

class CustomerController extends Controller
{

    public function index()
    {
        $customers = User::whereRole('user')->get();
        return view('admin.pages.customer.manage',['customers'=>$customers]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Customer $customer)
    {
        //
    }


    public function edit(Customer $customer)
    {
        //
    }


    public function update(Request $request, Customer $customer)
    {
        //
    }


    public function destroy(Customer $customer)
    {
        //
    }
}
