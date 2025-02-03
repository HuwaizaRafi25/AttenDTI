<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function applicationSetting()
    {
        return view('menus.settings');
    }
}
