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
        if (!$request->session()->exists('uczestnik')) {
            return redirect('/');
        }

        return $next($request);
    }
}
