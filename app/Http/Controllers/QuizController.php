<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function __construct()
    {
        $this->middleware('uczestnik');
        $this->middleware('test');
    }

    public function getQuestions(Request $request)
    {
        $uczestnik = Uczestnik();
        $uczestnik->banned = true;
        $uczestnik->save();

        return response()->json([
            [
                'text' => 'Pytanie 1',
                'responses' => ['Odpowiedź 1.1', 'Odpowiedź 1.2', 'Odpowiedź 1.3'],
            ],
            [
                'text' => 'Pytanie 2',
                'responses' => ['Odpowiedź 2.1', 'Odpowiedź 2.2', 'Odpowiedź 2.3'],
            ],
        ]);
    }
}
