<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class AdminAuthController extends Controller
{
    public function login () {
        return view('admin.pages.auth.login');
    }
}
