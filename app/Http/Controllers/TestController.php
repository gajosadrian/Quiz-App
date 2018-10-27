<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function __construct()
    {
        $this->middleware('uczestnik');
        $this->middleware('test');
    }

    public function index()
    {
        return view('test');
    }
}
