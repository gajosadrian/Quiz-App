<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Auth;
use App\Uczestnik;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin', [
            'user' => Auth::user(),
            'currentTime' => Carbon::now(),
        ]);
    }

    public function responses()
    {
        return view('responses', [
            'uczestnicy' => Uczestnik::orderBy('odpowiedzi', 'desc')->orderBy('czas')->where('grupa', getPytaniaId())->get(),
        ]);
    }

    public function questions()
    {
        return view('questions', [
            'pytania' => getPytania(),
        ]);
    }
}
