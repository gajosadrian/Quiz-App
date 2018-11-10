<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

class QuizController extends Controller
{
    public function __construct()
    {
        $this->middleware('uczestnik');
        $this->middleware('test')->except('finish');
    }

    public function start(Request $request)
    {
        $uczestnik = Uczestnik();
        // $uczestnik->banned = true;
        $uczestnik->data_rozpoczecia_testu = Carbon::now();
        $uczestnik->save();
        return response()->json('success', 200);
    }

    public function finish(Request $request)
    {
        $responses = array_filter($request->input('responses'), 'strlen');
        $timeLeft = $request->input('timeLeft');
        $uczestnik = Uczestnik();
        $uczestnik->czas = 3000 - $timeLeft;
        $uczestnik->data_zakonczenia_testu = Carbon::now();
        $uczestnik->odpowiedzi = $responses;
        $uczestnik->save();
        return response()->json([
            'correctResponsesAmount' => sizeof(getCorrectQuestionIds($responses)),
            'time' => $uczestnik->czas,
        ]);
        // return response()->json('success', 200);
    }

    public function getQuestions()
    {
        $pytania = getPytania();
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
                shuffle($responses);
                $questions[] = [
                    'id' => getRawQuestionId($index, $questionId),
                    'text' => $question['text'],
                    'image' => $question['image'],
                    'responses' => $responses,
                ];
            }
        }
        shuffle($questions);

        return response()->json($questions);
    }
}
