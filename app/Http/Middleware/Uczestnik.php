<?php

namespace App\Http\Middleware;

use Closure;

class Uczestnik
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
        if ( !Uczestnik() ) {
            return redirect()->route('index')->withErrors([ 'Najpierw musisz się zalogować!' ]);
        }

        return $next($request);
    }
}
