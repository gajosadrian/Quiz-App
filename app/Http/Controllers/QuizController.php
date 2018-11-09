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
        $responses = array_filter($request->input('responses'), 'strlen');
        $timeLeft = $request->input('timeLeft');
        $uczestnik = Uczestnik();
        $uczestnik->czas = $timeLeft;
        $uczestnik->data_zakonczenia_testu = Carbon::now();
        $uczestnik->odpowiedzi = $responses;
        $uczestnik->save();
        return response()->json($responses);
        // return response()->json('success', 200);
    }

    public function getQuestions()
    {
        $pytania = include public_path('quiz-app/' . getPytaniaId() . '.php');
        $questions = [];

        foreach ($pytania as $index => $v) {
            $drawnQuestionIds = randomGen(1, sizeof($v['questions']), $v['amount']);
            foreach ($drawnQuestionIds as $questionId) {
                $question = $v['questions'][$questionId];
                $responses = [];
                foreach ($question['responses'] as $responseIndex => $response) {
                    $responses[] = [
                        'id' => $responseIndex + 1,
                        'text' => $response[0],
                    ];
                }
                $questions[] = [
                    'id' => getRawQuestionId($index, $questionId),
                    'text' => $question['text'],
                    'image' => $question['image'],
                    'responses' => shuffle($responses),
                ];
            }
        }
        shuffle($questions);

        return response()->json($questions);

        // return response()->json([
        //     [
        //         'id' => 23,
        //         'text' => 'Pytanie 1',
        //         'image' => null,
        //         'correct' => 1,
        //         'responses' => [['id' => 1, 'text' => 'Odpowiedź 1.1'], ['id' => 2, 'text' => 'Odpowiedź 1.2'], ['id' => 3, 'text' => 'Odpowiedź 1.3'], ['id' => 4, 'text' => 'Odpowiedź 1.4']],
        //     ],
        //     [
        //         'id' => 12,
        //         'text' => 'Pytanie 2',
        //         'image' => 'https://www.happybarok.pl/images/happybarok/2000-3000/Tapeta-scienna-Sauvage_%5B2572%5D_480.jpg',
        //         'correct' => 1,
        //         'responses' => [['id' => 1, 'text' => 'Odpowiedź 2.1'], ['id' => 2, 'text' => 'Odpowiedź 2.2'], ['id' => 3, 'text' => 'Odpowiedź 2.3'], ['id' => 4, 'text' => 'Odpowiedź 2.4']],
        //     ],
        //     [
        //         'id' => 15,
        //         'text' => 'Pytanie 3',
        //         'image' => null,
        //         'responses' => [['id' => 1, 'text' => 'Odpowiedź 3.1'], ['id' => 2, 'text' => 'Odpowiedź 3.2'], ['id' => 3, 'text' => 'Odpowiedź 3.3'], ['id' => 4, 'text' => 'Odpowiedź 3.4'], ['id' => 5, 'text' => 'Odpowiedź 3.5']],
        //     ],
        // ]);
    }
}
