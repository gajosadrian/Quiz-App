<?php

function Uczestnik() {
    $id = session('uczestnik', false);
    if (!$id) return false;
    return App\Uczestnik::where('nazwa', $id)->first();
}

function UczestnikLogout() {
    session()->pull('uczestnik');
}

function randomGen($min, $max, $quantity) {
    $numbers = range($min, $max);
    shuffle($numbers);
    return array_slice($numbers, 0, $quantity);
}

function getPytania()
{
    return include public_path('quiz-app/pytania1.php');
}
function getGroupIndex($questionRawId)
{
    return (int) substr($questionRawId, 1, 2);
}
function getQuestionId($questionRawId)
{
    return (int) substr($questionRawId, 3);
}
function getRawQuestionId($groupIndex, $questionId)
{
    return (int) ('1' . sprintf('%02d', $groupIndex) . $questionId);
}
function getCorrectQuestionIds($responses)
{
    $array = [];
    $pytania = getPytania();
    foreach ($responses as $questionRawId => $responseId) {
        if ($responseId > 0) {
            $group = getGroupIndex($questionRawId);
            $questionId = getQuestionId($questionRawId);
            $question = $pytania[$group]['questions'][$questionId];
            $response = $question['responses'][$responseId - 1];
            if (isset($response[1]) and $response[1]) {
                $array[] = $questionRawId;
            }
        }
    }
    return $array;
}
