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

    public function responses(string $grupa = null)
    {
        $grupa = $grupa ?? getPytaniaId();
        foreach (Uczestnik::where('grupa', $grupa)->get() as $uczestnik) {
            $uczestnik->calcResponses();
        }
        return view('responses', [
            'uczestnicy' => Uczestnik::orderBy('_correct', 'desc')->orderBy('czas')->where('grupa', $grupa)->get(),
        ]);
    }

    public function questions()
    {
        return view('questions', [
            'pytania' => getPytania(),
        ]);
    }

    public function userResponses(int $uczestnik_id)
    {
        $uczestnik = Uczestnik::find($uczestnik_id);;
        if (!$uczestnik or !$uczestnik->odpowiedzi) {
            abort(404);
        }

        return view('user_responses', [
            'uczestnik' => $uczestnik,
            'correctQuestionsAmount' => count($uczestnik->correctQuestionIds),
            'pytania' => getPytania($uczestnik->grupa),
        ]);
    }
}
