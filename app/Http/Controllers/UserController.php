<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
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
            $uczestnik->last_ip = $request->ip();
            $uczestnik->data_ostatniego_logowania = Carbon::now();
            $uczestnik->user_agent = $request->header('User-Agent');
            $uczestnik->save();
            session([ 'uczestnik' => $login ]);
            return redirect()->route('test_kontrolny');
        } else {
            return redirect()->back()->withErrors([ 'Podany login jest błędny!' ]);
        }
    }

    public function logout(Request $request)
    {
        UczestnikLogout();
        return redirect()->route('index');
    }
}
