<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RolePermissionController extends Controller
{
    public function index(){
        return view('menus.role_permission');
    }
}
