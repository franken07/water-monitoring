<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    // Display the Sensor page
    public function sensor()
    {
        return view('sensor');
    }
}
