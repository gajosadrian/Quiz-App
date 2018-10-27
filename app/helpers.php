<?php

function Uczestnik()
{
    $id = session('uczestnik', false);
    if (!$id) return false;
    return App\Uczestnik::where('nazwa', $id)->first();
}

function UczestnikLogout()
{
    session()->pull('uczestnik');
}
