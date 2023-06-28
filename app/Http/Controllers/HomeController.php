<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    //guest
    public function index()
    {
        return view('landing');
    }

    //member
    public function indexmember()
    {
        return view('member.homepage');
    }
    public function aboutusmember()
    {
        return view('member.aboutus');
    }

    //admin
    public function indexadmin()
    {
        return view('admin.homepage');
    }
    public function aboutusadmin()
    {
        return view('admin.aboutus');
    }
}
