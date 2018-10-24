<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Uczestnik;

class UserController extends Controller
{
    public function tryLogin(Request $request)
    {
        $this->middleware('niezalogowany');
        $request->validate([
            'login' => 'required|max:255',
        ]);

        $login = $request->input('login');
        $uczestnik = Uczestnik::where('nazwa', $login)->first();

        if ($uczestnik) {
            Session::put('uczestnik', $login);
            return redirect()->route('home');
        } else {
            return redirect()->back()->withErrors(['Podany login nie istnieje!']);
        }
    }

    public function logout(Request $request)
    {
        Session::pull('uczestnik');
        return redirect()->route('index');
    }
}
