<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        // Dashboard page
        return view('admin.index');
   
    }
}
