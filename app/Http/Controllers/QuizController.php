<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

class QuizController extends Controller
{
    public function __construct()
    {
        $this->middleware('uczestnik');
        $this->middleware('test');
    }

    public function start(Request $request)
    {
        $uczestnik = Uczestnik();
        $uczestnik->banned = true;
        $uczestnik->data_rozpoczecia_testu = Carbon::now();
        // TODO:
        // $uczestnik->save();
        return response()->json('success', 200);
    }

    public function finish(Request $request)
    {
        //
    }

    public function getQuestions(Request $request)
    {
        return response()->json([
            [
                'id' => 23,
                'text' => 'Pytanie 1',
                'responses' => [['id' => 1, 'text' => 'Odpowiedź 1.1'], ['id' => 2, 'text' => 'Odpowiedź 1.2'], ['id' => 3, 'text' => 'Odpowiedź 1.3'], ['id' => 4, 'text' => 'Odpowiedź 1.4']],
            ],
            [
                'id' => 12,
                'text' => 'Pytanie 2',
                'responses' => [['id' => 1, 'text' => 'Odpowiedź 2.1'], ['id' => 2, 'text' => 'Odpowiedź 2.2'], ['id' => 3, 'text' => 'Odpowiedź 2.3'], ['id' => 4, 'text' => 'Odpowiedź 2.4']],
            ],
        ]);
    }
}
