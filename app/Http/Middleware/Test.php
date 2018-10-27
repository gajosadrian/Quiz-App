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
            return redirect()->route('index')->withErrors([ 'Test już był uruchamiany!' ]);
        }
        if (!$uczestnik->test_kontrolny and $request->route()->getName() != 'test_kontrolny') {
            return redirect()->route('test_kontrolny')->withErrors([ 'Najpierw wypełnij test kontrolny!' ]);
        }

        return $next($request);
    }
}
