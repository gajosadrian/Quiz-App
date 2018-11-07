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
