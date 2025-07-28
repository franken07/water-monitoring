<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class contacts_controller extends Controller
{
    public function contact()
    {
        return view('contact');
    }
}
