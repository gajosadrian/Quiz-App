<?php

namespace App\Http\Middleware;

use Closure;

class Test
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $uczestnik = Uczestnik();

        if ($uczestnik->banned) {
            UczestnikLogout();
            return redirect()->route('index')->withErrors([ 'Login został wykorzystany! Jeśli chcecie poznać więcej szczegołów związanych z Waszymi odpowiedziami, prosimy o kontakt: <span class="font-w600">grzegorz@doniepodleglej.pl</span>. Prześlemy wasze odpowiedzi wraz z modelem. Dziękujemy za udział, Organizatorzy quizu.' ]);
        }
        if (!$uczestnik->test_kontrolny and $request->route()->getName() != 'test_kontrolny') {
            return redirect()->route('test_kontrolny')->withErrors([ 'Najpierw wypełnij test kontrolny!' ]);
        }

        return $next($request);
    }
}
