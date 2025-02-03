<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SupportController extends Controller
{
    public function index()
    {
        return view('menus.support_center');
    }

    public function contactSupport()
    {
        return view('menus.contact_support');
    }
}
